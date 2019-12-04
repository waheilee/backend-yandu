<?php

namespace App\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
class ProjectRequest extends FormRequest
{
    /**
     * 确定用户是否有权提出此请求。
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 获取应用于请求的验证规则。
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
        ];
    }

    /**
     * 自定义返回消息
     * @return array
     */
    public function messages()
    {
        return [
            'content.required' => '项目详情不能为空',
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator ) {
        exit(json_encode(array(
            'code' => false,
            'message' => 'There are incorect values in the form!',
            'errors' => $validator->getMessageBag()->toArray()
        )));
    }
}