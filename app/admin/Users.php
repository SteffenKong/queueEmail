<?php

namespace App\admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Predis;


/**
 * Class Users
 * @package App\admin
 * 用户模型器
 */
class Users extends Model
{

    /**
     * @param $username
     * @param $password
     * @return array|bool
     * 登录
     */
    public function login($username,$password) {
        $admin = Users::where('username',$username)->first();
        if(!$admin) {
            return false;
        }

        if(!password_hash($password,$admin->password)) {
            return false;
        }

        return [
            'id'=>$admin->id,
            'username'=>$admin->username,
            'phone'=>$admin->phone,
            'email'=>$admin->email,
            'status'=>$admin->status,
            'createdAt'=>$admin->created_at,
            'updatedAt'=>$admin->updated_at
        ];
    }

    /**
     * @param $adminId
     * @return bool
     * 检测用户是否邮箱激活
     */
    public function getActiveStatus($adminId) {
        $activeStatus = Users::where('id',$adminId)->value('active_status');
        if(!$activeStatus) {
            return false;
        }
        return true;
    }


    /**
     * @param $adminId
     * @return bool
     * 检测用户是否被激活
     */
    public function getStatus($adminId) {
        $status = Users::where('id',$adminId)->value('status');
        if(!$status) {
            return false;
        }
        return true;
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $phone
     * @return bool
     * 创建用户
     */
    public function create($username,$password,$email,$phone) {
        //随机生成一个验证code
        $code = md5(md5(uniqid('safe',true).mt_rand('1','9999')));

        $id = DB::table('users')->insertGetId([
            'username'=>$username,
            'password'=>$password,
            'email'=>$email,
            'phone'=>$phone,
            'status'=>0,
            'active_status'=>0,
            'code'=>$code,
            'commit_at'=>Carbon::now()->toDateTimeString(), //创建时间
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);

        if(!$id) {
            return false;
        }

        //将用户id存入redis的哈希列表中


        return true;
    }


    /**
     * @param $adminId
     * @param $code
     * @return bool
     * 校验
     */
    public function userActive($adminId,$code) {
        $activeCode = Users::where('id',$adminId)->value('active_code');
        if(!$activeCode) {
            return false;
        }

        if($code !== $activeCode) {
            return false;
        }
        $res = true;
        DB::beginTransaction();
        try{
            $res = Users::where('id',$adminId)->update(['active_status'=>1,'status'=>1,'updated_at'=>Carbon::now()->toDateTimeString()]);
            if(!$res) {
                return false;
            }
        }catch (Exception $e) {
            DB::rollBack();
            return false;
        }

        return true;
    }
}
