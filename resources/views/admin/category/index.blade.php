@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="tables">                <div class="bs-example widget-shadow" data-example-id="hoverable-table">                    <h4>                        文章栏目:                        <a href="{{url('admin/category/create')}}" class="btn btn-primary">添加栏目</a>                    </h4>                    <table class="table table-hover">                        <thead>                        <tr>                            <th>ID</th>                            <th>分类名称</th>                            <th>分类标题</th>                            <th>查看次数</th>                            <th>排序</th>                            <th>操作</th>                        </tr>                        </thead>                        <tbody>                        @foreach($data as $v)                        <tr>                            <th scope="row">{{$v->id}}</th>                            <td>{{$v->_cate_name}}</td>                            <td>{{$v->cate_title}}</td>                            <td>{{$v->cate_view}}</td>                            <td>{{$v->cate_order}}</td>                            <td>                                <a href="{{url('admin/category/'.$v->id.'/edit')}}">修改</a>                                /                                <a href="javascript:;">删除</a>                            </td>                        </tr>                        @endforeach                        </tbody>                    </table>                </div>            </div>        </div>    </div>@endsection