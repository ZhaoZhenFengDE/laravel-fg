<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function getProvince()
    {
        $province = DB::select('select * from fg_province');
        return response()->json($province);
    }

    public function getCities($request)
    {
        $cities = DB::select('select * from fg_city where father = :id', ['id' => $request]);
        $area = DB::select('select * from fg_area where father = :id', ['id' => $request + 100]);
        $areas = DB::select('select * from fg_area where father = :id', ['id' => $request + 200]);
        $city = $cities ? $cities : array_merge($area, $areas);
        return response()->json($city);
    }

    public function preview()
    {
        $categories = DB::select('select * from fg_commodity');
        $preview = array();
        for($i = 0; $i< count($categories); $i++){
            $commodity_id = $categories[$i]->commodity_id;
            $commodity_name = $categories[$i]->commodity_name;
            $commodity_pic = $categories[$i]->commodity_pic;
            $price = $categories[$i]->price;
            $old_price = $categories[$i]->old_price;
            $star = $categories[$i]->star;
            $type = $categories[$i]->type;
            $preview[$i] = array(
                "commodity_id"=>$commodity_id,
                "commodity_name"=>$commodity_name,
                "commodity_pic"=>$commodity_pic,
                "price"=>$price,
                "old_price"=>$old_price,
                "star"=>$star,
                "type"=>$type);
        }
        return response()->json($preview);
    }

    public function getCategor($id)
    {
        $categories = DB::select('select * from fg_commodity WHERE commodity_id =  :id',['id' => $id]);
        return response()->json($categories);
    }
}
