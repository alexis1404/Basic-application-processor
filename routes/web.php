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
    return view('custom_pages.home');
});

//auth routes
Route::get('register_page', 'AuthController@registerPage')->name('registerPage');
Route::get('login_page', 'AuthController@loginPage')->name('loginPage');
Route::post('reg_form', 'AuthController@regForm')->name('regForm');
Route::post('login_form', 'AuthController@loginForm')->name('loginForm');
Route::get('logout', 'AuthController@logout')->name('logout');

//user`s routes
Route::group(['middleware' => 'checkUser'], function () {

    Route::get('user_page', 'UserController@userPage')->name('userPage');
    Route::post('user_form', 'UserController@userForm')->name('userForm');

});

//manager`s routes
Route::group(['middleware' => 'checkManager'], function () {

    Route::get('manager_page', 'ManagerController@managerPage')->name('managerPage');

});









