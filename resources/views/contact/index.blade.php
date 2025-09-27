@extends('layouts.frontend')

@section('title', __('messages.contact.title'))

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="fade-in">
            <h1 class="section-title">{{ __('messages.contact.title') }}</h1>
            <p class="section-subtitle">{{ __('messages.contact.subtitle') }}</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="card fade-in">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('contact.store', app()->getLocale()) }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label">{{ __('messages.contact.form.name') }} *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">{{ __('messages.contact.form.email') }} *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label">{{ __('messages.contact.form.phone') }}</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" 
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="service_id" class="form-label">{{ __('messages.contact.form.service') }}</label>
                                    <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id">
                                        <option value="">{{ __('messages.contact.form.service_select') }}</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->getTranslation('name', app()->getLocale()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">{{ __('messages.contact.form.message') }} *</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="5" 
                                          placeholder="Décrivez votre demande, vos questions ou ce que vous aimeriez savoir..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    {{ __('messages.contact.form.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card fade-in">
                    <div class="card-body p-4">
                        <h4 class="mb-4">{{ __('messages.contact.info.title') }}</h4>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <strong>{{ __('messages.contact.info.email') }}</strong><br>
                                    <a href="mailto:{{ \App\Models\Setting::get('contact_email') }}" class="text-decoration-none">
                                        {{ \App\Models\Setting::get('contact_email') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <strong>{{ __('messages.contact.info.phone') }}</strong><br>
                                    <a href="tel:{{ \App\Models\Setting::get('contact_phone') }}" class="text-decoration-none">
                                        {{ \App\Models\Setting::get('contact_phone') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="service-icon me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <strong>{{ __('messages.contact.info.address') }}</strong><br>
                                    {{ \App\Models\Setting::get('address')[app()->getLocale()] ?? '' }}
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">{{ __('messages.contact.social.title') }}</h5>
                        <div class="social-links">
                            @if(\App\Models\Setting::get('social_facebook'))
                                <a href="{{ \App\Models\Setting::get('social_facebook') }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <i class="fab fa-facebook-f me-1"></i> Facebook
                                </a>
                            @endif
                            @if(\App\Models\Setting::get('social_instagram'))
                                <a href="{{ \App\Models\Setting::get('social_instagram') }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                    <i class="fab fa-instagram me-1"></i> Instagram
                                </a>
                            @endif
                        </div>

                        <div class="mt-4 p-3 rounded" style="background: var(--light-pink);">
                            <h6 class="mb-2">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Prêt(e) à réserver ?
                            </h6>
                            <p class="small mb-2">Réservez directement votre séance en ligne</p>
                            <a href="{{ route('booking.index', app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                {{ __('messages.nav.book') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection