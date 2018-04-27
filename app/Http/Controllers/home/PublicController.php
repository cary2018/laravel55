<?php/** * Created by PhpStorm. * User: asusa * Date: 2018/4/25/0025 * Author: Cary.He * Contact QQ  : 373889161($S$-Memory) * email: 373889161@qq.com * Time: 14:57 */namespace App\Http\Controllers\home;use App\Http\Controllers\Controller;use App\Http\Model\Article;use App\Http\Model\Links;use App\Http\Model\Navs;use Illuminate\Support\Facades\View;class PublicController extends Controller{    public function __construct()    {        //导航菜单        $navs = Navs::where('nav_show',1)->orderBy('nav_order','desc')->get();        //最新发布的8篇文章        $new = Article::orderBy('art_view','desc')->take(8)->get();        //点击排行5篇        $rhot = Article::orderBy('art_view','desc')->take(5)->get();        //友情链接        $links = Links::orderBy('link_order','desc')->get();        View::share('navs',$navs);        View::share('new',$new);        View::share('links',$links);        View::share('rhot',$rhot);    }}