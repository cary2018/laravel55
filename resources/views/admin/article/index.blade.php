@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="tables">                <div class="bs-example widget-shadow" data-example-id="hoverable-table">                    <h4>                        文章栏目:                        <a href="{{url('admin/article/create')}}" class="btn btn-primary">添加文章</a>                        <span>文章数量：<strong>{{$count}}</strong> 篇</span>                        <form method="get" action="{{url('admin/article?cate_id')}}" id="serform" style="float:left;margin-right:50px;">                            <select name="cate_id" onchange="changeuser()" style="width:auto;" class="form-control1">                                <option value="">全部</option>                                @foreach($cate as $v)                                <option value="{{$v->cate_id}}" @if($v->cate_id == \Illuminate\Support\Facades\Input::get('cate_id')) selected = "selected" @endif >{{$v->_cate_name}}</option>                                @endforeach                            </select>                        </form>                    </h4>                    <table class="table table-hover">                        <thead>                        <tr>                            <th>ID</th>                            <th>标题</th>                            <th>栏目</th>                            <th>查看次数</th>                            <th>作者</th>                            <th>添加时间</th>                            <th>更新时间</th>                            <th>操作</th>                        </tr>                        </thead>                        <tbody>                        @foreach($data as $v)                            <tr id="del_{{$v->art_id}}">                                <th scope="row">{{$v->art_id}}</th>                                <td>                                    <a href="{{url('a/'.$v->art_id)}}" target="_blank">                                    {{$v->art_title}}                                    </a>                                </td>                                <td>                                    <a href="{{url('admin/article?cate_id='.$v->cate_id)}}">                                    {{$v->cate_name}}                                    </a>                                </td>                                <td>{{$v->art_view}}</td>                                <td>{{$v->art_author}}</td>                                <td>{{date('Y-m-d H:i:s',$v->art_add_time)}}</td>                                <td>{{date('Y-m-d H:i:s',$v->art_uptime)}}</td>                                <td>                                    <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>                                    /                                    <a href="javascript:;" onclick="delArt({{$v->art_id}})">删除</a>                                </td>                            </tr>                        @endforeach                        </tbody>                    </table>                </div>                {{$data->links()}}            </div>        </div>    </div>    <script type="text/javascript">        //搜索        function changeuser(){            $("#serform").submit();        }    </script>    <script>        function delArt(art_id){            layer.confirm('您确定要删除这篇文章吗？',{                btn:['确定','取消']  //按钮            },function () {                $.post("{{url('admin/article/')}}/"+art_id,{                    '_method':'delete',                    '_token':"{{csrf_token()}}"                },function(data){                    if(data.status==0){                        //location.href = location.href;                        layer.msg(data.msg,{icon:6});                        $("#del_"+art_id).remove();                    }else{                        layer.msg(data.msg,{icon:5});                    }                });            });        }    </script>@endsection