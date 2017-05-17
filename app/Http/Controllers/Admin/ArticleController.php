<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    // 全部博客列表
    public function index()
    {
        $data = Article::orderBy('new_id','desc')->paginate(10);
        return view('admin.article.index',compact('data'));
    }
    // get.admin/article/create 添加文章
    public function create()
    {
        return view('admin.article.add');
    }

    // post.admin/article 添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'new_title' =>'required',
            'new_content' =>'required',
        ];
        $message = [
            'new_title.required'=>'文章标题不能为空！',
            'new_content.required'=>'文章内容不能为空！'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Article::Create($input);
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','数据提交错误，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    // get.admin/article/{article}/edit 添加文章
    public function edit($blog_id)
    {
        $data = Article::find($blog_id);
        return view('admin.article.edit',compact('data'));
    }

    // put.admin/article/{article}更新文章
    public function update($blog_id)
    {
        $input = Input::except('_token','_method');
        $re = Article::where('new_id',$blog_id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return back()->with('errors','更新文章失败，请稍后重试！');
        }
    }
    //delete.admin/category/{category}  删除单个分类
    public function destroy($blog_id)
    {
        $re = Article::where('new_id',$blog_id)->delete();
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
