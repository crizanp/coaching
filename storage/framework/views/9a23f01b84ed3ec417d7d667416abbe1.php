

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
<!-- Event Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="fade-in">
                    <div class="mb-3">
                        <span class="badge bg-primary px-3 py-2">
                            <?php echo e(ucfirst($event->type)); ?> - <?php echo e(ucfirst($event->status)); ?>

                        </span>
                    </div>
                    <h1 class="section-title"><?php echo e($event->getTranslation('title', app()->getLocale())); ?></h1>
                    <p class="lead mb-4"><?php echo e($event->getTranslation('description', app()->getLocale())); ?></p>
                    
                    <?php if($event->can_register): ?>
                    <div class="mt-4">
                        <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-user-plus me-2"></i>
                            <?php echo e(__('messages.events.register_now')); ?>

                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event Details -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <!-- Featured Image -->
                <?php if($event->featured_image): ?>
                <div class="practice-card-textured mb-4" style="border-radius: 20px; overflow: hidden;">
                    <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                         alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                         class="w-100" style="height: 400px; object-fit: cover;">
                </div>
                <?php endif; ?>
                
                <!-- Content -->
                <div class="practice-card-textured mb-4">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.about_event')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <?php echo nl2br(e($event->getTranslation('content', app()->getLocale()))); ?>

                    </div>
                </div>
                
                <!-- Benefits -->
                <?php if($event->benefits && count($event->getTranslation('benefits', app()->getLocale())) > 0): ?>
                <div class="practice-card-textured mb-4">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.benefits')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <div class="row">
                            <?php $__currentLoopData = $event->getTranslation('benefits', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check me-3 mt-1" style="color: var(--primary-pink);"></i>
                                    <span><?php echo e($benefit); ?></span>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Program -->
                <?php if($event->program && count($event->getTranslation('program', app()->getLocale())) > 0): ?>
                <div class="practice-card-textured mb-4">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.program')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <div class="program-list">
                            <?php $__currentLoopData = $event->getTranslation('program', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="program-item d-flex align-items-start mb-3">
                                <span class="badge bg-primary me-3 mt-1" style="border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                    <?php echo e($index + 1); ?>

                                </span>
                                <span><?php echo e($item); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Requirements -->
                <?php if($event->requirements && count($event->getTranslation('requirements', app()->getLocale())) > 0): ?>
                <div class="practice-card-textured mb-4">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.requirements')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <ul class="list-unstyled">
                            <?php $__currentLoopData = $event->getTranslation('requirements', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="mb-2">
                                <i class="fas fa-dot-circle me-2" style="color: var(--primary-pink);"></i>
                                <?php echo e($requirement); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Gallery -->
                <?php if($event->gallery && count($event->gallery) > 0): ?>
                <div class="practice-card-textured">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.gallery')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <div class="row">
                            <?php $__currentLoopData = $event->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-3">
                                <div class="gallery-item" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s ease;">
                                    <img src="<?php echo e(asset('storage/' . $image)); ?>" 
                                         alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                                         class="w-100" style="height: 200px; object-fit: cover;">
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Event Info -->
                <div class="practice-card-textured mb-4">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.event_info')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description"style="padding: 0 20px 20px 20px;">
                    
                        <?php if($event->event_date): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.date')); ?>:</strong> <?php echo e($event->event_date->format('d/m/Y')); ?>

                        </div>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.time')); ?>:</strong> <?php echo e($event->event_date->format('H:i')); ?>

                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->duration): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.duration')); ?>:</strong> <?php echo e($event->duration); ?>

                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->price): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.price')); ?>:</strong> <?php echo e(number_format($event->price, 2)); ?>€
                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->max_participants): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.participants')); ?>:</strong> <?php echo e($event->current_participants); ?>/<?php echo e($event->max_participants); ?>

                            <br><small class="text-success"><?php echo e($event->available_spots); ?> <?php echo e(__('messages.events.spots_left')); ?></small>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->location): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.location')); ?>:</strong>
                            <?php if(is_array($event->getTranslation('location', app()->getLocale()))): ?>
                                <?php $__currentLoopData = $event->getTranslation('location', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><?php echo e($value); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php echo e($event->getTranslation('location', app()->getLocale())); ?>

                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->registration_deadline): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.deadline')); ?>:</strong> 
                            <span class="text-danger"><?php echo e($event->registration_deadline->format('d/m/Y')); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Registration Card -->
                <?php if($event->can_register): ?>
                <div class="practice-card-textured mb-4" style="background: var(--light-pink);">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.quick_register')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <p class="mb-4"><?php echo e(__('messages.events.register_description')); ?></p>
                        <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-primary w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            <?php echo e(__('messages.events.register_button')); ?>

                        </a>
                    </div>
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
                <div class="practice-card-textured">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.need_help')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <p class="mb-3"><?php echo e(__('messages.events.contact_description')); ?></p>
                        <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                           class="btn btn-outline-primary w-100">
                            <i class="fas fa-envelope me-2"></i>
                            <?php echo e(__('messages.events.contact_us')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('styles'); ?>
<style>
    .practice-card-textured {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        text-align: left;
        border: 1px solid #000000;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease;
        color: var(--text-dark);
    }

    .practice-card-textured::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: repeating-linear-gradient(
            45deg,
            rgba(0,0,0,0.01),
            rgba(0,0,0,0.01) 12px,
            rgba(255,255,255,0.01) 12px,
            rgba(255,255,255,0.01) 24px
        );
        opacity: 0.08;
        pointer-events: none;
    }

    .practice-card-textured:hover {
        transform: translateY(-4px);
        border-color: rgba(0,0,0,0.85);
    }

    .practice-icon-left {
        width: 60px;
        height: 60px;
        background: transparent;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #000000;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
        box-shadow: none;
    }

    .practice-card-textured h4 {
        color: #1e1d1dff;
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .practice-card-body {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 20px;
    }

    .practice-card-content {
        flex: 1 1 auto;
    }

    .content-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
        padding: 0 20px 20px 20px;
    }

    .service-detail-item {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    @media (max-width: 767px) {
        .practice-card-body {
            flex-direction: column;
            gap: 12px;
        }
        .practice-icon-left {
            width: 56px;
            height: 56px;
            font-size: 1.6rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/show.blade.php ENDPATH**/ ?>