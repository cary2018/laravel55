<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_user extends Model
{
    protected $table = 'admin_user';    //自定义表名
    protected $primaryKey = 'id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];             //保护字段
    //
}
