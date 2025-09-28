

<?php $__env->startSection('title', $blog->meta_title ?: $blog->title); ?>
<?php $__env->startSection('description', $blog->meta_description ?: $blog->excerpt); ?>

<?php $__env->startPush('head'); ?>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo e($blog->meta_title ?: $blog->title); ?>">
    <meta property="og:description" content="<?php echo e($blog->meta_description ?: $blog->excerpt); ?>">
    <?php if($blog->featured_image): ?>
        <meta property="og:image" content="<?php echo e(Storage::url($blog->featured_image)); ?>">
    <?php endif; ?>
    <meta property="article:published_time" content="<?php echo e($blog->published_at->toISOString()); ?>">
    <meta property="article:modified_time" content="<?php echo e($blog->updated_at->toISOString()); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($blog->meta_title ?: $blog->title); ?>">
    <meta name="twitter:description" content="<?php echo e($blog->meta_description ?: $blog->excerpt); ?>">
    <?php if($blog->featured_image): ?>
        <meta name="twitter:image" content="<?php echo e(Storage::url($blog->featured_image)); ?>">
    <?php endif; ?>

    <!-- Keywords -->
    <?php if($blog->meta_keywords): ?>
        <meta name="keywords" content="<?php echo e(implode(', ', $blog->meta_keywords)); ?>">
    <?php endif; ?>

    <!-- Structured Data -->
    <?php
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $blog->title,
            'description' => $blog->excerpt,
            'author' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
            ],
            'datePublished' => $blog->published_at->toISOString(),
            'dateModified' => $blog->updated_at->toISOString(),
            'wordCount' => str_word_count(strip_tags($blog->content)),
            'timeRequired' => 'PT' . $blog->reading_time . 'M',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url()->current(),
            ],
        ];

        if ($blog->featured_image) {
            $structuredData['image'] = Storage::url($blog->featured_image);
        }
    ?>

    <script type="application/ld+json">
        <?php echo json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <article class="blog-post" style="margin-top: 94px;">
        <?php if($blog->featured_image): ?>
            <div class="blog-hero-image">
                <img src="<?php echo e(Storage::url($blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>" class="img-fluid">
                <div class="blog-hero-overlay"></div>
            </div>
        <?php endif; ?>

        <section class="blog-header section-padding" style="background: white;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="blog-header-content">
                            <nav aria-label="breadcrumb" class="mb-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo e(route('home', app()->getLocale())); ?>"><?php echo e(__('messages.nav.home')); ?></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo e(route('blog.index', app()->getLocale())); ?>"><?php echo e(__('messages.nav.blog')); ?></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo e($blog->title); ?></li>
                                </ol>
                            </nav>

                            <div class="post-meta mb-4">
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <time datetime="<?php echo e($blog->published_at->toISOString()); ?>">
                                        <?php echo e($blog->formatted_published_at); ?>

                                    </time>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock me-2"></i>
                                    <?php echo e($blog->reading_time); ?> <?php echo e(__('messages.blog.reading_time')); ?>

                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-eye me-2"></i>
                                    <?php echo e(number_format($blog->views_count)); ?> <?php echo e(__('messages.blog.views')); ?>

                                </div>
                            </div>

                            <h1 class="post-title"><?php echo e($blog->title); ?></h1>

                            <?php if($blog->excerpt): ?>
                                <div class="post-excerpt">
                                    <p class="lead"><?php echo e($blog->excerpt); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="blog-content section-padding" style="background: var(--cream);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="post-content">
                            <?php echo $blog->content; ?>

                        </div>

                        <div class="post-reactions">
                            <h5><?php echo e(__('messages.blog.reactions.title')); ?></h5>
                            <div class="reaction-buttons">
                                <button type="button"
                                        class="btn reaction-btn <?php echo e($userReaction && $userReaction->type === 'like' ? 'active' : ''); ?>"
                                        data-type="like"
                                        data-blog-id="<?php echo e($blog->id); ?>">
                                    <i class="fas fa-thumbs-up me-2"></i>
                                    <span class="like-count"><?php echo e($blog->likes_count); ?></span>
                                    <?php echo e(__('messages.blog.reactions.like')); ?>

                                </button>
                                <button type="button"
                                        class="btn reaction-btn <?php echo e($userReaction && $userReaction->type === 'dislike' ? 'active' : ''); ?>"
                                        data-type="dislike"
                                        data-blog-id="<?php echo e($blog->id); ?>">
                                    <i class="fas fa-thumbs-down me-2"></i>
                                    <span class="dislike-count"><?php echo e($blog->dislikes_count); ?></span>
                                    <?php echo e(__('messages.blog.reactions.dislike')); ?>

                                </button>
                            </div>
                        </div>

                        <div class="post-share">
                            <h5><?php echo e(__('messages.blog.share.title')); ?></h5>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"
                                   target="_blank"
                                   class="btn btn-facebook">
                                    <i class="fab fa-facebook-f me-2"></i>Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($blog->title)); ?>"
                                   target="_blank"
                                   class="btn btn-twitter">
                                    <i class="fab fa-twitter me-2"></i>Twitter
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(url()->current())); ?>"
                                   target="_blank"
                                   class="btn btn-linkedin">
                                    <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                                </a>
                                <button type="button" class="btn btn-copy" data-url="<?php echo e(url()->current()); ?>">
                                    <i class="fas fa-link me-2"></i><?php echo e(__('messages.blog.share.copy')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if($relatedBlogs->count() > 0): ?>
            <section class="related-posts section-padding" style="background: var(--light-pink);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-header text-center mb-5">
                                <h2 class="section-title"><?php echo e(__('messages.blog.related.title')); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $relatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <article class="blog-card">
                                    <div class="blog-card-image">
                                        <?php if($related->featured_image): ?>
                                            <img src="<?php echo e(Storage::url($related->featured_image)); ?>" alt="<?php echo e($related->title); ?>" class="img-fluid">
                                        <?php else: ?>
                                            <div class="placeholder-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="blog-card-content">
                                        <div class="blog-meta">
                                            <span class="blog-date">
                                                <i class="fas fa-calendar-alt me-1"></i><?php echo e($related->formatted_published_at); ?>

                                            </span>
                                            <span class="blog-reading-time">
                                                <i class="fas fa-clock me-1"></i><?php echo e($related->reading_time); ?> <?php echo e(__('messages.blog.reading_time')); ?>

                                            </span>
                                        </div>
                                        <h3 class="blog-card-title">
                                            <a href="<?php echo e(route('blog.show', ['locale' => app()->getLocale(), 'blog' => $related->slug])); ?>">
                                                <?php echo e($related->title); ?>

                                            </a>
                                        </h3>
                                        <p class="blog-card-excerpt"><?php echo e(Str::limit($related->excerpt, 100)); ?></p>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="<?php echo e(route('blog.index', app()->getLocale())); ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-blog me-2"></i><?php echo e(__('messages.blog.view_all')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .blog-hero-image {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .blog-hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%);
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-pink);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-muted);
        }

        .post-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
        }

        .meta-item i {
            color: var(--primary-pink);
        }

        .post-title {
            font-size: 3rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 2rem;
        }

        .post-excerpt {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid var(--light-pink);
        }

        .post-excerpt .lead {
            font-size: 1.3rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .post-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 3rem;
        }

        .post-content h1,
        .post-content h2,
        .post-content h3,
        .post-content h4,
        .post-content h5,
        .post-content h6 {
            color: var(--text-dark);
            font-weight: 600;
            margin: 2rem 0 1rem;
        }

        .post-content p {
            margin-bottom: 1.5rem;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 2rem 0;
        }

        .post-content blockquote {
            border-left: 4px solid var(--primary-pink);
            padding-left: 20px;
            margin: 2rem 0;
            font-style: italic;
            color: var(--text-muted);
        }

        .post-reactions,
        .post-share {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .post-reactions h5,
        .post-share h5 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .reaction-buttons,
        .share-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .reaction-btn {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            color: var(--text-dark);
            padding: 12px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .reaction-btn:hover {
            background: var(--light-pink);
            border-color: var(--primary-pink);
            color: var(--text-dark);
            transform: translateY(-2px);
        }

        .reaction-btn.active {
            background: var(--primary-pink);
            border-color: var(--primary-pink);
            color: white;
        }

        .btn-facebook {
            background: #3b5998;
            border-color: #3b5998;
            color: white;
        }

        .btn-twitter {
            background: #1da1f2;
            border-color: #1da1f2;
            color: white;
        }

        .btn-linkedin {
            background: #0077b5;
            border-color: #0077b5;
            color: white;
        }

        .btn-copy {
            background: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .share-buttons .btn {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .share-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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

        .blog-card-image {
            position: relative;
            height: 200px;
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
            font-size: 2rem;
        }

        .blog-card-content {
            padding: 20px;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .blog-card-title {
            font-size: 1.2rem;
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
            font-size: 0.95rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .blog-hero-image {
                height: 250px;
            }

            .post-title {
                font-size: 2.2rem;
            }

            .post-meta {
                flex-direction: column;
                gap: 10px;
            }

            .reaction-buttons,
            .share-buttons {
                flex-direction: column;
            }

            .reaction-btn,
            .share-buttons .btn {
                text-align: center;
            }

            .blog-meta {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const reactionButtons = document.querySelectorAll('.reaction-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const reactionUrl = `<?php echo e(route('blog.react', ['locale' => app()->getLocale(), 'blog' => $blog->id])); ?>`;

    reactionButtons.forEach(button => {
        button.addEventListener('click', () => {
            const type = button.dataset.type;

            fetch(reactionUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ type })
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        throw new Error('Reaction failed');
                    }

                    document.querySelector('.like-count').textContent = data.likes_count;
                    document.querySelector('.dislike-count').textContent = data.dislikes_count;

                    reactionButtons.forEach(btn => btn.classList.remove('active'));
                    if (data.user_reaction) {
                        document.querySelector(`[data-type="${data.user_reaction}"]`).classList.add('active');
                    }

                    showToast(data.message, 'success');
                })
                .catch(() => showToast(`<?php echo e(__('messages.blog.reactions.error')); ?>`, 'error'));
        });
    });

    const copyButton = document.querySelector('.btn-copy');
    if (copyButton) {
        copyButton.addEventListener('click', () => {
            const url = copyButton.dataset.url;
            navigator.clipboard.writeText(url)
                .then(() => showToast(`<?php echo e(__('messages.blog.share.copied')); ?>`, 'success'))
                .catch(() => showToast(`<?php echo e(__('messages.blog.share.error')); ?>`, 'error'));
        });
    }

    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
        toast.textContent = message;

        document.body.appendChild(toast);

        setTimeout(() => toast.remove(), 3000);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/blog/show.blade.php ENDPATH**/ ?>