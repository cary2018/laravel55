<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';    //自定义表名
    protected $primaryKey = 'cate_id';       //自定义主键
    public $timestamps = false;         //禁用默认更新设置
    protected $guarded = [];            //保护字段

    /**
     * @param $data  传入的数据
     * @param int $id  上级id
     * @param int $lave 分级层次
     * @return array
     * 递归无限分类
     */
    public function ArrTree($data,$id=0,$lave=0){
        static $tree = array();
        foreach($data as $k){
            if($k->cate_pid == $id){
                $k->lave = $lave;
                $k->art = Article::where('cate_id','=',$k->cate_id)->count();
                $tree[] = $k;
                $this->ArrTree($data,$k->cate_id,$lave+1);
            }
        }
        return $tree;
    }

    /**
     * @param $data
     * @return array
     * 返回数组中的ID，用于判断选择上级分类是否有效
     */
    public function return_id($data)
    {
        static $arr = array();
        foreach($data as $v)
        {
            $arr[] = $v->cate_id;
        }
        return $arr;
    }
}
