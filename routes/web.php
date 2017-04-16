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
Route::group(['middleware' => ['web'],'prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::any('login','LoginController@login');
    Route::get('code/{tmp}','LoginController@getCode');
});
Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){
   Route::get('index','IndexController@index');
   Route::get('info','IndexController@info');
   Route::get('quit','LoginController@quit');
   Route::any('psw','IndexController@psw');
});