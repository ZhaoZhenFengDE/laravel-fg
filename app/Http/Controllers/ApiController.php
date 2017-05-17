<?php

namespace App\Http\Controllers;

use App\Http\Model\Cart;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Products;
use App\Http\Model\Article;
use App\Http\Model\Users;
use App\Http\Model\Active;

class ApiController extends Controller
{
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
        $products = Products::all()->where('cate_id', $cate_id);
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
        $articles =
            Article::select('new_id','new_title','new_thumb','created_at')
                ->orderBy('new_id','desc')->paginate(8);
//            DB::select("select new_id,new_title,new_thumb,new_description,created_at FROM fg_news ORDER BY created_at DESC")
//                ->paginate(8);
        return response()->json($articles);
    }

    // 获取文章更多信息，用yu卡片渲染
    public function getMorePreview()
    {
        $articles = Article::select('new_id','new_title','new_thumb','new_description','created_at')->orderBy('new_id','desc')->paginate(6);
        return $articles;
    }

    // 获取最近一篇文章
    public function getRecentArticle()
    {
        $articles =
            DB::select("select new_id,new_title,new_editor,new_thumb,new_description,created_at from fg_news where new_id = (select MAX(new_id) from fg_news);");
        return response()->json($articles);
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
        $flowers = Products::all()->where('cate_id', 1);
        $allFlowers = array();
        for ($i = 0; $i < count($flowers); $i++) {
            $commodity_id = $flowers[$i]->commodity_id;
            $commodity_name = $flowers[$i]->commodity_name;
            $commodity_pic = $flowers[$i]->commodity_pic;
            $price = $flowers[$i]->price;
            $old_price = $flowers[$i]->old_price;
            $cate_id = $flowers[$i]->cate_id;
            $star = $flowers[$i]->star;
            $allFlowers[$i] = array(
                "commodity_id" => $commodity_id,
                "commodity_name" => $commodity_name,
                "commodity_pic" => $commodity_pic,
                "price" => $price,
                "old_price" => $old_price,
                "cate_id" => $cate_id,
                "star" => $star);
        }
        return response()->json($allFlowers);
    }

    //用户注册
    public function Register(Request $request)
    {
        $name = $request['name'];
        $user_name = Users::where('user_name', $name)->first();
        if ($user_name) {
            $data = [
                'status' => 0,
                'msg' => '账户名已存在'
            ];
            return $data;
        } else {
            $newUsers = [
                'user_name' => $request['name'],
                'user_psw' => $request['password']
            ];
            $re = Users::Create($newUsers);
            if ($re) {
                return $data = [
                    'status' => 1,
                    'msg' => '注册成功'
                ];
            } else {
                return $data = [
                    'status' => 0,
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
        $user = Users::where('user_name', $name)->first();
        if ($user) {
            if ($password === $user['user_psw']) {
                $data = [
                    'status' => 1,
                    'msg' => '登录成功！'
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => 0,
                    'msg' => '用户密码错误！'
                ];
                return response()->json($data);
            }
        } else {
            $data = [
                'status' => 0,
                'msg' => '用户不存在，请注册！'
            ];
            return response()->json($data);
        }
    }

    // 活动

    public function Active()
    {
        $active = Active::all()->take(4);
        return response()->json($active);
    }

    // 获取购物车信息
    public function CartInfo($user_name)
    {
        $cartInfo = DB::select('select * from fg_cart WHERE user_name = :username', ['username' => $user_name]);
        return response()->json($cartInfo);
    }

    //删除购物车信息
    public function DeleteCart(Request $request)
    {
        $cart_id = $request['cart_id'];
        $re = Cart::where('cart_id', $cart_id)->delete();
        if ($re) {
            $data = [
                'status' => 1,
                'msg' => '删除物品成功'
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除物品失败'
            ];
            return response()->json($data);
        }
    }

    //添加购物车信息
    public function addCartInfo(Request $request)
    {
        $cart = [
            'user_name' => $request['user_name'],
            'commodity_id' => $request['commodity_id'],
            'commodity_name' => $request['commodity_name'],
            'commodity_pic' => $request['commodity_pic'],
            'price' => $request['price'],
            'number' => $request['number']
        ];
        $re = Cart::Create($cart);
        if ($re) {
            $data = [
                'status' => 1,
                'msg' => '添加购物车成功！'
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => 0,
                'msg' => '添加购物车失败，请重试！'
            ];
            return response()->json($data);
        }
    }

    //查询地址
    public function GetAddress($user_name)
    {
        $user = Users::all()->where('user_name', $user_name)->first();
        return response()->json($user['user_addr']);
    }

    // 添加地址
    public function AddAddress(Request $request)
    {
        $userAddress = [
            "user_addr" => $request['address']
        ];
        $re = Users::where('user_name', $request['user_name'])->update($userAddress);
        if ($re) {
            $data = [
                'status' => 1,
                'msg' => '添加地址成功！'
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => 0,
                'msg' => '添加地址失败！'
            ];
            return response()->json($data);
        }
    }

}
