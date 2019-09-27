<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\LoginRequest;
use Illuminate\Http\Request;
use App\admin\Users;

class LoginController extends Controller
{

    protected $usersModel;


    public function __construct()
    {
        $this->usersModel = new Users();
    }


    public function login() {

    }


    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign(LoginRequest $request) {
        $data = $request->post();
        $username = $data['username'];
        $password = $data['password'];

        $admin = $this->usersModel->login($username,$password);

        if(!$admin) {
            return response()->json([
                'code'=>'001',
                'message'=>'登录失败',
                'data'=>[],
                'extra'=>[]
            ],200);
        }

        $isActive = $this->usersModel->getActiveStatus($admin['id']);
        if(!$isActive) {
            return response()->json([
                'code'=>'001',
                'message'=>'用户未进行特殊激活',
                'data'=>[],
                'extra'=>[]
            ],200);
        }

        $isStatus = $this->usersModel->getStatus($admin['id']);
        if(!$isStatus) {
            return response()->json([
                'code'=>'001',
                'message'=>'用户被禁用,请联系管理员',
                'data'=>[],
                'extra'=>[]
            ],200);
        }

        return response()->json([
            'code'=>'000',
            'message'=>'登录成功',
            'data'=>[],
            'extra'=>[]
        ],200);
    }
}
