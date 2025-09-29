

<?php $__env->startSection('title'); ?>
<?php echo e(__('messages.events.title')); ?> - <?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e(__('messages.events.description')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('keywords'); ?>
atelier, événement, groupe, émotions, communication, partage, Martinique, développement personnel
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Events Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="hero-icon mb-4">
                        <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--primary-pink);"></i>
                    </div>
                    <h1 class="section-title"><?php echo e(__('messages.events.hero.title')); ?></h1>
                    <p class="lead mb-4"><?php echo e(__('messages.events.hero.subtitle')); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practical Information Section -->
<?php if($practicalEvents->count() > 0): ?>
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5 fade-in">
                    <h2 class="section-title"><?php echo e(__('messages.events.practical.title')); ?></h2>
                    <p class="lead mb-4"><?php echo e(__('messages.events.practical.subtitle')); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $practicalEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="position-relative">
                        <?php if($event->featured_image): ?>
                        <div class="practice-image">
                            <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                 alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                                 class="w-100" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                        </div>
                        <?php endif; ?>
                        
                        <div class="badge bg-primary position-absolute top-0 end-0 m-3">
                            <?php echo e(__('messages.events.status.active')); ?>

                        </div>
                    </div>
                    
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e($event->getTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4"><?php echo e($event->getTranslation('description', app()->getLocale())); ?></p>
                    
                    <div class="service-details mb-4">
                        <?php if($event->duration): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.duration')); ?>:</strong> <?php echo e($event->duration); ?>

                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->price): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.price')); ?>:</strong> <?php echo e(number_format($event->price, 2)); ?>€
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="service-actions">
                        <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-outline-primary btn-sm me-2 mb-2">
                            <?php echo e(__('messages.events.read_more')); ?>

                        </a>
                        <?php if($event->can_register): ?>
                        <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-user-plus me-1"></i><?php echo e(__('messages.events.register')); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Upcoming Workshops Section -->
<?php if($upcomingWorkshops->count() > 0): ?>
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5 fade-in">
                    <h2 class="section-title"><?php echo e(__('messages.events.upcoming.title')); ?></h2>
                    <p class="lead mb-4"><?php echo e(__('messages.events.upcoming.subtitle')); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $upcomingWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="position-relative">
                        <?php if($event->featured_image): ?>
                        <div class="practice-image">
                            <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                 alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                                 class="w-100" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                        </div>
                        <?php endif; ?>
                        
                        <div class="badge bg-success position-absolute top-0 end-0 m-3">
                            <?php echo e(__('messages.events.status.upcoming')); ?>

                        </div>
                    </div>
                    
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e($event->getTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4"><?php echo e(Str::limit($event->getTranslation('description', app()->getLocale()), 100)); ?></p>
                    
                    <div class="service-details mb-4">
                        <?php if($event->event_date): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.date')); ?>:</strong> <?php echo e($event->event_date->format('d/m/Y H:i')); ?>

                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->max_participants): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.spots_available')); ?>:</strong> <?php echo e($event->available_spots); ?>

                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->price): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.price')); ?>:</strong> <?php echo e(number_format($event->price, 2)); ?>€
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="service-actions">
                        <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-outline-primary btn-sm me-2 mb-2">
                            <?php echo e(__('messages.events.learn_more')); ?>

                        </a>
                        <?php if($event->can_register): ?>
                        <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-user-plus me-1"></i><?php echo e(__('messages.events.register')); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php else: ?>
<!-- No Upcoming Workshops Notice -->
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center fade-in">
                    <i class="fas fa-calendar-times mb-4" style="font-size: 3rem; color: var(--warm-gray); opacity: 0.6;"></i>
                    <h3 class="mb-3"><?php echo e(__('messages.events.no_upcoming.title')); ?></h3>
                    <p class="lead mb-4"><?php echo e(__('messages.events.no_upcoming.description')); ?></p>
                    <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                       class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i><?php echo e(__('messages.events.no_upcoming.contact')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Workshop On Demand Section -->
<?php if($activeWorkshops->count() > 0): ?>
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5 fade-in">
                    <h2 class="section-title"><?php echo e(__('messages.events.workshops.title')); ?></h2>
                    <p class="lead mb-4"><?php echo e(__('messages.events.workshops.subtitle')); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $activeWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="position-relative">
                        <?php if($event->featured_image): ?>
                        <div class="practice-image">
                            <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                 alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                                 class="w-100" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                        </div>
                        <?php endif; ?>
                        
                        <div class="badge bg-info position-absolute top-0 end-0 m-3">
                            <?php echo e(__('messages.events.status.on_demand')); ?>

                        </div>
                    </div>
                    
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e($event->getTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4"><?php echo e($event->getTranslation('description', app()->getLocale())); ?></p>
                    
                    <?php if($event->gallery && count($event->gallery) > 0): ?>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">
                            <i class="fas fa-images me-1"></i>
                            <?php echo e(__('messages.events.gallery_available')); ?>

                        </small>
                    </div>
                    <?php endif; ?>
                    
                    <div class="service-details mb-4">
                        <?php if($event->duration): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.duration')); ?>:</strong> <?php echo e($event->duration); ?>

                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->price): ?>
                        <div class="service-detail-item mb-2">
                            <strong><?php echo e(__('messages.events.price')); ?>:</strong> <?php echo e(number_format($event->price, 2)); ?>€
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="service-actions">
                        <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-outline-primary btn-sm me-2 mb-2">
                            <?php echo e(__('messages.events.learn_more')); ?>

                        </a>
                        <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                           class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-envelope me-1"></i><?php echo e(__('messages.events.request')); ?>

                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action Section -->
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title"><?php echo e(__('messages.events.cta.title')); ?></h2>
            <p class="lead mb-5"><?php echo e(__('messages.events.cta.description')); ?></p>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-buttons">
                        <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="btn btn-primary btn-lg me-3 mb-3">
                            <i class="fas fa-envelope me-2"></i><?php echo e(__('messages.events.cta.contact')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('structured-data'); ?>

<?php $__env->stopPush(); ?>

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

    .service-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .service-details {
        position: relative;
        z-index: 1;
    }

    .service-detail-item {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .service-actions {
        position: relative;
        z-index: 1;
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
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/index.blade.php ENDPATH**/ ?>