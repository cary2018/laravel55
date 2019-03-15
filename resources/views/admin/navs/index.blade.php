@extends('layouts.menu')@section('content')    <div id="page-wrapper">        <div class="main-page">            <div class="tables">                <div class="bs-example widget-shadow" data-example-id="hoverable-table">                    <h4>                        自定义菜单:                        <a href="{{url('admin/navs/create')}}" class="btn btn-primary">添加菜单</a>                    </h4>                    <table class="table table-hover">                        <thead>                        <tr>                            <th>导航名</th>                            <th>别名</th>                            <th>URl地址</th>                            <th>排序</th>                            <th>显示</th>                            <th>操作</th>                        </tr>                        </thead>                        <tbody>                        @foreach($data as $v)                            <tr id="del_{{$v->nav_id}}">                                <td>                                    <a href="{{$v->nav_url}}" target="_blank">                                         @if($v->lave!=0) <?php echo '┝'.str_repeat('━',$v->lave)?> @endif {{$v->nav_name}}                                    </a>                                </td>                                <td>{{$v->nav_alias}}</td>                                <td>{{$v->nav_url}}</td>                                <td style="cursor:pointer;" onclick="change_order(this,{{$v->nav_id}})" id="{{$v->nav_id}}">{{$v->nav_order}}</td>                                <td style="cursor:pointer;" onclick="show(this)" id="{{$v->nav_id}}" alt="{{$v->nav_show}}" >                                    @if($v->nav_show ==1)                                        <img src="/images/yes.gif" />                                        @else                                        <img src="/images/no.gif" />                                    @endif                                </td>                                <td>                                    <a href="{{url('admin/navs/'.$v->nav_id.'/edit')}}">修改</a>                                    /                                    <a href="javascript:;" onclick="delNav({{$v->nav_id}})">删除</a>                                </td>                            </tr>                        @endforeach                        </tbody>                    </table>                </div>            </div>        </div>    </div>    <script>        //异步修改菜单排序        function change_order(obj)        {            var val = $(obj).attr('id');   //要修改的菜单ID            var oval = $(obj).text();      //排序的数值                var input = $("<input type=text name=\"order\" size=\"6\" maxlength='5' class=\"foc\" value='"+oval+"' />");                //添加input                $(obj).html(input);                //选中内容                input.trigger('select');                //在input在点击无效                input.click(function(){return false;});                //光标离开 input 后进行更新相关操作                input.blur(function(){                    var tex = $(this).val();                    if(tex != oval)                    {                        $(obj).html(tex);                        $.post("{{url('admin/changeOrder')}}",{                            _token:"{{csrf_token()}}",                            nav_id:val,                            nav_order:tex                        },function(data){                            if(data.status == 1)                            {                                layer.msg(data.msg,{icon:6});                                //alert(data.msg);                            }                            else                            {                                layer.msg(data.msg,{icon:5});                            }                            //alert(object.result+'---'+status);                        });                    }                    else                    {                        $(obj).html(tex);                    }                });        }        //异步修改菜单是否显示        function show(obj)        {            var uid = $(obj).attr('id');            var oval = $(obj).attr('alt');            //alert(oval);            $.post("{{url('admin/changeShow')}}",{                _token:"{{csrf_token()}}",                nav_id:uid,                nav_show:oval            },function(data){                if(data.status == 1)                {                    $(obj).attr('alt',data.status);                    $(obj).html('<img src="/images/yes.gif" />');                    //alert(data.msg);                }                else                {                    $(obj).attr('alt',data.status);                    $(obj).html('<img src="/images/no.gif" />');                }            });        }        //异步删除菜单        function delNav(nav_id){            layer.confirm('您确定要删除这篇文章吗？',{                btn:['确定','取消']  //按钮            },function () {                $.post("{{url('admin/navs/')}}/"+nav_id,{                    '_method':'delete',                    '_token':"{{csrf_token()}}"                },function(data){                    if(data.status==0){                        //location.href = location.href;                        layer.msg(data.msg,{icon:6});                        $("#del_"+nav_id).remove();                    }else{                        layer.msg(data.msg,{icon:5});                    }                });            });        }    </script>@endsection