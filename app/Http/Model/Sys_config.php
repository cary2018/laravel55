<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Sys_config extends Model
{
    protected $table = 'sys_config';    //自定义表名
    protected $primaryKey = 'config_id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];            //保护字段
}
