@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="forms">                <div class=" form-grids row form-grids-right">                    <div class="widget-shadow " data-example-id="basic-forms">                        <div class="form-title">                            <h4>                                添加文章栏目 :                                <a href="{{url('admin/category')}}" class="btn btn-default">返回栏目列表</a>                            </h4>                        </div>                        <div class="form-body">                            @if(is_object($errors))                                @if(count($errors)>0)                                    @foreach($errors->all() as $item)                                        <h4>{{$item}}</h4>                                    @endforeach                                @endif                            @else                                <h4>{{$errors}}</h4>                            @endif                        </div>                        <div class="form-body">                            <form action="{{url('admin/category/'.$field->cate_id)}}" method="post" class="form-horizontal">                                <input type="hidden" name="_method" value="put">                                {{csrf_field()}}                                <div class="form-group">                                    <label for="inputPassword3" class="col-sm-2 control-label">上级分类</label>                                    <div class="col-sm-9">                                        <select name="cate_pid" id="selector1" class="form-control1">                                            <option value="0">==顶级分类==</option>                                            @foreach($data as $v)                                                <option value="{{$v->cate_id}}" @if($v->cate_id == $field->cate_pid) selected @endif>@if($v->lave!=0) <?php echo '┝'.str_repeat('━',$v->lave)?> @endif{{$v->cate_name}}</option>                                            @endforeach                                        </select>                                    </div>                                </div>                                <div class="form-group">                                    <label for="inputEmail3" class="col-sm-2 control-label">分类名*</label>                                    <div class="col-sm-9">                                        <input type="text" name="cate_name" value="{{$field->cate_name}}" class="form-control" id="inputEmail3" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="inputPassword3" class="col-sm-2 control-label">分类标题</label>                                    <div class="col-sm-9">                                        <input type="text" name="cate_title" value='{{$field->cate_title}}' class="form-control" id="cate_title" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="inputPassword3" class="col-sm-2 control-label">关键词</label>                                    <div class="col-sm-9">                                        <textarea name="cate_keywords" id="cate_keywords" style="height:100px;" cols="50" rows="4" class="form-control1">{{$field->cate_keywords}}</textarea>                                    </div>                                </div>                                <div class="form-group">                                    <label for="inputPassword3" class="col-sm-2 control-label">描述</label>                                    <div class="col-sm-9">                                        <textarea name="cate_description" id="description" style="height:100px;" cols="50" rows="4" class="form-control1">{{$field->cate_description}}</textarea>                                    </div>                                </div>                                <div class="form-group">                                    <label for="inputPassword3" class="col-sm-2 control-label">排序</label>                                    <div class="col-sm-9">                                        <input type="text" value="{{$field->cate_order}}" name="cate_order" class="form-control" id="cate_title" >                                    </div>                                </div>                                <div class="col-sm-offset-2">                                    <button type="submit" class="btn btn-default">提 交</button>                                </div>                            </form>                        </div>                    </div>                </div>            </div>        </div>    </div>@endsection