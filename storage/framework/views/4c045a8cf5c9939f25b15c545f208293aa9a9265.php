<?php/** * Created by PhpStorm. * User: asusa * Date: 2018/6/5/0005 * Author: Cary.He * Contact QQ  : 373889161($S$-Memory) * email: 373889161@qq.com * Time: 15:03 */?><?php $__env->startSection('content'); ?>    <div id="page-wrapper">        <div class="main-page">            <div class="tables">                <div class="bs-example widget-shadow" data-example-id="hoverable-table">                    <h4>                        角色列表:                        <a href="<?php echo e(url('admin/jurisdiction/create')); ?>" class="btn btn-primary">添加角色</a>                    </h4>                    <table class="table table-hover">                        <thead>                        <tr>                            <th>ID</th>                            <th>权限名称</th>                            <th>权限地址</th>                            <th>状 态</th>                            <th>添加时间</th>                            <th>更新时间</th>                            <th>操作</th>                        </tr>                        </thead>                        <tbody>                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            <tr id="del_<?php echo e($v->id); ?>">                                <th scope="row"><?php echo e($v->id); ?></th>                                <td>                                    <a href="<?php echo e(url('admin/jurisdiction/'.$v->id.'/edit')); ?>">                                        <?php echo e($v->title); ?>                                    </a>                                </td>                                <td><?php $u = $v->urls?json_decode($v->urls):'';                                    echo nl2br($u?implode('',$u):'');?></td>                                <td onclick="admin(this)" id="<?php echo e($v->id); ?>" >                                    <?php echo e($v->status); ?>                                </td>                                <td><?php echo e(date('Y-m-d H:i:s',$v->created_time)); ?></td>                                <td><?php echo e(date('Y-m-d H:i:s',$v->update_time)); ?></td>                                <td>                                    <a href="<?php echo e(url('admin/jurisdiction/'.$v->id.'/edit')); ?>">修改</a>                                    /                                    <a href="javascript:;" onclick="delArt(<?php echo e($v->id); ?>)">删除</a>                                </td>                            </tr>                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        </tbody>                    </table>                </div>                <div style="margin:0 auto;">                    <div style="text-align:center;">                        <?php echo e($data->links()); ?>                    </div>                </div>            </div>        </div>    </div>    <script type="text/javascript">        //搜索        function changeuser(){            $("#serform").submit();        }    </script>    <script>        //异步删除角色        function delArt(art_id){            layer.confirm('您确定要删除这篇文章吗？',{                btn:['确定','取消']  //按钮            },function () {                $.post("<?php echo e(url('admin/jurisdiction/')); ?>/"+art_id,{                    '_method':'delete',                    '_token':"<?php echo e(csrf_token()); ?>"                },function(data){                    if(data.status==0){                        //location.href = location.href;                        layer.msg(data.msg,{icon:6});                        $("#del_"+art_id).remove();                    }else{                        layer.msg(data.msg,{icon:5});                    }                });            });        }    </script><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>