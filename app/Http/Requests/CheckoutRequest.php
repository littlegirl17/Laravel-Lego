<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required',
                'province' => 'required|string|max:100',
                'district' => 'required|string|max:100',
                'ward' => 'required|string|max:100',
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên đặt hàng.',
            'name.string' => 'Tên phải là một chuỗi.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'phone.required' => 'Số điện thoại là bắt buộc.',

            'province.required' => 'Tỉnh/Thành phố là bắt buộc.',
            'province.string' => 'Tỉnh/Thành phố phải là một chuỗi.',
            'province.max' => 'Tỉnh/Thành phố không được vượt quá 100 ký tự.',

            'district.required' => 'Quận/Huyện là bắt buộc.',
            'district.string' => 'Quận/Huyện phải là một chuỗi.',
            'district.max' => 'Quận/Huyện không được vượt quá 100 ký tự.',

            'ward.required' => 'Phường/Xã là bắt buộc.',
            'ward.string' => 'Phường/Xã phải là một chuỗi.',
            'ward.max' => 'Phường/Xã không được vượt quá 100 ký tự.',
        ];
    }
}