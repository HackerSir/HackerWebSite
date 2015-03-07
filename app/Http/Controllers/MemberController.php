<?php namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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
                'getResetPassword',
                'postResetPassword'
            ]
        ]);
        //會員限定
        $this->middleware('auth', [
            'only' => [
                'getResend',
                'postResend',
                'getChangePassword',
                'postChangePassword',
                'getProfile',
                'getEditProfile',
                'postEditProfile'
            ]
        ]);
        //需完成信箱驗證
        $this->middleware('email', [
            'only' => [
                //條件不能空白，否則會出錯
                'method_needs_email_confirm'
            ]
        ]);
    }

    //登入
    public function getLogin()
    {
        return view('member.login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::route('member.login')
                ->withErrors($validator)
                ->withInput();
        } else {
            $remember = ($request->has('remember')) ? true : false;
            $auth = Auth::attempt([
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ], $remember);

            if ($auth) {
                $user = Auth::user();
                //更新資料
                $user->lastlogin_ip = $request->getClientIp();
                $user->lastlogin_at = date('Y-m-d H:i:s', time());
                $user->save();
                //重導向至登入前頁面
                return Redirect::intended('/');
            } else {
                return Redirect::route('member.login')
                    ->with('global', '帳號或密碼錯誤');
            }
        }
    }

    //註冊
    public function getRegister()
    {
        return view('member.register');
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password',
            )
        );

        if ($validator->fails()) {
            return Redirect::route('member.register')
                ->withErrors($validator)
                ->withInput();
        } else {
            $email = $request->get('email');
            $password = $request->get('password');
            //驗證碼
            $code = str_random(60);
            //預設暱稱
            $nickname = explode("@", $email)[0];

            $user = User::create(array(
                'email' => $email,
                'password' => Hash::make($password),
                'name' => $nickname,
                'confirm_code' => $code,
                'register_ip' => $request->getClientIp(),
                'register_at' => date('Y-m-d H:i:s', time())
            ));
            //預設群組
            $group = Group::where('name', '=', 'default')->first();
            $user = $group->users()->save($user);

            if ($user) {
                //發送驗證信件
                Mail::send('emails.confirm', array('link' => URL::route('member.confirm', $code)), function ($message) use ($user) {
                    $message->to($user->email)->subject("[" . Config::get('config.sitename') . "] 信箱驗證");
                });
                return Redirect::route('home')
                    ->with('global', '註冊完成，請至信箱收取驗證信件並啟用帳號。');
            }
        }
        return Redirect::route('member.register')
            ->with('global', '註冊時發生錯誤。');
    }

    //驗證信箱
    public function getConfirm($token = null)
    {
        $user = User::where('confirm_code', '=', $token)->whereNull('confirm_at');
        if ($user->count()) {
            $user = $user->first();
            //更新資料
            $user->confirm_at = date('Y-m-d H:i:s', time());
            $user->confirm_code = '';

            if ($user->save()) {
                return Redirect::route('home')
                    ->with('global', '帳號啟用成功。');
            }
        }
        return Redirect::route('home')
            ->with('global', '驗證連結無效，也可能是帳號已啟用，請再次確認');
    }

    //重發驗證信
    public function getResend()
    {
        $user = Auth::user();
        //帳號已啟用
        if (empty($user->confirm_code)) {
            return Redirect::back()
                ->with('global', '此帳號已啟用，無須再次認證');
        }

        return view('member.resend');
    }

    public function postResend(Request $request)
    {
        $user = Auth::user();
        //帳號已啟用
        if (empty($user->confirm_code)) {
            return Redirect::back()
                ->with('global', '此帳號已啟用，無須再次認證');
        }
        //更換驗證碼
        $code = str_random(60);
        $user->confirm_code = $code;

        if ($user->save()) {
            //重新發送驗證信件
            Mail::send('emails.confirm', array('link' => URL::route('member.confirm', $code)), function ($message) use ($user) {
                $message->to($user->email)->subject("[" . Config::get('config.sitename') . "] 信箱驗證");
            });
            return Redirect::route('home')
                ->with('global', '已重新發送，請至信箱收取驗證信件並啟用帳號。');
        }
        return Redirect::route('member.resend')
            ->with('global', '發送信件時發生錯誤。');
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
    public function getResetPassword($token = null)
    {
        return 'getResetPassword';
    }

    public function postResetPassword(Request $request)
    {
        return 'postResetPassword';
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

    //個人資料
    public function getProfile()
    {
        return 'getProfile';
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
        Auth::logout();
        return Redirect::route('home');
    }

}
