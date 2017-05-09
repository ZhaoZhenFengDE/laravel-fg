@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{'admin/info'}}">首页</a> &raquo 全部商品
    </div>
    <!--面包屑导航 结束-->
    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>商品管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/products/create')}}"><i class="fa fa-plus"></i>添加商品</a>
                    <a href="{{url('admin/products')}}"><i class="fa fa-recycle"></i>全部商品</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>商品名称</th>
                        <th>商品分类</th>
                        <th>商品售价</th>
                        <th>商品材料</th>
                        <th>商品包装</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->commodity_id}}</td>
                        <td>
                            <a href="#">{{$v->commodity_name}}</a>
                        </td>
                        <td>
                            <a href="#">{{$v->category}}</a>
                        </td>
                        <td>{{$v->price}}</td>
                        <td>{{$v->material}}</td>
                        <td>{{$v->package}}</td>
                        <td>
                            <a href="{{url('admin/products/'.$v->commodity_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delPro({{$v->commodity_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <style>
        .result_content ul li span{
            font-size: 15px;
            padding: 6px 12px;
        }
    </style>
    <script>

        function changeOrder(obj,cate_id){
            var cate_order = $(obj).val();
            $.post(
                '{{url('admin/cate/changeorder')}}',
                {
                    '_token':'{{csrf_token()}}',
                    'cate_id':cate_id,
                    'cate_order':cate_order
                },
                function(data){
                    if(data.status === 0) {
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg,{icon:5})
                    }
                })
        }

        //删除分类
        function delPro(id){
            layer.confirm('确定删除商品？',{
                btn:['确定','取消']
            },function(){
                $.post("{{url('admin/products/')}}" + '/' + id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                   if(data.status === 0){
                       location.reload(true);
                       layer.msg(data.msg,{icon:6})
                   }else{
                       layer.msg(data.msg,{icon:5})
                   }
                })
            },function(){

            });
        }
    </script>
@endsection