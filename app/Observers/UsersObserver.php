<?php

namespace App\Observers;

use App\admin\Users;

class UsersObserver
{

    public function created(Users $user) {
        //TODO
        //发送邮件
    }
}
