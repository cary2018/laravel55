@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="forms">                <div class=" form-grids row form-grids-right">                    <div class="widget-shadow " data-example-id="basic-forms">                        <div class="form-title">                            <h4>                                添加导航菜单 :                                <a href="{{url('admin/navs')}}" class="btn btn-default">返回导航菜单列表</a>                            </h4>                        </div>                        <div class="form-body">                            @if(is_object($errors))                                @if(count($errors)>0)                                    @foreach($errors->all() as $item)                                        <h4>{{$item}}</h4>                                    @endforeach                                @endif                            @else                                <h4>{{$errors}}</h4>                            @endif                        </div>                        <div class="form-body">                            <form action="{{url('admin/navs')}}" method="post" class="form-horizontal">                                {{csrf_field()}}                                <div class="form-group">                                    <label for="nav_name" class="col-sm-2 control-label">导航名称*</label>                                    <div class="col-sm-9">                                        <input type="text" name="nav_name" class="form-control" id="nav_name" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="nav_url" class="col-sm-2 control-label">URL地址*</label>                                    <div class="col-sm-9">                                        <input type="text" name="nav_url" value="http://" class="form-control" id="nav_url" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="nav_order" class="col-sm-2 control-label">排序</label>                                    <div class="col-sm-9">                                        <input type="text" name="nav_order" class="form-control" id="nav_order" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="nav_show" class="col-sm-2 control-label">是否显示</label>                                    <div class="col-sm-9">                                        <div class="checkbox"><label> <input name="nav_show" value="1" checked type="checkbox"> 显示 </label></div>                                    </div>                                </div>                                <div class="col-sm-offset-2">                                    <button type="submit" class="btn btn-default">提 交</button>                                </div>                            </form>                        </div>                    </div>                </div>            </div>        </div>    </div>@endsection