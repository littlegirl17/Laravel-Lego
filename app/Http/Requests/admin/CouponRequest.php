<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
                'name_coupon' => 'required|string|max:255', // Điều kiện: bắt buộc, chuỗi và tối đa 255 ký tự
                'code' => 'required|string|unique:coupons,code|max:50', // Điều kiện: bắt buộc, chuỗi, duy nhất trong bảng coupons, tối đa 50 ký tự
                'type' => 'required|in:0,1', // Điều kiện: bắt buộc và phải là một trong các giá trị đã xác định (ví dụ: percentage hoặc amount)
                'discount' => 'required|numeric|min:0', // Điều kiện: bắt buộc, phải là số và không âm
                'total' => 'required|numeric|min:1', // Điều kiện: bắt buộc, phải là số và lớn hơn hoặc bằng 1
                'status' => 'required|in:0,1', // Điều kiện: bắt buộc và phải là 0 hoặc 1
                'date_start' => 'required', // Điều kiện: bắt buộc và phải là 0 hoặc 1
                'date_end' => 'required', // Điều kiện: bắt buộc và phải là 0 hoặc 1
            ];
        }
        return [];
    }
    public function messages(): array
    {
        return [
            'name_coupon.required' => 'Vui lòng nhập tên coupon.',
            'name_coupon.string' => 'Tên coupon phải là một chuỗi.',
            'name_coupon.max' => 'Tên coupon không được vượt quá 255 ký tự.',

            'code.required' => 'Vui lòng nhập mã giảm giá.',
            'code.string' => 'Mã giảm giá phải là một chuỗi.',
            'code.unique' => 'Mã giảm giá này đã tồn tại. Vui lòng chọn mã khác.',
            'code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',

            'type.required' => 'Vui lòng chọn loại giảm giá.',
            'type.in' => 'Loại giảm giá phải là một trong các giá trị: percentage, amount.',

            'discount.required' => 'Vui lòng nhập giá trị giảm giá.',
            'discount.numeric' => 'Giá trị giảm giá phải là một số.',
            'discount.min' => 'Giá trị giảm giá không được âm.',

            'total.required' => 'Vui lòng nhập tổng số.',
            'total.numeric' => 'Tổng số phải là một số.',
            'total.min' => 'Tổng số phải lớn hơn hoặc bằng 1.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái phải là 0 hoặc 1.',

            'date_start.required' => 'Vui lòng chọn ngày bắt đầu.',
            'date_end.required' => 'Vui lòng chọn ngày kết thúc.',
        ];
    }
}
