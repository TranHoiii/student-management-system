<?php

namespace App\Services;

use App\Mail\ConsultationRequestReceived;
use App\Models\ConsultationRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ConsultationService
{
    /**
     * Store a new consultation request with input sanitization and spam protection.
     *
     * @param array $data
     * @return ConsultationRequest
     * @throws Exception
     */
    public function createRequest(array $data): ConsultationRequest
    {
        // 1. Sanitize Inputs
        $sanitizedData = [
            'full_name' => strip_tags(trim($data['full_name'])),
            'phone' => trim($data['phone']),
            'email' => isset($data['email']) ? filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL) : null,
            'company_name' => isset($data['company_name']) ? strip_tags(trim($data['company_name'])) : null,
            'service_id' => (int) $data['service_id'],
            'message' => strip_tags(trim($data['message'])),
            'status' => 'pending',
        ];

        // 2. Basic Anti-Spam Check
        // Check if there is an existing request from the same phone number within the last 5 minutes
        $spamCheck = ConsultationRequest::where('phone', $sanitizedData['phone'])
            ->where('created_at', '>=', now()->subMinutes(5))
            ->exists();

        if ($spamCheck) {
            throw new Exception('Bạn đã gửi yêu cầu tư vấn gần đây. Vui lòng đợi 5 phút trước khi gửi yêu cầu tiếp theo.');
        }

        // 3. Save to database using transaction and handle exceptions
        DB::beginTransaction();
        try {
            $request = ConsultationRequest::create($sanitizedData);
            DB::commit();

            $this->sendAdminNotification($request);

            return $request;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error saving consultation request: ' . $e->getMessage(), [
                'input' => $data,
                'exception' => $e
            ]);
            throw new Exception('Có lỗi xảy ra trong quá trình xử lý yêu cầu của bạn. Vui lòng thử lại sau.');
        }
    }

    private function sendAdminNotification(ConsultationRequest $request): void
    {
        try {
            Mail::to(config('company.admin_email'))->send(
                new ConsultationRequestReceived($request->loadMissing('service'))
            );
        } catch (Throwable $e) {
            Log::error('Error sending consultation request notification: ' . $e->getMessage(), [
                'consultation_request_id' => $request->id,
                'admin_email' => config('company.admin_email'),
                'exception' => $e,
            ]);
        }
    }

    /**
     * Get all consultation requests for the admin area, ordered by latest.
     *
     * @param string|null $statusFilter
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedRequests(?string $statusFilter = null)
    {
        $query = ConsultationRequest::with('service')->latest();

        if ($statusFilter && in_array($statusFilter, ['pending', 'processing', 'completed', 'cancelled'])) {
            $query->where('status', $statusFilter);
        }

        return $query->paginate(15);
    }

    /**
     * Update the status of a consultation request.
     *
     * @param int $id
     * @param string $status
     * @return ConsultationRequest
     * @throws Exception
     */
    public function updateRequestStatus(int $id, string $status): ConsultationRequest
    {
        if (!in_array($status, ['pending', 'processing', 'completed', 'cancelled'])) {
            throw new Exception('Trạng thái cập nhật không hợp lệ.');
        }

        $request = ConsultationRequest::findOrFail($id);

        DB::beginTransaction();
        try {
            $request->update(['status' => $status]);
            DB::commit();

            return $request;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating consultation request status (ID: {$id}): " . $e->getMessage());
            throw new Exception('Không thể cập nhật trạng thái yêu cầu.');
        }
    }

    /**
     * Find a consultation request by ID.
     *
     * @param int $id
     * @return ConsultationRequest
     */
    public function findRequest(int $id): ConsultationRequest
    {
        return ConsultationRequest::with('service')->findOrFail($id);
    }
}
