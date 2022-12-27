<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class AddProvinceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // chỉnh false ở đây thành true nhé
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // cú pháp tạo: php artisan make:request <tên request>
        // để tạo form request phải biết là nghiệp vụ j, bảng nào cần:
        // ở đây là nghiệp vụ Thêm mới, bảng Provinces thì tên file là AddProvinceRequest
        // Update làm tương tự
        // định nghĩa các thuộc tính cần validate: ở đây là bắt buộc nhập, tối thiểu 2, tối đa 100

        return [
            'name' => 'bail|required|min:2|max:100'
        ];
    }
}
