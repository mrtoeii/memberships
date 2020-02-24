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

Route::get('/', 'RegisterController@index');
Route::post('/register.save', 'RegisterController@register_save');


Route::get('/login', 'AuthController@index');
Route::post('/checklogin', 'AuthController@checkLogin');

Route::group(['middleware'=>['checklogin']],function(){
    Route::get('/dashboard', 'AdminController@index');
    Route::get('/user_fetch_data', 'AdminController@user_fetch_data');
    Route::post('/view.user', 'AdminController@view_user');
    Route::post('/update.user', 'AdminController@update_user');
    Route::post('/delete.user', 'AdminController@delete_user');

    Route::get('/logout', 'AuthController@logout');
});