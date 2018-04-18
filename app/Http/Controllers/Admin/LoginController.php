<?php/** * Created by PhpStorm. * User: asusa * Date: 2018/4/11/0011 * Author: Cary.He * Contact QQ  : 373889161($S$-Memory) * email: 373889161@qq.com * Time: 16:05 */namespace App\Http\Controllers\Admin;use App\Http\Controllers\Controller;use App\Http\core\ValidateCode;use App\Http\Model\Admin_user;use Illuminate\Support\Facades\Hash;use Illuminate\Support\Facades\Input;class LoginController extends Controller{    public function index()    {        if($input = Input::all())        {            //判断验证码            if(strtoupper($input['code']) != $_SESSION['code_session'])            {                return back()->with('mess','验证码错误！');            }            $user = Admin_user::where('user_name',$input['username'])->first();            if ($user) {                if (Hash::check($input['password'], $user->password)) {                    //return back()->with('mess','密码正确！');                    session(['user' => $user]);   //保存用户登录信息                    return redirect('admin/index');                } else {                    return back()->with('mess', '密码错误！');                }            } else {                return back()->with('mess', '用户名错误！');            }        } else {            return view('admin.login.index');        }    }    public function logut()    {        session(['user'=>'']);        return redirect('admin/login');    }    public function code()    {        $new = new ValidateCode();        echo $new->doimg();        $_SESSION['code_session'] = $new->getCode();//验证码保存到SESSION中    }    public function get_code()    {        echo $_SESSION['code_session'];        $pa = 123;        $jp = Hash::make($pa);        if (Hash::check('123', $jp)) {            // 密码匹配...            echo '密码验证通过！';        }else{            echo '密码验证失败！';        }    }}