@extends('layouts.frontend')

@section('title', __('messages.services.title'))

@section('content')
<!-- Services Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <h1 class="section-title">{{ __('messages.services.title') }}</h1>
                    <p class="lead mb-4">{{ __('messages.services.subtitle') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
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
                                @default
                                    <i class="fas fa-heart"></i>
                            @endswitch
                        </div>
                        <div class="practice-card-content">
                            <h4>{{ $service->getTranslation('name', app()->getLocale()) }}</h4>
                        </div>
                    </div>
                    
                    <p class="service-description mb-4">{{ $service->getTranslation('description', app()->getLocale()) }}</p>
                    
                    <div class="service-details mb-4">
                        @if($service->price_individual)
                        <div class="service-detail-item mb-2">
                            <strong>{{ __('messages.services.price_individual') }}:</strong> {{ number_format($service->price_individual, 0) }}€
                        </div>
                        @endif
                        
                        @if($service->price_group)
                        <div class="service-detail-item mb-2">
                            <strong>{{ __('messages.services.price_group') }}:</strong> {{ number_format($service->price_group, 0) }}€
                        </div>
                        @endif
                        
                        @if($service->duration)
                        <div class="service-detail-item mb-2">
                            <strong>{{ __('messages.services.duration') }}:</strong> {{ $service->duration }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="service-actions">
                        <a href="{{ route('services.show', [app()->getLocale(), $service->slug]) }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                            {{ __('messages.services.learn_more') }}
                        </a>
                        <a href="{{ route('booking.index', app()->getLocale()) }}?service={{ $service->id }}" class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-calendar-check me-1"></i>{{ __('messages.services.book_now') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="section-padding" style="background: white;">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title">Prêt(e) à commencer votre transformation ?</h2>
            <p class="lead mb-5">Choisissez le service qui vous correspond le mieux et prenez rendez-vous dès aujourd'hui</p>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-buttons">
                        <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-primary btn-lg me-3 mb-3">
                            <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                        </a>
                        <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-outline-primary btn-lg mb-3">
                            <i class="fas fa-envelope me-2"></i>Poser une question
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
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .service-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .service-details {
        position: relative;
        z-index: 1;
    }

    .service-detail-item {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .service-detail-item strong {
        color: #1e1d1dff;
        font-weight: 600;
    }

    .service-actions {
        position: relative;
        z-index: 1;
    }

    /* Layout: icon left, content right */
    .practice-card-body {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 20px;
    }

    .practice-card-content {
        flex: 1 1 auto;
    }
    
    .cta-buttons .btn {
        min-width: 200px;
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
        
        .cta-buttons .btn {
            min-width: auto;
            width: 100%;
        }
    }
</style>
@endpush