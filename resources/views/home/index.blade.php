@extends('layouts.home')@section('info')    <title>{{config('web.web_title')}}</title>    <meta name="keywords" content="{{config('web.web_keywords')}}" />    <meta name="description" content="{{config('web.web_description')}}" />@endsection@section('content')    <div class="banner">        <section class="box">            <ul class="texts">                <p>从黑暗中感觉到                    在无助的时候                    在夜里是谁对我说                    别心灰想得太多                    全因你的一颗心                    </p>                <p>在藏着的承诺                    现实里时常对我说                    你定会冲破一切                    全赖你给我一双手臂                    就算在北风中</p>                <p>你也总没逃避                    全赖你给我一双手臂                    来为我奉上是最真挚的心                    似风呼应</p>            </ul>            <div class="avatar"><a href="javascript:;"> <span>何业优</span></a> </div>        </section>    </div>    <div class="template">        <div class="box">            <h3>                <p><span>热门</span>排行榜</p>            </h3>            <ul>                @foreach($hot as $v)                <li><a href="{{url('a/'.$v->art_id)}}" ><img src="{{$v->art_thumb}}"></a><span>{{$v->art_title}}</span></li>                @endforeach            </ul>        </div>    </div>    <article>        <h2 class="title_tj">            <p>文章<span>推荐</span></p>        </h2>        <div class="bloglist left">            @foreach($data as $v)            <h3>{{$v->art_title}}</h3>            <figure><img src="{{$v->art_thumb}}"></figure>            <ul>                <p>{{$v->art_description}}</p>                <a title="{{$v->art_title}}" href="{{url('a/'.$v->art_id)}}" class="readmore">阅读全文>></a>            </ul>            <p class="dateview"><span>{{date('Y-m-d',$v->art_add_time)}}</span><span>作者：{{$v->art_author}}</span></p>            @endforeach            <div class="page">                {{$data->links()}}            </div>        </div>        <aside class="right">            <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>            @parent        </aside>    </article>@endsection