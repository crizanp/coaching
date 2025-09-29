

<?php $__env->startSection('title'); ?>
<?php echo e($event->getTranslation('title', app()->getLocale())); ?> - <?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e($event->getTranslation('seo_description', app()->getLocale()) ?: $event->getTranslation('description', app()->getLocale())); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('keywords'); ?>
atelier, événement, <?php echo e($event->type); ?>, développement personnel, bien-être, Martinique
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    .container {
        max-width: 1345px !important;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .event-hero {
        margin-top: 80px;
        background: linear-gradient(135deg, #d4b3d6 0%, #f8f5ff 100%);
        border-radius: 0 0 50px 50px;
    }
    
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(212, 179, 214, 0.15);
        border: 1px solid rgba(212, 179, 214, 0.1);
        overflow: hidden;
    }
    
    .event-card-textured {
        background-color: white;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(212, 179, 214, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(248, 245, 255, 0.1) 0%, transparent 50%);
        background-size: 30px 30px;
    }
    
    .gallery-item {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(212, 179, 214, 0.1);
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover {
        transform: scale(1.05);
    }
    
    .application-form {
        background: linear-gradient(135deg, rgba(212, 179, 214, 0.1), rgba(248, 245, 255, 0.2));
        border-radius: 20px;
    }
    
    @media (max-width: 768px) {
        .event-hero {
            margin-top: 60px;
            border-radius: 0 0 30px 30px;
        }
    }
</style>

<!-- Hero Section -->
<section class="event-hero py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="mb-3">
                    <span class="badge px-3 py-2" style="background: rgba(255,255,255,0.2); color: white; border-radius: 20px;">
                        <?php echo e(ucfirst($event->type)); ?> - <?php echo e(ucfirst($event->status)); ?>

                    </span>
                </div>
                <h1 class="display-4 fw-bold text-white mb-4">
                    <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

                </h1>
                <p class="lead text-white opacity-90">
                    <?php echo e($event->getTranslation('description', app()->getLocale())); ?>

                </p>
                
                <?php if($event->can_register): ?>
                <div class="mt-4">
                    <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                       class="btn btn-light btn-lg px-5 py-3" style="border-radius: 50px;">
                        <i class="fas fa-user-plus me-2"></i>
                        <?php echo e(__('messages.events.register_now')); ?>

                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Event Details -->
<section class="event-details py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <!-- Featured Image -->
                <?php if($event->featured_image): ?>
                <div class="content-card mb-4">
                    <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                         alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                         class="w-100" style="height: 400px; object-fit: cover;">
                </div>
                <?php endif; ?>
                
                <!-- Content -->
                <div class="content-card event-card-textured p-4 mb-4">
                    <h2 class="h3 fw-bold mb-4" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.about_event')); ?>

                    </h2>
                    <div class="content">
                        <?php echo nl2br(e($event->getTranslation('content', app()->getLocale()))); ?>

                    </div>
                </div>
                
                <!-- Benefits -->
                <?php if($event->benefits && count($event->getTranslation('benefits', app()->getLocale())) > 0): ?>
                <div class="content-card event-card-textured p-4 mb-4">
                    <h3 class="h4 fw-bold mb-4" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.benefits')); ?>

                    </h3>
                    <div class="row">
                        <?php $__currentLoopData = $event->getTranslation('benefits', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check-circle me-3 mt-1" style="color: #d4b3d6;"></i>
                                <span><?php echo e($benefit); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Program -->
                <?php if($event->program && count($event->getTranslation('program', app()->getLocale())) > 0): ?>
                <div class="content-card event-card-textured p-4 mb-4">
                    <h3 class="h4 fw-bold mb-4" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.program')); ?>

                    </h3>
                    <div class="program-list">
                        <?php $__currentLoopData = $event->getTranslation('program', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="program-item d-flex align-items-start mb-3">
                            <span class="badge me-3 mt-1" style="background: #d4b3d6; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                <?php echo e($index + 1); ?>

                            </span>
                            <span><?php echo e($item); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Requirements -->
                <?php if($event->requirements && count($event->getTranslation('requirements', app()->getLocale())) > 0): ?>
                <div class="content-card event-card-textured p-4 mb-4">
                    <h3 class="h4 fw-bold mb-4" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.requirements')); ?>

                    </h3>
                    <ul class="list-unstyled">
                        <?php $__currentLoopData = $event->getTranslation('requirements', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2">
                            <i class="fas fa-info-circle me-2" style="color: #d4b3d6;"></i>
                            <?php echo e($requirement); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <!-- Gallery -->
                <?php if($event->gallery && count($event->gallery) > 0): ?>
                <div class="content-card p-4">
                    <h3 class="h4 fw-bold mb-4" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.gallery')); ?>

                    </h3>
                    <div class="row">
                        <?php $__currentLoopData = $event->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-3">
                            <div class="gallery-item">
                                <img src="<?php echo e(asset('storage/' . $image)); ?>" 
                                     alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                                     class="w-100" style="height: 200px; object-fit: cover;">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Event Info -->
                <div class="content-card event-card-textured p-4 mb-4">
                    <h3 class="h5 fw-bold mb-4" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.event_info')); ?>

                    </h3>
                    
                    <?php if($event->event_date): ?>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-calendar-alt me-3" style="color: #d4b3d6; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.date')); ?></small>
                            <strong><?php echo e($event->event_date->format('d/m/Y')); ?></strong>
                        </div>
                    </div>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-clock me-3" style="color: #d4b3d6; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.time')); ?></small>
                            <strong><?php echo e($event->event_date->format('H:i')); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($event->duration): ?>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-hourglass-half me-3" style="color: #d4b3d6; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.duration')); ?></small>
                            <strong><?php echo e($event->duration); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($event->price): ?>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-euro-sign me-3" style="color: #d4b3d6; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.price')); ?></small>
                            <strong><?php echo e(number_format($event->price, 2)); ?>€</strong>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($event->max_participants): ?>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-users me-3" style="color: #d4b3d6; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.participants')); ?></small>
                            <strong><?php echo e($event->current_participants); ?>/<?php echo e($event->max_participants); ?></strong>
                            <small class="text-success d-block"><?php echo e($event->available_spots); ?> <?php echo e(__('messages.events.spots_left')); ?></small>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($event->location): ?>
                    <div class="info-item d-flex align-items-start mb-3">
                        <i class="fas fa-map-marker-alt me-3 mt-1" style="color: #d4b3d6; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.location')); ?></small>
                            <?php if(is_array($event->getTranslation('location', app()->getLocale()))): ?>
                                <?php $__currentLoopData = $event->getTranslation('location', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><?php echo e($value); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <strong><?php echo e($event->getTranslation('location', app()->getLocale())); ?></strong>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($event->registration_deadline): ?>
                    <div class="info-item d-flex align-items-center mb-3">
                        <i class="fas fa-exclamation-triangle me-3" style="color: #ff6b6b; width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block"><?php echo e(__('messages.events.deadline')); ?></small>
                            <strong class="text-danger"><?php echo e($event->registration_deadline->format('d/m/Y')); ?></strong>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Registration Card -->
                <?php if($event->can_register): ?>
                <div class="application-form p-4 mb-4">
                    <h3 class="h5 fw-bold mb-3" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.quick_register')); ?>

                    </h3>
                    <p class="text-muted small mb-4">
                        <?php echo e(__('messages.events.register_description')); ?>

                    </p>
                    <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                       class="btn btn-primary w-100">
                        <i class="fas fa-user-plus me-2"></i>
                        <?php echo e(__('messages.events.register_button')); ?>

                    </a>
                </div>
                <?php elseif($event->is_full): ?>
                <div class="alert alert-warning">
                    <h6 class="fw-bold mb-2"><?php echo e(__('messages.events.event_full')); ?></h6>
                    <p class="mb-0 small"><?php echo e(__('messages.events.event_full_description')); ?></p>
                </div>
                <?php elseif(!$event->allow_registration): ?>
                <div class="alert alert-info">
                    <h6 class="fw-bold mb-2"><?php echo e(__('messages.events.registration_closed')); ?></h6>
                    <p class="mb-0 small"><?php echo e(__('messages.events.contact_for_info')); ?></p>
                </div>
                <?php endif; ?>
                
                <!-- Contact Card -->
                <div class="content-card event-card-textured p-4">
                    <h3 class="h5 fw-bold mb-3" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.need_help')); ?>

                    </h3>
                    <p class="text-muted small mb-3">
                        <?php echo e(__('messages.events.contact_description')); ?>

                    </p>
                    <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                       class="btn btn-outline-primary w-100">
                        <i class="fas fa-envelope me-2"></i>
                        <?php echo e(__('messages.events.contact_us')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/show.blade.php ENDPATH**/ ?>