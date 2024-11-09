<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AdministrationRequest extends FormRequest
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
                'fullname' => 'required | string | max:255',
                'username' => 'required | string | unique:administrations,username',
                'admin_group_id' => 'required ',
                'email' => 'required | email | unique:administrations,email',
                'password' => 'required | confirmed',
                'image' => 'nullable',
                'status' => 'required | in:0,1',
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

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái phải là 0 hoặc 1.',
        ];
    }
}
