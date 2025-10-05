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
        <meta name="keywords" content="<?php echo e(is_array($blog->meta_keywords) ? implode(', ', $blog->meta_keywords) : $blog->meta_keywords); ?>">
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
    <!-- Blog Hero Section -->
    <section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="fade-in">
                        <nav aria-label="breadcrumb" class="mb-4 d-flex justify-content-center">
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
                        
                        <?php if($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)): ?>
                            <div class="mb-4">
                                <img src="<?php echo e(Storage::url($blog->featured_image)); ?>" 
                                     alt="<?php echo e($blog->title); ?>" 
                                     class="img-fluid rounded-3"
                                     style="max-height: 300px; width: auto;">
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="section-title"><?php echo e($blog->title); ?></h1>
                        <p class="lead mb-4"><?php echo e($blog->excerpt); ?></p>
                        
                        <div class="post-meta d-flex justify-content-center gap-4">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <time datetime="<?php echo e($blog->published_at->toISOString()); ?>">
                                    <?php echo e($blog->formatted_published_at); ?>

                                </time>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-eye me-2"></i>
                                <?php echo e(number_format($blog->views_count)); ?> <?php echo e(__('messages.blog.views')); ?>

                            </div>
                        </div>

                        <div class="gift-cta mt-4">
                            <button type="button"
                                    class="btn btn-primary btn-lg gift-request-trigger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#blogGiftRequestModal">
                                <i class="fas fa-gift me-2"></i>
                                <?php echo e(__('messages.blog.gift.cta')); ?>

                            </button>
                            <p class="text-muted small mt-2 mb-0">
                                <?php echo e(__('messages.blog.gift.caption')); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sticky Share Sidebar -->
    <div class="sticky-share-sidebar">
        <div class="share-buttons-vertical">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"
               target="_blank"
               class="share-btn facebook"
               title="Share on Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($blog->title)); ?>"
               target="_blank"
               class="share-btn twitter"
               title="Share on Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(url()->current())); ?>"
               target="_blank"
               class="share-btn linkedin"
               title="Share on LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <button type="button" class="share-btn copy" data-url="<?php echo e(url()->current()); ?>" title="Copy Link">
                <i class="fas fa-link"></i>
            </button>
        </div>
    </div>

    <article class="blog-post">
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
                                    <i class="fas fa-heart me-1"></i>
                                    <span class="reaction-count" id="like-count"><?php echo e($blog->likes_count); ?></span>
                                    <?php echo e(__('messages.blog.reactions.like')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                    </div>
                </div>
            </div>
        </section>

        <!-- Gift Request Modal -->
        <div class="modal fade" id="blogGiftRequestModal" tabindex="-1" aria-labelledby="blogGiftRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blogGiftRequestModalLabel">
                            <i class="fas fa-gift me-2"></i>
                            <?php echo e(__('messages.blog.gift.modal_title')); ?>

                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo e(__('messages.common.close')); ?>"></button>
                    </div>
                    <div class="modal-body">
                        <div id="blogGiftFeedback" class="alert d-none" role="alert"></div>
                        <form id="blogGiftRequestForm" action="<?php echo e(route('blog.gift-request', ['locale' => app()->getLocale(), 'blog' => $blog->slug])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="gift_last_name" class="form-label"><?php echo e(__('messages.blog.gift.form.last_name')); ?></label>
                                    <input type="text" class="form-control" id="gift_last_name" name="last_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="gift_first_name" class="form-label"><?php echo e(__('messages.blog.gift.form.first_name')); ?></label>
                                    <input type="text" class="form-control" id="gift_first_name" name="first_name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="gift_email" class="form-label"><?php echo e(__('messages.blog.gift.form.email')); ?></label>
                                    <input type="email" class="form-control" id="gift_email" name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="gift_phone" class="form-label"><?php echo e(__('messages.blog.gift.form.phone')); ?></label>
                                    <input type="tel" class="form-control" id="gift_phone" name="phone" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <?php echo e(__('messages.common.close')); ?>

                        </button>
                        <button type="submit" form="blogGiftRequestForm" class="btn btn-primary" id="blogGiftSubmit">
                            <i class="fas fa-paper-plane me-2"></i><?php echo e(__('messages.blog.gift.form.submit')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>

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
        /* Ensure all containers match navbar width */
        .container {
            max-width: 1345px;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .about-image-container {
            position: relative;
            text-align: center;
        }

        .about-image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .blog-icon-large {
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--text-dark);
            margin: 0 auto;
            border: 3px solid rgba(255,255,255,0.3);
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

        .gift-cta {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .gift-cta .btn {
            border-radius: 999px;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
            box-shadow: 0 10px 25px rgba(233, 30, 99, 0.2);
        }

        .gift-cta .btn:hover {
            box-shadow: 0 12px 30px rgba(233, 30, 99, 0.25);
            transform: translateY(-2px);
        }

        .meta-item {
            display: flex;
            align-items: center;
        }

        .meta-item i {
            color: var(--primary-pink);
        }

        /* Sticky Share Sidebar */
        .sticky-share-sidebar {
            position: fixed;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            display: none;
        }

        .share-buttons-vertical {
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: white;
            padding: 15px 8px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: 2px solid var(--light-pink);
        }

        .share-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .share-btn.facebook {
            background: #1877f2;
            color: white;
        }

        .share-btn.facebook:hover {
            background: #166fe5;
            transform: scale(1.1);
        }

        .share-btn.twitter {
            background: #1da1f2;
            color: white;
        }

        .share-btn.twitter:hover {
            background: #1a91da;
            transform: scale(1.1);
        }

        .share-btn.linkedin {
            background: #0077b5;
            color: white;
        }

        .share-btn.linkedin:hover {
            background: #006ba1;
            transform: scale(1.1);
        }

        .share-btn.copy {
            background: var(--primary-pink);
            color: white;
        }

        .share-btn.copy:hover {
            background: var(--primary-pink-dark, #e91e63);
            transform: scale(1.1);
        }

        /* Show sticky sidebar on larger screens */
        @media (min-width: 1200px) {
            .sticky-share-sidebar {
                display: block;
            }
        }

        /* Hide on smaller screens */
        @media (max-width: 1199px) {
            .sticky-share-sidebar {
                display: none;
            }
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

        #blogGiftFeedback {
            transition: all 0.3s ease;
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
    const giftForm = document.getElementById('blogGiftRequestForm');
    const giftSubmit = document.getElementById('blogGiftSubmit');
    const giftFeedback = document.getElementById('blogGiftFeedback');
    const giftModalElement = document.getElementById('blogGiftRequestModal');
    const giftModalInstance = giftModalElement ? bootstrap.Modal.getOrCreateInstance(giftModalElement) : null;

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
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success === false) {
                        showToast(data.message || `<?php echo e(__('messages.blog.reactions.error')); ?>`, 'error');
                        return;
                    }

                    document.querySelector('#like-count').textContent = data.likes_count;

                    reactionButtons.forEach(btn => btn.classList.remove('active'));
                    if (data.user_reaction) {
                        document.querySelector(`[data-type="${data.user_reaction}"]`).classList.add('active');
                    }

                    showToast(data.message, 'success');
                })
                .catch(error => {
                    console.error('Blog reaction error:', error);
                    console.error('Error details:', {
                        status: error.status,
                        statusText: error.statusText,
                        message: error.message
                    });
                    showToast(`<?php echo e(__('messages.blog.reactions.error')); ?>`, 'error');
                });
        });
    });

    // Handle sticky sidebar copy button
    const copyButtons = document.querySelectorAll('.share-btn.copy');
    copyButtons.forEach(copyButton => {
        copyButton.addEventListener('click', () => {
            const url = copyButton.dataset.url;
            navigator.clipboard.writeText(url)
                .then(() => showToast(`<?php echo e(__('messages.blog.share.copied')); ?>`, 'success'))
                .catch(() => showToast(`<?php echo e(__('messages.blog.share.error')); ?>`, 'error'));
        });
    });

    if (giftForm && giftSubmit) {
        giftForm.addEventListener('submit', (event) => {
            event.preventDefault();
            toggleGiftSubmitState(true);
            resetGiftFeedback();
            clearValidationStates();

            const formData = new FormData(giftForm);

            fetch(giftForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(async response => {
                    const data = await response.json().catch(() => ({}));
                    if (!response.ok) {
                        const message = data.message || `<?php echo e(__('messages.blog.gift.messages.error')); ?>`;
                        throw { message, errors: data.errors, status: response.status };
                    }
                    return data;
                })
                .then(data => {
                    showGiftFeedback('success', data.message || `<?php echo e(__('messages.blog.gift.messages.success')); ?>`);
                    giftForm.reset();
                    if (giftModalInstance) {
                        setTimeout(() => giftModalInstance.hide(), 1500);
                    }
                })
                .catch(error => {
                    console.error('Gift request error:', error);
                    if (error.errors) {
                        displayValidationErrors(error.errors);
                    }
                    const firstError = error.errors ? Object.values(error.errors).flat()[0] : null;
                    showGiftFeedback('danger', firstError || error.message || `<?php echo e(__('messages.blog.gift.messages.error')); ?>`);
                })
                .finally(() => {
                    toggleGiftSubmitState(false);
                });
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

    function toggleGiftSubmitState(isSubmitting) {
        if (!giftSubmit) return;
        giftSubmit.disabled = isSubmitting;
        giftSubmit.innerHTML = isSubmitting
            ? `<i class="fas fa-spinner fa-spin me-2"></i><?php echo e(__('messages.blog.gift.form.submitting')); ?>`
            : `<i class="fas fa-paper-plane me-2"></i><?php echo e(__('messages.blog.gift.form.submit')); ?>`;
    }

    function resetGiftFeedback() {
        if (!giftFeedback) return;
        giftFeedback.classList.add('d-none');
        giftFeedback.textContent = '';
        giftFeedback.classList.remove('alert-success', 'alert-danger');
    }

    function showGiftFeedback(type, message) {
        if (!giftFeedback) return;
        giftFeedback.classList.remove('d-none');
        giftFeedback.classList.toggle('alert-success', type === 'success');
        giftFeedback.classList.toggle('alert-danger', type !== 'success');
        giftFeedback.textContent = message;
    }

    function clearValidationStates() {
        if (!giftForm) return;
        giftForm.querySelectorAll('.is-invalid').forEach(field => field.classList.remove('is-invalid'));
    }

    function displayValidationErrors(errors) {
        if (!errors) return;
        Object.entries(errors).forEach(([name, messages]) => {
            const field = giftForm.querySelector(`[name="${name}"]`);
            if (!field) return;
            field.classList.add('is-invalid');

            field.addEventListener('input', () => field.classList.remove('is-invalid'), { once: true });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/blog/show.blade.php ENDPATH**/ ?>