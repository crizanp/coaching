

<?php $__env->startSection('page-title', 'Blog Gift Requests'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-gift me-3"></i>Blog Gift Requests
        </h1>
    </div>
</div>

<div class="admin-content">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="stat-value"><?php echo e($stats['total']); ?></div>
                <div class="stat-label">Total Requests</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-value"><?php echo e($stats['pending']); ?></div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo e($stats['processed']); ?></div>
                <div class="stat-label">Processed</div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.blog-gift-requests.index')); ?>" class="row g-3">
                <div class="col-md-5">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by name or email">
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="<?php echo e(\App\Models\BlogGiftRequest::STATUS_PENDING); ?>" <?php echo e(request('status') === \App\Models\BlogGiftRequest::STATUS_PENDING ? 'selected' : ''); ?>>Pending</option>
                        <option value="<?php echo e(\App\Models\BlogGiftRequest::STATUS_PROCESSED); ?>" <?php echo e(request('status') === \App\Models\BlogGiftRequest::STATUS_PROCESSED ? 'selected' : ''); ?>>Processed</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                    <a href="<?php echo e(route('admin.blog-gift-requests.index')); ?>" class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($requests->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Requester</th>
                                <th>Contact</th>
                                <th>Blog Post</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requestItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e($requestItem->full_name); ?></strong>
                                    </td>
                                    <td class="text-muted">
                                        <div><i class="fas fa-envelope me-2"></i><?php echo e($requestItem->email); ?></div>
                                        <div><i class="fas fa-phone me-2"></i><?php echo e($requestItem->phone); ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"><?php echo e($requestItem->blog_title); ?></div>
                                        <small class="text-muted">Locale: <?php echo e(strtoupper($requestItem->locale)); ?></small>
                                    </td>
                                    <td><?php echo $requestItem->status_badge; ?></td>
                                    <td><small class="text-muted"><?php echo e($requestItem->formatted_created_at); ?></small></td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e(route('admin.blog-gift-requests.show', $requestItem)); ?>" class="btn btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if($requestItem->status === \App\Models\BlogGiftRequest::STATUS_PENDING): ?>
                                                <form method="POST" action="<?php echo e(route('admin.blog-gift-requests.update', $requestItem)); ?>" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="status" value="<?php echo e(\App\Models\BlogGiftRequest::STATUS_PROCESSED); ?>">
                                                    <button type="submit" class="btn btn-outline-success" title="Mark as processed">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" action="<?php echo e(route('admin.blog-gift-requests.update', $requestItem)); ?>" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="status" value="<?php echo e(\App\Models\BlogGiftRequest::STATUS_PENDING); ?>">
                                                    <button type="submit" class="btn btn-outline-warning" title="Mark as pending">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <form method="POST" action="<?php echo e(route('admin.blog-gift-requests.destroy', $requestItem)); ?>" class="d-inline" onsubmit="return confirm('Delete this request?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
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

                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($requests->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No requests found</h5>
                    <p class="text-muted">Gift requests submitted from blog posts will appear here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/blog-gift-requests/index.blade.php ENDPATH**/ ?>