

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?php echo e(__('Edit Service')); ?>: <?php echo e($service->getTranslation('name', 'fr')); ?></h4>
                        <div>
                            <a href="<?php echo e(route('admin.services.show', $service)); ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Services
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('admin.services.update', $service)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Service Names -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name_fr" class="form-label"><?php echo e(__('Service Name (French)')); ?> <span class="text-danger">*</span></label>
                                <input id="name_fr" type="text" class="form-control <?php $__errorArgs = ['name_fr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="name_fr" value="<?php echo e(old('name_fr', $service->getTranslation('name', 'fr'))); ?>" required>
                                <?php $__errorArgs = ['name_fr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="name_en" class="form-label"><?php echo e(__('Service Name (English)')); ?> <span class="text-danger">*</span></label>
                                <input id="name_en" type="text" class="form-control <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="name_en" value="<?php echo e(old('name_en', $service->getTranslation('name', 'en'))); ?>" required>
                                <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Service Descriptions -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="description_fr" class="form-label"><?php echo e(__('Description (French)')); ?> <span class="text-danger">*</span></label>
                                <textarea id="description_fr" class="form-control <?php $__errorArgs = ['description_fr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          name="description_fr" rows="3" required><?php echo e(old('description_fr', $service->getTranslation('description', 'fr'))); ?></textarea>
                                <?php $__errorArgs = ['description_fr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="description_en" class="form-label"><?php echo e(__('Description (English)')); ?> <span class="text-danger">*</span></label>
                                <textarea id="description_en" class="form-control <?php $__errorArgs = ['description_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          name="description_en" rows="3" required><?php echo e(old('description_en', $service->getTranslation('description', 'en'))); ?></textarea>
                                <?php $__errorArgs = ['description_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Service Content -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="content_fr" class="form-label"><?php echo e(__('Full Content (French)')); ?></label>
                                <textarea id="content_fr" class="form-control tinymce-editor <?php $__errorArgs = ['content_fr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          name="content_fr" rows="8"><?php echo e(old('content_fr', $service->getTranslation('content', 'fr'))); ?></textarea>
                                <?php $__errorArgs = ['content_fr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="content_en" class="form-label"><?php echo e(__('Full Content (English)')); ?></label>
                                <textarea id="content_en" class="form-control tinymce-editor <?php $__errorArgs = ['content_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          name="content_en" rows="8"><?php echo e(old('content_en', $service->getTranslation('content', 'en'))); ?></textarea>
                                <?php $__errorArgs = ['content_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Benefits -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="benefits_fr" class="form-label"><?php echo e(__('Benefits (French)')); ?></label>
                                <div id="benefits_fr_container">
                                    <?php 
                                        $benefits_fr = old('benefits_fr'); 
                                        if (!$benefits_fr) {
                                            $benefits_fr = $service->getLocalizedTranslation('benefits', 'fr');
                                            $benefits_fr = is_array($benefits_fr) ? $benefits_fr : [];
                                        }
                                    ?>
                                    <?php if(empty($benefits_fr)): ?>
                                        <input type="text" class="form-control mb-2" name="benefits_fr[]" placeholder="Enter a benefit">
                                    <?php else: ?>
                                        <?php $__currentLoopData = $benefits_fr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="text" class="form-control mb-2" name="benefits_fr[]" value="<?php echo e($benefit); ?>" placeholder="Enter a benefit">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addBenefit('fr')">
                                    <i class="fas fa-plus"></i> Add Benefit
                                </button>
                            </div>
                            <div class="col-md-6">
                                <label for="benefits_en" class="form-label"><?php echo e(__('Benefits (English)')); ?></label>
                                <div id="benefits_en_container">
                                    <?php 
                                        $benefits_en = old('benefits_en'); 
                                        if (!$benefits_en) {
                                            $benefits_en = $service->getLocalizedTranslation('benefits', 'en');
                                            $benefits_en = is_array($benefits_en) ? $benefits_en : [];
                                        }
                                    ?>
                                    <?php if(empty($benefits_en)): ?>
                                        <input type="text" class="form-control mb-2" name="benefits_en[]" placeholder="Enter a benefit">
                                    <?php else: ?>
                                        <?php $__currentLoopData = $benefits_en; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="text" class="form-control mb-2" name="benefits_en[]" value="<?php echo e($benefit); ?>" placeholder="Enter a benefit">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addBenefit('en')">
                                    <i class="fas fa-plus"></i> Add Benefit
                                </button>
                            </div>
                        </div>

                        <!-- Session Format -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="session_format_fr" class="form-label"><?php echo e(__('Session Format (French)')); ?></label>
                                <div id="session_format_fr_container">
                                    <?php 
                                        $session_format_fr = old('session_format_fr'); 
                                        if (!$session_format_fr) {
                                            $session_format_fr = $service->getLocalizedTranslation('session_format', 'fr');
                                            $session_format_fr = is_array($session_format_fr) ? $session_format_fr : [];
                                        }
                                    ?>
                                    <?php if(empty($session_format_fr)): ?>
                                        <input type="text" class="form-control mb-2" name="session_format_fr[]" placeholder="Enter session format">
                                    <?php else: ?>
                                        <?php $__currentLoopData = $session_format_fr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="text" class="form-control mb-2" name="session_format_fr[]" value="<?php echo e($format); ?>" placeholder="Enter session format">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSessionFormat('fr')">
                                    <i class="fas fa-plus"></i> Add Format
                                </button>
                            </div>
                            <div class="col-md-6">
                                <label for="session_format_en" class="form-label"><?php echo e(__('Session Format (English)')); ?></label>
                                <div id="session_format_en_container">
                                    <?php 
                                        $session_format_en = old('session_format_en'); 
                                        if (!$session_format_en) {
                                            $session_format_en = $service->getLocalizedTranslation('session_format', 'en');
                                            $session_format_en = is_array($session_format_en) ? $session_format_en : [];
                                        }
                                    ?>
                                    <?php if(empty($session_format_en)): ?>
                                        <input type="text" class="form-control mb-2" name="session_format_en[]" placeholder="Enter session format">
                                    <?php else: ?>
                                        <?php $__currentLoopData = $session_format_en; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="text" class="form-control mb-2" name="session_format_en[]" value="<?php echo e($format); ?>" placeholder="Enter session format">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSessionFormat('en')">
                                    <i class="fas fa-plus"></i> Add Format
                                </button>
                            </div>
                        </div>

                        <!-- Pricing and Details -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="price_individual" class="form-label"><?php echo e(__('Individual Price (€)')); ?></label>
                                <input id="price_individual" type="number" class="form-control <?php $__errorArgs = ['price_individual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="price_individual" value="<?php echo e(old('price_individual', $service->price_individual)); ?>" min="0" step="0.01">
                                <?php $__errorArgs = ['price_individual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="duration" class="form-label"><?php echo e(__('Duration (minutes)')); ?></label>
                                <input id="duration" type="number" class="form-control <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="duration" value="<?php echo e(old('duration', $service->duration)); ?>" min="1">
                                <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label"><?php echo e(__('Sort Order')); ?></label>
                                <input id="sort_order" type="number" class="form-control <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="sort_order" value="<?php echo e(old('sort_order', $service->sort_order)); ?>" min="0">
                                <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Icon and Status -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="icon" class="form-label"><?php echo e(__('Icon')); ?></label>
                                <select id="icon" class="form-select <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="icon">
                                    <option value="heart" <?php echo e(old('icon', $service->icon) == 'heart' ? 'selected' : ''); ?>>❤️ Heart</option>
                                    <option value="leaf" <?php echo e(old('icon', $service->icon) == 'leaf' ? 'selected' : ''); ?>>🍃 Leaf</option>
                                    <option value="moon" <?php echo e(old('icon', $service->icon) == 'moon' ? 'selected' : ''); ?>>🌙 Moon</option>
                                    <option value="brain" <?php echo e(old('icon', $service->icon) == 'brain' ? 'selected' : ''); ?>>🧠 Brain</option>
                                    <option value="lotus" <?php echo e(old('icon', $service->icon) == 'lotus' ? 'selected' : ''); ?>>🪷 Lotus</option>
                                    <option value="spa" <?php echo e(old('icon', $service->icon) == 'spa' ? 'selected' : ''); ?>>🧘 Spa</option>
                                </select>
                                <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><?php echo e(__('Status')); ?></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', $service->is_active) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="is_active">
                                        <?php echo e(__('Active')); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><?php echo e(__('Featured')); ?></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" <?php echo e(old('is_featured', $service->is_featured) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="is_featured">
                                        <?php echo e(__('Featured Service')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo e(route('admin.services.show', $service)); ?>" class="btn btn-secondary">
                                <?php echo e(__('Cancel')); ?>

                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <?php echo e(__('Update Service')); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addBenefit(lang) {
    const container = document.getElementById(`benefits_${lang}_container`);
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.name = `benefits_${lang}[]`;
    input.placeholder = 'Enter a benefit';
    container.appendChild(input);
}

function addSessionFormat(lang) {
    const container = document.getElementById(`session_format_${lang}_container`);
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.name = `session_format_${lang}[]`;
    input.placeholder = 'Enter session format';
    container.appendChild(input);
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- TinyMCE Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 400,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
        content_style: 'body { font-family: Poppins, Arial, sans-serif; font-size: 14px }',
        branding: false,
        promotion: false
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>