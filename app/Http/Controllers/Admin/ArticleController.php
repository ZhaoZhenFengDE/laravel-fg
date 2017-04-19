<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ArticleController extends CommonController
{
    // 全部博客列表
    public function index()
    {
        return view('vendor.UEditor.test');
    }
    // get.admin/article/create 添加文章
    public function create()
    {

        return view('admin.article.add');
    }
}
