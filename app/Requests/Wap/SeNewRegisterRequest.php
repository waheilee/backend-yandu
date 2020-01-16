<?php

namespace App\Requests\Wap;

use Illuminate\Foundation\Http\FormRequest;

class SeNewRegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:9',
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写职员名称',
            'name.max' => '职员名称9个字符以内',
            'phone.required' => '请填写手机号',
            'phone.regex' => '手机号码格式不正确',
        ];
    }
}