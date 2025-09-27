@extends('layouts.frontend')

@section('title', __('messages.seo.home.title'))
@section('description', __('messages.seo.home.description'))

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold text-dark mb-4 fade-in">
                    {{ __('messages.home.hero.title') }}
                </h1>
                <p class="lead mb-5 text-dark-50 fade-in">
                    {{ __('messages.home.hero.subtitle') }}
                </p>
                <div class="fade-in">
                    <a href="{{ route('services.index', app()->getLocale()) }}" class="btn btn-primary btn-lg me-3">
                        {{ __('messages.home.hero.cta') }}
                    </a>
                    <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-outline-primary btn-lg">
                        {{ __('messages.nav.book') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center fade-in">
                <div style="font-size: 15rem; color: rgba(255,255,255,0.3);">
                    <i class="fas fa-lotus"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.home.services.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.home.services.subtitle') }}</p>
        </div>
        
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 mb-4 fade-in">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon">
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
                        <h4 class="mb-3">{{ $service->getTranslation('name', app()->getLocale()) }}</h4>
                        <p class="text-muted mb-4">{{ $service->getTranslation('description', app()->getLocale()) }}</p>
                        
                        @if($service->price_individual)
                        <div class="mb-3">
                            <span class="badge bg-light text-dark">
                                {{ __('messages.services.price_individual') }}: {{ number_format($service->price_individual, 0) }}€
                            </span>
                        </div>
                        @endif
                        
                        <a href="{{ route('services.show', [app()->getLocale(), $service->slug]) }}" class="btn btn-outline-primary">
                            {{ __('messages.services.learn_more') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
@if($testimonials->count() > 0)
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.home.testimonials.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.home.testimonials.subtitle') }}</p>
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
                        @if($testimonial->service)
                            <small class="text-muted">{{ $testimonial->service->getTranslation('name', app()->getLocale()) }}</small>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="section-padding gradient-bg">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title text-dark">{{ __('messages.home.cta.title') }}</h2>
            <p class="section-subtitle text-dark-50">{{ __('messages.home.cta.subtitle') }}</p>
            <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-primary btn-lg">
                {{ __('messages.home.cta.button') }}
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@php
        $business = [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching',
                'description' => __('messages.seo.home.description'),
                'url' => url('/'),
                'telephone' => \App\Models\Setting::get('contact_phone'),
                'email' => \App\Models\Setting::get('contact_email'),
                'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => \App\Models\Setting::get('address')[app()->getLocale()] ?? '',
                ],
                'sameAs' => array_values(array_filter([\App\Models\Setting::get('social_facebook'), \App\Models\Setting::get('social_instagram')])),
                'serviceType' => $services->map(function($service){ return $service->getTranslation('name', app()->getLocale()); })->toArray(),
        ];
@endphp
<script type="application/ld+json">{!! json_encode($business, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}</script>
@endpush
