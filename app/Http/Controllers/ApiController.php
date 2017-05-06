<?php

namespace App\Http\Controllers;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Products;
use App\Http\Model\Article;
use App\Http\Model\Users;

class ApiController extends Controller
{
    // 获取省列表
    public function getProvince()
    {
        $province = DB::select('select * from fg_province');
        return response()->json($province);
    }

    // 获取市列表
    public function getCities($request)
    {
        $cities = DB::select('select * from fg_city where father = :id', ['id' => $request]);
        $area = DB::select('select * from fg_area where father = :id', ['id' => $request + 100]);
        $areas = DB::select('select * from fg_area where father = :id', ['id' => $request + 200]);
        $city = $cities ? $cities : array_merge($area, $areas);
        return response()->json($city);
    }

    // 商品简介
    public function preview()
    {
        $products = Products::all();
        $preview = array();
        for ($i = 0; $i < count($products); $i++) {
            $commodity_id = $products[$i]->commodity_id;
            $commodity_name = $products[$i]->commodity_name;
            $commodity_pic = $products[$i]->commodity_pic;
            $price = $products[$i]->price;
            $old_price = $products[$i]->old_price;
            $cate_id = $products[$i]->cate_id;
            $star = $products[$i]->star;
            $preview[$i] = array(
                "commodity_id" => $commodity_id,
                "commodity_name" => $commodity_name,
                "commodity_pic" => $commodity_pic,
                "price" => $price,
                "old_price" => $old_price,
                "cate_id" => $cate_id,
                "star" => $star);
        }
        return response()->json($preview);
    }

    //价格筛选，获取商品。
    public function priceFilter(Request $request)
    {
        echo $request;
    }

    //获取分页信息
    public function getAllPage()
    {
        $products = Products::orderBy('commodity_id')->paginate(9);
        return response()->json($products);
    }

    //获取分类商品信息
    public function getCategory($cate_id)
    {
        $products  = Products::all()->where('cate_id',$cate_id);
        return response()->json($products);
    }

    //获取商品详情
    public function getProduct($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }
    // 获取左侧文章列表
    public function getArticlesPreview()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        for ($i = 0; $i < 5; $i++) {
            $blog_id = $articles[$i]->blog_id;
            $blog_title = $articles[$i]->blog_title;
            $blog_thumb = $articles[$i]->blog_thumb;
            $created_at = $articles[$i]->created_at;
            $articles_preview[$i] = array(
                "blog_id" => $blog_id,
                "blog_title" => $blog_title,
                "blog_thumb" => $blog_thumb,
                "created_at" => $created_at);
        }
        return response()->json($articles_preview);
    }

    // 获取文章更多信息，用与卡片渲染
    public function getMorePreview()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(6);
        for ($i = 0; $i < count($articles); $i++) {
            $blog_id = $articles[$i]->blog_id;
            $blog_title = $articles[$i]->blog_title;
            $blog_thumb = $articles[$i]->blog_thumb;
            $blog_description = $articles[$i]->blog_description;
            $articles_preview[$i] = array(
                "blog_id" => $blog_id,
                "blog_title" => $blog_title,
                "blog_thumb" => $blog_thumb,
                "blog_description" => $blog_description,);
        };
        return $articles_preview;
    }

    // 获取最近一篇文章
    public function getRecentArticle()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(6);
        for ($i = 0; $i < 1; $i++) {
            $blog_id = $articles[$i]->blog_id;
            $blog_title = $articles[$i]->blog_title;
            $blog_thumb = $articles[$i]->blog_thumb;
            $blog_description = $articles[$i]->blog_description;
            $blog_editor = $articles[$i]->blog_editor;
            $created_at = $articles[$i]->created_at;
            $articles_preview[$i] = array(
                "blog_id" => $blog_id,
                "blog_title" => $blog_title,
                "blog_thumb" => $blog_thumb,
                "blog_description" => $blog_description,
                "blog_editor"=> $blog_editor,
                "created_at"=>$created_at);
        };
        return $articles_preview;
    }
    // 获取单个文章详细信息
    public function getArticleDetail($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }
    // 获取所有的花朵
    public function getAllFlowers()
    {
        $flowers = Products::all()->where('cate_id',1);
        for ($i = 0; $i < count($flowers); $i++) {
            $commodity_id = $flowers[$i]->commodity_id;
            $commodity_name = $flowers[$i]->commodity_name;
            $commodity_pic = $flowers[$i]->commodity_pic;
            $price = $flowers[$i]->price;
            $old_price = $flowers[$i]->old_price;
            $cate_id = $flowers[$i]->cate_id;
            $star = $flowers[$i]->star;
            $flower[$i] = array(
                "commodity_id" => $commodity_id,
                "commodity_name" => $commodity_name,
                "commodity_pic" => $commodity_pic,
                "price" => $price,
                "old_price" => $old_price,
                "cate_id" => $cate_id,
                "star" => $star);
        }
        return response()->json($flower);
    }

    //用户注册
    public function Register(Request $request)
    {
        $name = $request['name'];
        $user_name = Users::where('user_name',$name)->first();
        if($user_name){
            $data = [
                'status'=> 0,
                'msg' => '账户名已存在'
            ];
            return $data;
        }else{
            $newUsers = [
                'user_name'=>$request['name'],
                'user_psw'=> $request['password']
            ];
            $re = Users::Create($newUsers);
            if($re){
                return $data = [
                    'status'=> 1,
                    'msg' => '注册成功'
                ];
            }else{
               return $data = [
                   'status'=> 0,
                   'msg' => '注册成功'
               ];
            }
        }
    }
    //用户登录
    public function UserLogin(Request $request)
    {
        $name = $request['name'];
        $password = $request['password'];
        $user = Users::where('user_name',$name)->first();
        if($user){
            if($password === $user['user_psw']){
                $data = [
                    'status'=> 1,
                    'msg' => '登录成功！'
                ];
                return response()->json($data);
            }else {
                $data = [
                    'status'=> 0,
                    'msg' => '用户密码错误！'
                ];
                return response()->json($data);
            }
        }else{
            $data = [
                'status'=> 0,
                'msg' => '用户不存在，请注册！'
            ];
            return response()->json($data);
        }
    }

    public function getProvinceName($request)
    {
       $province = DB::select('select * from fg_province WHERE value = :id',['id' => $request]);
       return response()->json($province);
    }
    public function getCityName($request)
    {
        $cityname = DB::select('select * from fg_city WHERE value = :id',['id' => $request]);
        $area = DB::select('select * from fg_area WHERE value = :id',['id' => $request]);
        $city = array_merge($cityname, $area);
        return response()->json($city);
    }
}
