<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
//        $categories = Category::tree();
        $categories = (new Category)->tree();
        return view('admin.category.index')->with("data",$categories);
    }

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        if($re){
            $data = [
                'status'=>0,
                'msg'=> '分类排序成功！'
            ];
        }else{
            $data = [
                'status'=> 1,
                'msg'=> '分类排序失败，请稍后重试！'
            ];
        }
        return $data;
    }
    //get.admin/category/create  添加分类
    public function create()
    {
        $data = Category::where('cid',0)->get();
        return view('admin.category.add',compact('data'));
    }
    //post.admin/category 添加分类提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'cate_name' =>'required',
        ];
        $message = [
          'cate_name.required'=>'分类名称不能为空！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据提交错误，请稍后重试！');
            }
        }else{
           return back()->withErrors($validator);
        }
    }
    //get.admin/category/{category} 编辑分类
    public function edit($cate_id)
    {
        $data = Category::where('cid',0)->get();
        $filed = Category::find($cate_id);
        return view('admin.category.edit',compact('filed','data'));
    }
    //put.admin/category/{category} 更新分类
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $re = Category::where("cate_id",$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->width('errors','分类信息更新失败，请稍后重试！');
        }
    }
    //get.admin/category/{category} 显示单个分类信息
    public function show()
    {

    }
    //delete.admin/category/{category}  删除单个分类
    public function destroy($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cid',$cate_id) -> update(['cid' => 0]);
        if($re){
            $data = [
                'status'=> 0,
                'msg' => '分类删除成功!'
            ];
            return response()->json($data);
        }else{
            $data = [
                'status'=> 1,
                'msg' => '分类删除失败，请稍后重试！'
            ];
            return response()->json($data);
        }
    }

}
