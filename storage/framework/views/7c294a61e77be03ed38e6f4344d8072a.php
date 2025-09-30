

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?php echo e(__('Services Management')); ?></h4>
                        <div>
                            <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> New Service
                            </a>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary">
                                <i class="fas fa-dashboard"></i> Dashboard
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

                    <?php if($services->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Sort Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($service->id); ?></td>
                                        <td>
                                            <div>
                                                <strong><?php echo e($service->getTranslation('name', 'fr')); ?></strong>
                                                <br>
                                                <small class="text-muted"><?php echo e($service->getTranslation('name', 'en')); ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($service->price_individual): ?>
                                                <span class="badge bg-primary">Individual: <?php echo e(number_format($service->price_individual, 0)); ?>€</span>
                                            <?php endif; ?>
                                            <?php if($service->price_group): ?>
                                                <br><span class="badge bg-success">Group: <?php echo e(number_format($service->price_group, 0)); ?>€</span>
                                            <?php endif; ?>
                                            <?php if(!$service->price_individual && !$service->price_group): ?>
                                                <span class="text-muted">No pricing set</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo e($service->is_active ? 'success' : 'secondary'); ?>">
                                                <?php echo e($service->is_active ? 'Active' : 'Inactive'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if($service->is_featured): ?>
                                                <span class="badge bg-warning">Featured</span>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($service->sort_order); ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo e(route('admin.services.show', $service)); ?>" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?php echo e(route('services.show', ['fr', $service->slug])); ?>" class="btn btn-sm btn-outline-secondary" target="_blank">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <form method="POST" action="<?php echo e(route('admin.services.destroy', $service)); ?>" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this service?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            <?php echo e($services->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-concierge-bell fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No services found</h5>
                            <p class="text-muted">Create your first service to get started.</p>
                            <a href="<?php echo e(route('admin.services.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create First Service
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/services/index.blade.php ENDPATH**/ ?>