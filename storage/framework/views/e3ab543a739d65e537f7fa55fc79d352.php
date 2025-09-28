

<?php $__env->startSection('title', __('messages.services.title')); ?>

<?php $__env->startSection('content'); ?>
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h1 class="section-title"><?php echo e(__('messages.services.title')); ?></h1>
            <p class="section-subtitle"><?php echo e(__('messages.services.subtitle')); ?></p>
        </div>
        
        <div class="row">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 mb-5 fade-in">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon">
                            <?php switch($service->icon):
                                case ('leaf'): ?>
                                    <i class="fas fa-leaf"></i>
                                    <?php break; ?>
                                <?php case ('moon'): ?>
                                    <i class="fas fa-moon"></i>
                                    <?php break; ?>
                                <?php case ('brain'): ?>
                                    <i class="fas fa-brain"></i>
                                    <?php break; ?>
                                <?php default: ?>
                                    <i class="fas fa-heart"></i>
                            <?php endswitch; ?>
                        </div>
                        <h3 class="mb-3"><?php echo e($service->getTranslation('name', app()->getLocale())); ?></h3>
                        <p class="text-muted mb-4"><?php echo e($service->getTranslation('description', app()->getLocale())); ?></p>
                        
                        <div class="mb-4">
                            <?php if($service->price_individual): ?>
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">
                                    <?php echo e(__('messages.services.price_individual')); ?>: <?php echo e(number_format($service->price_individual, 0)); ?>€
                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($service->price_group): ?>
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">
                                    <?php echo e(__('messages.services.price_group')); ?>: <?php echo e(number_format($service->price_group, 0)); ?>€
                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($service->duration): ?>
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">
                                    <?php echo e(__('messages.services.duration')); ?>: <?php echo e($service->duration); ?>

                                </span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(route('services.show', [app()->getLocale(), $service->slug])); ?>" class="btn btn-outline-primary">
                                <?php echo e(__('messages.services.learn_more')); ?>

                            </a>
                            <a href="<?php echo e(route('booking.index', app()->getLocale())); ?>?service=<?php echo e($service->id); ?>" class="btn btn-primary">
                                <?php echo e(__('messages.services.book_now')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/services/index.blade.php ENDPATH**/ ?>