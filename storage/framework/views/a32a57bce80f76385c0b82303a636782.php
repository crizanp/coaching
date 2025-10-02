

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?php echo e(__('Service Details')); ?></h4>
                        <div>
                            <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?php echo e(route('services.show', ['fr', $service->slug])); ?>" class="btn btn-outline-secondary" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View Live
                            </a>
                            <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>French Content</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td><?php echo e($service->getTranslation('name', 'fr')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td><?php echo e($service->getTranslation('description', 'fr')); ?></td>
                                </tr>
                                <?php if($service->getTranslation('benefits', 'fr')): ?>
                                <tr>
                                    <td><strong>Benefits:</strong></td>
                                    <td>
                                        <?php $__currentLoopData = $service->getTranslation('benefits', 'fr'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-primary me-1 mb-1"><?php echo e($benefit); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if($service->getTranslation('session_format', 'fr')): ?>
                                <tr>
                                    <td><strong>Session Format:</strong></td>
                                    <td>
                                        <?php $__currentLoopData = $service->getTranslation('session_format', 'fr'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-info me-1 mb-1"><?php echo e($format); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>English Content</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td><?php echo e($service->getTranslation('name', 'en')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td><?php echo e($service->getTranslation('description', 'en')); ?></td>
                                </tr>
                                <?php if($service->getTranslation('benefits', 'en')): ?>
                                <tr>
                                    <td><strong>Benefits:</strong></td>
                                    <td>
                                        <?php $__currentLoopData = $service->getTranslation('benefits', 'en'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-primary me-1 mb-1"><?php echo e($benefit); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php if($service->getTranslation('session_format', 'en')): ?>
                                <tr>
                                    <td><strong>Session Format:</strong></td>
                                    <td>
                                        <?php $__currentLoopData = $service->getTranslation('session_format', 'en'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-info me-1 mb-1"><?php echo e($format); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Service Information</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Slug:</strong></td>
                                            <td><code><?php echo e($service->slug); ?></code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Icon:</strong></td>
                                            <td><i class="fas fa-<?php echo e($service->icon); ?>"></i> <?php echo e($service->icon); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Individual Price:</strong></td>
                                            <td><?php echo e($service->price_individual ? number_format($service->price_individual, 0) . '€' : 'Not set'); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Duration:</strong></td>
                                            <td><?php echo e($service->duration ? $service->duration . ' minutes' : 'Not set'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sort Order:</strong></td>
                                            <td><?php echo e($service->sort_order); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <span class="badge bg-<?php echo e($service->is_active ? 'success' : 'secondary'); ?>">
                                                    <?php echo e($service->is_active ? 'Active' : 'Inactive'); ?>

                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Featured:</strong></td>
                                            <td>
                                                <?php if($service->is_featured): ?>
                                                    <span class="badge bg-warning">Yes</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">No</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($service->getTranslation('content', 'fr') || $service->getTranslation('content', 'en')): ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>French Content</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <?php echo $service->getTranslation('content', 'fr'); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>English Content</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <?php echo $service->getTranslation('content', 'en'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5>Actions</h5>
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit Service
                                </a>
                                <a href="<?php echo e(route('services.show', ['fr', $service->slug])); ?>" class="btn btn-outline-secondary" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> View on Site
                                </a>
                                <form method="POST" action="<?php echo e(route('admin.services.destroy', $service)); ?>" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this service?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i> Delete Service
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/services/show.blade.php ENDPATH**/ ?>