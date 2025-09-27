@extends('layouts.frontend')

@section('title')
{{ __('messages.practices.title') }} - {{ \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE' }}
@endsection

@section('description')
{{ __('messages.practices.description') }}
@endsection

@section('keywords')
sophrologie, PNL, hypnose, thérapie brève, Martinique, relaxation, développement personnel, stress, émotions
@endsection

@section('content')
<!-- Hero Section -->
<section class="practices-hero py-5" style="background: linear-gradient(135deg, rgba(212, 179, 214, 0.9), rgba(248, 245, 255, 0.9)), url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="meditation-icon mb-4">
                    <i class="fas fa-spa" style="font-size: 3rem; color: #d4b3d6;"></i>
                </div>
                <h1 class="hero-title mb-4">{{ __('messages.practices.title') }}</h1>
                <p class="hero-subtitle">{{ __('messages.practices.subtitle') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Approach Section -->
<section class="approach-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="section-title">{{ __('messages.practices.approach.title') }}</h2>
                    <p class="section-subtitle">{{ __('messages.practices.approach.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practices Grid -->
<section class="practices-grid py-5" style="background-color: #f8f5ff;">
    <div class="container">
        <div class="row g-4">
            <!-- Sophrologie -->
            <div class="col-lg-4 col-md-6">
                <div class="practice-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1); border: 1px solid rgba(212, 179, 214, 0.2);">
                    <div class="practice-icon text-center mb-4">
                        <i class="fas fa-leaf" style="font-size: 3rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="practice-title text-center mb-3">{{ __('messages.practices.sophrology.title') }}</h3>
                    <p class="practice-description mb-4">{{ __('messages.practices.sophrology.description') }}</p>
                    
                    <div class="practice-benefits mb-4">
                        <h5>{{ __('messages.practices.benefits') }}:</h5>
                        <ul class="practice-list">
                            @foreach(__('messages.practices.sophrology.benefits') as $benefit)
                            <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="practice-techniques">
                        <h5>{{ __('messages.practices.techniques') }}:</h5>
                        <p class="small text-muted">{{ __('messages.practices.sophrology.techniques') }}</p>
                    </div>
                </div>
            </div>

            <!-- PNL -->
            <div class="col-lg-4 col-md-6">
                <div class="practice-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1); border: 1px solid rgba(212, 179, 214, 0.2);">
                    <div class="practice-icon text-center mb-4">
                        <i class="fas fa-brain" style="font-size: 3rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="practice-title text-center mb-3">{{ __('messages.practices.nlp.title') }}</h3>
                    <p class="practice-description mb-4">{{ __('messages.practices.nlp.description') }}</p>
                    
                    <div class="practice-benefits mb-4">
                        <h5>{{ __('messages.practices.benefits') }}:</h5>
                        <ul class="practice-list">
                            @foreach(__('messages.practices.nlp.benefits') as $benefit)
                            <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="practice-techniques">
                        <h5>{{ __('messages.practices.techniques') }}:</h5>
                        <p class="small text-muted">{{ __('messages.practices.nlp.techniques') }}</p>
                    </div>
                </div>
            </div>

            <!-- Hypnose -->
            <div class="col-lg-4 col-md-6">
                <div class="practice-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1); border: 1px solid rgba(212, 179, 214, 0.2);">
                    <div class="practice-icon text-center mb-4">
                        <i class="fas fa-moon" style="font-size: 3rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="practice-title text-center mb-3">{{ __('messages.practices.hypnosis.title') }}</h3>
                    <p class="practice-description mb-4">{{ __('messages.practices.hypnosis.description') }}</p>
                    
                    <div class="practice-benefits mb-4">
                        <h5>{{ __('messages.practices.benefits') }}:</h5>
                        <ul class="practice-list">
                            @foreach(__('messages.practices.hypnosis.benefits') as $benefit)
                            <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="practice-techniques">
                        <h5>{{ __('messages.practices.techniques') }}:</h5>
                        <p class="small text-muted">{{ __('messages.practices.hypnosis.techniques') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="practices-cta py-5" style="background: linear-gradient(135deg, #d4b3d6, #f8f5ff);">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="text-white mb-4">{{ __('messages.practices.cta.title') }}</h2>
                <p class="text-white mb-4">{{ __('messages.practices.cta.description') }}</p>
                <div class="cta-buttons">
                    <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-light btn-lg me-3 mb-2">
                        {{ __('messages.practices.cta.book') }}
                    </a>
                    <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-outline-light btn-lg mb-2">
                        {{ __('messages.practices.cta.contact') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('structured-data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MedicalBusiness",
  "name": "SSJCHRYSALIDE",
  "description": "{{ __('messages.practices.description') }}",
  "url": "{{ url()->current() }}",
  "telephone": "+596 696 103 622",
  "email": "contact@ssjchrysalide.com",
  "address": {
    "@type": "PostalAddress",
    "addressRegion": "Martinique",
    "addressCountry": "FR"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "14.641528",
    "longitude": "-61.024174"
  },
  "medicalSpecialty": [
    "Sophrology",
    "Hypnotherapy", 
    "NLP Coaching"
  ],
  "serviceType": [
    "Brief Therapy",
    "Stress Management",
    "Personal Development"
  ]
}
</script>
@endpush

@push('styles')
<style>
.practice-list {
    list-style: none;
    padding-left: 0;
}

.practice-list li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.5rem;
}

.practice-list li:before {
    content: "✨";
    position: absolute;
    left: 0;
    color: #d4b3d6;
}

.practice-card {
    transition: transform 0.3s ease;
}

.practice-card:hover {
    transform: translateY(-5px);
}

.hero-title {
    font-size: 3rem;
    font-weight: 300;
    color: #4a4a4a;
    margin-bottom: 1rem;
}

.section-title {
    color: #4a4a4a;
    font-weight: 300;
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.practice-title {
    color: #d4b3d6;
    font-weight: 500;
    font-size: 1.5rem;
}
</style>
@endpush

@endsection