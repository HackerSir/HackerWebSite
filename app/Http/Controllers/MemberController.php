<?php namespace App\Http\Controllers;

use App\Http\Requests\Request;

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

    public function postLogin(Request $request)
    {
        return 'postLogin';
    }

    //註冊
    public function getRegister()
    {
        return 'getRegister';
    }

    public function postRegister(Request $request)
    {
        return 'postRegister';
    }

    //驗證信箱
    public function getConfirm($token = null)
    {
        return 'getConfirm';
    }

    //重發驗證信
    public function getResend()
    {
        return 'getResend';
    }

    public function postResend(Request $request)
    {
        return 'postResend';
    }

    //忘記密碼
    public function getForgotPassword()
    {
        return 'getForgotPassword';
    }

    public function postForgotPassword(Request $request)
    {
        return 'postForgotPassword';
    }

    //重設密碼
    public function getRecover($token = null)
    {
        return 'getRecover';
    }

    //修改密碼
    public function getChangePassword()
    {
        return 'getChangePassword';
    }

    public function postChangePassword(Request $request)
    {
        return 'postChangePassword';
    }

    //修改資料
    public function getEditProfile()
    {
        return 'getEditProfile';
    }

    public function postEditProfile(Request $request)
    {
        return 'postEditProfile';
    }

    //登出
    public function getLogout()
    {
        return 'getLogout';
    }

}
