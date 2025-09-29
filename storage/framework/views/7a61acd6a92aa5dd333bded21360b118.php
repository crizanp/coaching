

<?php $__env->startSection('title', 'Blog Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-blog me-3"></i>Blog Posts
        </h1>
        <div class="header-actions">
            <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>New Post
            </a>
        </div>
    </div>
</div>

<div class="admin-content">
    <!-- Search & Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.blogs.index')); ?>" class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="<?php echo e(request('search')); ?>" placeholder="Search in title, content...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Posts</option>
                            <option value="published" <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                            <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-outline-primary d-block w-100">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Blog Posts Table -->
    <div class="card">
        <div class="card-body">
            <?php if($blogs->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Image</th>
                                <th>Title</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 100px;">Views</th>
                                <th style="width: 80px;">Likes</th>
                                <th style="width: 120px;">Published</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php if($blog->featured_image): ?>
                                            <img src="<?php echo e(Storage::url($blog->featured_image)); ?>" 
                                                 alt="<?php echo e($blog->title); ?>" class="rounded" 
                                                 style="width: 50px; height: 35px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 35px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo e($blog->title); ?></h6>
                                        <small class="text-muted"><?php echo e(Str::limit($blog->excerpt, 50)); ?></small>
                                    </td>
                                    <td>
                                        <?php if($blog->is_published): ?>
                                            <span class="badge bg-success">Published</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            <i class="fas fa-eye me-1"></i><?php echo e(number_format($blog->views_count)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-success">
                                            <i class="fas fa-thumbs-up me-1"></i><?php echo e($blog->likes_count); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo e($blog->formatted_published_at ?? 'Not published'); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e(route('admin.blogs.show', $blog)); ?>" 
                                               class="btn btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.blogs.edit', $blog)); ?>" 
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.blogs.toggle-publish', $blog)); ?>" 
                                                  method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" 
                                                        class="btn btn-outline-<?php echo e($blog->is_published ? 'warning' : 'success'); ?>" 
                                                        title="<?php echo e($blog->is_published ? 'Unpublish' : 'Publish'); ?>">
                                                    <i class="fas fa-<?php echo e($blog->is_published ? 'eye-slash' : 'globe'); ?>"></i>
                                                </button>
                                            </form>
                                            <form action="<?php echo e(route('admin.blogs.destroy', $blog)); ?>" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this blog post?')">
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

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($blogs->appends(request()->query())->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No blog posts found</h5>
                    <p class="text-muted">Get started by creating your first blog post.</p>
                    <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create New Post
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .admin-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 10px;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
    }

    .admin-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(255, 255, 255, 0.075);
        border-radius: 10px;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
    }

    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/blogs/index.blade.php ENDPATH**/ ?>