@extends('layouts.frontend')

@section('title', __('messages.seo.contact.title'))

@section('description', __('messages.seo.contact.description'))

@section('content')
<!-- Contact Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="fade-in">
                    <div class="contact-icon mb-4">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h1 class="section-title">{{ __('messages.contact.title') }}</h1>
                    <p class="lead mb-4">{{ __('messages.contact.subtitle') }}</p>
                    <div class="hero-features">
                        <span class="feature-item">
                            <i class="fas fa-reply me-2"></i>Réponse rapide
                        </span>
                        
                        <span class="feature-separator">•</span>
                        <span class="feature-item">
                            <i class="fas fa-heart me-2"></i>Accompagnement personnalisé
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Options Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-8 mb-5" id="contact-form">
                <div class="contact-form-card fade-in">
                    <h3 class="form-title mb-4">
                        <i class="fas fa-envelope me-2"></i>Envoyez-moi un message
                    </h3>
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
                                                {{ $service->getLocalizedTranslation('name', app()->getLocale()) }}
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

            <div class="col-lg-4">
                <div class="contact-info-card fade-in">
                    <div class="contact-info-header">
                        <h4 class="mb-4">Contact Information</h4>
                    </div>

                    <div class="contact-info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h6>Email</h6>
                            <a href="mailto:contact@ssjchrysalide.com" class="info-link">
                                contact@ssjchrysalide.com
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h6>Telephone</h6>
                            <a href="tel:+596696103622" class="info-link">
                                +596 696 103 622
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h6>Address</h6>
                            <span class="info-text">
                               Fort-de-France
                            </span>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="social-section">
                        <h6 class="mb-3">Follow me</h6>
                        <div class="social-icons">
                            @if(\App\Models\Setting::get('social_facebook'))
                            <a href="{{ \App\Models\Setting::get('social_facebook') }}" class="social-icon facebook" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if(\App\Models\Setting::get('social_instagram'))
                            <a href="{{ \App\Models\Setting::get('social_instagram') }}" class="social-icon instagram" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                        </div>
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

    .contact-icon {
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

    .hero-features {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
    }

    .feature-separator {
        color: rgba(0,0,0,0.3);
        font-weight: bold;
    }

    .contact-form-card {
        background: white;
        border-radius: 20px;
        padding: clamp(26px, 3.8vw, 40px);
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 1px solid #f1f1f1;
    }

    .contact-info-card {
        background: white;
        border-radius: 20px;
        padding: clamp(22px, 3.5vw, 30px);
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 1px solid #f1f1f1;
        height: fit-content;
        position: sticky;
        top: 30px;
    }

    .contact-info-header h4 {
        color: var(--text-dark);
        font-weight: 700;
        font-size: clamp(1.15rem, 2.3vw, 1.4rem);
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
        padding: 15px 0;
    }

    .info-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--primary-pink) 0%, #ff4081 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        color: white;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .info-content h6 {
        color: var(--text-dark);
        font-weight: 600;
        margin-bottom: 5px;
        font-size: clamp(0.9rem, 2vw, 0.95rem);
    }

    .info-link {
        color: var(--primary-pink);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .info-link:hover {
        color: var(--primary-pink-dark, #e91e63);
        text-decoration: underline;
    }

    .info-text {
        color: var(--text-muted);
        font-size: clamp(0.9rem, 2vw, 0.95rem);
        line-height: 1.5;
    }

    .divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, #eee 20%, #eee 80%, transparent 100%);
        margin: 25px 0;
    }

    .social-section h6 {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1rem;
    }

    .social-icons {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .social-icon.facebook {
        background: #1877f2;
    }

    .social-icon.instagram {
        background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
    }

    .social-icon.linkedin {
        background: #0077b5;
    }

    .social-icon.twitter {
        background: #1da1f2;
    }

    .social-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    @media (max-width: 991px) {
        .contact-info-card {
            position: static;
            top: auto;
            margin-top: 30px;
        }

        .hero-features {
            gap: 12px;
        }
    }

    .form-title {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1.5rem;
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

    .btn-primary {
       background: #73e4d8;
    border: 2px solid #0eaac3;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .btn-primary:hover {
        background: var(--primary-pink-dark, #e91e63);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(233, 30, 99, 0.4);
    }

    .btn-outline-primary {
            border: 2px solid #0eaac3;

        color:black;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
       background: #73e4d8;
    border: 2px solid #0eaac3;
        transform: translateY(-2px);
    }

    .service-icon {
        background: var(--primary-pink);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .hero-features {
            flex-direction: column;
            gap: 10px;
        }
        
        .feature-separator {
            display: none;
        }
        
        .contact-form-card {
            padding: 25px;
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .contact-info-card {
            padding: 24px;
        }

        .contact-info-item {
            align-items: center;
        }

        .social-icons {
            justify-content: center;
        }

        .btn-primary,
        .btn-outline-primary {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
function scrollToForm() {
    document.getElementById('contact-form').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}
</script>
@endpush