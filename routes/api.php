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

// 商品类API
Route::middleware('cors','api')->get('/preview','ApiController@preview');
Route::middleware('cors','api')->get('/product/{id}','ApiController@getProduct');
Route::middleware('cors','api')->get('/allproducts','ApiController@getAllPage');
Route::middleware('cors','api')->get('/category/{cate_id}','ApiController@getCategory');

// 文章类API
Route::middleware('cors','api')->get('/news','ApiController@getArticlesPreview');
Route::middleware('cors','api')->get('/articles','ApiController@getMorePreview');
Route::middleware('cors','api')->get('/recentArticle','ApiController@getRecentArticle');
Route::middleware('cors','api')->get('/article/{id}','ApiController@getArticleDetail');

// 登录类API
Route::middleware('cors','api')->post('/register','ApiController@Register');
Route::middleware('cors','api')->post('/login','ApiController@UserLogin');

// 活动类API
Route::middleware('cors','api')->get('/active','ApiController@Active');
Route::middleware('cors','api')->get('/allactive','ApiController@AllActive');
Route::middleware('cors','api')->get('/active/{id}','ApiController@ActiveDetail');

// 购物车API
Route::middleware('cors','api')->get('/cart/{user_name}','ApiController@CartInfo');
Route::middleware('cors','api')->delete('/delete','ApiController@DeleteCart');
Route::middleware('cors','api')->post('/addcart','ApiController@addCartInfo');
Route::middleware('cors','api')->get('/getaddress/{user_name}','ApiController@GetAddress');