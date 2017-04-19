<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ArticleController extends CommonController
{
    // 全部博客列表
    public function index()
    {
        echo '全部文章列表';
    }
    // get.admin/article/create 添加文章
    public function create()
    {
        echo '这是添加文章列表';
    }
}
