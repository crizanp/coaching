@extends('layouts.frontend')

@section('title', __('messages.booking.title') . ' - ' . $locationData['display_name'])

@section('description', __('messages.seo.booking_location.description', ['location' => $locationData['display_name']]))

@section('content')
<!-- Booking Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="booking-icon mb-4">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h1 class="section-title">{{ __('messages.booking.title') }}</h1>
                    <p class="lead mb-3">{{ $locationData['display_name'] }}</p>
                    <p class="mb-4">{{ $locationData['description'] }}</p>
                    <p class="text-muted">
                        <i class="fas fa-clock me-2"></i>Réponse sous 24h
                        <span class="mx-3">•</span>
                        <i class="fas fa-shield-alt me-2"></i>Consultation confidentielle
                        <span class="mx-3">•</span>
                        <i class="fas fa-heart me-2"></i>Accompagnement personnalisé
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calendly Integration Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Location Info -->
                <div class="card mb-4 fade-in">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="card-title">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    {{ $locationData['display_name'] }}
                                </h5>
                                <p class="card-text">{{ $locationData['address'] }}</p>
                            </div>
                            <!-- <div class="col-md-4 text-md-end">
                                <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Choisir un autre lieu
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- Calendly Widget -->
                <div class="calendly-section fade-in">
                    <div class="calendly-container">
                        <div class="calendly-inline-widget" 
                             data-url="{{ $locationData['calendly_url'] }}" 
                             style="min-width:320px;height:630px;">
                        </div>
                    </div>
                </div>

                <!-- Alternative Booking Form -->
                <!-- <div class="card mt-4 fade-in">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-form me-2"></i>
                            Alternative: Formulaire de demande de rendez-vous
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4">
                            Si vous préférez ne pas utiliser Calendly, vous pouvez remplir ce formulaire et nous vous contacterons.
                        </p>

                        @if($errors->has('duplicate'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ $errors->first('duplicate') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('booking.location.store', [app()->getLocale(), $location]) }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="service_id" class="form-label">{{ __('messages.booking.form.service') }} *</label>
                                    <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                        <option value="">{{ __('messages.contact.form.service_select') }}</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id', request('service')) == $service->id ? 'selected' : '' }}>
                                                {{ $service->getLocalizedTranslation('name', app()->getLocale()) }}
                                                @if($service->slug === 'accompagnement-sur-mesure')
                                                    - {{ __('messages.services.customized_pricing') }}
                                                @elseif($service->price_individual > 0)
                                                    - {{ number_format($service->price_individual, 0) }}€
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="appointment_datetime" class="form-label">{{ __('messages.booking.form.date') }} *</label>
                                    <input type="datetime-local" class="form-control @error('appointment_datetime') is-invalid @enderror" 
                                           id="appointment_datetime" name="appointment_datetime" 
                                           value="{{ old('appointment_datetime') }}" 
                                           min="{{ now()->addDay()->format('Y-m-d\TH:i') }}" required>
                                    @error('appointment_datetime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="client_name" class="form-label">{{ __('messages.booking.form.name') }} *</label>
                                    <input type="text" class="form-control @error('client_name') is-invalid @enderror" 
                                           id="client_name" name="client_name" 
                                           value="{{ old('client_name') }}" required>
                                    @error('client_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="client_email" class="form-label">{{ __('messages.booking.form.email') }} *</label>
                                    <input type="email" class="form-control @error('client_email') is-invalid @enderror" 
                                           id="client_email" name="client_email" 
                                           value="{{ old('client_email') }}" required>
                                    @error('client_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="client_phone" class="form-label">{{ __('messages.booking.form.phone') }}</label>
                                    <input type="tel" class="form-control @error('client_phone') is-invalid @enderror" 
                                           id="client_phone" name="client_phone" 
                                           value="{{ old('client_phone') }}"required>
                                    @error('client_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">{{ __('messages.booking.form.first_session') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_first_session" id="first_yes" value="1" 
                                               {{ old('is_first_session', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="first_yes">
                                            {{ __('messages.common.yes') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_first_session" id="first_no" value="0"
                                               {{ old('is_first_session') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="first_no">
                                            {{ __('messages.common.no') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">{{ __('messages.booking.form.message') }}</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="4" 
                                          placeholder="Décrivez vos besoins, vos attentes ou toute information utile...">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-calendar-plus me-2"></i>
                                    {{ __('messages.booking.form.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Calendly Section */
    .calendly-section {
        background: #f8f9fa;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .calendly-container {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .calendly-inline-widget {
        border-radius: 8px;
        overflow: hidden;
    }

    .booking-icon {
        font-size: 3rem;
        color: var(--primary-color);
    }

    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@push('scripts')
<!-- Calendly Inline Widget -->
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Calendly inline widget
    if (typeof Calendly !== 'undefined') {
        Calendly.initInlineWidget({
            url: '{{ $locationData["calendly_url"] }}',
            parentElement: document.querySelector('.calendly-inline-widget'),
            prefill: {},
            utm: {}
        });
    }

    // Auto-select service if passed in URL
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('service');
    if (serviceId) {
        const serviceSelect = document.getElementById('service_id');
        if (serviceSelect) {
            serviceSelect.value = serviceId;
        }
    }
});
</script>
@endpush