

<?php $__env->startSection('title', __('messages.contact.title')); ?>

<?php $__env->startSection('content'); ?>
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h1 class="section-title"><?php echo e(__('messages.contact.title')); ?></h1>
            <p class="section-subtitle"><?php echo e(__('messages.contact.subtitle')); ?></p>
        </div>

        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="card fade-in">
                    <div class="card-body p-5">
                        <form method="POST" action="<?php echo e(route('contact.store', app()->getLocale())); ?>">
                            <?php echo csrf_field(); ?>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label"><?php echo e(__('messages.contact.form.name')); ?> *</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="name" name="name" 
                                           value="<?php echo e(old('name')); ?>" required>
                                    <?php $__errorArgs = ['name'];
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
                                    <label for="email" class="form-label"><?php echo e(__('messages.contact.form.email')); ?> *</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="email" name="email" 
                                           value="<?php echo e(old('email')); ?>" required>
                                    <?php $__errorArgs = ['email'];
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
                                    <label for="phone" class="form-label"><?php echo e(__('messages.contact.form.phone')); ?></label>
                                    <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="phone" name="phone" 
                                           value="<?php echo e(old('phone')); ?>">
                                    <?php $__errorArgs = ['phone'];
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
                                    <label for="service_id" class="form-label"><?php echo e(__('messages.contact.form.service')); ?></label>
                                    <select class="form-select <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="service_id" name="service_id">
                                        <option value=""><?php echo e(__('messages.contact.form.service_select')); ?></option>
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id') == $service->id ? 'selected' : ''); ?>>
                                                <?php echo e($service->getTranslation('name', app()->getLocale())); ?>

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
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label"><?php echo e(__('messages.contact.form.message')); ?> *</label>
                                <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="message" name="message" rows="5" 
                                          placeholder="Décrivez votre demande, vos questions ou ce que vous aimeriez savoir..." required><?php echo e(old('message')); ?></textarea>
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
                                    <i class="fas fa-paper-plane me-2"></i>
                                    <?php echo e(__('messages.contact.form.submit')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card fade-in">
                    <div class="card-body p-4">
                        <h4 class="mb-4"><?php echo e(__('messages.contact.info.title')); ?></h4>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <strong><?php echo e(__('messages.contact.info.email')); ?></strong><br>
                                    <a href="mailto:<?php echo e(\App\Models\Setting::get('contact_email')); ?>" class="text-decoration-none">
                                        <?php echo e(\App\Models\Setting::get('contact_email')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <strong><?php echo e(__('messages.contact.info.phone')); ?></strong><br>
                                    <a href="tel:<?php echo e(\App\Models\Setting::get('contact_phone')); ?>" class="text-decoration-none">
                                        <?php echo e(\App\Models\Setting::get('contact_phone')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <strong><?php echo e(__('messages.contact.info.address')); ?></strong><br>
                                    <?php echo e(\App\Models\Setting::get('address')[app()->getLocale()] ?? ''); ?>

                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3"><?php echo e(__('messages.contact.social.title')); ?></h5>
                        <div class="social-links">
                            <?php if(\App\Models\Setting::get('social_facebook')): ?>
                                <a href="<?php echo e(\App\Models\Setting::get('social_facebook')); ?>" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <i class="fab fa-facebook-f me-1"></i> Facebook
                                </a>
                            <?php endif; ?>
                            <?php if(\App\Models\Setting::get('social_instagram')): ?>
                                <a href="<?php echo e(\App\Models\Setting::get('social_instagram')); ?>" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <i class="fab fa-instagram me-1"></i> Instagram
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="mt-4 p-3 rounded" style="background: var(--light-pink);">
                            <h6 class="mb-2">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Prêt(e) à réserver ?
                            </h6>
                            <p class="small mb-2">Réservez directement votre séance en ligne</p>
                            <a href="<?php echo e(route('booking.index', app()->getLocale())); ?>" class="btn btn-primary btn-sm">
                                <?php echo e(__('messages.nav.book')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/contact/index.blade.php ENDPATH**/ ?>