

<?php $__env->startSection('title', __('messages.booking.title')); ?>

<?php $__env->startSection('content'); ?>
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h1 class="section-title"><?php echo e(__('messages.booking.title')); ?></h1>
            <p class="section-subtitle"><?php echo e(__('messages.booking.subtitle')); ?></p>
        </div>
        
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in">
                    <div class="card-body p-5">
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
                </div>

                <div class="text-center mt-4 fade-in">
                    <p class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Votre demande sera traitée sous 24h. Un email de confirmation vous sera envoyé.
                    </p>
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
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/booking/index.blade.php ENDPATH**/ ?>