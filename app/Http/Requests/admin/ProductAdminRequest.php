<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductAdminRequest extends FormRequest
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
                'slug' => 'required|unique:products,slug|max:255',
                'description' => 'nullable',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|max:2048',
                'status' => 'required',
                'view' => 'nullable|min:0',
                'outstanding' => 'nullable',
            ];
        }
        return [];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là một chuỗi.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'slug.required' => 'Slug sản phẩm là bắt buộc.',
            'slug.unique' => 'Slug sản phẩm đã tồn tại.',
            'slug.max' => 'Slug sản phẩm không được vượt quá 255 ký tự.',

            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không tồn tại.',

            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là một số.',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0.',

            'image.image' => 'Hình ảnh sản phẩm không hợp lệ.',
            'image.mimes' => 'Hình ảnh sản phẩm phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Hình ảnh sản phẩm không được vượt quá 2MB.',

            'status.required' => 'Trạng thái sản phẩm là bắt buộc.',

            'view.min' => 'Lượt xem sản phẩm không được nhỏ hơn 0.',

        ];
    }
}
