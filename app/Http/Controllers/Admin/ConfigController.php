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

use App\Http\Model\Sys_config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends BaseController
{
    //系统配置列表
    public function index()
    {
        $data = Sys_config::orderby('config_order','desc')->paginate(10);
        foreach($data as $k=>$v)
        {
            switch ($v->config_type)
            {
                case 'input':
                    $data[$k]->_html = '<input type="text" name="config_content[]" value="'.$v->config_content.'" class="form-control" id="nav_url" >';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea name="config_content[]" id="config_content" style="height:50px;" cols="50" rows="4" class="form-control1">'.$v->config_content.'</textarea>';
                    break;
                case 'radio':
                    $c = '';
                    if($v->config_content == 1){
                        $data[$k]->_html .= '<label for="sl1" class="poin" style="cursor:pointer;"><div class="mail "><input type="radio" style="min-height:20px;float:left" checked name="config_content[]" value="1" id="sl1" class="checkbox"></div><div class="mail "> <h6>是</h6> </div></label>';
                        $data[$k]->_html .= '<label for="sl2" class="poin" style="cursor:pointer;"><div class="mail "><input type="radio" style="min-height:20px;float:left;" name="config_content[]" value="0" id="sl2" class="checkbox"></div><div class="mail "> <h6>否</h6> </div></label>';
                    }else{
                        $data[$k]->_html .= '<label for="sl1" class="poin" style="cursor:pointer;"><div class="mail "><input type="radio" style="min-height:20px;float:left" name="config_content[]" value="1" id="sl1" class="checkbox"></div><div class="mail "> <h6>是</h6> </div></label>';
                        $data[$k]->_html .= '<label for="sl2" class="poin" style="cursor:pointer;"><div class="mail "><input type="radio" style="min-height:20px;float:left;" checked name="config_content[]" value="0" id="sl2" class="checkbox"></div><div class="mail "> <h6>否</h6> </div></label>';
                    }
                    break;
                case 'number':
                    $data[$k]->_html = '<input type="text" name="config_content[]" value="'.$v->config_content.'" class="form-control" id="number" >';
                    break;
            }
        }
        return view('admin.config.index')->with('data',$data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 创建系统配置
     */
    public function create()
    {
        return view('admin.config.add');
    }

    /**
     * 执行添加系统配置操作
     */
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'config_name' => 'required',
            'config_tips' => 'required',
        ];
        if($input['config_type']=='radio' && $input['config_content']!='')
        {
            $input['config_content'] = strtolower($input['config_content']);
            $rules['config_content'] = 'boolean';
        }
        if($input['config_type']=='number' && $input['config_content']!='')
        {
            $input['config_content'] = strtolower($input['config_content']);
            $rules['config_content'] = 'digits_between:1,5';
        }
        $messages = [
            'config_content.digits_between'=>'选择的参数类型为数字，请填写小于5位的数字！',
            'config_content.boolean'=>'选择的参数类型是布尔值，必需填写1或者0！',
            'config_name.required'=>'变量名不能为空！',
            'config_tips.required'=>'参数说明不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Sys_config::create($input);
            if ($re)
            {
                $this->putFile();
                return redirect('admin/config');
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
     * 编辑系统配置页面
     */
    public function edit($id)
    {
        $field = Sys_config::find($id);
        return view('admin.config.edit',compact('field'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 更新系统配置操作
     */
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $rules = [
            'config_name' => 'required',
            'config_tips' => 'required',
        ];
        if($input['config_type']=='radio' && $input['config_content']!='')
        {
            $input['config_content'] = strtolower($input['config_content']);
            $rules['config_content'] = 'boolean';
        }
        if($input['config_type']=='number' && $input['config_content']!='')
        {
            $input['config_content'] = strtolower($input['config_content']);
            $rules['config_content'] = 'digits_between:1,5';
        }
        $messages = [
            'config_content.digits_between'=>'类型为数字，请填写小于5位的数字！',
            'config_content.boolean'=>'选择的参数类型是布尔值，必需填写1或者0！',
            'config_name.required'=>'变量名不能为空！',
            'config_tips.required'=>'参数说明不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Sys_config::where('config_id',$id)->update($input);
            if ($re)
            {
                $this->putFile();
                return redirect('admin/config');
            }else{
                return back()->with('errors', '数据未发生变化！！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * @param $config_id
     * @return array
     * @throws \Exception
     * 删除系统配置
     */
    public function destroy($config_id)
    {
        $re = Sys_config::where('config_id',$config_id)->delete();
        if ($re)
        {
            $data = [
                'status'=>0,
                'msg'=>'删除成功！'
            ];
            $this->putFile();
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败，请稍后再试！'
            ];
        }
        return $data;
    }

    public function change()
    {
        $input = Input::all();
        foreach($input['config_id'] as $k=>$v)
        {
            Sys_config::where('config_id',$v)->update(['config_content' => $input['config_content'][$k]]);
            $this->putFile();
        }
        return back()->with('errors', '更新完成！');
    }

    /**
     * 将配置项写入文件中
     */
    public function putFile()
    {
        $data = Sys_config::pluck('config_content','config_name')->all();
        $path = base_path().'/config/web.php';
        $str = '<?php return '.var_export($data,true).';';
        file_put_contents($path,$str);
        //dd($data);
    }
}
