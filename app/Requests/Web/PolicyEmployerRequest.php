<?php

namespace App\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PolicyEmployerRequest extends FormRequest
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
            'idcard' => 'required|max:18',
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',
//            'email' => 'required|email',
            'position' => 'required|max:10',
            'number'   => 'required:min:1'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写职员名称',
            'name.max' => '职员名称9个字符以内',
            'idcard.required' => '请填写身份证号',
            'idcard' => '身份证号18个字符',
            'phone.required' => '请填写手机号',
            'phone.regex' => '手机号码格式不正确',
//            'email.required' => '请填写邮箱',
//            'email.email' => '请填写正确的邮箱',
            'position.required' => '请填写职位',
            'position.max' => '职位10个字符以内',
            'number.required'=>'购买数量不能为空',
            'number.min'=>'购买数量最小为一份',
        ];
    }
}
