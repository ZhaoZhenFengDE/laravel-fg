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
Route::middleware('cors','api')->get('/provincename/{id}','ApiController@getProvinceName');
Route::middleware('cors','api')->get('/cities/{id}','ApiController@getCities');
Route::middleware('cors','api')->get('/cityname/{id}','ApiController@getCityName');
Route::middleware('cors','api')->get('/preview','ApiController@preview');
Route::middleware('cors','api')->get('/product/{id}','ApiController@getProduct');
Route::middleware('cors','api')->get('/blog','ApiController@getArticlesPreview');
Route::middleware('cors','api')->get('/articles','ApiController@getMorePreview');
Route::middleware('cors','api')->get('/recentArticle','ApiController@getRecentArticle');
Route::middleware('cors','api')->get('/article/{id}','ApiController@getArticleDetail');
Route::middleware('cors','api')->get('/allproducts','ApiController@getAllPage');
Route::middleware('cors','api')->get('/flowers','ApiController@getAllFlowers');
Route::middleware('cors','api')->get('/category/{cate_id}','ApiController@getCategory');
Route::middleware('cors','api')->post('/register','ApiController@Register');
Route::middleware('cors','api')->post('/login','ApiController@UserLogin');
Route::middleware('cors','api')->get('/active','ApiController@Active');
Route::middleware('cors','api')->get('/cart/{user_name}','ApiController@CartInfo');
Route::middleware('cors','api')->delete('/delete','ApiController@DeleteCart');
Route::middleware('cors','api')->post('/addcart','ApiController@addCartInfo');
Route::middleware('cors','api')->get('/getaddress/{user_name}','ApiController@GetAddress');
Route::middleware('cors','api')->post('/addAddress','ApiController@AddAddress');