<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';    //自定义表名
    protected $primaryKey = 'art_id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];            //保护字段
    //
}
