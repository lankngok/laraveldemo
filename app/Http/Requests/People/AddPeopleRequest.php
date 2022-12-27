<?php

namespace App\Http\Requests\People;

use Illuminate\Foundation\Http\FormRequest;

class AddPeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // ở đây validate:
        /**
         * name: bắt buộc, tối thiểu 3, tối đa 100
         * avatar: bắt buộc, theo đúng định dạng png,jpg,jpeg,webp,jfif
         * birthday: bắt buộc, đúng định dạng ngày tháng
         * about: bắt buộc nhập
        */
        return [
            'name' => "bail|required|min:3|max:100",
            'avatar' => 'bail|required|mimes:png,jpg,jpeg,webp,jfif',
            'birthday' => 'bail|required|date',
            'about' => 'bail|required'
        ];
    }
}
