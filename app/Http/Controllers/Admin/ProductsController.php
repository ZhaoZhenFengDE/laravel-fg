<?php
namespace App\Http\Controllers\Admin;

use App\Http\Model\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Category;

class ProductsController extends CommonController
{
    // 全部商品列表
    public function index()
    {
        $data = Products::orderBy('commodity_id','desc')->paginate(10);
        return view('admin.products.index',compact('data'));
    }
    // get.admin/article/create 添加文章
    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.products.add',compact('data'));
    }

    // post.admin/article 添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'commodity_name' =>'required',
            'price' =>'required',
            'commodity_pic' =>'required',
        ];
        $message = [
            'commodity_name.required'=>'商品名称不能为空！',
            'price.required'=>'请设置商品售价！',
            'commodity_pic.required' => '请添加商品图片！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Products::Create($input);
            if($re){
                return redirect('admin/products');
            }else{
                return back()->with('errors','数据提交错误，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    // get.admin/article/{article}/edit 添加文章
    public function edit($product_id)
    {
        $data = (new Category)->tree();
        $files = Products::find($product_id);
        return view('admin.products.edit',compact('data','files'));
    }

    // put.admin/article/{article}更新文章
    public function update($product_id)
    {
        $input = Input::except('_token','_method');
        $re = Products::where('commodity_id',$product_id)->update($input);
        if($re){
            return redirect('admin/products');
        }else{
            return back()->with('errors','更新文章失败，请稍后重试！');
        }
    }
    //delete.admin/category/{category}  删除单个分类
    public function destroy($product_id)
    {
        $re = Products::where('commodity_id',$product_id)->delete();
        if($re){
            $data = [
                'status'=> 0,
                'msg' => '文章删除成功!'
            ];
            return response()->json($data);
        }else{
            $data = [
                'status'=> 1,
                'msg' => '文章删除失败，请稍后重试！'
            ];
            return response()->json($data);
        }
    }
}
