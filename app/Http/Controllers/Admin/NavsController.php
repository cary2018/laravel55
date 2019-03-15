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


use App\Http\Model\Navs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends BaseController
{
    //自定义菜单列表
    public function index()
    {
        $data = Navs::orderby('nav_order','desc')->get();
        $data = (new Navs())->GetTree($data);
        return view('admin.navs.index')->with('data',$data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 创建自定义导航
     */
    public function create()
    {
        $data = Navs::where('nav_show',1)->orderby('nav_order','desc')->get();
        $date = (new Navs())->GetTree($data);
        return view('admin.navs.add')->with('arr',$date);
    }

    /**
     * 执行添加自定义导航操作
     */
    public function store()
    {
        $input = Input::except('_token');
        $input = array_filter($input);
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $messages = [
            'nav_name.required'=>'导航名称不能为空！',
            'nav_url.required'=>'URL地址不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Navs::create($input);
            if ($re)
            {
                return redirect('admin/navs');
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
     * 编辑自定义导航页面
     */
    public function edit($id)
    {
        $field = Navs::find($id);
        $data = Navs::orderby('nav_order','desc')->get();
        $arr = (new Navs())->GetTree($data);
        return view('admin.navs.edit',compact('field','arr'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 更新自定义导航操作
     */
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $input = array_filter($input);
        if(!array_key_exists('nav_pid',$input)){
            $input['nav_pid'] = 0;
        }
        if(!array_key_exists('nav_show',$input)){
            $input['nav_show'] = 0;
        }
        $data = Navs::all();
        $tree = (new Navs())->GetTree($data,$id);
        $return_id = (new Navs())->return_id($tree);
        if($id == $input['nav_pid']){
            return back()->with('errors', '上级分类错误！！');
        }
        if(in_array($input['nav_pid'],$return_id)){
            return back()->with('errors', '上级分类错误！！');
        }
        $re = Navs::where('nav_id',$id)->update($input);
        if ($re)
        {
            return redirect('admin/navs');
        }else{
            return back()->with('errors', '数据未发生变化！！');
        }
    }

    /**
     * @param $nav_id
     * @return array
     * @throws \Exception
     * 删除自定义导航
     */
    public function destroy($nav_id)
    {
        $re = Navs::where('nav_id',$nav_id)->delete();
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

    /**
     * 异步更新排序&&是否有效
     */
    public function changeOrder()
    {
        $input = Input::except('_token');
        $re = Navs::where('nav_id',$input['nav_id'])->update($input);
        if($re)
        {
            $data = Navs::find($input['nav_id'],['nav_id','nav_show']);
            $result = [
                'status'=>1,
                'msg' => '状态更新成功！'
            ];
        }else{
            $result = [
                'status'=>0,
                'msg' => '状态更新失败！'
            ];
        }
        return $result;
    }

    /**
     * @return array
     * 异步更新导航状态
     */
    public function changeShow()
    {
        $input = Input::except('_token');
        $nav = Navs::find($input['nav_id']);
        if($input['nav_show']==0)
        {
            $nav->nav_show = 1;
        }else{
            $nav->nav_show = 0;
        }
        $re = $nav->update();
        if($re)
        {
            $data = Navs::find($input['nav_id'],['nav_id','nav_show']);
            $result = [
                'status'=>$data->nav_show,
                'msg' => '状态更新成功！'
            ];
        }else{
            $result = [
                'status'=>$data->nav_show,
                'msg' => '状态更新失败！'
            ];
        }

        return $result;
    }
}
