<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
                'status' => 'required|boolean',
                'image' => 'nullable|image',
                'categoryArticle_id' => 'required|exists:category_articles,id'
            ];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',

            'description_short.string' => 'Mô tả ngắn phải là một chuỗi ký tự.',

            'description.string' => 'Mô tả phải là một chuỗi ký tự.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.boolean' => 'Trạng thái phải là bật hoặc tắt',

            'image.image' => 'Ảnh phải là một định dạng hình ảnh hợp lệ.',

            'categoryArticle_id.required' => 'Vui lòng chọn danh mục.',
            'categoryArticle_id.exists' => 'Danh mục đã chọn không tồn tại.',
        ];
    }
}