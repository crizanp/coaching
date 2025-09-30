

<?php $__env->startSection('title', 'Guides Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Guides Management</h1>
        <a href="<?php echo e(route('admin.guides.create')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Guide
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Guides</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($stats['total']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Guides</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($stats['active']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Inactive Guides</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($stats['inactive']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pause-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Downloads</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($stats['total_downloads']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guides Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Guides</h6>
        </div>
        <div class="card-body">
            <?php if($guides->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Downloads</th>
                                <th>Sort Order</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="font-weight-bold"><?php echo e($guide->title); ?></div>
                                                <div class="text-muted small"><?php echo e(Str::limit($guide->description, 50)); ?></div>
                                                <div class="text-muted small"><strong>Slug:</strong> <?php echo e($guide->slug); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="fas <?php echo e($guide->icon); ?> fa-2x text-primary"></i>
                                    </td>
                                    <td>
                                        <?php if($guide->is_active): ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-info"><?php echo e($guide->total_downloads); ?></span>
                                    </td>
                                    <td class="text-center"><?php echo e($guide->sort_order); ?></td>
                                    <td><?php echo e($guide->created_at->format('d/m/Y')); ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.guides.show', $guide)); ?>" class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.guides.edit', $guide)); ?>" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.guides.toggle-status', $guide)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="btn btn-<?php echo e($guide->is_active ? 'secondary' : 'success'); ?> btn-sm" 
                                                        title="<?php echo e($guide->is_active ? 'Deactivate' : 'Activate'); ?>">
                                                    <i class="fas fa-<?php echo e($guide->is_active ? 'pause' : 'play'); ?>"></i>
                                                </button>
                                            </form>
                                            <?php if($guide->total_downloads == 0): ?>
                                                <form action="<?php echo e(route('admin.guides.destroy', $guide)); ?>" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this guide?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <?php echo e($guides->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-book fa-3x text-gray-300 mb-3"></i>
                    <h5 class="text-gray-500">No guides found</h5>
                    <p class="text-gray-400">Start by creating your first guide.</p>
                    <a href="<?php echo e(route('admin.guides.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add First Guide
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/guides/index.blade.php ENDPATH**/ ?>