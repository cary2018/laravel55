<?php $__env->startSection('info'); ?>    <title><?php echo e(config('web.web_title')); ?></title>    <meta name="keywords" content="<?php echo e(config('web.web_keywords')); ?>" />    <meta name="description" content="<?php echo e(config('web.web_description')); ?>" /><?php $__env->stopSection(); ?><?php $__env->startSection('content'); ?>    <div class="banner">        <section class="box">            <ul class="texts">                <p>从黑暗中感觉到                    在无助的时候                    在夜里是谁对我说                    别心灰想得太多                    全因你的一颗心                    </p>                <p>在藏着的承诺                    现实里时常对我说                    你定会冲破一切                    全赖你给我一双手臂                    就算在北风中</p>                <p>你也总没逃避                    全赖你给我一双手臂                    来为我奉上是最真挚的心                    似风呼应</p>            </ul>            <div class="avatar"><a href="javascript:;"> <span>何业优</span></a> </div>        </section>    </div>    <div class="template">        <div class="box">            <h3>                <p><span>热门</span>排行榜</p>            </h3>            <ul>                <?php $__currentLoopData = $hot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                <li><a href="<?php echo e(url('a/'.$v->art_id)); ?>" ><img src="<?php echo e($v->art_thumb); ?>"></a><span><?php echo e($v->art_title); ?></span></li>                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            </ul>        </div>    </div>    <article>        <h2 class="title_tj">            <p>最新<span>文章</span></p>        </h2>        <div class="bloglist left">            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            <h3><?php echo e($v->art_title); ?></h3>            <figure>                <a title="<?php echo e($v->art_title); ?>" href="<?php echo e(url('a/'.$v->art_id)); ?>" >                    <img src="<?php echo e($v->art_thumb); ?>">                </a>            </figure>            <ul>                <p><?php echo e($v->art_description); ?></p>                <a title="<?php echo e($v->art_title); ?>" href="<?php echo e(url('a/'.$v->art_id)); ?>" class="readmore">阅读全文>></a>            </ul>            <p class="dateview">                <span><?php echo e(date('Y-m-d H:i:s',$v->art_add_time)); ?></span>                <span>作者：<?php echo e($v->art_author); ?></span>                <span>浏览量：<?php echo e($v->art_view); ?></span>            </p>            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            <div class="page">                <?php echo e($data->links()); ?>            </div>        </div>        <aside class="right">            <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>            ##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##        </aside>    </article><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>