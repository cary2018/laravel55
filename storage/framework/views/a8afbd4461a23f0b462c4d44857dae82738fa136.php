<?php $__env->startSection('content'); ?>    <div id="page-wrapper">        <div class="main-page">            <div class="tables">                <div class="bs-example widget-shadow" data-example-id="hoverable-table">                    <h4>                        自定义菜单:                        <a href="<?php echo e(url('admin/navs/create')); ?>" class="btn btn-primary">添加菜单</a>                    </h4>                    <table class="table table-hover">                        <thead>                        <tr>                            <th>导航名</th>                            <th>别名</th>                            <th>URl地址</th>                            <th>排序</th>                            <th>显示</th>                            <th>操作</th>                        </tr>                        </thead>                        <tbody>                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                            <tr id="del_<?php echo e($v->nav_id); ?>">                                <td>                                    <a href="<?php echo e($v->nav_url); ?>" target="_blank">                                         <?php if($v->lave!=0): ?> <?php echo '┝'.str_repeat('━',$v->lave)?> <?php endif; ?> <?php echo e($v->nav_name); ?>                                    </a>                                </td>                                <td><?php echo e($v->nav_alias); ?></td>                                <td><?php echo e($v->nav_url); ?></td>                                <td style="cursor:pointer;" onclick="change_order(this,<?php echo e($v->nav_id); ?>)" id="<?php echo e($v->nav_id); ?>"><?php echo e($v->nav_order); ?></td>                                <td style="cursor:pointer;" onclick="show(this)" id="<?php echo e($v->nav_id); ?>" alt="<?php echo e($v->nav_show); ?>" >                                    <?php if($v->nav_show ==1): ?>                                        <img src="/images/yes.gif" />                                        <?php else: ?>                                        <img src="/images/no.gif" />                                    <?php endif; ?>                                </td>                                <td>                                    <a href="<?php echo e(url('admin/navs/'.$v->nav_id.'/edit')); ?>">修改</a>                                    /                                    <a href="javascript:;" onclick="delNav(<?php echo e($v->nav_id); ?>)">删除</a>                                </td>                            </tr>                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        </tbody>                    </table>                </div>            </div>        </div>    </div>    <script>        //异步修改菜单排序        function change_order(obj)        {            var val = $(obj).attr('id');   //要修改的菜单ID            var oval = $(obj).text();      //排序的数值                var input = $("<input type=text name=\"order\" size=\"6\" maxlength='5' class=\"foc\" value='"+oval+"' />");                //添加input                $(obj).html(input);                //选中内容                input.trigger('select');                //在input在点击无效                input.click(function(){return false;});                //光标离开 input 后进行更新相关操作                input.blur(function(){                    var tex = $(this).val();                    if(tex != oval)                    {                        $(obj).html(tex);                        $.post("<?php echo e(url('admin/changeOrder')); ?>",{                            _token:"<?php echo e(csrf_token()); ?>",                            nav_id:val,                            nav_order:tex                        },function(data){                            if(data.status == 1)                            {                                layer.msg(data.msg,{icon:6});                                //alert(data.msg);                            }                            else                            {                                layer.msg(data.msg,{icon:5});                            }                            //alert(object.result+'---'+status);                        });                    }                    else                    {                        $(obj).html(tex);                    }                });        }        //异步修改菜单是否显示        function show(obj)        {            var uid = $(obj).attr('id');            var oval = $(obj).attr('alt');            //alert(oval);            $.post("<?php echo e(url('admin/changeShow')); ?>",{                _token:"<?php echo e(csrf_token()); ?>",                nav_id:uid,                nav_show:oval            },function(data){                if(data.status == 1)                {                    $(obj).attr('alt',data.status);                    $(obj).html('<img src="/images/yes.gif" />');                    //alert(data.msg);                }                else                {                    $(obj).attr('alt',data.status);                    $(obj).html('<img src="/images/no.gif" />');                }            });        }        //异步删除菜单        function delNav(nav_id){            layer.confirm('您确定要删除这篇文章吗？',{                btn:['确定','取消']  //按钮            },function () {                $.post("<?php echo e(url('admin/navs/')); ?>/"+nav_id,{                    '_method':'delete',                    '_token':"<?php echo e(csrf_token()); ?>"                },function(data){                    if(data.status==0){                        //location.href = location.href;                        layer.msg(data.msg,{icon:6});                        $("#del_"+nav_id).remove();                    }else{                        layer.msg(data.msg,{icon:5});                    }                });            });        }    </script><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>