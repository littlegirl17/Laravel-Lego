<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'fullname' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'nullable|string|min:8|confirmed',
                'phone' => 'required|unique:users,phone',
                'admin_group_id' => 'required|exists:administration_groups,id',
                'image' => 'nullable|image',
            ];
        }
        return [];
    }
    public function messages(): array
    {
        return [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'fullname.string' => 'Họ tên phải là một chuỗi.',
            'fullname.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.string' => 'Tên đăng nhập phải là một chuỗi.',
            'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',

            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.string' => 'Địa chỉ email phải là một chuỗi.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            'email.unique' => 'Địa chỉ email này đã được sử dụng.',

            'password.string' => 'Mật khẩu phải là một chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            'phone.unique' => 'Số điện thoại này đã được sử dụng.',

            'admin_group_id.required' => 'Vui lòng chọn nhóm quản trị.',
            'admin_group_id.exists' => 'Nhóm quản trị không tồn tại.',

            'image.image' => 'Tệp tải lên phải là một hình ảnh.',

        ];
    }
}
