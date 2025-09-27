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
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Sandrine - Sophrologue" class="img-fluid rounded-circle about-image">
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
                <div class="fade-in text-start">
                    <h2 class="section-title">{{ __('messages.about.story.title') }}</h2>
                    <div class="about-content">
                        <p class="lead">{{ __('messages.about.story.intro') }}</p>
                        <p>{{ __('messages.about.story.journey') }}</p>
                        <p>{{ __('messages.about.story.discovery') }}</p>
                        <p>{{ __('messages.about.story.mission') }}</p>
                    </div>
                    
                    <div class="contact-cta mt-5">
                        <h4>{{ __('messages.about.contact.title') }}</h4>
                        <div class="d-flex justify-content-start gap-3 flex-wrap mt-3">
                            <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>{{ __('messages.about.contact.email') }}
                            </a>
                            <a href="tel:{{ \App\Models\Setting::get('contact_phone') }}" class="btn btn-outline-primary">
                                <i class="fas fa-phone me-2"></i>{{ __('messages.about.contact.phone') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practices Section -->
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container">
        <div class="fade-in text-center mb-5">
            <h2 class="section-title">{{ __('messages.about.practices.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.about.practices.subtitle') }}</p>
        </div>
        
        <div class="row">
            <!-- Sophrology -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card h-100">
                    <div class="practice-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4>{{ __('messages.about.practices.sophrology.title') }}</h4>
                    <p>{{ __('messages.about.practices.sophrology.description') }}</p>
                    <blockquote class="practice-quote">
                        <em>"{{ __('messages.about.practices.sophrology.quote') }}"</em>
                    </blockquote>
                </div>
            </div>
            
            <!-- NLP -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card h-100">
                    <div class="practice-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h4>{{ __('messages.about.practices.nlp.title') }}</h4>
                    <p>{{ __('messages.about.practices.nlp.description') }}</p>
                    <blockquote class="practice-quote">
                        <em>"{{ __('messages.about.practices.nlp.quote') }}"</em>
                    </blockquote>
                </div>
            </div>
            
            <!-- Hypnosis -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card h-100">
                    <div class="practice-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                    <h4>{{ __('messages.about.practices.hypnosis.title') }}</h4>
                    <p>{{ __('messages.about.practices.hypnosis.description') }}</p>
                    <blockquote class="practice-quote">
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
            <p class="lead mb-5">{{ __('messages.about.mission.description') }}</p>
            
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
        max-width: 1200px;
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
    
    .practice-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        border: 1px solid rgba(247, 178, 189, 0.2);
        box-shadow: 0 10px 25px rgba(247, 178, 189, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .practice-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(247, 178, 189, 0.2);
    }
    
    .practice-icon {
        width: 80px;
        height: 80px;
        background: var(--light-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2rem;
        color: var(--primary-pink);
    }
    
    .practice-card h4 {
        color: var(--text-dark);
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .practice-card p {
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .practice-quote {
        background: rgba(247, 178, 189, 0.1);
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
        font-size: 0.95rem;
        color: var(--primary-pink);
        border-left: none;
    }
    
    .cta-buttons .btn {
        min-width: 200px;
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