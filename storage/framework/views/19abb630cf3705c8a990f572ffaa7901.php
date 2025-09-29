

<?php $__env->startSection('title', __('messages.booking.title')); ?>

<?php $__env->startSection('content'); ?>
<!-- Booking Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="booking-icon mb-4">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h1 class="section-title"><?php echo e(__('messages.booking.title')); ?></h1>
                    <p class="lead mb-4"><?php echo e(__('messages.booking.subtitle')); ?></p>
                    <p class="text-muted">
                        <i class="fas fa-clock me-2"></i>Réponse sous 24h
                        <span class="mx-3">•</span>
                        <i class="fas fa-shield-alt me-2"></i>Consultation confidentielle
                        <span class="mx-3">•</span>
                        <i class="fas fa-heart me-2"></i>Accompagnement personnalisé
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="booking-form-card fade-in">
                        <form method="POST" action="<?php echo e(route('booking.store', app()->getLocale())); ?>">
                            <?php echo csrf_field(); ?>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="service_id" class="form-label"><?php echo e(__('messages.booking.form.service')); ?> *</label>
                                    <select class="form-select <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="service_id" name="service_id" required>
                                        <option value=""><?php echo e(__('messages.contact.form.service_select')); ?></option>
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id', request('service')) == $service->id ? 'selected' : ''); ?>>
                                                <?php echo e($service->getTranslation('name', app()->getLocale())); ?>

                                                <?php if($service->price_individual): ?>
                                                    - <?php echo e(number_format($service->price_individual, 0)); ?>€
                                                <?php endif; ?>
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['service_id'];
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

                                <div class="col-md-6 mb-4">
                                    <label for="appointment_datetime" class="form-label"><?php echo e(__('messages.booking.form.date')); ?> *</label>
                                    <input type="datetime-local" class="form-control <?php $__errorArgs = ['appointment_datetime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="appointment_datetime" name="appointment_datetime" 
                                           value="<?php echo e(old('appointment_datetime')); ?>" 
                                           min="<?php echo e(now()->addDay()->format('Y-m-d\TH:i')); ?>" required>
                                    <?php $__errorArgs = ['appointment_datetime'];
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

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="client_name" class="form-label"><?php echo e(__('messages.booking.form.name')); ?> *</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['client_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="client_name" name="client_name" 
                                           value="<?php echo e(old('client_name')); ?>" required>
                                    <?php $__errorArgs = ['client_name'];
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

                                <div class="col-md-6 mb-4">
                                    <label for="client_email" class="form-label"><?php echo e(__('messages.booking.form.email')); ?> *</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['client_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="client_email" name="client_email" 
                                           value="<?php echo e(old('client_email')); ?>" required>
                                    <?php $__errorArgs = ['client_email'];
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

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="client_phone" class="form-label"><?php echo e(__('messages.booking.form.phone')); ?></label>
                                    <input type="tel" class="form-control <?php $__errorArgs = ['client_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="client_phone" name="client_phone" 
                                           value="<?php echo e(old('client_phone')); ?>">
                                    <?php $__errorArgs = ['client_phone'];
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

                                <div class="col-md-6 mb-4">
                                    <label class="form-label"><?php echo e(__('messages.booking.form.first_session')); ?></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_first_session" id="first_yes" value="1" 
                                               <?php echo e(old('is_first_session', '1') == '1' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="first_yes">
                                            <?php echo e(__('messages.common.yes')); ?>

                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_first_session" id="first_no" value="0"
                                               <?php echo e(old('is_first_session') == '0' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="first_no">
                                            <?php echo e(__('messages.common.no')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label"><?php echo e(__('messages.booking.form.message')); ?></label>
                                <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="message" name="message" rows="4" 
                                          placeholder="Décrivez vos besoins, vos attentes ou toute information utile..."><?php echo e(old('message')); ?></textarea>
                                <?php $__errorArgs = ['message'];
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

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-calendar-plus me-2"></i>
                                    <?php echo e(__('messages.booking.form.submit')); ?>

                                </button>
                            </div>
                        </form>
                </div>

                <div class="booking-info text-center fade-in">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-clock text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="mb-1">Réponse rapide</h6>
                            <small class="text-muted">Sous 24h maximum</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-shield-alt text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="mb-1">Confidentialité</h6>
                            <small class="text-muted">Données sécurisées</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-heart text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="mb-1">Accompagnement</h6>
                            <small class="text-muted">Personnalisé</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-select service if passed in URL
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('service');
    if (serviceId) {
        const serviceSelect = document.getElementById('service_id');
        if (serviceSelect) {
            serviceSelect.value = serviceId;
        }
    }
    
    // Set minimum date to tomorrow
    const dateInput = document.getElementById('appointment_datetime');
    if (dateInput) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(9, 0, 0, 0); // Default to 9 AM
        
        const minDate = tomorrow.toISOString().slice(0, 16);
        dateInput.setAttribute('min', minDate);
        
        if (!dateInput.value) {
            dateInput.value = minDate;
        }
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Ensure all containers match navbar width */
    .container {
        max-width: 1345px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    .booking-icon {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary-pink);
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 3px solid rgba(255,255,255,0.8);
    }

    .booking-form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 1px solid #f1f1f1;
        margin-top: -50px;
        position: relative;
        z-index: 2;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 2px solid #f1f1f1;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.15);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .btn-primary {
        background: var(--primary-pink);
        border: none;
        border-radius: 50px;
        padding: 15px 40px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .btn-primary:hover {
        background: var(--primary-pink-dark, #e91e63);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(233, 30, 99, 0.4);
    }

    .alert {
        border-radius: 15px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 30px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .form-check-input:checked {
        background-color: var(--primary-pink);
        border-color: var(--primary-pink);
    }

    .form-check-input:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.15);
    }

    .booking-info {
        background: linear-gradient(135deg, var(--light-pink) 0%, rgba(255,255,255,0.8) 100%);
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
        border: 1px solid rgba(233, 30, 99, 0.1);
    }

    @media (max-width: 768px) {
        .booking-form-card {
            padding: 25px;
            margin-top: -30px;
        }
        
        .booking-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/booking/index.blade.php ENDPATH**/ ?>