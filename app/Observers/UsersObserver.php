<?php

namespace App\Observers;

use App\Admin\Users;
use App\TraitTools\email;

/**
 * Class UsersObserver
 * @package App\Observers
 */
class UsersObserver
{

    use email;

    public function creating(Users $user) {
        //TODO
//        $this->sendEmail();
    }
}
