

<?php $__env->startSection('page-title', 'Blog Gift Request Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-gift me-3"></i>Request from <?php echo e($blogGiftRequest->full_name); ?>

        </h1>
        <div class="header-actions">
            <a href="<?php echo e(route('admin.blog-gift-requests.index')); ?>" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Back to list
            </a>
            <a href="<?php echo e(url($blogGiftRequest->locale . '/blog/' . $blogGiftRequest->blog_slug)); ?>" target="_blank" class="btn btn-light">
                <i class="fas fa-external-link-alt me-2"></i>View blog post
            </a>
        </div>
    </div>
</div>

<div class="admin-content">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">Contact Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">First name</span>
                                <span class="info-value"><?php echo e($blogGiftRequest->first_name); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">Last name</span>
                                <span class="info-value"><?php echo e($blogGiftRequest->last_name); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">Email</span>
                                <a href="mailto:<?php echo e($blogGiftRequest->email); ?>" class="info-value">
                                    <?php echo e($blogGiftRequest->email); ?>

                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <span class="info-label">Phone</span>
                                <a href="tel:<?php echo e($blogGiftRequest->phone); ?>" class="info-value">
                                    <?php echo e($blogGiftRequest->phone); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="card-title mb-3">Blog Post</h5>
                    <p class="mb-1 fw-semibold"><?php echo e($blogGiftRequest->blog_title); ?></p>
                    <p class="text-muted mb-0">Submitted from locale: <strong><?php echo e(strtoupper($blogGiftRequest->locale)); ?></strong></p>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">Status & Notes</h5>
                    <div class="mb-3">
                        <div class="info-block mb-2">
                            <span class="info-label">Current status</span>
                            <span class="info-value"><?php echo $blogGiftRequest->status_badge; ?></span>
                        </div>
                        <div class="info-block">
                            <span class="info-label">Submitted at</span>
                            <span class="info-value"><?php echo e($blogGiftRequest->formatted_created_at); ?></span>
                        </div>
                        <?php if($blogGiftRequest->processed_at): ?>
                            <div class="info-block">
                                <span class="info-label">Processed at</span>
                                <span class="info-value"><?php echo e($blogGiftRequest->processed_at->format('d/m/Y H:i')); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.blog-gift-requests.update', $blogGiftRequest)); ?>" class="d-grid gap-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="<?php echo e(\App\Models\BlogGiftRequest::STATUS_PENDING); ?>" <?php echo e($blogGiftRequest->status === \App\Models\BlogGiftRequest::STATUS_PENDING ? 'selected' : ''); ?>>Pending</option>
                                <option value="<?php echo e(\App\Models\BlogGiftRequest::STATUS_PROCESSED); ?>" <?php echo e($blogGiftRequest->status === \App\Models\BlogGiftRequest::STATUS_PROCESSED ? 'selected' : ''); ?>>Processed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="admin_notes" class="form-label">Admin notes</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4" placeholder="Add a follow-up note or summary"><?php echo e(old('admin_notes', $blogGiftRequest->admin_notes)); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save changes
                        </button>
                    </form>

                    <form method="POST" action="<?php echo e(route('admin.blog-gift-requests.destroy', $blogGiftRequest)); ?>" class="mt-4" onsubmit="return confirm('Delete this request? This action cannot be undone.');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .info-block {
        display: flex;
        flex-direction: column;
    }
    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
    }
    .info-value {
        font-weight: 600;
        color: var(--admin-text);
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/blog-gift-requests/show.blade.php ENDPATH**/ ?>