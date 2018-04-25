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

Route::group(['middleware'=>['web']],function(){
    Route::get('/', function () {
        //return 'hello laravel!';
        return view('welcome');
    });
});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'admin.login'],function(){
    Route::get('/','IndexController@index');
    Route::get('index','IndexController@index');
    Route::any('pass','AdminController@pass');
    Route::any('upload','UploadController@upload');

    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');
    Route::resource('links','LinksController');
    Route::resource('navs','NavsController');

    Route::post('change', 'configController@change');
    Route::get('putfile', 'configController@putFile');
    Route::resource('config','ConfigController');

});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['web']],function(){
    Route::any('login','LoginController@index');
    Route::get('logut','LoginController@logut');
    Route::get('code','LoginController@code');
    Route::get('get_code','LoginController@get_code');
});
