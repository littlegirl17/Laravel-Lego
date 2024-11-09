<?php

namespace App\Http\Requests\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdministrationEditRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            return [
                'fullname' => 'required|string|max:255',
                'username' => 'required|string|unique:administrations,username,' .  auth()->guard('admin')->user()->id,
                'admin_group_id' => 'required|exists:administration_groups,id',
                'email' => 'required|email|unique:administrations,email,' .  auth()->guard('admin')->user()->id,
                'password' => 'nullable|confirmed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:0,1',
            ];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'fullname.string' => 'Họ tên phải là một chuỗi ký tự.',
            'fullname.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.string' => 'Tên đăng nhập phải là một chuỗi ký tự.',
            'username.unique' => 'Tên đăng nhập này đã tồn tại.',

            'admin_group_id.required' => 'Vui lòng chọn nhóm quản trị.',
            'admin_group_id.exists' => 'Nhóm quản trị được chọn không tồn tại.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',

            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

            'image.image' => 'Tệp phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái phải là 0 hoặc 1.',
        ];
    }
}