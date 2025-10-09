@extends('layouts.frontend')

@section('title', __('messages.seo.booking.title'))

@section('description', __('messages.seo.booking.description'))

@section('content')
<!-- Booking Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="booking-icon mb-4">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h1 class="section-title">{{ __('messages.booking.title') }}</h1>
                    <p class="lead mb-4">{{ __('messages.booking.subtitle') }}</p>
                    <div class="booking-highlights text-muted">
                        <span class="highlight-item">
                            <i class="fas fa-clock me-2"></i>Réponse sous 24h
                        </span>
                        <span class="highlight-item">
                            <i class="fas fa-shield-alt me-2"></i>Consultation confidentielle
                        </span>
                        <span class="highlight-item">
                            <i class="fas fa-heart me-2"></i>Accompagnement personnalisé
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->has('duplicate'))
        <div class="alert alert-warning alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ $errors->first('duplicate') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="booking-form-card fade-in">
                        <form method="POST" action="{{ route('booking.store', app()->getLocale()) }}">
                            @csrf
                            
                            <div class="row g-4">
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

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="client_name" class="form-label">{{ __('messages.booking.form.name') }} *</label>
                                    <input type="text" class="form-control @error('client_name') is-invalid @enderror" 
                                           id="client_name" name="client_name" 
                                           value="{{ old('client_name') }}" required>
                                    @error('client_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="client_email" class="form-label">{{ __('messages.booking.form.email') }} *</label>
                                    <input type="email" class="form-control @error('client_email') is-invalid @enderror" 
                                           id="client_email" name="client_email" 
                                           value="{{ old('client_email') }}" required>
                                    @error('client_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="client_phone" class="form-label">{{ __('messages.booking.form.phone') }}</label>
                                    <input type="tel" class="form-control @error('client_phone') is-invalid @enderror" 
                                           id="client_phone" name="client_phone" 
                                           value="{{ old('client_phone') }}">
                                    @error('client_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.booking.form.first_session') }}</label>
                                    <div class="form-check-group d-flex flex-wrap gap-3">
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

                <div class="booking-info text-center fade-in">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-clock text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="mb-1">Réponse rapide</h6>
                            <small class="text-muted">Sous 24h maximum</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-shield-alt text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="mb-1">Confidentialité</h6>
                            <small class="text-muted">Données sécurisées</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-heart text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <h6 class="mb-1">Accompagnement</h6>
                            <small class="text-muted">Personnalisé</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to top if there are errors
    const errorAlert = document.querySelector('.alert-warning');
    if (errorAlert) {
        setTimeout(function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }, 100);
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
    
    // Set minimum date to tomorrow
    const dateInput = document.getElementById('appointment_datetime');
    if (dateInput) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(9, 0, 0, 0); // Default to 9 AM
        
        const minDate = tomorrow.toISOString().slice(0, 16);
        dateInput.setAttribute('min', minDate);
        
        if (!dateInput.value) {
            dateInput.value = minDate;
        }
    }
});
</script>
@endpush

@push('styles')
<style>
    /* Ensure all containers match navbar width */
    .container {
        max-width: 1345px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    .booking-icon {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary-pink);
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 3px solid rgba(255,255,255,0.8);
    }

    .booking-form-card {
        background: white;
        border-radius: 20px;
        padding: clamp(28px, 4vw, 40px);
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 1px solid #f1f1f1;
        margin-top: -50px;
        position: relative;
        z-index: 2;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 2px solid #f1f1f1;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.15);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .booking-highlights {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem 1.5rem;
        text-align: left;
        margin: 0 auto;
        max-width: 640px;
        font-size: 0.95rem;
    }

    .booking-highlights .highlight-item {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        white-space: nowrap;
    }

    .booking-highlights .highlight-item i {
        color: var(--primary-pink);
    }

    .btn-primary {
background: #73e4d8;
    border: 2px solid #0eaac3;
        border-radius: 50px;
        padding: 15px 40px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .btn-primary:hover {
        background: var(--primary-pink-dark, #e91e63);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(233, 30, 99, 0.4);
    }

    .alert {
        border-radius: 15px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 30px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .form-check-input:checked {
        background-color: var(--primary-pink);
        border-color: var(--primary-pink);
    }

    .form-check-input:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.15);
    }

    .booking-info {
        background: linear-gradient(135deg, var(--light-pink) 0%, rgba(255,255,255,0.8) 100%);
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
        border: 1px solid rgba(233, 30, 99, 0.1);
    }

    @media (max-width: 991px) {
        .booking-form-card {
            margin-top: -30px;
        }

        .booking-info .col-md-4 {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 768px) {
        .booking-form-card {
            padding: 25px;
            margin-top: -30px;
        }
        
        .booking-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }

        .btn-primary {
            width: 100%;
        }

        .booking-highlights {
            justify-content: flex-start;
            gap: 0.75rem 1rem;
        }

        .booking-highlights .highlight-item {
            white-space: normal;
        }

        .booking-info {
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .booking-form-card {
            padding: 22px;
        }

        .booking-highlights {
            flex-direction: column;
            align-items: flex-start;
            max-width: none;
        }

        .form-check-group {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush