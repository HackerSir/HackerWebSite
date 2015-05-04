<?php namespace App\Http\Controllers;

use App\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
                'getIndex',
            ]
        ]);
        //限工作人員
        $this->middleware('staff', [
            'only' => [
                'getEditOtherProfile',
                'postEditOtherProfile'
            ]
        ]);
    }

    //會員清單
    public function getIndex()
    {
        $user = Auth::user();
        //取得會員清單
        if ($user->isStaff()) {
            //幹部可取得完整名單
            $userList = User::paginate(20);
        } else {
            //非幹部僅能取得幹部名單
            $userList = User::whereHas('group', function ($q) {
                $q->where('name', '=', 'staff');
            })->paginate(20);
        }
        return view('member.list')->with('userList', $userList);
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
                $user->lastlogin_at = Carbon::now()->toDateTimeString();
                $user->save();
                //移除重新設定密碼的驗證碼
                DB::table('password_resets')->where('email', '=', $user->email)->delete();
                //重導向至登入前頁面
                return Redirect::intended('/');
            } else {
                return Redirect::route('member.login')
                    ->with('warning', '帳號或密碼錯誤');
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
                'nickname' => $nickname,
                'confirm_code' => $code,
                'register_ip' => $request->getClientIp(),
                'register_at' => Carbon::now()->toDateTimeString()
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
            ->with('warning', '註冊時發生錯誤。');
    }

    //驗證信箱
    public function getConfirm($token = null)
    {
        $user = User::where('confirm_code', '=', $token)->whereNull('confirm_at');
        if ($user->count()) {
            $user = $user->first();
            //更新資料
            $user->confirm_at = Carbon::now()->toDateTimeString();
            $user->confirm_code = '';

            if ($user->save()) {
                return Redirect::route('home')
                    ->with('global', '帳號啟用成功。');
            }
        }
        return Redirect::route('home')
            ->with('warning', '驗證連結無效，也可能是帳號已啟用，請再次確認');
    }

    //重發驗證信
    public function getResend()
    {
        $user = Auth::user();
        //帳號已啟用
        if (empty($user->confirm_code)) {
            return Redirect::back()
                ->with('warning', '此帳號已啟用，無須再次認證');
        }

        return view('member.resend');
    }

    public function postResend(Request $request)
    {
        $user = Auth::user();
        //帳號已啟用
        if (empty($user->confirm_code)) {
            return Redirect::back()
                ->with('warning', '此帳號已啟用，無須再次認證');
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
            ->with('warning', '發送信件時發生錯誤。');
    }

    //忘記密碼
    public function getForgotPassword()
    {
        return view('member.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'email' => 'required|email',
            )
        );
        if ($validator->fails()) {
            return Redirect::route('member.forgot-password')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::where('email', '=', $request->get('email'));
            if ($user->count()) {
                $user = $user->first();
                $code = str_random(60);
                //檢查是否曾有驗證碼記錄
                if (DB::table('password_resets')->where('email', '=', $user->email)->count()) {
                    //更新找回密碼的驗證碼
                    DB::table('password_resets')->where('email', '=', $user->email)->update([
                        'token' => $code,
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ]);
                } else {
                    //產生找回密碼的驗證碼
                    DB::table('password_resets')->insert([
                        'email' => $user->email,
                        'token' => $code,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ]);
                }
                if ($user->save()) {
                    //發送信件
                    Mail::send('emails.forgot', array('link' => URL::route('member.reset-password', $code)), function ($message) use ($user) {
                        $message->to($user->email)->subject("[" . Config::get('config.sitename') . "] 重新設定密碼");
                    });
                    return Redirect::route('home')
                        ->with('global', '更換密碼的連結已發送至信箱。');
                }
            } else {
                return Redirect::route('member.forgot-password')
                    ->with('warning', '此信箱仍未註冊成為會員。');
            }
        }
        return Redirect::route('member.forgot-password')
            ->with('warning', '無法取得更換密碼的連結。');
    }

    //重設密碼
    public function getResetPassword($token = null)
    {
        if (DB::table('password_resets')->where('token', '=', $token)->count()) {
            $email = DB::table('password_resets')->where('token', '=', $token)->first()->email;
            $user = User::where('email', '=', $email)->first();
            //檢查使用者是否存在
            if ($user) {
                return view('member.reset-password')->with('user', $user)->with('token', $token);
            }
        }
        return Redirect::route('home')
            ->with('warning', '連結無效，無法重新設定密碼，請再次確認');
    }

    public function postResetPassword(Request $request)
    {
        $token = $request->get('token');
        if (DB::table('password_resets')->where('token', '=', $token)->count()) {
            $email = DB::table('password_resets')->where('token', '=', $token)->first()->email;
            $user = User::where('email', '=', $email)->first();
            //檢查使用者是否存在
            if ($user) {
                $validator = Validator::make($request->all(),
                    array(
                        'password' => 'required|min:6',
                        'password_again' => 'required|same:password',
                    )
                );

                if ($validator->fails()) {
                    return Redirect::route('member.reset-password', $token)
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    $password = $request->get('password');
                    $user->password = Hash::make($password);

                    if ($user->save()) {
                        //移除重新設定密碼的驗證碼
                        DB::table('password_resets')->where('email', '=', $email)->delete();
                        return Redirect::route('home')
                            ->with('global', '密碼重新設定完成，請使用新密碼重新登入。');
                    }
                }
            }
        }
        return Redirect::route('member.change-password')
            ->with('warning', '密碼無法修改。');
    }

    //修改密碼
    public function getChangePassword()
    {
        return view('member.change-password');
    }

    public function postChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'old_password' => 'required',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password',
            )
        );

        if ($validator->fails()) {
            return Redirect::route('member.change-password')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = Auth::user();

            $old_password = $request->get('old_password');
            $password = $request->get('password');

            if (Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($password);

                if ($user->save()) {
                    return Redirect::route('home')
                        ->with('global', '密碼修改完成。');
                }
            } else {
                return Redirect::route('member.change-password')
                    ->with('warning', '舊密碼輸入錯誤。');
            }
        }
        return Redirect::route('member.change-password')
            ->with('warning', '密碼無法修改。');
    }

    //個人資料
    public function getProfile($uid = null)
    {
        $user = Auth::user();
        if (empty($uid)) {
            return view('member.profile')->with('user', $user);
        } else {
            $showUser = User::find($uid);
            if ($showUser) {
                if ($user->isStaff() || $showUser->isStaff() || $user == $showUser) {
                    return view('member.other-profile')->with('user', $user)->with('showUser', $showUser);
                } else {
                    return Redirect::route('member.list')
                        ->with('warning', '無權訪問該成員資料。');
                }
            } else {
                return Redirect::route('member.list')
                    ->with('warning', '該成員不存在。');
            }
        }
    }

    //修改資料
    public function getEditProfile()
    {
        $user = Auth::user();
        return view('member.edit-profile')->with('user', $user);
    }

    public function postEditProfile(Request $request)
    {
        $validator = Validator::make($request->all(),
            array(
                'name' => array(
                    'required',
                    'min:2',
                    'max:20'
                ),
                'nickname' => array(
                    'required',
                    'unique:users,nickname,' . Auth::user()->id,
                    'min:2',
                    'max:20'
                ),
                'nid' => array(
                    'size:8',
                    'unique:users,nid,' . Auth::user()->id,
                    'regex:/^([depm]([0-9]){7})|(t[0-9]{5})$/i'
                ),
                'grade' => array(
                    'max:20'
                ),
                'job' => array(
                    'max:20'
                ),
            )
        );

        if ($validator->fails()) {
            return Redirect::route('member.edit-profile')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = Auth::user();
            $user->nickname = $request->get('nickname');
            if (empty($user->name)) {
                $user->name = $request->get('name');
            }
            if (empty($user->nid)) {
                $user->nid = strtoupper($request->get('nid'));
            }
            $user->grade = $request->get('grade');
            if ($user->isStaff()) {
                $user->job = $request->get('job');
            }
            if ($user->save()) {
                return Redirect::route('member.profile')
                    ->with('global', '個人資料修改完成。');
            }
        }
        return Redirect::route('member.edit-profile')
            ->with('warning', '個人資料無法修改。');
    }

    //修改他人資料
    public function getEditOtherProfile($uid)
    {
        $user = Auth::user();
        $showUser = User::find($uid);
        if ($showUser) {
            $groups = Group::all();
            foreach ($groups as $group) {
                $groupList[$group->name] = $group->title;
            }
            return view('member.edit-other-profile')->with('user', $user)->with('showUser', $showUser)->with('groupList', $groupList);
        } else {
            return Redirect::route('member.list')
                ->with('warning', '該成員不存在。');
        }
    }

    public function postEditOtherProfile(Request $request, $uid = null)
    {
        $user = Auth::user();
        $showUser = User::find($uid);
        if (!$showUser) {
            return Redirect::route('member.list')
                ->with('warning', '該成員不存在。');
        }

        $validator = Validator::make($request->all(),
            array(
                'name' => array(
                    'max:20'
                ),
                'nickname' => array(
                    'required',
                    'unique:users,nickname,' . $showUser->id,
                    'min:2',
                    'max:20'
                ),
                'nid' => array(
                    'size:8',
                    'unique:users,nid,' . $showUser->id,
                    'regex:/^([depm]([0-9]){7})|(t[0-9]{5})$/i'
                ),
                'grade' => array(
                    'max:20'
                ),
                'job' => array(
                    'max:20'
                ),
            )
        );

        if ($validator->fails()) {
            return Redirect::route('member.edit-other-profile', $uid)
                ->withErrors($validator)
                ->withInput();
        } else {
            $showUser->nickname = $request->get('nickname');
            $showUser->name = $request->get('name');
            $showUser->nid = strtoupper($request->get('nid'));
            $showUser->grade = $request->get('grade');
            if ($showUser->id != $user->id) {
                $groupName = $request->get('group');
                $group = Group::where('name', '=', $groupName)->first();
                $showUser = $group->users()->save($showUser);
            }
            if ($showUser->group->name == "staff") {
                $showUser->job = $request->get('job');
            } else {
                $showUser->job = "";
            }

            if ($showUser->save()) {
                return Redirect::route('member.profile', $uid)
                    ->with('global', '資料修改完成。');
            }
        }
        return Redirect::route('member.edit-other-profile', $uid)
            ->with('warning', '資料無法修改。');
    }

    //登出
    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('home');
    }

}
