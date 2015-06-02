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

//入口頁面
Route::get('/', [
    'as' => 'entrance',
    'uses' => 'HomeController@entrance'
]);
//真正的首頁
Route::get('home', [
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
Route::resource('card', 'CardController');
Route::delete('signin/destroy/{id}', array(
    'as' => 'signin.destroy',
    'uses' => 'SigninController@destroy'
));
Route::get('signin/create/{courseId}', array(
    'as' => 'signin.create',
    'uses' => 'SigninController@create'
));
Route::post('signin/store/{courseId}', array(
    'as' => 'signin.store',
    'uses' => 'SigninController@store'
));

//學生會開票系統
Route::resource('candidate', 'CandidateController');
Route::resource('booth', 'BoothController');
Route::get('/savote', [
    'as' => 'savote',
    'uses' => 'VoteController@saVote'
]);
Route::controller('vote-api', 'VoteApiController', array(
    'anyVote' => 'vote-api.vote',
));

//Markdown API
Route::any('markdown', [
    'as' => 'markdown.preview',
    'uses' => 'MarkdownApiController@markdownPreview'
]);

//記錄檢視器
Route::group(['middleware' => 'staff'], function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::controller('export', 'ExportController', array(
    'getSigninList' => 'export.signin-list'
));

//投票系統
Route::controller('vote', 'VoteController', array(
    'getIndex' => 'vote.vote',
    'getBilling' => 'vote.billing',
    'postIndex' => 'vote.user-vote',
));
Route::post('vote-event/start/{vid}', [
    'as' => 'vote-event.start',
    'uses' => 'VoteEventController@start'
]);
Route::post('vote-event/end/{vid}', [
    'as' => 'vote-event.end',
    'uses' => 'VoteEventController@end'
]);
Route::resource('vote-event', 'VoteEventController');
Route::resource('vote-selection', 'VoteSelectionController', ['except' => ['index', 'show']]);

//未定義路由
Route::get('{all}', array(
    'as' => 'not-found',
    function () {
        abort(404);
    }
))->where('all', '.*');
