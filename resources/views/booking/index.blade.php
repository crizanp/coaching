@extends('layouts.frontend')

@section('title', __('messages.booking.title'))

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h1 class="section-title">{{ __('messages.booking.title') }}</h1>
            <p class="section-subtitle">{{ __('messages.booking.subtitle') }}</p>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('booking.store', app()->getLocale()) }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="service_id" class="form-label">{{ __('messages.booking.form.service') }} *</label>
                                    <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                        <option value="">{{ __('messages.contact.form.service_select') }}</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id', request('service')) == $service->id ? 'selected' : '' }}>
                                                {{ $service->getTranslation('name', app()->getLocale()) }}
                                                @if($service->price_individual)
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
                                           value="{{ old('client_phone') }}">
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
                </div>

                <div class="text-center mt-4 fade-in">
                    <p class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Votre demande sera traitée sous 24h. Un email de confirmation vous sera envoyé.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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