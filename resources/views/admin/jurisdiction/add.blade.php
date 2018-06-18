@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="forms">                <div class=" form-grids row form-grids-right">                    <div class="widget-shadow " data-example-id="basic-forms">                        <div class="form-title">                            <h4>                                添加用户 :                                <a href="{{url('admin/jurisdiction')}}" class="btn btn-default">返回用户列表</a>                            </h4>                        </div>                        <div class="form-body">                        </div>                        <div class="form-body">                            <form action="{{url('admin/jurisdiction')}}" method="post" class="form-horizontal" enctype="multipart/form-data">                                {{csrf_field()}}                                <div style="margin:0 auto;height: auto;padding-bottom:20px;">                                    <div style="text-align:center;">                                        @if(is_object($errors))                                            @if(count($errors)>0)                                                @foreach($errors->all() as $item)                                                    <h4>{{$item}}</h4>                                                @endforeach                                            @endif                                        @else                                            <h4>{{$errors}}</h4>                                        @endif                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_title" class="col-sm-2 control-label">权限名称*</label>                                    <div class="col-sm-9">                                        <input type="text" name="title" class="form-control" id="art_title" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="urls" class="col-sm-2 control-label">权限地址URLS</label>                                    <div class="col-sm-9 inbox-page">                                        <textarea name="urls" id="urls" style="height:150px;" placeholder="一行一个url" rows="5" class="form-control1"></textarea>                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_description" class="col-sm-2 control-label">状 态</label>                                    <div class="col-sm-9 inbox-page">                                        <label for="jurisdiction" class="poin" style="cursor:pointer;">                                            <div class="mail ">                                                <input type="checkbox" style="min-height:20px;" value="1" checked name="status" id="jurisdiction" class="checkbox">                                            </div>                                            <div class="mail "> <h6>有 效</h6> </div>                                        </label>                                    </div>                                </div>                                <div class="col-sm-offset-2">                                    <button type="submit" class="btn btn-default">提 交</button>                                </div>                            </form>                            <div class="form-group" style="color:#ccc;">                                <h1>权限说明：</h1>                                <p>admin/article --------------读取文章列表</p>                                <p>admin/article/create -------添加文章</p>                                <p>admin/article/ -------------执行更新或者删除文章操作</p>                                <p>admin/article//edit --------编辑文章</p>                            </div>                        </div>                    </div>                </div>            </div>        </div>    </div>@endsection