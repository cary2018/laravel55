<?php/** * Created by PhpStorm. * User: asusa * Date: 2018/4/16/0016 * Author: Cary.He * Contact QQ  : 373889161($S$-Memory) * email: 373889161@qq.com * Time: 10:07 */namespace App\Http\Controllers\Admin;use App\Http\Controllers\Controller;use App\Http\Model\Article;use App\Http\Model\Category;use Illuminate\Support\Facades\Input;use Illuminate\Support\Facades\Validator;class CategoryController extends Controller{    /**     * @return $this     * 分类列表     */    public function index()    {        $categorys = Category::all();        $data = (new Category())->getTree($categorys,'cate_name','cate_pid');        $data = (new Category())->array_one($data);        return view('admin.category.index')->with('data',$data);    }    /**     * @return $this     * 添加文章栏目页面     */    public function create()    {        $categorys = Category::all();        $data = (new Category())->getTree($categorys,'cate_name','cate_pid');        $data = (new Category())->array_one($data);        return view('admin.category.add')->with('data',$data);    }    /**     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector     * 执行添加文章栏目操作     */    public function store()    {        $input = Input::except('_token');        $input = array_filter($input);        $rules = [            'cate_name' => 'required',        ];        $messages = [            'cate_name.required'=>'分类名称不能为空！',        ];        $validator = Validator::make($input,$rules,$messages);        if($validator->passes()){            $re = Category::create($input);            if ($re)            {                return redirect('admin/category');            }else{                return back()->with('errors', '添加失败，请重新添加！');            }        }else{            return back()->withErrors($validator);        }    }    /**     * @param $id     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View     * 编辑文章栏目信息     */    public function edit($id)    {        $categorys = Category::all();        $data = (new Category())->getTree($categorys,'cate_name','cate_pid');        $data = (new Category())->array_one($data);        $field = Category::find($id);        return view('admin.category.edit',compact('field','data'));    }    /**     * @param $id     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector     * 提交更新分类     */    public function update($id)    {        $input = Input::except('_token','_method');        $input = array_filter($input);        //dd($input);        $categorys = Category::all();        $data = (new Category())->getTree($categorys,'cate_name','cate_pid',$id);        $data = (new Category())->array_one($data);        $data = (new Category())->return_id($data);        if (array_key_exists("cate_pid",$input))        {            if($id != $input['cate_pid'])            {                if(in_array($input['cate_pid'],$data))                {                    echo $input['cate_pid'];                }else{                    //echo $input['cate_pid'].'no!';                    $re = Category::where('cate_id',$id)->update($input);                    if ($re)                    {                        return redirect('admin/category');                    }else{                        return back()->with('errors', '数据未发生变化！');                    }                }            }else{                return back()->with('errors', '上级分类选择错误！');            }        }        else        {            $input['cate_pid'] = 0;            $re = Category::where('cate_id',$id)->update($input);            if ($re)            {                return redirect('admin/category');            }else{                return back()->with('errors', '数据未发生变化！！');            }        }    }    /**     * @param $cate_id     * @return array     * @throws \Exception     * 删除文章栏目     */    public function destroy($cate_id)    {        $re = Article::where('cate_id',$cate_id)->first();        if ($re)        {            $data = [                'status'=>1,                'msg'=>'分类下有数据，不能直接删除！'            ];        }else{            $categorys = Category::all();            $data = (new Category())->getTree($categorys,'cate_name','cate_pid',$cate_id);            $data = (new Category())->array_one($data);            $data = (new Category())->return_id($data);            if($data)            {                $data = [                    'status'=>1,                    'msg'=>'栏目有子栏目，不能直接删除！'                ];            }else{                $del = Category::where('cate_id',$cate_id)->delete();                if($del){                    $data = [                        'status'=>0,                        'msg'=>'删除成功！！'                    ];                }else{                    $data = [                        'status'=>1,                        'msg'=>'删除失败，请稍后再试！！'                    ];                }            }        }        return $data;    }}