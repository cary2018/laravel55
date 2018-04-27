<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//前台页面
Route::group(['middleware'=>['web']],function(){
    Route::get('/','home\IndexController@index');
    Route::get('/cate/{cate_id}','home\IndexController@cate');
    Route::get('a/{art_id}','home\IndexController@article');
});
//后台页面组
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'admin.login'],function(){
    Route::get('/','IndexController@index');
    Route::get('index','IndexController@index');
    Route::any('pass','AdminController@pass');
    Route::any('upload','UploadController@upload');

    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');
    Route::resource('links','LinksController');
    Route::resource('navs','NavsController');
    Route::post('changeOrder','NavsController@changeOrder');
    Route::post('changeShow','NavsController@changeShow');

    Route::post('change', 'configController@change');
    Route::resource('config','ConfigController');

});
//后台登录路由组
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['web']],function(){
    Route::any('login','LoginController@index');
    Route::get('logut','LoginController@logut');
    Route::get('code','LoginController@code');
    Route::get('get_code','LoginController@get_code');
});
