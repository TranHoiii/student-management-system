<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ConsultationService;
use Exception;
use Illuminate\Http\Request;

class AdminConsultationController extends Controller
{
    protected ConsultationService $consultationService;

    /**
     * Inject ConsultationService.
     */
    public function __construct(ConsultationService $consultationService)
    {
        $this->consultationService = $consultationService;
    }

    /**
     * Display a listing of the consultation requests.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $consultations = $this->consultationService->getPaginatedRequests($status);

        return view('admin.consultations.index', compact('consultations', 'status'));
    }

    /**
     * Display the specified consultation request details.
     */
    public function show(int $id)
    {
        try {
            $consultation = $this->consultationService->findRequest($id);
            return view('admin.consultations.show', compact('consultation'));
        } catch (Exception $e) {
            return redirect()->route('admin.consultations.index')->with('error', 'Không tìm thấy yêu cầu tư vấn.');
        }
    }

    /**
     * Update the status of the specified consultation request.
     */
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        try {
            $this->consultationService->updateRequestStatus($id, $request->get('status'));
            return redirect()->back()->with('success', 'Cập nhật trạng thái yêu cầu tư vấn thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
