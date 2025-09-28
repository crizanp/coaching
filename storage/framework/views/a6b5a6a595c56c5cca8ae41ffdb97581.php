

<?php $__env->startSection('title', 'View Blog Post'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <div class="header-content">
        <h1 class="page-title">
            <i class="fas fa-eye me-3"></i><?php echo e($blog->title); ?>

        </h1>
        <div class="header-actions">
            <a href="<?php echo e(route('admin.blogs.index')); ?>" class="btn btn-outline-light me-2">
                <i class="fas fa-arrow-left me-2"></i>Back to Posts
            </a>
            <a href="<?php echo e(route('admin.blogs.edit', $blog)); ?>" class="btn btn-primary me-2">
                <i class="fas fa-edit me-2"></i>Edit Post
            </a>
            <a href="<?php echo e(route('blog.show', ['locale' => 'en', 'blog' => $blog->slug])); ?>" 
               class="btn btn-outline-light" target="_blank">
                <i class="fas fa-external-link-alt me-2"></i>View Live
            </a>
        </div>
    </div>
</div>

<div class="admin-content">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post Content -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Content</h5>
                </div>
                <div class="card-body">
                    <!-- Featured Image -->
                    <?php if($blog->featured_image): ?>
                        <div class="mb-4">
                            <img src="<?php echo e(Storage::url($blog->featured_image)); ?>" 
                                 alt="<?php echo e($blog->title); ?>" class="img-fluid rounded">
                        </div>
                    <?php endif; ?>

                    <!-- Excerpt -->
                    <div class="mb-4">
                        <h6 class="text-muted">Excerpt:</h6>
                        <div class="excerpt-box">
                            <?php echo e($blog->excerpt); ?>

                        </div>
                    </div>

                    <!-- Content -->
                    <div class="post-content">
                        <?php echo $blog->content; ?>

                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">SEO Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Meta Title:</h6>
                            <p><?php echo e($blog->meta_title ?: $blog->title); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Slug:</h6>
                            <p><code><?php echo e($blog->slug); ?></code></p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted">Meta Description:</h6>
                        <p><?php echo e($blog->meta_description ?: $blog->excerpt); ?></p>
                    </div>
                    <?php if($blog->meta_keywords): ?>
                        <div class="mb-3">
                            <h6 class="text-muted">Keywords:</h6>
                            <div>
                                <?php $__currentLoopData = $blog->meta_keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-secondary me-1"><?php echo e($keyword); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Post Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Status & Statistics</h5>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-3">
                        <?php if($blog->is_published): ?>
                            <span class="badge bg-success fs-6">Published</span>
                        <?php else: ?>
                            <span class="badge bg-secondary fs-6">Draft</span>
                        <?php endif; ?>
                    </div>

                    <!-- Dates -->
                    <div class="mb-3">
                        <h6 class="text-muted">Created:</h6>
                        <p class="mb-1"><?php echo e($blog->created_at->format('M d, Y \a\t g:i A')); ?></p>
                        
                        <h6 class="text-muted mt-3">Last Updated:</h6>
                        <p class="mb-1"><?php echo e($blog->updated_at->format('M d, Y \a\t g:i A')); ?></p>
                        
                        <?php if($blog->published_at): ?>
                            <h6 class="text-muted mt-3">Published:</h6>
                            <p class="mb-1"><?php echo e($blog->published_at->format('M d, Y \a\t g:i A')); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Statistics -->
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e(number_format($blog->views_count)); ?></div>
                            <div class="stat-label">Views</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($blog->likes_count); ?></div>
                            <div class="stat-label">Likes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($blog->dislikes_count); ?></div>
                            <div class="stat-label">Dislikes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($blog->reading_time); ?></div>
                            <div class="stat-label">Min Read</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('admin.blogs.edit', $blog)); ?>" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Post
                        </a>
                        
                        <form action="<?php echo e(route('admin.blogs.toggle-publish', $blog)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-<?php echo e($blog->is_published ? 'warning' : 'success'); ?> w-100">
                                <i class="fas fa-<?php echo e($blog->is_published ? 'eye-slash' : 'globe'); ?> me-2"></i>
                                <?php echo e($blog->is_published ? 'Unpublish' : 'Publish'); ?>

                            </button>
                        </form>
                        
                        <form action="<?php echo e(route('admin.blogs.destroy', $blog)); ?>" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
        word-break: break-word;
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

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
    }

    .excerpt-box {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #0d6efd;
        font-style: italic;
    }

    .post-content {
        font-size: 1.1rem;
        line-height: 1.7;
    }

    .post-content h1,
    .post-content h2,
    .post-content h3,
    .post-content h4,
    .post-content h5,
    .post-content h6 {
        margin: 1.5rem 0 1rem 0;
        font-weight: 600;
    }

    .post-content p {
        margin-bottom: 1rem;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/blogs/show.blade.php ENDPATH**/ ?>