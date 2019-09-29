<?php

namespace App\Http\Controllers;

use App\Admin\Users;
use App\Http\Requests\admin\RegisterRequest;
use Illuminate\Http\Request;
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


    /**
     * @param Request $request
     * @return string
     * 会员邮箱激活功能
     */
    public function checkActiveCode(Request $request) {
        $userId = $request->get('userId');
        $activeCode = $request->get('activeCode');

        //检测是否已激活(防止重复激活)
        $isActive = $this->usersModel->getActiveStatus($userId);
        if($isActive) {
            return '该会员已激活';
        }

        if(empty($userId)) {
            //激活失败页面
            return '激活失败';
//            return redirect('');
        }

        if(empty($activeCode)) {
            //激活失败页面
            return '激活失败';
//            return redirect('');
        }

        $res = $this->usersModel->userActive($userId,$activeCode);
        if(!$res) {
            //激活失败页面
            return '激活失败';
//            return redirect('');
        }

        //激活成功页面
        return '激活成功';
//        return redirect('/login');
    }
}
