<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
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
            $categoryId = $this->route('id'); // Lấy giá trị của {id} từ route
            return [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:categories,slug,' . $categoryId,
                'sort_order' => 'nullable|integer',
                'status' => 'required|in:0,1',
                'parent_id' => 'nullable|exists:categories,id',
                'description' => 'nullable|string',
                'choose' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ];
        }
        return [];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',

            'slug.required' => 'Vui lòng nhập slug.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.unique' => 'Slug này đã tồn tại.',

            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái phải là 0 hoặc 1.',

            'parent_id.exists' => 'Danh mục cha không hợp lệ.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'choose.boolean' => 'Lựa chọn phải là true hoặc false.',

            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ];
    }
}
