<?php $__env->startSection('title', __('messages.blog.page.title')); ?>
<?php $__env->startSection('description', __('messages.blog.page.description')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $shouldHighlight = $blogs->currentPage() === 1 && !request('search');
?>

<!-- Blog Hero Section -->
<section class="section-padding blog-hero" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="fade-in">
                    <div class="hero-icon mb-4">
                        <i class="fas fa-feather-alt" style="font-size: 3rem; color: var(--primary-pink);"></i>
                    </div>
                    <h1 class="section-title"><?php echo e(__('messages.blog.hero.title')); ?></h1>
                    <p class="lead mb-4"><?php echo e(__('messages.blog.hero.subtitle')); ?></p>

                    <!-- Search Form -->
                    <form method="GET" action="<?php echo e(route('blog.index', app()->getLocale())); ?>" class="blog-search-form mt-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search"
                                   placeholder="<?php echo e(__('messages.blog.search.placeholder')); ?>"
                                   value="<?php echo e(request('search')); ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Highlights -->
                    <div class="workshop-highlights mt-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="highlight-card">
                                    <h3 class="mb-4" style="color: var(--primary-pink); font-weight: 600;">
                                        <i class="fas fa-magic me-2"></i>
                                        Des articles pour éclairer votre quotidien
                                    </h3>
                                    <p class="mb-4" style="font-size: 1.1rem; color: #6c757d;">
                                        Explorez des conseils concrets, des réflexions inspirantes et des outils pratiques pour avancer sereinement.
                                    </p>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-item">
                                                <i class="fas fa-lightbulb mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                                <h5>Inspiration</h5>
                                                <p class="mb-0">Comprenez vos émotions et gagnez en clarté.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-item">
                                                <i class="fas fa-hands-helping mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                                <h5>Outils pratiques</h5>
                                                <p class="mb-0">Appliquez des exercices simples au quotidien.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="highlight-item">
                                                <i class="fas fa-heart mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                                <h5>Témoignages</h5>
                                                <p class="mb-0">Découvrez des parcours réels de transformation.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($blogs->count() > 0): ?>
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5 fade-in">
                    <h2 class="section-title">
                        <?php echo e(request('search') ? __('messages.blog.search.results') : __('messages.blog.all.title')); ?>

                    </h2>
                    <?php if(request('search')): ?>
                        <p class="text-muted"><?php echo e(__('messages.blog.search.query')); ?> : "<?php echo e(request('search')); ?>"</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $isFeatured = $shouldHighlight && $loop->index < 3; ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <article class="practice-card-textured h-100 blog-article-card">
                    <div class="position-relative blog-cover-wrapper">
                        <?php if($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)): ?>
                            <img src="<?php echo e(Storage::url($blog->featured_image)); ?>"
                                 alt="<?php echo e($blog->title); ?>" class="blog-cover">
                        <?php else: ?>
                            <div class="blog-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>

                        <?php if($isFeatured): ?>
                            <div class="badge bg-primary position-absolute top-0 end-0 m-3">
                                <i class="fas fa-star me-1"></i><?php echo e(__('messages.blog.featured.badge')); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e($blog->title); ?></h4>
                            <div class="blog-meta">
                                <span><i class="fas fa-calendar-alt me-2"></i><?php echo e($blog->formatted_published_at); ?></span>
                                <?php if(!empty($blog->reading_time)): ?>
                                    <span><i class="fas fa-clock me-2"></i><?php echo e($blog->reading_time); ?> <?php echo e(__('messages.blog.reading_time')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <p class="service-description mb-4"><?php echo e(Str::limit(strip_tags($blog->excerpt), 160)); ?></p>

                    <div class="blog-card-stats mb-4">
                        <span><i class="fas fa-eye me-1"></i><?php echo e(number_format($blog->views_count)); ?></span>
                        <span><i class="fas fa-heart me-1"></i><?php echo e(number_format($blog->likes_count)); ?></span>
                    </div>

                    <div class="service-actions">
                        <a href="<?php echo e(route('blog.show', ['locale' => app()->getLocale(), 'blog' => $blog->slug])); ?>"
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-book-open me-2"></i><?php echo e(__('messages.blog.read_more')); ?>

                        </a>
                    </div>
                </article>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($blogs->appends(request()->query())->links()); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center fade-in empty-state">
                    <i class="fas fa-book-open mb-4" style="font-size: 3rem; color: var(--warm-gray); opacity: 0.6;"></i>
                    <h3 class="mb-3"><?php echo e(__('messages.blog.no_posts.title')); ?></h3>
                    <p class="lead mb-4"><?php echo e(__('messages.blog.no_posts.message')); ?></p>
                    <?php if(request('search')): ?>
                        <a href="<?php echo e(route('blog.index', app()->getLocale())); ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-undo me-2"></i><?php echo e(__('messages.blog.no_posts.view_all')); ?>

                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .blog-search-form {
        max-width: 520px;
        margin: 0 auto;
    }

    .blog-search-form .form-control {
        border-radius: 50px 0 0 50px;
        border: none;
        padding: 16px 26px;
        font-size: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .blog-search-form .btn {
        border-radius: 0 50px 50px 0;
        padding: 0 24px;
        border: none;
    }

    .practice-card-textured {
        background: #ffffff;
        border-radius: 20px;
        padding: 28px;
        text-align: left;
        border: 1px solid #000000;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease;
        color: var(--text-dark);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .practice-card-textured::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: repeating-linear-gradient(
            45deg,
            rgba(0, 0, 0, 0.02),
            rgba(0, 0, 0, 0.02) 12px,
            rgba(255, 255, 255, 0.02) 12px,
            rgba(255, 255, 255, 0.02) 24px
        );
        opacity: 0.08;
        pointer-events: none;
    }

    .practice-card-textured:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 0, 0, 0.85);
    }

    .blog-cover-wrapper {
        height: 220px;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .blog-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 2.5rem;
    }

    .practice-card-body {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .practice-icon-left {
        width: 58px;
        height: 58px;
        background: transparent;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        color: #000000;
        margin-bottom: 0;
        box-shadow: none;
    }

    .practice-card-content {
        flex: 1;
    }

    .practice-card-content h4 {
        color: #1e1d1dff;
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 10px;
    }

    .blog-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 0.95rem;
        color: #6c757d;
    }

    .blog-meta i {
        color: var(--primary-pink);
    }

    .service-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        position: relative;
        z-index: 1;
        flex-grow: 1;
    }

    .blog-card-stats {
        display: flex;
        justify-content: space-between;
        font-size: 0.95rem;
        color: #6c757d;
        position: relative;
        z-index: 1;
    }

    .blog-card-stats i {
        color: var(--primary-pink);
    }

    .service-actions {
        position: relative;
        z-index: 1;
        margin-top: auto;
    }

    .highlight-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 25px;
        padding: 40px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .highlight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: rgba(0, 0, 0, 0.2);
    }

    .highlight-item {
        text-align: center;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .highlight-item:hover {
        transform: translateY(-3px);
    }

    .highlight-item h5 {
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .highlight-item p {
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .empty-state {
        padding: 60px 20px;
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 991px) {
        .blog-cover-wrapper {
            height: 200px;
        }

        .highlight-card {
            padding: 30px;
        }
    }

    @media (max-width: 767px) {
        .blog-search-form .form-control {
            border-radius: 15px;
            margin-bottom: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .blog-search-form .btn {
            border-radius: 15px;
            width: 100%;
        }

        .practice-card-body {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .blog-meta {
            flex-direction: column;
            gap: 6px;
        }

        .highlight-card {
            padding: 25px;
            margin: 0 10px;
        }

        .highlight-item {
            padding: 15px 10px;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/blog/index.blade.php ENDPATH**/ ?>