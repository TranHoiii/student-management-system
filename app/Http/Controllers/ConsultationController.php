<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Services\ConsultationService;
use Exception;

class ConsultationController extends Controller
{
    protected ConsultationService $consultationService;

    /**
     * Inject consultation service.
     */
    public function __construct(ConsultationService $consultationService)
    {
        $this->consultationService = $consultationService;
    }

    /**
     * Store a new consultation request in the system.
     *
     * @param StoreConsultationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreConsultationRequest $request)
    {
        try {
            // Get validated data from Form Request
            $validatedData = $request->validated();
            
            // Delegate creation logic to Service Layer
            $this->consultationService->createRequest($validatedData);

            return redirect()->back()->with('success', 'Yêu cầu tư vấn của bạn đã được gửi thành công! Hộ kinh doanh THM sẽ liên hệ với bạn qua số điện thoại sớm nhất có thể.');
        } catch (Exception $e) {
            // Catch custom exception messages (e.g. spam protection) and pass back to the user
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
