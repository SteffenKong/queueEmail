<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required|unique:users',
            'password'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required|unique:users'
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'username.required'=>'请填写用户名',
            'username.unique'=>'用户名已存在',
            'password.required'=>'请填写密码',
            'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已被其他用户使用',
            'phone.required'=>'请填写手机号码',
            'phone.unique'=>'请填写手机号码'
        ];
    }
}
