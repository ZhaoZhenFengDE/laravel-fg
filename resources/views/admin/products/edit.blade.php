@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo 添加文章分类
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>分类管理</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加商品</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部商品</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/products/'.$files->commodity_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>商品类别：</th>
                    <td>
                        <select name="cate_id">
                            @foreach($data as $d)
                                <option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>商品名称：</th>
                    <td>
                        <input type="text" name="commodity_name" value="{{$files->commodity_name}}">
                    </td>
                </tr>
                <tr>
                    <th>商品图片：</th>
                    <td>
                        <input type="text" size="50" name="commodity_pic" value="{{$files->commodity_pic}}">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText' : '图片上传',
                                    'formData'     : {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token'     : "{{csrf_token()}}"
                                    },
                                    'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                    'uploader' : "{{url('admin/upload')}}",
                                    'onUploadSuccess' : function(file, data, response) {
                                        $('input[name=blog_thumb]').val(data);
                                        $('#blog_thumb_img').attr('src','/'+ data);
                                    }
                                });
                            });
                        </script>
                        <style>
                            .uploadify{display:inline-block;}
                            .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                            table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                        </style>
                    </td>
                </tr>
                <tr>
                    <th>图片预览</th>
                    <td style="height: 100px;">
                        <img src="" alt="" id="blog_thumb_img" style="max-width: 350px; max-height:100px;">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>商品售价：</th>
                    <td>
                        <input type="text" name="price" value="{{$files->price}}">
                    </td>
                </tr>
                <tr>
                    <th>商品材料：</th>
                    <td>
                        <input type="text" name="material" value="{{$files->material}}">
                    </td>
                </tr>
                <tr>
                    <th>商品包装：</th>
                    <td>
                        <input type="text" name="package" value="{{$files->package}}">
                    </td>
                </tr>
                <tr>
                    <th>配送范围：</th>
                    <td>
                        <input type="text" name="distribution" value="{{$files->distribution}}">
                    </td>
                </tr>
                <tr>
                    <th>附送：</th>
                    <td>
                        <input type="text" name="include" value="{{$files->include}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>商品含义：</th>
                    <td>
                        <input type="text" name="flw_lan" value="{{$files->flw_lan}}">
                    </td>
                </tr>
                <tr>
                    <th>商品详情：</th>
                    <td>
                        <textarea name="product_des" style="resize: none">{{$files->product_des}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>Star：</th>
                    <td>
                        <input type="text" class="sm" name="star" value="{{$files->star}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>不大于5的数字</span>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection