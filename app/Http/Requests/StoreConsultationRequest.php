<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Anyone can submit a consultation request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^(0|\+84)[0-9]{9,10}$/'],
            'email' => 'nullable|email|max:255',
            'company_name' => 'nullable|string|max:255',
            'service_id' => 'required|exists:services,id',
            'message' => 'required|string|min:10|max:3000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập họ và tên của bạn.',
            'full_name.string' => 'Họ và tên phải là chuỗi ký tự hợp lệ.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ.',
            'phone.regex' => 'Số điện thoại không đúng định dạng Việt Nam (ví dụ: 0986039287 hoặc +84986039287).',
            
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            
            'company_name.string' => 'Tên công ty phải là chuỗi ký tự.',
            'company_name.max' => 'Tên công ty không được vượt quá 255 ký tự.',
            
            'service_id.required' => 'Vui lòng chọn dịch vụ bạn cần tư vấn.',
            'service_id.exists' => 'Dịch vụ đã chọn không tồn tại trên hệ thống.',
            
            'message.required' => 'Vui lòng nhập nội dung yêu cầu tư vấn.',
            'message.min' => 'Nội dung yêu cầu phải có ít nhất 10 ký tự để chúng tôi có đủ thông tin hỗ trợ.',
            'message.max' => 'Nội dung yêu cầu không được vượt quá 3000 ký tự.',
        ];
    }
}
