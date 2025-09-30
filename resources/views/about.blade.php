@extends('layouts.frontend')

@section('title', __('messages.about.page.title'))
@section('description', __('messages.about.page.description'))

@section('content')
<!-- About Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="fade-in">
                    <h1 class="section-title">{{ __('messages.about.hero.title') }}</h1>
                    <p class="lead mb-4">{{ __('messages.about.hero.subtitle') }}</p>
                    <blockquote class="blockquote">
                        <p class="mb-0">"{{ __('messages.about.hero.quote') }}"</p>
                    </blockquote>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fade-in">
                    <div class="about-image-container">
                        <img src="{{ asset('images/assets/SSJchrysalis.png') }}" 
                             alt="Sandrine - Sophrologue Logo" class="img-fluid rounded-circle about-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Story Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- <div class="fade-in text-start">
                    <h2 class="section-title">{{ __('messages.about.story.title') }}</h2>
                    <div class="about-content">
                        <p class="lead">{{ __('messages.about.story.intro') }}</p>
                        <p>{{ __('messages.about.story.journey') }}</p>
                        <p>{{ __('messages.about.story.discovery') }}</p>
                        <p>{{ __('messages.about.story.mission') }}</p>
                    </div>
                     -->
                    <div class="contact-cta mt-5">
                        <h4>{{ __('messages.about.contact.title') }}</h4>
                        <div class="d-flex justify-content-start gap-3 flex-wrap mt-3">
                            <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>{{ __('messages.about.contact.email') }}
                            </a>
                            <a href="https://wa.me/{{ str_replace(['+', ' ', '-', '(', ')'], '', \App\Models\Setting::get('contact_phone')) }}" target="_blank" class="btn btn-outline-primary">
                                <i class="fab fa-whatsapp me-2"></i>{{ __('messages.about.contact.phone') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practices Section -->
<section class="section-padding" style="background-color: #F8E8EA;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="fade-in mb-5">
                    <h2 class="section-title text-center"style="color: #000000ff;">{{ __('messages.about.practices.title') }}</h2>
                    <p class="section-subtitle text-left">{{ __('messages.about.practices.subtitle') }}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Sophrology -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4>{{ __('messages.about.practices.sophrology.title') }}</h4>
                        </div>
                    </div>
                    <blockquote class="practice-quote-textured">
                        <em>"{{ __('messages.about.practices.sophrology.quote') }}"</em>
                    </blockquote>
                </div>
            </div>
            
            <!-- NLP -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4>{{ __('messages.about.practices.nlp.title') }}</h4>
                        </div>
                    </div>
                    <blockquote class="practice-quote-textured">
                        <em>"{{ __('messages.about.practices.nlp.quote') }}"</em>
                    </blockquote>
                </div>
            </div>
            
            <!-- Hypnosis -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-moon"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4>{{ __('messages.about.practices.hypnosis.title') }}</h4>
                        </div>
                    </div>
                    <blockquote class="practice-quote-textured">
                        <em>"{{ __('messages.about.practices.hypnosis.quote') }}"</em>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & CTA Section -->
<section class="section-padding" style="background: white;">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.about.mission.title') }}</h2>
            <p class="lead mb-5">{!! __('messages.about.mission.description') !!}</p>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-buttons">
                        <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-primary btn-lg me-3 mb-3">
                            <i class="fas fa-calendar-check me-2"></i>{{ __('messages.about.cta.book') }}
                        </a>
                        <a href="{{ route('services.index', app()->getLocale()) }}" class="btn btn-outline-primary btn-lg mb-3">
                            <i class="fas fa-info-circle me-2"></i>{{ __('messages.about.cta.services') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Ensure all containers match navbar width */
    .container {
        max-width: 1345px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .about-image-container {
        text-align: center;
        position: relative;
    }
    
    .about-image {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 15px 35px rgba(247, 178, 189, 0.3);
        transition: transform 0.3s ease;
    }
    
    .about-image:hover {
        transform: scale(1.05);
    }
    
    .about-content p {
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        color: var(--text-muted);
    }
    
    .about-content .lead {
        font-size: 1.3rem;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 2rem;
    }
    
    .blockquote {
        border-left: 4px solid var(--primary-pink);
        padding-left: 20px;
        font-style: italic;
        font-size: 1.2rem;
        color: var(--text-dark);
        margin: 2rem 0;
    }
    
    .contact-cta {
        background: rgba(247, 178, 189, 0.1);
        padding: 30px;
        border-radius: 20px;
        margin-top: 3rem;
    }
    
    /* Light practice card: white background, black border, no shadows */
    .practice-card-textured {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        text-align: left;
        border: 1px solid #000000;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease;
        color: var(--text-dark);
    }

    .practice-card-textured::before {
        /* very subtle paper grain */
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: repeating-linear-gradient(
            45deg,
            rgba(0,0,0,0.01),
            rgba(0,0,0,0.01) 12px,
            rgba(255,255,255,0.01) 12px,
            rgba(255,255,255,0.01) 24px
        );
        opacity: 0.08;
        pointer-events: none;
    }

    .practice-card-textured:hover {
        transform: translateY(-4px);
        border-color: rgba(0,0,0,0.85);
    }

    /* Icon: black glyph on transparent background (no heavy white circle), no shadow */
    .practice-icon-left {
        width: 60px;
        height: 60px;
        background: transparent;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #000000;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
        box-shadow: none;
    }

    .practice-card-textured h4 {
        color: #1e1d1dff;
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .practice-card-textured p {
        color: rgba(235,235,235,0.85);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .practice-quote-textured {
        background: rgba(255,255,255,0.02);
        border-left: none;
        border-radius: 6px;
        padding: 15px 20px;
        margin: 0;
        font-size: 0.95rem;
        color: #F7B2BD;
        font-style: italic;
        position: relative;
        z-index: 1;
    }

    /* Layout: icon left, content right */
    .practice-card-body {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .practice-card-content {
        flex: 1 1 auto;
    }

    @media (max-width: 767px) {
        .practice-card-body {
            flex-direction: column;
            gap: 12px;
        }
        .practice-icon-left {
            width: 56px;
            height: 56px;
            font-size: 1.6rem;
        }
    }
    
    .cta-buttons .btn {
        min-width: 200px;
    }

    /* Section subtitle should be black on the pale background */
    .section-subtitle {
        color: #000000;
    }
    
    @media (max-width: 768px) {
        .about-image {
            width: 250px;
            height: 250px;
        }
        
        .cta-buttons .btn {
            min-width: auto;
            width: 100%;
        }
        
        .d-flex.gap-3 {
            flex-direction: column;
            gap: 1rem !important;
        }
    }
</style>
@endpush