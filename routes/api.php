<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('cors','api')->get('/province','ApiController@getProvince');
Route::middleware('cors','api')->get('/cities/{id}','ApiController@getCities');
Route::middleware('cors','api')->get('/preview','ApiController@preview');
Route::middleware('cors','api')->get('/product/{id}','ApiController@getProduct');
Route::middleware('cors','api')->get('/blog','ApiController@getArticlesPreview');
Route::middleware('cors','api')->get('/articles','ApiController@getMorePreview');