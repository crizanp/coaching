

<?php $__env->startSection('title'); ?>
<?php echo e(__('messages.events.apply_title')); ?> - <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e(__('messages.events.apply_description')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
    .container {
        max-width: 1345px !important;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .apply-hero {
        margin-top: 80px;
        background: linear-gradient(135deg, #d4b3d6 0%, #f8f5ff 100%);
        border-radius: 0 0 50px 50px;
    }
    
    .application-form {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(212, 179, 214, 0.15);
        border: 1px solid rgba(212, 179, 214, 0.1);
    }
    
    .form-control:focus {
        border-color: #d4b3d6;
        box-shadow: 0 0 0 0.2rem rgba(212, 179, 214, 0.25);
    }
    
    .event-summary {
        background: linear-gradient(135deg, rgba(212, 179, 214, 0.1), rgba(248, 245, 255, 0.2));
        border-radius: 15px;
    }
    
    @media (max-width: 768px) {
        .apply-hero {
            margin-top: 60px;
            border-radius: 0 0 30px 30px;
        }
    }
</style>

<!-- Hero Section -->
<section class="apply-hero py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold text-white mb-4">
                    <?php echo e(__('messages.events.apply_title')); ?>

                </h1>
                <p class="lead text-white opacity-90">
                    <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

                </p>
            </div>
        </div>
    </div>
</section>

<!-- Application Form -->
<section class="application-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Event Summary -->
                <div class="event-summary p-4 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="h5 fw-bold mb-2" style="color: #d4b3d6;">
                                <?php echo e($event->getTranslation('title', app()->getLocale())); ?>

                            </h3>
                            <p class="text-muted mb-0">
                                <?php echo e($event->getTranslation('description', app()->getLocale())); ?>

                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <?php if($event->event_date): ?>
                            <div class="mb-2">
                                <i class="fas fa-calendar me-2" style="color: #d4b3d6;"></i>
                                <small><?php echo e($event->event_date->format('d/m/Y H:i')); ?></small>
                            </div>
                            <?php endif; ?>
                            <?php if($event->price): ?>
                            <div class="mb-2">
                                <i class="fas fa-euro-sign me-2" style="color: #d4b3d6;"></i>
                                <strong><?php echo e(number_format($event->price, 2)); ?>€</strong>
                            </div>
                            <?php endif; ?>
                            <?php if($event->max_participants): ?>
                            <div>
                                <i class="fas fa-users me-2" style="color: #d4b3d6;"></i>
                                <small class="text-success"><?php echo e($event->available_spots); ?> <?php echo e(__('messages.events.spots_left')); ?></small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Application Form Card -->
                <div class="application-form p-5">
                    <h2 class="h4 fw-bold mb-4 text-center" style="color: #d4b3d6;">
                        <?php echo e(__('messages.events.registration_form')); ?>

                    </h2>
                    
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
                                <h5 class="fw-bold mb-3" style="color: #d4b3d6;">
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
                                    <?php echo e(__('messages.events.phone')); ?>

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
                            <h5 class="fw-bold mb-3" style="color: #d4b3d6;">
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
                            <h5 class="fw-bold mb-3" style="color: #d4b3d6;">
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

                                    <a href="<?php echo e(route('terms-conditions', app()->getLocale())); ?>" target="_blank" style="color: #d4b3d6;">
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
                
                <!-- Additional Information -->
                <div class="mt-4 text-center">
                    <p class="text-muted small">
                        <?php echo e(__('messages.events.application_info')); ?>

                    </p>
                    <p class="text-muted small">
                        <?php echo e(__('messages.events.contact_help')); ?>

                        <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" style="color: #d4b3d6;">
                            <?php echo e(__('messages.events.contact_us')); ?>

                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/apply.blade.php ENDPATH**/ ?>