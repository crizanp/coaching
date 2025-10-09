

<?php $__env->startSection('title'); ?>
<?php echo e(__('messages.events.apply_title')); ?> - <?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e(__('messages.events.apply_description')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <h1 class="section-title"><?php echo e(__('messages.events.apply_title')); ?></h1>
                    <p class="lead mb-4"><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Form -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Event Summary -->
                <div class="practice-card-textured mb-4" style="background: var(--light-pink);">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                        <p class="mb-3"><?php echo e($event->getLocalizedTranslation('description', app()->getLocale())); ?></p>
                        
                        <div class="row">
                            <?php if($event->event_date): ?>
                            <div class="col-md-4 mb-2">
                                <strong><?php echo e(__('messages.events.date')); ?>:</strong><br>
                                <small><?php echo e($event->event_date->format('d/m/Y H:i')); ?></small>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-4 mb-2">
                                <strong><?php echo e(__('messages.events.price')); ?>:</strong><br>
                                <strong>
                                    <?php if($event->price): ?>
                                        <?php echo e(number_format((float)$event->price, 2)); ?>€
                                    <?php else: ?>
                                        <?php echo e(__('messages.events.tba')); ?>

                                    <?php endif; ?>
                                </strong>
                            </div>
                            <?php if($event->max_participants): ?>
                            <div class="col-md-4 mb-2">
                                <strong><?php echo e(__('messages.events.spots_left')); ?>:</strong><br>
                                <small class="text-success"><?php echo e($event->available_spots); ?></small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Application Form Card -->
                <div class="practice-card-textured">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.events.registration_form')); ?></h4>
                        </div>
                    </div>
                    <div class="content-description">
                    
                    <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>
                    
                    <?php if(session('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('events.store-application', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="fw-bold mb-3 text-primary">
                                    <?php echo e(__('messages.events.personal_info')); ?>

                                </h5>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="applicant_name" class="form-label">
                                    <?php echo e(__('messages.events.full_name')); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['applicant_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="applicant_name" 
                                       name="applicant_name" 
                                       value="<?php echo e(old('applicant_name')); ?>" 
                                       required>
                                <?php $__errorArgs = ['applicant_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="applicant_email" class="form-label">
                                    <?php echo e(__('messages.events.email')); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control <?php $__errorArgs = ['applicant_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="applicant_email" 
                                       name="applicant_email" 
                                       value="<?php echo e(old('applicant_email')); ?>" 
                                       required>
                                <?php $__errorArgs = ['applicant_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="applicant_phone" class="form-label">
                                    <?php echo e(__('messages.events.phone')); ?><span class="text-danger">*</span>
                                </label>
                                <input type="tel" 
                                       class="form-control <?php $__errorArgs = ['applicant_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="applicant_phone" 
                                       name="applicant_phone" 
                                       value="<?php echo e(old('applicant_phone')); ?>">
                                <?php $__errorArgs = ['applicant_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="applicant_age" class="form-label">
                                    <?php echo e(__('messages.events.age')); ?>

                                </label>
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['applicant_age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="applicant_age" 
                                       name="applicant_age" 
                                       value="<?php echo e(old('applicant_age')); ?>" 
                                       placeholder="<?php echo e(__('messages.events.age_placeholder')); ?>">
                                <?php $__errorArgs = ['applicant_age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <!-- Motivation -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-primary">
                                <?php echo e(__('messages.events.motivation_section')); ?>

                            </h5>
                            
                            <div class="mb-3">
                                <label for="motivation" class="form-label">
                                    <?php echo e(__('messages.events.motivation')); ?>

                                </label>
                                <textarea class="form-control <?php $__errorArgs = ['motivation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="motivation" 
                                          name="motivation" 
                                          rows="4" 
                                          placeholder="<?php echo e(__('messages.events.motivation_placeholder')); ?>"><?php echo e(old('motivation')); ?></textarea>
                                <?php $__errorArgs = ['motivation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="form-text">
                                    <?php echo e(__('messages.events.motivation_help')); ?>

                                </div>
                            </div>
                        </div>
                        
                        <!-- Special Requirements -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-primary">
                                <?php echo e(__('messages.events.special_requirements_section')); ?>

                            </h5>
                            
                            <div class="mb-3">
                                <label for="special_requirements" class="form-label">
                                    <?php echo e(__('messages.events.special_requirements')); ?>

                                </label>
                                <textarea class="form-control <?php $__errorArgs = ['special_requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="special_requirements" 
                                          name="special_requirements" 
                                          rows="3" 
                                          placeholder="<?php echo e(__('messages.events.special_requirements_placeholder')); ?>"><?php echo e(old('special_requirements')); ?></textarea>
                                <?php $__errorArgs = ['special_requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="form-text">
                                    <?php echo e(__('messages.events.special_requirements_help')); ?>

                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    <?php echo e(__('messages.events.terms_accept')); ?>

                                    <a href="<?php echo e(route('terms-conditions', app()->getLocale())); ?>" target="_blank" class="text-primary">
                                        <?php echo e(__('messages.events.terms_link')); ?>

                                    </a>
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="text-center">
                            <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>" 
                               class="btn btn-outline-secondary me-3">
                                <i class="fas fa-arrow-left me-2"></i>
                                <?php echo e(__('messages.events.back_to_event')); ?>

                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>
                                <?php echo e(__('messages.events.submit_application')); ?>

                            </button>
                        </div>
                    </form>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="mt-4 text-center">
                    <div class="practice-card-textured p-4" style="background: var(--light-pink);">
                        <p class="mb-2">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            <?php echo e(__('messages.events.application_info')); ?>

                        </p>
                        <p class="mb-0">
                            <i class="fas fa-headset me-2 text-primary"></i>
                            <?php echo e(__('messages.events.contact_help')); ?>

                            <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="text-primary fw-bold">
                                <?php echo e(__('messages.events.contact_us')); ?>

                            </a>
                        </p>
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

    .form-control:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 0.2rem rgba(247, 178, 189, 0.25);
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
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/apply.blade.php ENDPATH**/ ?>