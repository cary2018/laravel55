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
use Intervention\Image\ImageManagerStatic as Image;//依赖包的Image静态方法生成缩略图

class UploadController extends Controller
{

    public function upload()
    {
        $file = Input::file('Filedata');
        $allowed_extensions = ["png", "jpg", "gif","jpeg","bmp"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => '允许上传文件类型为：gif; *.jpg; *.png;*.jpeg;*.bmp'];die;
        }

        if($file->isValid())
        {
            $file_path = '/uploads/'.date('Y-m-d',time()).'/';    //上传文件的目录
            //判断文件目录是否存在,不存在则创建
            if(!is_dir($file_path)){
                mkdir($file_path,0777,true);
            }
            $clientName = $file -> getClientOriginalName();    //客户端文件名称..
            $entension = $file->getClientOriginalExtension();               //上传文件的后缀
            $newName = date('YmdHis').time().mt_rand(100,999).'.'.$entension;  //重命名上传文件
            $path = $file->move(public_path().$file_path,$newName);             //将文件移动到目录下
            if ($path)
            {
                $new_filename = public_path().$file_path.$newName;

                $thumb_name = 'thumb_'.$newName;

                $thumb = public_path().$file_path.$thumb_name;

                Image::make($new_filename)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumb);  //生成缩略图并保存
                Image::make($new_filename)->resize(300,300)->save($thumb);  //生成缩略图并保存
            }
            return $file_path.$thumb_name;
        }
    }

    /**
     * @param $request
     * @param string $field
     * @return array
     * 上传测试
     */
    function upload_image($request, $field = 'Filedata') {

        $file = $request->file($field);
        if ($file->isValid()) {
            $extension = $file->getClientOriginalExtension(); //获取上传图片的后缀名
            if (!in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png'])) {
                return ['code' => 202, 'data' => null, 'msg' => '图片格式只允许pdf,jpg,jpeg,png'];
            }
            $date = date('Y-m-d');
            $fileName = $date . '/' . md5(time()) . random_int(5,5) . "." . $extension; //5、重新命名上传文件名字
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $bool = Storage::disk('admin')->put($fileName, file_get_contents($realPath));//解决方式 换成 Storage::disk('')->put()
            if ($bool) {
                return ['code' => 200, 'data' => '/' .$fileName, 'msg' => '图片上传成功'];
            }
            return ['code' => 202, 'data' => $file, 'msg' => '图片上传失败'];
        } else {
            return ['code' => 202, 'data' => null, 'msg' => '图片上传失败'];
        }
    }
}