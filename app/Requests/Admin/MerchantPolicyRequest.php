<?php

namespace App\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MerchantPolicyRequest extends FormRequest
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
            'company' => 'required|max:15',
            'total' => 'required|min:1'
        ];
    }

    public function messages()
    {
        return [
            'company.required' => '请输入客户名称',
            'company.max' => '客户名称15个字符以内',
            'total.required' => '请输入保单数',
            'total.min' => '保单数必须大于0'
        ];
    }
}
