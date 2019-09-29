<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//登录
Route::get('/login','LoginController@login');
Route::post('/sign','LoginController@sign');

//注册
Route::get('/register','RegisterController@signIn');
Route::post('/doRegister','RegisterController@register');

//激活校验
Route::get('/checkActiveCode','RegisterController@checkActiveCode');