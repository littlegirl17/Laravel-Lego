<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        return [
            'image' => 'nullable',
            'fullname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|digits_between:10,11|unique:users,phone,' . Auth::user()->id,
            'province' => 'nullable',
            'district' => 'nullable',
            'ward' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'image.nullable' => 'Ảnh là tùy chọn.',
            'fullname.required' => 'Họ và tên là bắt buộc.',
            'fullname.string' => 'Họ và tên phải là một chuỗi.',
            'fullname.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'name.required' => 'Tên đăng nhập là bắt buộc.',
            'name.string' => 'Tên đăng nhập phải là một chuỗi.',
            'name.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'province.nullable' => 'Tỉnh là tùy chọn.',
            'district.nullable' => 'Quận/Huyện là tùy chọn.',
            'ward.nullable' => 'Phường/Xã là tùy chọn.',
        ];
    }
}
