

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
            <div class="col-lg-10">
                <div class="fade-in">
                    <div class="hero-icon mb-4">
                        <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--primary-pink);"></i>
                    </div>
                    <h1 class="section-title"><?php echo e(__('messages.events.hero.title')); ?></h1>
                    <p class="lead mb-4"><?php echo e(__('messages.events.hero.subtitle')); ?></p>
                    
                    <!-- Workshop Highlights -->
                    <div class="workshop-highlights mt-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="highlight-card">
                                    <h3 class="mb-4" style="color: var(--primary-pink); font-weight: 600;">
                                        <i class="fas fa-sparkles me-2"></i>
                                        Ateliers riches en découvertes
                                    </h3>
                                    <p class="mb-4" style="font-size: 1.1rem; color: #6c757d;">
                                        Chacun repart avec les clés pour mieux vivre ses relations
                                    </p>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-item">
                                                <i class="fas fa-heart mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                                <h5 style="color: var(--text-dark); font-weight: 600;">Reconnaître</h5>
                                                <p class="mb-0" style="color: #6c757d;">ses émotions et les accueillir</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-item">
                                                <i class="fas fa-search mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                                <h5 style="color: var(--text-dark); font-weight: 600;">Comprendre</h5>
                                                <p class="mb-0" style="color: #6c757d;">les besoins cachés derrière</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-item">
                                                <i class="fas fa-comments mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                                <h5 style="color: var(--text-dark); font-weight: 600;">Communiquer</h5>
                                                <p class="mb-0" style="color: #6c757d;">avec vos proches et collègues</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <?php if($event->featured_image && file_exists(storage_path('app/public/' . $event->featured_image))): ?>
                        <div class="practice-image">
                            <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                 alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
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
                            <h4><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4"><?php echo e($event->getLocalizedTranslation('description', app()->getLocale())); ?></p>
                    
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
                        <?php if($event->featured_image && file_exists(storage_path('app/public/' . $event->featured_image))): ?>
                        <div class="practice-image">
                            <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                 alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
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
                            <h4><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4"><?php echo e(Str::limit($event->getLocalizedTranslation('description', app()->getLocale()), 100)); ?></p>
                    
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
                    
                    <!-- Workshop Benefits Banner -->
                    
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $activeWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="position-relative">
                        <?php if($event->featured_image && file_exists(storage_path('app/public/' . $event->featured_image))): ?>
                        <div class="practice-image">
                            <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                 alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
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
                            <h4><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4"><?php echo e($event->getLocalizedTranslation('description', app()->getLocale())); ?></p>
                    
                    <?php if($event->gallery && (is_array($event->gallery) ? count($event->gallery) : !empty($event->gallery)) > 0): ?>
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
        padding: clamp(22px, 3vw, 30px);
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
        font-size: clamp(1.15rem, 2.2vw, 1.3rem);
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
        font-size: clamp(0.95rem, 2.1vw, 1rem);
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
        font-size: clamp(0.9rem, 2vw, 0.95rem);
    }

    .service-actions {
        position: relative;
        z-index: 1;
    }

    /* Workshop Highlights Styles */
    .workshop-highlights {
        margin-top: 3rem;
    }

    .highlight-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 25px;
        padding: clamp(28px, 4vw, 40px);
        border: 2px solid rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .highlight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: rgba(0, 0, 0, 0.2);
    }

    .highlight-item {
        text-align: center;
        padding: clamp(16px, 3vw, 20px);
        transition: transform 0.3s ease;
    }

    .highlight-item:hover {
        transform: translateY(-3px);
    }

    .highlight-item i {
        transition: all 0.3s ease;
    }

    .highlight-item:hover i {
        transform: scale(1.1);
        filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.2));
    }

    .highlight-item h5 {
        margin-bottom: 8px;
        font-size: clamp(1rem, 2.2vw, 1.1rem);
    }

    .highlight-item p {
        font-size: clamp(0.9rem, 2vw, 0.95rem);
        line-height: 1.4;
    }

    /* Workshop Benefits Banner */
    .workshop-benefits-banner {
        margin: 2rem 0;
    }

    .benefits-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 249, 250, 0.95) 100%);
        border-radius: 20px;
        padding: clamp(26px, 4vw, 35px);
        border: 2px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: left;
    }

    .benefits-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        border-color: rgba(0, 0, 0, 0.15);
    }

    .benefits-card h4 {
        margin-bottom: 20px;
        font-size: clamp(1.1rem, 2.5vw, 1.3rem);
    }

    .benefits-card .col-sm-6 {
        font-size: clamp(0.9rem, 2vw, 0.95rem);
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .benefits-icon {
        padding: 20px;
        transition: transform 0.3s ease;
    }

    @media (max-width: 991px) {
        .practice-card-body {
            align-items: flex-start;
        }

        .service-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .workshop-highlights {
            margin-top: 2.5rem;
        }

        .benefits-card {
            text-align: center;
        }
    }

    .benefits-icon:hover {
        transform: scale(1.1);
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
        
        .workshop-highlights {
            margin-top: 2rem;
        }
        
        .highlight-card {
            padding: 25px;
            margin: 0 15px;
        }
        
        .highlight-item {
            padding: 15px 10px;
        }
        
        .highlight-item i {
            font-size: 1.5rem !important;
        }
        
        .highlight-item h5 {
            font-size: 1rem;
        }
        
        .highlight-item p {
            font-size: 0.9rem;
        }

        .service-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .service-actions .btn {
            width: 100%;
        }
        

    @media (max-width: 575px) {
        .practice-card-body {
            align-items: center;
            text-align: center;
        }

        .practice-card-content {
            width: 100%;
        }

        .highlight-card,
        .benefits-card {
            margin: 0 5px;
        }
    }
        .workshop-benefits-banner {
            margin: 1.5rem 0;
        }
        
        .benefits-card {
            padding: 25px 20px;
            margin: 0 15px;
        }
        
        .benefits-card h4 {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        
        .benefits-card .col-sm-6 {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .benefits-icon {
            padding: 15px;
            margin-top: 15px;
        }
        
        .benefits-icon i {
            font-size: 2.5rem !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/index.blade.php ENDPATH**/ ?>