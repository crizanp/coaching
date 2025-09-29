

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
<style>
    .container {
        max-width: 1345px !important;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .events-hero {
        margin-top: 80px;
        background: linear-gradient(135deg, #d4b3d6 0%, #f8f5ff 100%);
        border-radius: 0 0 50px 50px;
    }
    
    .event-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(212, 179, 214, 0.15);
        border: 1px solid rgba(212, 179, 214, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(212, 179, 214, 0.2);
    }
    
    .event-card-textured {
        background-color: white;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(212, 179, 214, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(248, 245, 255, 0.1) 0%, transparent 50%);
        background-size: 30px 30px;
    }
    
    .section-divider {
        height: 4px;
        background: linear-gradient(135deg, #d4b3d6, #f8f5ff);
        border-radius: 2px;
        margin: 2rem auto;
        width: 100px;
    }
    
    .event-status {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-active {
        background: linear-gradient(135deg, #d4b3d6, #e8d4ea);
        color: white;
    }
    
    .status-upcoming {
        background: linear-gradient(135deg, #6c63ff, #a855f7);
        color: white;
    }
    
    @media (max-width: 768px) {
        .events-hero {
            margin-top: 60px;
            border-radius: 0 0 30px 30px;
        }
    }
</style>

<!-- Hero Section -->
<section class="events-hero py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-icon mb-4">
                    <i class="fas fa-calendar-alt" style="font-size: 3rem; color: white;"></i>
                </div>
                <h1 class="display-4 fw-bold text-white mb-4"><?php echo e(__('messages.events.hero.title')); ?></h1>
                <p class="lead text-white opacity-90"><?php echo e(__('messages.events.hero.subtitle')); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Practical Information Section -->
<?php if($practicalEvents->count() > 0): ?>
<section class="practical-events py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3" style="color: #d4b3d6;"><?php echo e(__('messages.events.practical.title')); ?></h2>
                    <div class="section-divider"></div>
                    <p class="lead text-muted"><?php echo e(__('messages.events.practical.subtitle')); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $practicalEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mb-4">
                <div class="event-card event-card-textured h-100 position-relative">
                    <div class="event-status status-active">
                        <?php echo e(__('messages.events.status.active')); ?>

                    </div>
                    
                    <?php if($event->featured_image): ?>
                    <div class="event-image">
                        <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                             alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                             class="w-100" style="height: 200px; object-fit: cover;">
                    </div>
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <h3 class="h4 fw-bold mb-3" style="color: #d4b3d6;">
                            <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

                        </h3>
                        
                        <p class="text-muted mb-3">
                            <?php echo e($event->getTranslation('description', app()->getLocale())); ?>

                        </p>
                        
                        <?php if($event->duration): ?>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-clock me-2" style="color: #d4b3d6;"></i>
                            <small class="text-muted"><?php echo e($event->duration); ?></small>
                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->price): ?>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-euro-sign me-2" style="color: #d4b3d6;"></i>
                            <small class="text-muted"><?php echo e(number_format($event->price, 2)); ?>€</small>
                        </div>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-outline-primary btn-sm">
                            <?php echo e(__('messages.events.read_more')); ?>

                        </a>
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
<section class="upcoming-workshops py-5" style="background-color: #f8f5ff;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3" style="color: #d4b3d6;"><?php echo e(__('messages.events.upcoming.title')); ?></h2>
                    <div class="section-divider"></div>
                    <p class="lead text-muted"><?php echo e(__('messages.events.upcoming.subtitle')); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $upcomingWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 mb-4">
                <div class="event-card h-100 position-relative">
                    <div class="event-status status-upcoming">
                        <?php echo e(__('messages.events.status.upcoming')); ?>

                    </div>
                    
                    <?php if($event->featured_image): ?>
                    <div class="event-image">
                        <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                             alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                             class="w-100" style="height: 200px; object-fit: cover;">
                    </div>
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <h3 class="h5 fw-bold mb-3" style="color: #d4b3d6;">
                            <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

                        </h3>
                        
                        <p class="text-muted mb-3 small">
                            <?php echo e(Str::limit($event->getTranslation('description', app()->getLocale()), 100)); ?>

                        </p>
                        
                        <div class="event-details mb-3">
                            <?php if($event->event_date): ?>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar me-2" style="color: #d4b3d6;"></i>
                                <small class="text-muted"><?php echo e($event->event_date->format('d/m/Y H:i')); ?></small>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($event->max_participants): ?>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-users me-2" style="color: #d4b3d6;"></i>
                                <small class="text-muted">
                                    <?php echo e($event->available_spots); ?> <?php echo e(__('messages.events.spots_available')); ?>

                                </small>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($event->price): ?>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-euro-sign me-2" style="color: #d4b3d6;"></i>
                                <small class="text-muted"><?php echo e(number_format($event->price, 2)); ?>€</small>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                               class="btn btn-outline-primary btn-sm flex-fill">
                                <?php echo e(__('messages.events.learn_more')); ?>

                            </a>
                            <?php if($event->can_register): ?>
                            <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                               class="btn btn-primary btn-sm">
                                <?php echo e(__('messages.events.register')); ?>

                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php else: ?>
<!-- No Upcoming Workshops Notice -->
<section class="no-upcoming py-5" style="background-color: #f8f5ff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center">
                    <i class="fas fa-calendar-times mb-4" style="font-size: 3rem; color: #d4b3d6; opacity: 0.5;"></i>
                    <h3 class="mb-3" style="color: #d4b3d6;"><?php echo e(__('messages.events.no_upcoming.title')); ?></h3>
                    <p class="text-muted mb-4"><?php echo e(__('messages.events.no_upcoming.description')); ?></p>
                    <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                       class="btn btn-primary">
                        <?php echo e(__('messages.events.no_upcoming.contact')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Workshop On Demand Section -->
<?php if($activeWorkshops->count() > 0): ?>
<section class="workshop-demand py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3" style="color: #d4b3d6;"><?php echo e(__('messages.events.workshops.title')); ?></h2>
                    <div class="section-divider"></div>
                    <p class="lead text-muted"><?php echo e(__('messages.events.workshops.subtitle')); ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $activeWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mb-4">
                <div class="event-card event-card-textured h-100 position-relative">
                    <div class="event-status status-active">
                        <?php echo e(__('messages.events.status.on_demand')); ?>

                    </div>
                    
                    <?php if($event->featured_image): ?>
                    <div class="event-image">
                        <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                             alt="<?php echo e($event->getTranslation('title', app()->getLocale())); ?>"
                             class="w-100" style="height: 200px; object-fit: cover;">
                    </div>
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <h3 class="h4 fw-bold mb-3" style="color: #d4b3d6;">
                            <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

                        </h3>
                        
                        <p class="text-muted mb-3">
                            <?php echo e($event->getTranslation('description', app()->getLocale())); ?>

                        </p>
                        
                        <?php if($event->gallery && count($event->gallery) > 0): ?>
                        <div class="event-gallery mb-3">
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-images me-1"></i>
                                <?php echo e(__('messages.events.gallery_available')); ?>

                            </small>
                        </div>
                        <?php endif; ?>
                        
                        <div class="event-meta mb-3">
                            <?php if($event->duration): ?>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-clock me-2" style="color: #d4b3d6;"></i>
                                <small class="text-muted"><?php echo e($event->duration); ?></small>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($event->price): ?>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-euro-sign me-2" style="color: #d4b3d6;"></i>
                                <small class="text-muted"><?php echo e(number_format($event->price, 2)); ?>€</small>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                               class="btn btn-outline-primary btn-sm flex-fill">
                                <?php echo e(__('messages.events.learn_more')); ?>

                            </a>
                            <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                               class="btn btn-primary btn-sm">
                                <?php echo e(__('messages.events.request')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="events-cta py-5" style="background: linear-gradient(135deg, #d4b3d6, #f8f5ff);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-6 fw-bold text-white mb-4"><?php echo e(__('messages.events.cta.title')); ?></h2>
                <p class="text-white opacity-90 mb-4"><?php echo e(__('messages.events.cta.description')); ?></p>
                <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" 
                   class="btn btn-light btn-lg px-5 py-3" style="border-radius: 50px;">
                    <?php echo e(__('messages.events.cta.contact')); ?>

                </a>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('structured-data'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/index.blade.php ENDPATH**/ ?>