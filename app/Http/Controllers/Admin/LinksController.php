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
namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends BaseController
{
    /**
     * @return $this
     * 友情链接列表
     */
    public function index()
    {
        $data = Links::orderby('link_id','desc')->paginate(10);
        return view('admin.links.index')->with('data',$data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 创建友情链接
     */
    public function create()
    {
        return view('admin.links.add');
    }

    /**
     * 执行添加友情链接操作
     */
    public function store()
    {
        $input = Input::except('_token');
        $input['link_time'] = time();
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];
        $messages = [
            'link_name.required'=>'网站名称不能为空！',
            'link_url.required'=>'网站地址不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $input = array_filter($input);
            $re = Links::create($input);
            if ($re)
            {
                return redirect('admin/links');
            }else{
                return back()->with('errors', '添加失败，请重新添加！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 编辑友情链接页面
     */
    public function edit($id)
    {
        $field = Links::find($id);
        return view('admin.links.edit',compact('field'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 更新友情链接操作
     */
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $input = array_filter($input);
        $re = Links::where('link_id',$id)->update($input);
        if ($re)
        {
            return redirect('admin/links');
        }else{
            return back()->with('errors', '数据未发生变化！！');
        }
    }

    /**
     * @param $link_id
     * @return array
     * @throws \Exception
     * 删除友情链接
     */
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if ($re)
        {
            $data = [
                'status'=>0,
                'msg'=>'删除成功！'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败，请稍后再试！'
            ];
        }
        return $data;
    }
}
