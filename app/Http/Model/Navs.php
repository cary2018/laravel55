<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    protected $table = 'navs';    //自定义表名
    protected $primaryKey = 'nav_id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];            //保护字段
}
