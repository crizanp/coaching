@extends('layouts.frontend')

@section('title', $blog->meta_title ?: $blog->title)
@section('description', $blog->meta_description ?: $blog->excerpt)

@push('head')
<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta property="og:description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
@if($blog->featured_image)
<meta property="og:image" content="{{ Storage::url($blog->featured_image) }}">
@endif
<meta property="article:published_time" content="{{ $blog->published_at->toISOString() }}">
<meta property="article:modified_time" content="{{ $blog->updated_at->toISOString() }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $blog->meta_title ?: $blog->title }}">
<meta name="twitter:description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
@if($blog->featured_image)
<meta name="twitter:image" content="{{ Storage::url($blog->featured_image) }}">
@endif

<!-- Keywords -->
@if($blog->meta_keywords)
<meta name="keywords" content="{{ is_array($blog->meta_keywords) ? implode(', ', $blog->meta_keywords) : $blog->meta_keywords }}">
@endif

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "{{ $blog->title }}",
  "description": "{{ $blog->excerpt }}",
  "image": "{{ $blog->featured_image ? Storage::url($blog->featured_image) : '' }}",
  "author": {
    "@type": "Organization",
    "name": "{{ config('app.name') }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.name') }}"
  },
  "datePublished": "{{ $blog->published_at->toISOString() }}",
  "dateModified": "{{ $blog->updated_at->toISOString() }}",
  "wordCount": {{ str_word_count(strip_tags($blog->content)) }},
  "timeRequired": "PT{{ $blog->reading_time }}M",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  }
}
</script>
@endpush

@section('content')
<!-- Blog Post Header -->
<article class="blog-post" style="margin-top: 94px;">
    <!-- Featured Image -->
    @if($blog->featured_image)
        <div class="blog-hero-image">
            <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid">
            <div class="blog-hero-overlay"></div>
        </div>
    @endif

    <!-- Post Header -->
    <section class="blog-header section-padding" style="background: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-header-content">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home', app()->getLocale()) }}">{{ __('messages.nav.home') }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('blog.index', app()->getLocale()) }}">{{ __('messages.nav.blog') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
                            </ol>
                        </nav>

                        <!-- Post Meta -->
                        <div class="post-meta mb-4">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <time datetime="{{ $blog->published_at->toISOString() }}">
                                    {{ $blog->formatted_published_at }}
                                </time>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock me-2"></i>
                                {{ $blog->reading_time }} {{ __('messages.blog.reading_time') }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-eye me-2"></i>
                                {{ number_format($blog->views_count) }} {{ __('messages.blog.views') }}
                            </div>
                        </div>

                        <!-- Post Title -->
                        <h1 class="post-title">{{ $blog->title }}</h1>

                        <!-- Post Excerpt -->
                        <div class="post-excerpt">
                            <p class="lead">{{ $blog->excerpt }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="blog-content section-padding" style="background: var(--cream);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="post-content">
                        {!! $blog->content !!}
                    </div>

                    <!-- Post Reactions -->
                    <div class="post-reactions">
                        <h5>{{ __('messages.blog.reactions.title') }}</h5>
                        <div class="reaction-buttons">
                            <button type="button" class="btn reaction-btn {{ $userReaction && $userReaction->type === 'like' ? 'active' : '' }}" 
                                    data-type="like" data-blog-id="{{ $blog->id }}">
                                <i class="fas fa-thumbs-up me-2"></i>
                                <span class="like-count">{{ $blog->likes_count }}</span>
                                {{ __('messages.blog.reactions.like') }}
                            </button>
                            <button type="button" class="btn reaction-btn {{ $userReaction && $userReaction->type === 'dislike' ? 'active' : '' }}" 
                                    data-type="dislike" data-blog-id="{{ $blog->id }}">
                                <i class="fas fa-thumbs-down me-2"></i>
                                <span class="dislike-count">{{ $blog->dislikes_count }}</span>
                                {{ __('messages.blog.reactions.dislike') }}
                            </button>
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="post-share">
                        <h5>{{ __('messages.blog.share.title') }}</h5>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" class="btn btn-facebook">
                                <i class="fab fa-facebook-f me-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" 
                               target="_blank" class="btn btn-twitter">
                                <i class="fab fa-twitter me-2"></i>Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                               target="_blank" class="btn btn-linkedin">
                                <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                            </a>
                            <button type="button" class="btn btn-copy" data-url="{{ url()->current() }}">
                                <i class="fas fa-link me-2"></i>{{ __('messages.blog.share.copy') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedBlogs->count() > 0)
        <section class="related-posts section-padding" style="background: var(--light-pink);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header text-center mb-5">
                            <h2 class="section-title">{{ __('messages.blog.related.title') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($relatedBlogs as $related)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <article class="blog-card">
                                <div class="blog-card-image">
                                    @if($related->featured_image)
                                        <img src="{{ Storage::url($related->featured_image) }}" 
                                             alt="{{ $related->title }}" class="img-fluid">
                                    @else
                                        <div class="placeholder-image">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-card-content">
                                    <div class="blog-meta">
                                        <span class="blog-date">
                                            <i class="fas fa-calendar-alt me-1"></i>{{ $related->formatted_published_at }}
                                        </span>
                                        <span class="blog-reading-time">
                                            <i class="fas fa-clock me-1"></i>{{ $related->reading_time }} {{ __('messages.blog.reading_time') }}
                                        </span>
                                    </div>
                                    <h3 class="blog-card-title">
                                        <a href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}">
                                            {{ $related->title }}
                                        </a>
                                    </h3>
                                    <p class="blog-card-excerpt">{{ Str::limit($related->excerpt, 100) }}</p>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{ route('blog.index', app()->getLocale()) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-blog me-2"></i>{{ __('messages.blog.view_all') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</article>
@endsection

@push('styles')
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
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
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
        margin: 2rem 0 1rem 0;
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
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle reaction buttons
        const reactionBtns = document.querySelectorAll('.reaction-btn');
        reactionBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.dataset.type;
                const blogId = this.dataset.blogId;
                
                fetch(`{{ route('blog.react', ':blog') }}`.replace(':blog', blogId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ type: type })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update counts
                        document.querySelector('.like-count').textContent = data.likes_count;
                        document.querySelector('.dislike-count').textContent = data.dislikes_count;
                        
                        // Update button states
                        reactionBtns.forEach(b => b.classList.remove('active'));
                        if (data.user_reaction) {
                            document.querySelector(`[data-type="${data.user_reaction}"]`).classList.add('active');
                        }
                        
                        // Show success message
                        showToast(data.message, 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('{{ __("messages.blog.reactions.error") }}', 'error');
                });
            });
        });

        // Handle copy link button
        const copyBtn = document.querySelector('.btn-copy');
        if (copyBtn) {
            copyBtn.addEventListener('click', function() {
                const url = this.dataset.url;
                navigator.clipboard.writeText(url).then(function() {
                    showToast('{{ __("messages.blog.share.copied") }}', 'success');
                });
            });
        }

        // Simple toast function
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    });
</script>
@endpush