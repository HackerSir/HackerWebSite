<?php namespace App\Http\Controllers;

class MemberController extends Controller
{
    public function __construct()
    {
        //遊客限定
        $this->middleware('guest', [
            'only' => [
                'getLogin',
                'postLogin',
                'getRegister',
                'postRegister',
                'getForgotPassword',
                'postForgotPassword',
                'getRecover'
            ]
        ]);
        //會員限定
        $this->middleware('auth', [
            'only' => [
                'getChangePassword',
                'postChangePassword',
                'getEditProfile',
                'postEditProfile',
                'getLogout'
            ]
        ]);
    }

    //登入
    public function getLogin()
    {
        return 'getLogin';
    }

    public function postLogin()
    {
        return 'postLogin';
    }

    //註冊
    public function getRegister()
    {
        return 'getRegister';
    }

    public function postRegister()
    {
        return 'postRegister';
    }

    //忘記密碼
    public function getForgotPassword()
    {
        return 'getForgotPassword';
    }

    public function postForgotPassword()
    {
        return 'postForgotPassword';
    }

    //重設密碼
    public function getRecover()
    {
        return 'getRecover';
    }

    //修改密碼
    public function getChangePassword()
    {
        return 'getChangePassword';
    }

    public function postChangePassword()
    {
        return 'postChangePassword';
    }

    //修改資料
    public function getEditProfile()
    {
        return 'getEditProfile';
    }

    public function postEditProfile()
    {
        return 'postEditProfile';
    }

    //登出
    public function getLogout()
    {
        return 'getLogout';
    }

}
