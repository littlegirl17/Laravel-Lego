<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'verification_code' => 'required',
        ];
    }
    public function messages()
    {
        return [

            'verification_code.required' => 'Vui lòng nhập mã xác nhận',
        ];
    }
}
