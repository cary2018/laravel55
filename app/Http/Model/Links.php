<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';    //自定义表名
    protected $primaryKey = 'link_id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];            //保护字段
    //
}
