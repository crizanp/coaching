@extends('layouts.frontend')

@section('title', $service->getTranslation('seo_title', app()->getLocale()) ?: $service->getTranslation('name', app()->getLocale()))
@section('description', $service->getTranslation('seo_description', app()->getLocale()) ?: $service->getTranslation('description', app()->getLocale()))

@section('content')
<!-- Service Hero -->
<section class="gradient-bg py-5" style="margin-top: -80px; padding-top: 140px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-dark mb-3 fade-in">
                    {{ $service->getTranslation('name', app()->getLocale()) }}
                </h1>
                <p class="lead text-dark-50 fade-in">
                    {{ $service->getTranslation('description', app()->getLocale()) }}
                </p>
            </div>
            <div class="col-lg-4 text-center fade-in">
                <div class="service-icon" style="width: 120px; height: 120px; font-size: 3rem;">
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
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="section-padding">
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
                <div class="card sticky-top" style="top: 100px;">
                    <div class="card-body">
                        <h4 class="mb-4">Informations pratiques</h4>
                        
                        @if($service->price_individual)
                        <div class="mb-3">
                            <strong>{{ __('messages.services.price_individual') }}:</strong><br>
                            <span class="h5 text-primary">{{ number_format($service->price_individual, 0) }}€</span>
                        </div>
                        @endif
                        
                        @if($service->price_group)
                        <div class="mb-3">
                            <strong>{{ __('messages.services.price_group') }}:</strong><br>
                            <span class="h5 text-primary">{{ number_format($service->price_group, 0) }}€</span>
                        </div>
                        @endif
                        
                        @if($service->duration)
                        <div class="mb-4">
                            <strong>{{ __('messages.services.duration') }}:</strong><br>
                            <span>{{ $service->duration }}</span>
                        </div>
                        @endif
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('booking.index', app()->getLocale()) }}?service={{ $service->id }}" class="btn btn-primary">
                                {{ __('messages.services.book_now') }}
                            </a>
                            <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-outline-primary">
                                {{ __('messages.common.contact') }}
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
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.testimonials.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.testimonials.subtitle') }}</p>
        </div>
        
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 mb-4 fade-in">
                <div class="testimonial-card">
                    <div class="stars mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
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