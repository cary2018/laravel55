<?php/** * Created by PhpStorm. * User: asusa * Date: 2018/6/13/0013 * Author: Cary.He * Contact QQ  : 373889161($S$-Memory) * email: 373889161@qq.com * Time: 15:39 */namespace App\Http\Model;use Illuminate\Database\Eloquent\Model;class Role_access extends Model{    protected $table = 'role_access';    //自定义表名    protected $primaryKey = 'id';       //自定义主键    public $timestamps = false;         //禁用默认更新设置    protected $guarded = [];             //保护字段}