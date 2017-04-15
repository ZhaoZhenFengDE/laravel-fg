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
Route::middleware('cors','api')->get('/province',function(){
    $province = DB::select('select * from fg_province');
    return response()->json($province);
});
Route::middleware('cors','api')->get('/cities/{id}',function($id){
    $cities = DB::select('select * from fg_city where father = :id',['id'=>$id]);
    $area = DB::select('select * from fg_area where father = :id',['id'=>$id+100]);
    $areas = DB::select('select * from fg_area where father = :id',['id'=>$id+200]);
    $city = $cities?$cities:array_merge($area,$areas);
    return response()->json($city);
});