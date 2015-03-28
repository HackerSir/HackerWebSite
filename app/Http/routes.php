<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\App;

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::controller('member', 'MemberController', array(
    'getIndex' => 'member.list',
    'getLogin' => 'member.login',
    'postLogin' => 'member.login',
    'getRegister' => 'member.register',
    'postRegister' => 'member.register',
    'getConfirm' => 'member.confirm',
    'getResend' => 'member.resend',
    'postResend' => 'member.resend',
    'getForgotPassword' => 'member.forgot-password',
    'postForgotPassword' => 'member.forgot-password',
    'getResetPassword' => 'member.reset-password',
    'postResetPassword' => 'member.reset-password',
    'getChangePassword' => 'member.change-password',
    'postChangePassword' => 'member.change-password',
    'getProfile' => 'member.profile',
    'getEditProfile' => 'member.edit-profile',
    'postEditProfile' => 'member.edit-profile',
    'getEditOtherProfile' => 'member.edit-other-profile',
    'postEditOtherProfile' => 'member.edit-other-profile',
    'getLogout' => 'member.logout'
));

Route::controller('api', 'ApiController');

Route::resource('course', 'CourseController');

//學生會開票系統
Route::resource('candidate', 'CandidateController');
Route::resource('booth', 'BoothController');
Route::resource('vote', 'VoteController');

//未定義路由
Route::get('{all}', array(
    'as' => 'not-found',
    function () {
        abort(404);
    }
))->where('all', '.*');
