@extends('layouts.frontend')

@section('title', $service->getTranslation('seo_title', app()->getLocale()) ?: $service->getTranslation('name', app()->getLocale()))
@section('description', $service->getTranslation('seo_description', app()->getLocale()) ?: $service->getTranslation('description', app()->getLocale()))

@section('content')
<!-- Service Hero -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <h1 class="section-title">{{ $service->getTranslation('name', app()->getLocale()) }}</h1>
                    <p class="lead mb-4">{{ $service->getTranslation('description', app()->getLocale()) }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fade-in">
                    <div class="about-image-container">
                        <div class="service-icon-large">
                            @switch($service->icon)
                                @case('leaf')
                                    <i class="fas fa-leaf"></i>
                                    @break
                                @case('moon')
                                    <i class="fas fa-moon"></i>
                                    @break
                                @case('brain')
                                    <i class="fas fa-brain"></i>
                                    @break
                                @case('palette')
                                    <i class="fas fa-palette"></i>
                                    @break
                                @default
                                    <i class="fas fa-heart"></i>
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 fade-in">
                <div class="content mb-5">
                    {!! $service->getTranslation('content', app()->getLocale()) !!}
                </div>
                
                @if($service->getTranslation('benefits', app()->getLocale()))
                <div class="mb-5">
                    <h3 class="mb-4">{{ __('messages.services.benefits') }}</h3>
                    <div class="row">
                        @foreach($service->getTranslation('benefits', app()->getLocale()) as $benefit)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3"></i>
                                <span>{{ $benefit }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($service->getTranslation('session_format', app()->getLocale()))
                <div class="mb-5">
                    <h3 class="mb-4">{{ __('messages.services.format') }}</h3>
                    <div class="row">
                        @foreach($service->getTranslation('session_format', app()->getLocale()) as $format)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-3"></i>
                                <span>{{ $format }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4 fade-in">
                <div class="practice-card-textured sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h4 class="mb-4">Informations pratiques</h4>
                        
                        @if($service->price_individual > 0)
                        <div class="mb-3">
                            <strong>{{ __('messages.services.price_individual') }}:</strong><br>
                            <span class="h5 text-primary">{{ number_format($service->price_individual, 0) }}€</span>
                        </div>
                        @elseif($service->slug === 'accompagnement-sur-mesure')
                        <div class="mb-3">
                            <strong>{{ app()->getLocale() === 'fr' ? 'Tarification' : 'Pricing' }}:</strong><br>
                            <span class="text-primary">{{ __('messages.services.customized_program') }}</span>
                        </div>
                        @endif
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('booking.index', app()->getLocale()) }}?service={{ $service->id }}" class="btn btn-primary">
                                <i class="fas fa-calendar-check me-2"></i>{{ __('messages.services.book_now') }}
                            </a>
                            <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-outline-primary">
                                <i class="fas fa-envelope me-2"></i>{{ __('messages.common.contact') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Testimonials -->
@if($testimonials->count() > 0)
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.testimonials.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.testimonials.subtitle') }}</p>
        </div>
        
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 mb-4 fade-in">
                <div class="practice-card-textured">
                    <div class="stars mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="mb-3">{{ $testimonial->getTranslation('testimonial', app()->getLocale()) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $testimonial->client_name }}</strong>
                            @if($testimonial->client_location)
                                <br><small class="text-muted">{{ $testimonial->client_location }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
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
    
    .service-icon-large {
        width: 200px;
        height: 200px;
        background: rgba(247, 178, 189, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: var(--text-dark);
        margin: 0 auto;
        border: 3px solid white;
        box-shadow: 0 15px 35px rgba(247, 178, 189, 0.3);
        transition: transform 0.3s ease;
    }
    
    .service-icon-large:hover {
        transform: scale(1.05);
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

    .practice-card-textured h4 {
        color: #1e1d1dff;
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .practice-card-textured p {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .practice-card-textured strong {
        color: #1e1d1dff;
        font-weight: 600;
    }

    .practice-card-textured .card-body {
        position: relative;
        z-index: 1;
    }
    
    @media (max-width: 768px) {
        .service-icon-large {
            width: 150px;
            height: 150px;
            font-size: 3rem;
        }
    }
</style>
@endpush