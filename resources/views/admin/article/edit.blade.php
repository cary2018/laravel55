@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="forms">                <div class=" form-grids row form-grids-right">                    <div class="widget-shadow " data-example-id="basic-forms">                        <div class="form-title">                            <h4>                                编辑文章 :                                <a href="{{url('admin/article')}}" class="btn btn-default">返回文章列表</a>                            </h4>                        </div>                        <div class="form-body">                            @if(is_object($errors))                                @if(count($errors)>0)                                    @foreach($errors->all() as $item)                                        <h4>{{$item}}</h4>                                    @endforeach                                @endif                            @else                                <h4>{{$errors}}</h4>                            @endif                        </div>                        <div class="form-body">                            <form action="{{url('admin/article/'.$field->art_id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">                                <input type="hidden" name="_method" value="put">                                {{csrf_field()}}                                <div class="form-group">                                    <label for="inputPassword3" class="col-sm-2 control-label">文章分类</label>                                    <div class="col-sm-9">                                        <select name="cate_id" id="selector1" style="width:350px;" class="form-control1">                                            @foreach($data as $v)                                                <option value="{{$v->cate_id}}" @if($v->cate_id == $field->cate_id) selected @endif >{{$v->_cate_name}}</option>                                            @endforeach                                        </select>                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_title" class="col-sm-2 control-label">文章标题*</label>                                    <div class="col-sm-9">                                        <input type="text" name="art_title" value="{{$field->art_title}}" class="form-control" id="art_title" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_author" class="col-sm-2 control-label">作 者</label>                                    <div class="col-sm-9">                                        <input type="text" name="art_author" value="{{$field->art_author}}" style="width:150px;" class="form-control" id="art_author" >                                    </div>                                </div>                                <div class="form-group">                                    <script src="{{url('uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>                                    <link rel="stylesheet" type="text/css" href="{{url('uploadify/uploadify.css')}}">                                    <label for="art_thumb" class="col-sm-2 control-label">缩略图</label>                                    <div class="col-sm-9">                                        <input type="hidden" name="ol_art_thumb" value="{{$field->art_thumb}}" style="width:350px;float: left;" class="form-control" id="art_thumb" >                                        <input id="file_upload" name="art_thumb" onchange="c('file_upload','art_thumb_img')" type="file" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple="true"><br>                                    </div>                                    <script type="text/javascript">                                        function c(id,show) {                                            var r= new FileReader();                                            f=document.getElementById(id).files[0];                                            r.readAsDataURL(f);                                            r.onload=function (e) {                                                document.getElementById(show).src=this.result;                                            };                                        }                                    </script>                                </div>                                <div class="form-group">                                    <label for="art_keywords" class="col-sm-2 control-label"></label>                                    <div class="col-sm-9">                                        <img id="art_thumb_img" src="{{$field->art_thumb}}" style="max-width:200px;max-height:200px;">                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_keywords" class="col-sm-2 control-label">关键字</label>                                    <div class="col-sm-9">                                        <input type="text" name="art_keywords" value='{{$field->art_keywords}}' class="form-control" id="art_keywords" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_description" class="col-sm-2 control-label">描述</label>                                    <div class="col-sm-9">                                        <textarea name="art_description" id="art_description" style="height:50px;" cols="50" rows="4" class="form-control1">{{$field->art_description}}</textarea>                                    </div>                                </div>                                <div class="form-group">                                    <script type="text/javascript" charset="utf-8" src="{{url('editer/ueditor.config.js')}}"></script>                                    <script type="text/javascript" charset="utf-8" src="{{url('editer/ueditor.all.min.js')}}"> </script>                                    <script type="text/javascript" charset="utf-8" src="{{url('editer/lang/zh-cn/zh-cn.js')}}"></script>                                    <label for="editor" class="col-sm-2 control-label">内容</label>                                    <div class="col-sm-9">                                        <script id="editor" name="art_content" type="text/plain" style="width:100%;height:300px;">{!! $field->art_content !!}</script>                                        <script type="text/javascript">                                        //实例化编辑器                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例                                        var ue = UE.getEditor('editor',{                                            scaleEnabled:true //[默认值：false]                                        });                                        </script>                                    </div>                                </div>                                <div class="col-sm-offset-2">                                    <button type="submit" class="btn btn-default">提 交</button>                                </div>                            </form>                        </div>                    </div>                </div>            </div>        </div>    </div>@endsection