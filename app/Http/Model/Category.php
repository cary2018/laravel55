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
     * @param $data         传入的据
     * @param int $id       取指定ID的所有下级（包括自己）
     * @param int $i        计算菜单层级
     * @return array        返回结果
     * @param $file_name    分类字段名
     * @param string $pid   PID字段名
     * @return array
     * 递归无限菜单
     */
    public function getTree($data,$file_name,$pid='pid',$id=0,$i = 0)
    {
        $arr = array();
        foreach($data as $k=>$v)
        {
            if($v->$pid == $id)
            {
                if($id != 0)
                {
                    $data[$k]['_parent'] = $i+1;
                    $data[$k]['_'.$file_name] = '┝'.$this->line($data[$k]['_parent']).$data[$k][$file_name];
                    $data[$k]['_art'] = Article::where('cate_id','=',$v->cate_id)->count();
                }
                else{
                    $data[$k]['_'.$file_name] = $data[$k][$file_name];
                    $data[$k]['_art'] = Article::where('cate_id','=',$v->cate_id)->count();
                }
                $arr[] = $data[$k];
                foreach($data as $m=>$n)
                {
                    if($n->$pid == $v->cate_id)
                    {
                        $data[$m]['_parent'] = $data[$k]['_parent']+1;
                        $data[$m]['_'.$file_name] = '┝'.$this->line($data[$m]['_parent']).$data[$m][$file_name];
                        $data[$m]['_art'] = Article::where('cate_id','=',$n->cate_id)->count();
                        $arr[] = $data[$m];
                        $arr[] = $this->getTree($data,$file_name,$pid,$n->cate_id,$data[$m]['_parent']);
                    }
                }
            }
        }
        return array_filter($arr);
    }

    /**
     * @param $va
     * @return string
     * 层级隔离线
     */
    public function line($va){
        $af = '';
        for($i=0;$i<$va;$i++)
        {
            $af .= '━';
        }
        return $af;
    }

    /**
     * @param $array
     * @return array
     * 多维数组转一维数组
     */
    public function array_one($array){
        static $result_array=array();
        foreach($array as $value)
        {
            if(is_array($value))
            {
                $this->array_one($value);
            }
            else
            {
                $result_array[]=$value;
            }
        }
        return $result_array;
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
