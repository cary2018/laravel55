<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    protected $table = 'navs';    //自定义表名
    protected $primaryKey = 'nav_id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];            //保护字段

    /**
     * @param $arr   传入的数据
     * @param int $id  上级id
     * @param int $lave 层次
     * @return array
     * 递归无限分类
     */
    public function GetTree($arr,$id=0,$lave=0){
        static $tree = array();
        foreach($arr as $k){
            if($k->nav_pid == $id){
                $k->lave = $lave;
                $tree[] = $k;
                $this->GetTree($arr,$k->nav_id,$lave+1);
            }
        }
        return $tree;
    }

    /**
     * @param $data
     * @return array
     */
    public function return_id($data)
    {
        static $arr = array();
        foreach($data as $v)
        {
            $arr[] = $v->nav_id;
        }
        return $arr;
    }
}
