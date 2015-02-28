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

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

//=====遊客限定=====
Route::group(['middleware' => 'guest'], function () {

});

//=====會員限定=====
Route::group(['middleware' => 'auth'], function () {

});
