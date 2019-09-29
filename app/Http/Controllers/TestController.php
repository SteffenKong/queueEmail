<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin\Users;

class TestController extends Controller
{

    /* @var Users $usersModel*/
    protected $usersModel = null;

    public function __construct()
    {
        $this->usersModel = new Users();
    }

    public function test() {
        $this->usersModel->test();
    }
}
