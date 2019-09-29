<?php

namespace App\Http\Requests\admin;

class LoginRequest extends BaseReqeuest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required',
            'password'=>'required',
//            'captcha'=>'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'username.required'=>'请填写用户名',
            'password.required'=>'请填写密码',
//            'captcha.required'=>'请填写验证码',
//            'captcha.captcha'=>'验证码错误'
        ];
    }
}
