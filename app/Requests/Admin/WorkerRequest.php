<?php

namespace App\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WorkerRequest extends FormRequest
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
            'card_as' => 'required',
            'card_bs' => 'required',
            'name' => 'required|max:5',
            'age' => 'required|integer',
            'sex' => 'required',
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',
            'work_age' => 'required',
            'tec' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'card_as.required' => '请上传身份证正面照片',
            'card_bs.required' => '请上传身份证反面照片',
            'name.required' => '用户姓名不能为空',
            'name.max' => '用户名过长',
            'age.required' => '年龄不能为空',
            'age.integer' => '年龄格式不正确',
//            'age.size' => '输入年龄过大',
            'sex' => '性别不能为空',
            'phone.required'=>'手机号码不能为空',
            'phone.regex' => '手机号码格式不正确',
            'work_age.required' => '工作年限不能为空',
            'tec.required' => '工作技能不能为空'

        ];
    }


    /**
     * 返回错误信息
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator )
    {
        throw (new HttpResponseException(response()->json([
            'message' => $validator->errors()->first(),
        ],403)));

    }
}