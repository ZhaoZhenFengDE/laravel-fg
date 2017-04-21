<?php

namespace App\Http\Controllers;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Products;
use App\Http\Model\Article;

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
        $products = Products::all();
        $preview = array();
        for($i = 0; $i< count($products); $i++){
            $commodity_id = $products[$i]->commodity_id;
            $commodity_name = $products[$i]->commodity_name;
            $commodity_pic = $products[$i]->commodity_pic;
            $price = $products[$i]->price;
            $old_price = $products[$i]->old_price;
            $star = $products[$i]->star;
            $preview[$i] = array(
                "commodity_id"=>$commodity_id,
                "commodity_name"=>$commodity_name,
                "commodity_pic"=>$commodity_pic,
                "price"=>$price,
                "old_price"=>$old_price,
                "star"=>$star);
        }
        return response()->json($preview);
    }

    public function getProduct($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    public function getArticlesPreview()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(5);
        for($i = 0;$i<5;$i++){
            $blog_id = $articles[$i]->blog_id;
            $blog_title = $articles[$i]->blog_title;
            $blog_thumb = $articles[$i]->blog_thumb;
            $created_at = $articles[$i]->created_at;
            $articles_preview[$i] = array(
                "blog_id"=>$blog_id,
                "blog_title"=>$blog_title,
                "blog_thumb"=>$blog_thumb,
                "created_at"=>$created_at);
        }
        return response()->json($articles_preview);
    }

    public function getMorePreview()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(6);
        dd($articles->links());
        for($i = 0;$i<count($articles);$i++){
            $blog_id = $articles[$i]->blog_id;
            $blog_title = $articles[$i]->blog_title;
            $blog_thumb = $articles[$i]->blog_thumb;
            $blog_description = $articles[$i]->blog_description;
            $articles_preview[$i] = array(
                "blog_id"=>$blog_id,
                "blog_title"=>$blog_title,
                "blog_thumb"=>$blog_thumb,
                "blog_description"=>$blog_description);
        }
        return response()->json($articles_preview);
    }
}
