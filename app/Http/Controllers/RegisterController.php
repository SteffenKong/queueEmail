<?php

namespace App\Http\Controllers;

use App\admin\Users;
use App\Http\Requests\admin\RegisterRequest;
use Illuminate\Http\Response;


/**
 * Class RegisterController
 * @package App\Http\Controllers
 */
class RegisterController extends Controller
{

    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new Users();
    }


    public function signIn() {

    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 注册
     */
    public function register(RegisterRequest $request) {
        $data = $request->post();

        $addRes = $this->usersModel->create($data['username'],$data['password'],$data['email'],$data['phone']);
        if (!$addRes) {
            return \response()->json([
                'code'=>'001',
                'message'=>'注册失败',
                'data'=>[],
                'extra'=>[]
            ],200);
        }

        return \response()->json([
            'code'=>'000',
            'message'=>'注册成功，请在５分钟之内到邮箱激活帐号',
            'data'=>[],
            'extra'=>[]
        ],200);
    }
}
