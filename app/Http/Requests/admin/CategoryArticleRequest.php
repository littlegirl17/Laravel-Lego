<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryArticleRequest extends FormRequest
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
                'title' => 'required|string|max:255',
                'description_short' => 'nullable|string',
                'description' => 'nullable|string',
                'status' => 'required', // Thêm 'boolean' để xác thực đúng định dạng
                'image' => 'nullable|image',
            ];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'description_short.string' => 'Mô tả ngắn phải là một chuỗi.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái phải là true hoặc false.',
            'image.image' => 'Tệp tin phải là hình ảnh.',
        ];
    }
}
