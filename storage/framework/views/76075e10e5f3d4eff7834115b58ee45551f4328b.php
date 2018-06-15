<?php $__env->startSection('content'); ?>    <div id="page-wrapper">        <div class="main-page">            <div class="forms">                <div class=" form-grids row form-grids-right">                    <div class="widget-shadow " data-example-id="basic-forms">                        <div class="form-title">                            <h4>                                编辑用户 :                                <a href="<?php echo e(url('admin/jurisdiction')); ?>" class="btn btn-default">返回用户列表</a>                            </h4>                        </div>                        <div class="form-body">                            <form action="<?php echo e(url('admin/jurisdiction/'.$field->id)); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">                                <input type="hidden" name="_method" value="put">                                <?php echo e(csrf_field()); ?>                                <div style="margin:0 auto;height: auto;padding-bottom:20px;">                                    <div class="form-body" style="text-align:center;">                                        <?php if(is_object($errors)): ?>                                            <?php if(count($errors)>0): ?>                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                    <h4><?php echo e($item); ?></h4>                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            <?php endif; ?>                                        <?php else: ?>                                            <h4><?php echo e($errors); ?></h4>                                        <?php endif; ?>                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_title" class="col-sm-2 control-label">权限名称*</label>                                    <div class="col-sm-9">                                        <input type="text" name="title" value="<?php echo e($field->title); ?>" class="form-control" id="art_title" >                                    </div>                                </div>                                <div class="form-group">                                    <label for="urls" class="col-sm-2 control-label">权限地址URLS</label>                                    <div class="col-sm-9 inbox-page">                                        <textarea name="urls" id="urls" style="height:150px;" placeholder="一行一个url" rows="5" class="form-control1"><?php                                                $u = $field->urls?json_decode($field->urls):'';                                                echo $u?implode('',$u):'';                                            ?></textarea>                                    </div>                                </div>                                <div class="form-group">                                    <label for="art_description" class="col-sm-2 control-label">状 态</label>                                    <div class="col-sm-9 inbox-page">                                        <label for="jurisdiction" class="poin" style="cursor:pointer;">                                            <div class="mail ">                                                <input type="checkbox" style="min-height:20px;" value="1" name="status" id="jurisdiction" <?php if($field->status ==1): ?> checked <?php endif; ?> class="checkbox">                                            </div>                                            <div class="mail "> <h6>有 效</h6> </div>                                        </label>                                    </div>                                </div>                                <div class="col-sm-offset-2">                                    <button type="submit" class="btn btn-default">提 交</button>                                </div>                            </form>                        </div>                    </div>                </div>            </div>        </div>    </div><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>