

<?php $__env->startSection('title', __('messages.blog.page.title')); ?>
<?php $__env->startSection('description', __('messages.blog.page.description')); ?>

<?php $__env->startSection('content'); ?>
<!-- Blog Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="hero-icon mb-4">
                        <i class="fas fa-blog" style="font-size: 3rem; color: var(--primary-pink);"></i>
                    </div>
                    <h1 class="section-title"><?php echo e(__('messages.blog.hero.title')); ?></h1>
                    <p class="lead mb-4"><?php echo e(__('messages.blog.hero.subtitle')); ?></p>
                    
                    <!-- Search Form -->
                    <form method="GET" action="<?php echo e(route('blog.index', app()->getLocale())); ?>" class="blog-search-form mt-4">
                        <div class="input-group" style="max-width: 500px; margin: 0 auto;">
                            <input type="text" class="form-control" name="search" 
                                   placeholder="<?php echo e(__('messages.blog.search.placeholder')); ?>" 
                                   value="<?php echo e(request('search')); ?>"
                                   style="border-radius: 25px 0 0 25px; padding: 12px 20px;">
                            <button class="btn btn-primary" type="submit" style="border-radius: 0 25px 25px 0; padding: 12px 20px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- All Posts Section -->
<section class="all-posts section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">
                        <?php echo e(request('search') ? __('messages.blog.search.results') : __('messages.blog.all.title')); ?>

                    </h2>
                    <?php if(request('search')): ?>
                        <p class="text-muted"><?php echo e(__('messages.blog.search.query')); ?>: "<?php echo e(request('search')); ?>"</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if($blogs->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <article class="practice-card-textured h-100">
                            <?php if($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)): ?>
                            <div class="position-relative">
                                <div class="blog-image">
                                    <img src="<?php echo e(Storage::url($blog->featured_image)); ?>" 
                                         alt="<?php echo e($blog->title); ?>" 
                                         class="w-100" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                                </div>
                                <?php if($index < 3 && !request('search')): ?>
                                    <div class="badge bg-primary position-absolute top-0 end-0 m-3">
                                        <i class="fas fa-star me-1"></i><?php echo e(__('messages.blog.featured.badge')); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="practice-card-body">
                                <div class="practice-icon-left">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div class="practice-card-content">
                                    <h4>
                                        <a href="<?php echo e(route('blog.show', ['locale' => app()->getLocale(), 'blog' => $blog->slug])); ?>" 
                                           style="text-decoration: none; color: inherit;">
                                            <?php echo e($blog->title); ?>

                                        </a>
                                    </h4>
                                </div>
                            </div>
                            
                            <p class="service-description mb-4"><?php echo e($blog->excerpt); ?></p>
                            
                            <div class="service-details mb-4">
                                <div class="service-detail-item mb-2">
                                    <strong><?php echo e(__('messages.blog.published')); ?>:</strong> <?php echo e($blog->formatted_published_at); ?>

                                </div>
                                <div class="service-detail-item mb-2">
                                    <strong><?php echo e(__('messages.blog.reading_time')); ?>:</strong> <?php echo e($blog->reading_time); ?> min
                                </div>
                                <div class="service-detail-item mb-2">
                                    <strong><?php echo e(__('messages.blog.views')); ?>:</strong> <?php echo e(number_format($blog->views_count)); ?>

                                </div>
                            </div>
                            
                            <div class="service-actions">
                                <a href="<?php echo e(route('blog.show', ['locale' => app()->getLocale(), 'blog' => $blog->slug])); ?>" 
                                   class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <?php echo e(__('messages.blog.read_more')); ?>

                                </a>
                                <div class="btn btn-sm mb-2" style="background: var(--light-pink); border: none;">
                                    <i class="fas fa-heart me-1"></i><?php echo e($blog->likes_count); ?>

                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-5">
                        <?php echo e($blogs->appends(request()->query())->links()); ?>

                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center fade-in">
                        <i class="fas fa-search mb-4" style="font-size: 3rem; color: var(--warm-gray); opacity: 0.6;"></i>
                        <h3 class="mb-3"><?php echo e(__('messages.blog.no_posts.title')); ?></h3>
                        <p class="lead mb-4"><?php echo e(__('messages.blog.no_posts.message')); ?></p>
                        <?php if(request('search')): ?>
                            <a href="<?php echo e(route('blog.index', app()->getLocale())); ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i><?php echo e(__('messages.blog.no_posts.view_all')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .blog-hero {
        position: relative;
        overflow: hidden;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .blog-search-form {
        max-width: 500px;
        margin: 0 auto;
    }

    .blog-search-form .form-control {
        border-radius: 50px 0 0 50px;
        border: none;
        padding: 15px 25px;
        font-size: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .blog-search-form .btn {
        border-radius: 0 50px 50px 0;
        padding: 15px 25px;
        border: none;
    }

    .blog-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .featured-card {
        border: 2px solid var(--primary-pink);
        position: relative;
    }

    .blog-card-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }

    .blog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-card-image img {
        transform: scale(1.05);
    }

    .placeholder-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 3rem;
    }

    .blog-card-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary-pink);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .blog-card-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 250px);
    }

    .blog-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .blog-card-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .blog-card-title a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .blog-card-title a:hover {
        color: var(--primary-pink);
    }

    .blog-card-excerpt {
        color: var(--text-muted);
        line-height: 1.6;
        flex-grow: 1;
        margin-bottom: 20px;
    }

    .blog-card-stats {
        display: flex;
        justify-content: space-between;
        padding-top: 15px;
        border-top: 1px solid #f1f1f1;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .no-posts {
        padding: 60px 20px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .blog-search-form .form-control,
        .blog-search-form .btn {
            border-radius: 15px;
            margin-bottom: 10px;
        }

        .blog-card-image {
            height: 200px;
        }

        .blog-meta {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/blog/index.blade.php ENDPATH**/ ?>