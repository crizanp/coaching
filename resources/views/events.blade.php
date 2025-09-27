@extends('layouts.frontend')

@section('title')
{{ __('messages.events.title') }} - {{ \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE' }}
@endsection

@section('description')
{{ __('messages.events.description') }}
@endsection

@section('keywords')
atelier, événement, groupe, émotions, communication, partage, Martinique, développement personnel
@endsection

@section('content')
<!-- Hero Section -->
<section class="events-hero py-5" style="background: linear-gradient(135deg, rgba(212, 179, 214, 0.9), rgba(248, 245, 255, 0.9)), url('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="meditation-icon mb-4">
                    <i class="fas fa-users" style="font-size: 3rem; color: #d4b3d6;"></i>
                </div>
                <h1 class="hero-title mb-4">{{ __('messages.events.title') }}</h1>
                <p class="hero-subtitle">{{ __('messages.events.subtitle') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Workshop Description -->
<section class="workshop-description py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="section-title">{{ __('messages.events.workshop.title') }}</h2>
                    <p class="section-subtitle">{{ __('messages.events.workshop.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Workshop Benefits -->
<section class="workshop-benefits py-5" style="background-color: #f8f5ff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="benefit-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1);">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-heart" style="font-size: 2.5rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="benefit-title mb-3">{{ __('messages.events.benefits.emotions.title') }}</h3>
                    <p class="benefit-description">{{ __('messages.events.benefits.emotions.description') }}</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="benefit-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1);">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-lightbulb" style="font-size: 2.5rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="benefit-title mb-3">{{ __('messages.events.benefits.needs.title') }}</h3>
                    <p class="benefit-description">{{ __('messages.events.benefits.needs.description') }}</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="benefit-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1);">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-comments" style="font-size: 2.5rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="benefit-title mb-3">{{ __('messages.events.benefits.communication.title') }}</h3>
                    <p class="benefit-description">{{ __('messages.events.benefits.communication.description') }}</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="benefit-card h-100" style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(212, 179, 214, 0.1);">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-hands-helping" style="font-size: 2.5rem; color: #d4b3d6;"></i>
                    </div>
                    <h3 class="benefit-title mb-3">{{ __('messages.events.benefits.sharing.title') }}</h3>
                    <p class="benefit-description">{{ __('messages.events.benefits.sharing.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Workshop Details -->
<section class="workshop-details py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="details-card" style="background: white; border-radius: 20px; padding: 2.5rem; box-shadow: 0 15px 40px rgba(212, 179, 214, 0.15); border: 1px solid rgba(212, 179, 214, 0.2);">
                    <h2 class="text-center mb-4" style="color: #d4b3d6;">{{ __('messages.events.details.title') }}</h2>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="detail-item mb-3">
                                <i class="fas fa-clock me-2" style="color: #d4b3d6;"></i>
                                <strong>{{ __('messages.events.details.duration') }}:</strong> {{ __('messages.events.details.duration_value') }}
                            </div>
                            <div class="detail-item mb-3">
                                <i class="fas fa-users me-2" style="color: #d4b3d6;"></i>
                                <strong>{{ __('messages.events.details.participants') }}:</strong> {{ __('messages.events.details.participants_value') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item mb-3">
                                <i class="fas fa-map-marker-alt me-2" style="color: #d4b3d6;"></i>
                                <strong>{{ __('messages.events.details.location') }}:</strong> {{ __('messages.events.details.location_value') }}
                            </div>
                            <div class="detail-item mb-3">
                                <i class="fas fa-euro-sign me-2" style="color: #d4b3d6;"></i>
                                <strong>{{ __('messages.events.details.price') }}:</strong> {{ __('messages.events.details.price_value') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="program mb-4">
                        <h4 class="mb-3" style="color: #4a4a4a;">{{ __('messages.events.program.title') }}</h4>
                        <ul class="program-list">
                            @foreach(__('messages.events.program.items') as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-lg" style="background-color: #d4b3d6; color: white; border: none; border-radius: 50px; padding: 1rem 2.5rem;">
                            {{ __('messages.events.cta.register') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events -->
<section class="upcoming-events py-5" style="background-color: #f8f5ff;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-center mb-5">{{ __('messages.events.upcoming.title') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="event-notice text-center p-4" style="background: white; border-radius: 15px; border-left: 5px solid #d4b3d6;">
                    <i class="fas fa-calendar-alt mb-3" style="font-size: 2rem; color: #d4b3d6;"></i>
                    <h4 class="mb-3">{{ __('messages.events.upcoming.notice_title') }}</h4>
                    <p class="mb-4">{{ __('messages.events.upcoming.notice_description') }}</p>
                    <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-outline-primary">
                        {{ __('messages.events.upcoming.contact') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Event",
  "name": "{{ __('messages.events.workshop.title') }}",
  "description": "{{ __('messages.events.workshop.description') }}",
  "organizer": {
    "@@type": "Person",
    "name": "Sandrine - SSJCHRYSALIDE",
    "url": "{{ url('/') }}"
  },
    "location": {
        "@@type": "Place",
    "name": "{{ __('messages.events.details.location_value') }}",
        "address": {
            "@@type": "PostalAddress",
      "addressRegion": "Martinique",
      "addressCountry": "FR"
    }
  },
    "offers": {
        "@@type": "Offer",
    "price": "{{ __('messages.events.details.price_value') }}",
    "priceCurrency": "EUR"
  }
}
</script>
@endpush

@push('styles')
<style>
.benefit-card {
    transition: transform 0.3s ease;
}

.benefit-card:hover {
    transform: translateY(-5px);
}

.program-list {
    list-style: none;
    padding-left: 0;
}

.program-list li {
    position: relative;
    padding-left: 2rem;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f0f0f0;
}

.program-list li:last-child {
    border-bottom: none;
}

.program-list li:before {
    content: "📝";
    position: absolute;
    left: 0;
    top: 0;
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

.benefit-title {
    color: #d4b3d6;
    font-weight: 500;
    font-size: 1.3rem;
}
</style>
@endpush

@endsection