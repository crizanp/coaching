

<?php $__env->startSection('title'); ?>
<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?> - <?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e($event->getLocalizedTranslation('seo_description', app()->getLocale()) ?: $event->getLocalizedTranslation('description', app()->getLocale())); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('keywords'); ?>
atelier, événement, <?php echo e($event->type); ?>, développement personnel, bien-être, Martinique
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Event Hero Section -->
<section class="section-padding event-hero" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <?php if(session('success') || session('error') || session('warning')): ?>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show event-alert" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo e(__('messages.common.close')); ?>"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show event-alert" role="alert">
                            <i class="fas fa-times-circle me-2"></i><?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo e(__('messages.common.close')); ?>"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(session('warning')): ?>
                        <div class="alert alert-warning alert-dismissible fade show event-alert" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i><?php echo e(session('warning')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo e(__('messages.common.close')); ?>"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="fade-in">
                    <div class="mb-3">
                        <span class="badge bg-primary px-3 py-2">
                            <?php echo e(ucfirst($event->type)); ?> - <?php echo e(ucfirst($event->status)); ?>

                        </span>
                    </div>
                    <h1 class="section-title"><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h1>
                    <p class="lead mb-4"><?php echo e($event->getLocalizedTranslation('description', app()->getLocale())); ?></p>
                    
                    <?php if($event->can_register): ?>
                    <div class="mt-4">
                        <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                           class="btn btn-primary btn-lg px-5 py-3 event-register-btn">
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
<section class="section-padding event-details" style="background: white;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <!-- Featured Image -->
                <?php if($event->featured_image && file_exists(storage_path('app/public/' . $event->featured_image))): ?>
                <div class="practice-card-textured mb-4" style="border-radius: 20px; overflow: hidden;">
                    <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                         alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
                         class="w-100 event-featured-image">
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
                        <?php echo nl2br(e($event->getLocalizedTranslation('content', app()->getLocale()))); ?>

                    </div>
                </div>

                <!-- Workshop Transformation Section -->
                <?php if($event->type === 'workshop' || $event->type === 'atelier'): ?>
                <div class="practice-card-textured mb-4">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-sparkles"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4>Une expérience transformante</h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <div class="transformation-highlights">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="transformation-item">
                                        <div class="d-flex align-items-start">
                                            <div class="transformation-icon me-3">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-2" style="color: var(--primary-pink); font-weight: 600;">Découverte émotionnelle</h6>
                                                <p class="mb-0">Apprenez à reconnaître et accueillir vos émotions avec bienveillance</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="transformation-item">
                                        <div class="d-flex align-items-start">
                                            <div class="transformation-icon me-3">
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-2" style="color: var(--primary-pink); font-weight: 600;">Compréhension profonde</h6>
                                                <p class="mb-0">Identifiez les besoins cachés derrière chaque émotion et comportement</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="transformation-item">
                                        <div class="d-flex align-items-start">
                                            <div class="transformation-icon me-3">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-2" style="color: var(--primary-pink); font-weight: 600;">Communication authentique</h6>
                                                <p class="mb-0">Développez une communication plus authentique et bienveillante</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="transformation-item">
                                        <div class="d-flex align-items-start">
                                            <div class="transformation-icon me-3">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-2" style="color: var(--primary-pink); font-weight: 600;">Relations harmonieuses</h6>
                                                <p class="mb-0">Créez des liens plus profonds avec vos proches et collègues</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 rounded-3" style="background: rgba(255, 182, 193, 0.1); border-left: 4px solid var(--primary-pink);">
                            <p class="mb-0" style="font-style: italic; color: #6c757d;">
                                <i class="fas fa-quote-left me-2" style="color: var(--primary-pink);"></i>
                                "Chaque participant repart avec les clés concrètes pour transformer ses relations et mieux vivre ses émotions au quotidien."
                                <i class="fas fa-quote-right ms-2" style="color: var(--primary-pink);"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Benefits -->
                <?php if($event->benefits && ($benefitsTranslation = $event->getLocalizedTranslation('benefits', app()->getLocale())) && (is_array($benefitsTranslation) ? count($benefitsTranslation) : !empty($benefitsTranslation)) > 0): ?>
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
                            <?php $__currentLoopData = $event->getLocalizedTranslation('benefits', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php if($event->program && ($programTranslation = $event->getLocalizedTranslation('program', app()->getLocale())) && (is_array($programTranslation) ? count($programTranslation) : !empty($programTranslation)) > 0): ?>
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
                            <?php $__currentLoopData = $event->getLocalizedTranslation('program', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php if($event->requirements && ($requirementsTranslation = $event->getLocalizedTranslation('requirements', app()->getLocale())) && (is_array($requirementsTranslation) ? count($requirementsTranslation) : !empty($requirementsTranslation)) > 0): ?>
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
                            <?php $__currentLoopData = $event->getLocalizedTranslation('requirements', app()->getLocale()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php
                    $validGalleryImages = [];
                    if($event->gallery && (is_array($event->gallery) ? count($event->gallery) : !empty($event->gallery)) > 0) {
                        foreach($event->gallery as $image) {
                            if($image && file_exists(storage_path('app/public/' . $image))) {
                                $validGalleryImages[] = $image;
                            }
                        }
                    }
                ?>
                <?php if(count($validGalleryImages) > 0): ?>
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
                            <?php $__currentLoopData = $validGalleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-3">
                                <div class="gallery-item" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s ease;">
                                    <img src="<?php echo e(asset('storage/' . $image)); ?>" 
                                         alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
                                         class="w-100 event-gallery-image">
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
                            <strong><?php echo e(__('messages.events.price')); ?>:</strong> <?php echo e(number_format((float)$event->price, 2)); ?>€
                        </div>
                        <?php endif; ?>
                        
                        <?php if($event->max_participants): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.participants')); ?>:</strong> <?php echo e($event->current_participants); ?>/<?php echo e($event->max_participants); ?>

                            <br><small class="text-success"><?php echo e($event->available_spots); ?> <?php echo e(__('messages.events.spots_left')); ?></small>
                        </div>
                        <?php endif; ?>
                        
                        <?php
                            $locationTranslation = $event->getLocalizedTranslation('location', app()->getLocale());
                        ?>
                        <?php if($locationTranslation && !empty($locationTranslation)): ?>
                        <div class="service-detail-item mb-3">
                            <strong><?php echo e(__('messages.events.location')); ?>:</strong>
                            <?php if(is_array($locationTranslation)): ?>
                                <?php $__currentLoopData = $locationTranslation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($value): ?>
                                        <div><?php echo e($value); ?></div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php echo e($locationTranslation); ?>

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
                                    class="btn btn-primary w-100 event-register-btn">
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
    .event-hero .badge {
        font-size: 0.95rem;
        border-radius: 999px;
        padding: 0.5rem 1.25rem;
    }

    .event-hero .lead {
        max-width: 760px;
        margin-left: auto;
        margin-right: auto;
    }

    .event-register-btn {
        border-radius: 999px;
        box-shadow: 0 12px 30px rgba(233, 30, 99, 0.25);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 45px rgba(233, 30, 99, 0.3);
    }

    .event-alert {
        border-radius: 16px;
        border: none;
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        padding: 16px 20px;
    }

    .event-featured-image {
        height: clamp(240px, 45vh, 420px);
        object-fit: cover;
        object-position: center;
    }

    .event-gallery-image {
        height: 200px;
        object-fit: cover;
        object-position: center;
    }

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

    /* Transformation Section Styles */
    .transformation-highlights {
        margin-top: 10px;
    }

    .transformation-item {
        padding: 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: rgba(255, 182, 193, 0.05);
        border: 1px solid rgba(255, 182, 193, 0.2);
    }

    .transformation-item:hover {
        background: rgba(255, 182, 193, 0.1);
        border-color: rgba(255, 182, 193, 0.3);
        transform: translateY(-2px);
    }

    .transformation-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .transformation-item h6 {
        font-size: 1rem;
        line-height: 1.3;
    }

    .transformation-item p {
        font-size: 0.9rem;
        line-height: 1.4;
        color: #6c757d;
    }

    @media (max-width: 992px) {
        .event-hero {
            padding-top: clamp(60px, 10vw, 80px);
            padding-bottom: clamp(60px, 10vw, 80px);
        }

        .event-register-btn {
            width: 100%;
        }

        .event-featured-image {
            height: clamp(220px, 40vh, 360px);
        }

        .practice-card-textured {
            padding: 26px;
        }

        .content-description {
            padding: 0 18px 18px 18px;
        }
    }

    @media (max-width: 767px) {
        .practice-card-body {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }

        .practice-icon-left {
            width: 56px;
            height: 56px;
            font-size: 1.6rem;
        }

        .practice-card-textured {
            padding: 22px;
        }

        .content-description {
            padding: 0 15px 18px 15px;
        }

        .transformation-item {
            padding: 12px;
            margin-bottom: 15px;
        }

        .transformation-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .transformation-item h6 {
            font-size: 0.95rem;
        }

        .transformation-item p {
            font-size: 0.85rem;
        }

        .event-gallery-image {
            height: 170px;
        }

        .event-details .col-lg-4 {
            margin-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .event-featured-image {
            height: clamp(200px, 55vw, 300px);
        }

        .event-gallery-image {
            height: 150px;
        }

        .event-hero .section-title {
            font-size: clamp(1.9rem, 6vw, 2.2rem);
        }

        .event-hero .lead {
            font-size: 1rem;
        }

        .event-details .row {
            row-gap: 25px;
        }

        .practice-card-textured {
            padding: 20px;
        }

        .content-description {
            padding: 0 12px 16px 12px;
        }

        .transformation-highlights .row {
            row-gap: 12px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/show.blade.php ENDPATH**/ ?>