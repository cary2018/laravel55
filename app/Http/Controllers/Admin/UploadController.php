<?php
/**
 * Created by PhpStorm.
 * User: asusa
 * Date: 2018/4/13/0013
 * Author: Cary.He
 * Contact QQ  : 373889161($S$-Memory)
 * email: 373889161@qq.com
 * Time: 11:51
 */
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{

    public function upload()
    {
        $file = Input::file('Filedata');
        //dd($file);
        if($file->isValid())
        {
            $file_path = '/uploads/'.date('Y-m-d',time()).'/';    //上传文件的目录
            //判断文件目录是否存在,不存在则创建
            if(!is_dir($file_path)){
                mkdir($file_path,0777,true);
            }
            $entension = $file->getClientOriginalExtension();               //上传文件的后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;  //重命名上传文件
            $path = $file->move(public_path().$file_path,$newName);
            return $file_path.$newName;
        }
    }
}
