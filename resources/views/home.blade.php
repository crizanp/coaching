@extends('layouts.frontend')

@section('title', __('messages.seo.home.title'))
@section('description', __('messages.seo.home.description'))

@section('content')
<!-- Meditative Hero Slider -->
<section class="hero-slider">
    <div id="meditativeSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Slides -->
        <div class="carousel-inner">
            <!-- Slide 1: Appointment -->
            <div class="carousel-item active">
                <div class="hero-slide slide-1" style="background: url('{{ asset('images/hero/1.png') }}'); background-size: cover; background-position: center;">
                    <div class="container h-100 position-relative">
                        <!-- Text overlay -->
                        <div class="hero-text-overlay">
                            <h1 class="hero-overlay-text">{!! __('messages.home.hero.slide1.text') !!}</h1>
                        </div>
                        
                        <!-- Button at bottom -->
                        <div class="hero-button-bottom">
                            <div class="text-center">
                                <a href="{{ route('practices', app()->getLocale()) }}" class="btn btn-hero-primary">
                                    {{ __('messages.home.hero.slide1.button') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: All Services -->
            <div class="carousel-item">
                <div class="hero-slide slide-2" style="background: url('{{ asset('images/hero/2.png') }}'); background-size: cover; background-position: center;">
                    <div class="container h-100 position-relative">
                        <!-- Text overlay -->
                        <div class="hero-text-overlay">
                            <h1 class="hero-overlay-text">{!! __('messages.home.hero.slide2.text') !!}</h1>
                        </div>
                        
                        <!-- Button at bottom -->
                       <div class="hero-button-bottom">
                            <div class="text-center">
                                <button onclick="openLocationModal()" class="btn btn-hero-primary">
                                    {{ __('messages.home.hero.slide2.button') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Contact Us -->
            <div class="carousel-item">
                <div class="hero-slide slide-3" style="background: url('{{ asset('images/hero/3.png') }}'); background-size: cover; background-position: center;">
                    <div class="container h-100 position-relative">
                        <!-- Text overlay -->
                        <div class="hero-text-overlay">
                            <h1 class="hero-overlay-text">{!! __('messages.home.hero.slide3.text') !!}</h1>
                        </div>
                        
                        <!-- Button at bottom -->
                        <div class="hero-button-bottom">
                            <div class="text-center">
                                <a href="{{ route('contact.index', app()->getLocale()) }}" class="btn btn-hero-primary">
                                    {{ __('messages.home.hero.slide3.button') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#meditativeSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#meditativeSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#meditativeSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Navigation Arrows -->
        <button class="carousel-control-prev" type="button" data-bs-target="#meditativeSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#meditativeSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Quote Section -->
<section class="section-padding section-quote bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="fade-in butterfly-container position-relative">
                    <!-- small flying butterflies (uses public/images/butterfly/1.png|2.png|3.png) -->
                    <img src="{{ asset('images/butterfly/1.png') }}" alt="butterfly 1" class="butterfly butterfly-1" />
                    <img src="{{ asset('images/butterfly/2.png') }}" alt="butterfly 2" class="butterfly butterfly-2" />
                    <img src="{{ asset('images/butterfly/3.png') }}" alt="butterfly 3" class="butterfly butterfly-3" />
                    <img src="{{ asset('images/butterfly/1.png') }}" alt="butterfly 4" class="butterfly butterfly-4" />

                    <h2 class="section-title quote-title mb-4" style="color: #0eaac3;">
                        "{{ __('messages.home.quote.title') }}"
                    </h2>
                    <div class="quote-content">
                        <p class="mb-4">{{ __('messages.home.quote.subtitle') }}</p>
                        <p class="mb-4">{{ __('messages.home.quote.description') }}</p>
                        <p class="mb-0 quote-highlight">
                            → {{ __('messages.home.quote.welcome') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding section-services">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.home.services.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.home.services.subtitle') }}</p>
        </div>
        
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-xl-6 col-lg-6 col-md-6 fade-in">
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
                                @case('palette')
                                    <i class="fas fa-palette"></i>
                                    @break
                                @default
                                    <i class="fas fa-heart"></i>
                            @endswitch
                        </div>
                        <h4 class="mb-3">{{ $service->getLocalizedTranslation('name', app()->getLocale()) }}</h4>
                        <p class="text-muted mb-4">{{ $service->getLocalizedTranslation('description', app()->getLocale()) }}</p>
                        
                        @if($service->price_individual > 0)
                        <div class="mb-3">
                            <span class="badge bg-light text-dark">
                                {{ __('messages.services.price_individual') }}: {{ number_format($service->price_individual, 0) }}€
                            </span>
                        </div>
                        @elseif($service->slug === 'accompagnement-sur-mesure')
                        <div class="mb-3">
                            <span class="badge bg-light text-dark">
                                {{ __('messages.services.customized_pricing') }}
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
<section class="section-padding section-testimonials bg-white">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.home.testimonials.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.home.testimonials.subtitle') }}</p>
        </div>
        
        <!-- Testimonials Carousel -->
        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($testimonials->take(6) as $index => $testimonial)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="testimonial-card text-center">
                                <div class="stars mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="mb-4 fs-5">{{ $testimonial->getLocalizedTranslation('testimonial', app()->getLocale()) }}</p>
                                <div class="testimonial-author">
                                    <strong class="d-block">{{ $testimonial->client_name }}</strong>
                                    @if($testimonial->client_location)
                                        <small class="text-muted">{{ $testimonial->client_location }}</small>
                                    @endif
                                    @if($testimonial->service)
                                        <br><small class="text-muted">{{ $testimonial->service->getLocalizedTranslation('name', app()->getLocale()) }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Carousel Controls -->
            @if($testimonials->take(6)->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Additional Gallery-style Testimonials -->
<section class="section-padding section-testimonials-gallery bg-white">
    <div class="container">
        

        <div class="row g-4">
            <!-- Testimonial 1: childbirth (uses 1.jpeg) -->
            <div class="col-lg-12">
                <div class="testimonial-gallery-card p-3 h-100 d-flex align-items-center">
                    <div class="row w-100 align-items-center">
                        <div class="col-md-9">
                            <blockquote class="gallery-quote mb-0">
                                <p>« Grâce à la sophrologie j’ai pu avoir une meilleure gestion de la douleur lors de mon accouchement. »</p>
                                <footer class="blockquote-footer">Mlle L</footer>
                            </blockquote>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="portrait-wrapper mx-auto">
                                <img src="{{ asset('images/testimonial/1.jpeg') }}" alt="Témoignage accouchement" class="img-fluid rounded shadow-sm portrait-image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2: energy (uses 2.jpeg) with blurred face overlay -->
            <div class="col-lg-12">
                <div class="testimonial-gallery-card p-3 h-100 d-flex align-items-center">
                    <div class="row w-100 align-items-center">
                        <div class="col-md-9">
                            <blockquote class="gallery-quote mb-0">
                                <p>« Dès ma première séance de Sophrologie avec Sandrine et lors des suivantes, j'ai pu ressentir un bénéfice immédiat grâce à l'apaisement et au bien être procurés. J'ai pu désamorcer rapidement mes situations de stress, d'angoisse et de confusion pour retrouver une harmonie entre mon corps et mon esprit. Cet accompagnement pour une reprise de conscience et une réhabilitation de ma confiance en moi m'a permise de sortir d'une période de crises délicate et de revenir progressivement à un équilibre de vie plus serein. Merci Sandrine pour ta bienveillance et ton attention précieuse. »</p>
                                <footer class="blockquote-footer">Mlle U</footer>
                            </blockquote>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="portrait-wrapper mx-auto position-relative">
                                <img src="{{ asset('images/testimonial/2.jpg') }}" alt="Témoignage énergie" class="img-fluid rounded shadow-sm portrait-image" />
                                <!-- Circular blurred overlay to protect identity (adjust position/size if needed) -->
                                <div class="face-blur" style="background-image: url('{{ asset('images/testimonial/2.jpeg') }}');"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<!-- Modal to preview testimonial images -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="testimonialModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="Preview" class="img-fluid" id="testimonialModalImage" style="max-height:80vh; width: auto;" />
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function () {
                var modalEl = document.getElementById('testimonialModal');
                var modalImage = document.getElementById('testimonialModalImage');

                if (modalEl) {
                        modalEl.addEventListener('show.bs.modal', function (event) {
                                var trigger = event.relatedTarget;
                                if (!trigger) return;
                                var src = trigger.getAttribute('data-src') || trigger.dataset.src;
                                if (src) {
                                        modalImage.src = src;
                                }
                        });

                        modalEl.addEventListener('hidden.bs.modal', function () {
                                // release image src to free memory
                                modalImage.src = '';
                        });
                }
        });
</script>
@endpush
<section class="section-padding section-faq">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.home.faq.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.home.faq.subtitle') }}</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    @php
                        $faqs = [
                            [
                                'question' => trans('messages.home.faq.q1.question'),
                                'answer' => trans('messages.home.faq.q1.answer')
                            ],
                            [
                                'question' => trans('messages.home.faq.q2.question'),
                                'answer' => trans('messages.home.faq.q2.answer')
                            ],
                            [
                                'question' => trans('messages.home.faq.q3.question'),
                                'answer' => trans('messages.home.faq.q3.answer')
                            ],
                            [
                                'question' => trans('messages.home.faq.q4.question'),
                                'answer' => trans('messages.home.faq.q4.answer')
                            ],
                            [
                                'question' => trans('messages.home.faq.q5.question'),
                                'answer' => trans('messages.home.faq.q5.answer')
                            ]
                        ];
                    @endphp
                    
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding section-cta bg-white">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title">{{ __('messages.home.cta.title') }}</h2>
            <p class="section-subtitle">{{ __('messages.home.cta.subtitle') }}</p>
            <button onclick="openLocationModal()" class="btn btn-primary btn-lg">
                {{ __('messages.home.cta.button') }}
            </button>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Hero Section */
    .hero-slider {
        position: relative;
    }

    .hero-slide {
        position: relative;
        min-height: ;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        isolation: isolate;
    }

    .hero-slide::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0) 15%, rgba(255, 255, 255, 0.9) 90%);
        z-index: 0;
    }

    .hero-slider .container {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: clamp(420px, 70vh, 600px);
        padding-block: 15px;
    }

    .hero-text-overlay {
        width: min(940px, 100%);
        padding: 0 1.5rem;
        text-align: center;
    }
    
    .hero-overlay-text {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.25rem, 4.5vw, 4.5rem);
        font-weight: 800;
        color: #1f1f1f;
        line-height: 1.15;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin: 0 auto;
    }
    
    .hero-button-bottom {
        margin-top: clamp(2rem, 4vw, 3.5rem);
    }
    
    /* Button Styling */
    .btn-hero-primary {
        background: white;
        border: 2px solid #F7B2BD;
        color: #D63384;
        padding: 0.9rem 2.5rem;
        font-size: 1.05rem;
        font-weight: 600;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(247, 178, 189, 0.3);
    }
    
    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(247, 178, 189, 0.4);
        background: #F7B2BD;
        color: white;
        border-color: #F7B2BD;
    }

    /* Quote Section */
    .section-quote .quote-title {
        color: #333;
        font-style: italic;
        line-height: 1.35;
        font-size: clamp(2rem, 5vw, 3.3rem);
    }

    .section-quote .quote-content {
        font-size: clamp(1rem, 2.4vw, 1.15rem);
        line-height: 1.85;
        margin-bottom: 2.25rem;
        color: #555;
    }

    .section-quote .quote-highlight {
        font-style: italic;
        color: #F7B2BD;
    }

    /* Services */
    .section-services {
        background-color: #F8E8EA;
    }

    .section-services .card {
        border: none;
        box-shadow: 0 18px 45px rgba(247, 178, 189, 0.25);
    }

    .section-services .card-body {
        padding: clamp(1.75rem, 3vw, 2.25rem);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        text-align: center;
    }

    .section-services .service-icon {
        width: 72px;
        height: 72px;
        margin-bottom: 1.5rem;
    }

    .section-services .card-body h4 {
        font-size: clamp(1.25rem, 2.4vw, 1.5rem);
    }

    .section-services .card-body p {
        font-size: clamp(0.95rem, 2.2vw, 1.05rem);
    }

    .section-services .btn {
        margin-top: auto;
    }

    /* Testimonials */
    .section-testimonials {
        background-color: white;
    }

    .section-testimonials .testimonial-card {
        padding: clamp(1.75rem, 4vw, 2.5rem);
        min-height: auto;
    }

    .section-testimonials .testimonial-card p {
        font-size: clamp(1rem, 2.6vw, 1.25rem);
    }

    .section-testimonials .carousel-control-prev,
    .section-testimonials .carousel-control-next {
        width: 48px;
        height: 48px;
    }

    /* Gallery-style testimonial: quote left, portrait right */
    .section-testimonials-gallery .gallery-quote {
        border-left: 6px solid #0eaac3;
        padding-left: 1rem;
        font-size: clamp(1rem, 2.6vw, 1.15rem);
        color: #243b4a;
    }

    .section-testimonials-gallery .portrait-image {
        max-width: 320px;
        height: auto;
        object-fit: cover;
    }

    .section-testimonials-gallery .quote-translation em {
        color: #3b5564;
        font-size: 0.98rem;
    }

    .testimonial-gallery-card {
        background: #fff;
        border-radius: 8px;
    }

    .portrait-wrapper { 
        width: 200px;
        height: 354px;
        overflow: hidden;
        display: inline-block;
    }

    .portrait-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Circular blurred overlay to hide face while preserving context */
    .face-blur {
        position: absolute;
        left: 50%;
        top: 30%;
        width: 64px;
        height: 64px;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        filter: blur(8px);
        background-size: cover;
        background-position: center;
        box-shadow: 0 0 0 9999px rgba(255,255,255,0.001) inset;
    }

    /* FAQ */
    .section-faq {
        background-color: #F8E8EA;
    }

    /* CTA */
    .section-cta {
        background-color: white;
    }

    /* Butterfly flying animation in Quote Section */
    .butterfly-container {
        position: relative;
        overflow: visible;
    }
.butterfly {
    position: absolute;
    width: 58px;
    height: auto;
    pointer-events: none;
    z-index: 5;
    filter: drop-shadow(0 6px 10px rgba(0,0,0,0.12));
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
    opacity: 0.3; /* Low opacity for all butterflies */
}
.butterfly-1 {
    left: -40px;
    top: 15%;
    animation: flyA 12s ease-in-out infinite;
}

.butterfly-2 {
    left: 10%;
    top: 75%;
    width: 50px;
    animation: flyB 14s ease-in-out infinite;
}

.butterfly-3 {
    left: 80%;
    top: 40%;
    width: 44px;
    animation: flyC 13s ease-in-out infinite;
}

.butterfly-4 {
    left: 90%;
    top: 20%;
    width: 38px;
    animation: flyD 15s ease-in-out infinite;
}

/* Remove the flutter animation completely */
.butterfly::after {
    content: '';
    display: block;
}

/* Updated flight paths - stay within screen bounds */
@keyframes flyA {
    0%   { transform: translate(0, 0) rotate(0deg); }
    25%  { transform: translate(180px, -30px) rotate(10deg); }
    50%  { transform: translate(320px, 20px) rotate(-5deg); }
    75%  { transform: translate(180px, 50px) rotate(8deg); }
    100% { transform: translate(0, 0) rotate(0deg); }
}

@keyframes flyB {
    0%   { transform: translate(0, 0) rotate(0deg); }
    25%  { transform: translate(150px, -60px) rotate(-8deg); }
    50%  { transform: translate(280px, 10px) rotate(12deg); }
    75%  { transform: translate(150px, 40px) rotate(-10deg); }
    100% { transform: translate(0, 0) rotate(0deg); }
}

@keyframes flyC {
    0%   { transform: translate(0, 0) rotate(0deg); }
    25%  { transform: translate(-120px, -40px) rotate(8deg); }
    50%  { transform: translate(-220px, 30px) rotate(-10deg); }
    75%  { transform: translate(-120px, 50px) rotate(5deg); }
    100% { transform: translate(0, 0) rotate(0deg); }
}

@keyframes flyD {
    0%   { transform: translate(0, 0) rotate(0deg); }
    25%  { transform: translate(-100px, -50px) rotate(-10deg); }
    50%  { transform: translate(-200px, 20px) rotate(12deg); }
    75%  { transform: translate(-100px, 45px) rotate(-8deg); }
    100% { transform: translate(0, 0) rotate(0deg); }
}
    /* combine flight with flutter for a natural effect */
    .butterfly {
        animation-timing-function: ease-in-out;
        animation-iteration-count: infinite;
    }
    
    .butterfly-1 { animation-name: flyA; animation-duration: 9s; }
    .butterfly-2 { animation-name: flyB; animation-duration: 11s; }
    .butterfly-3 { animation-name: flyC; animation-duration: 10.5s; }
    .butterfly-4 { animation-name: flyD; animation-duration: 8.5s; }

    .butterfly::after {
        content: '';
        display: block;
        animation: flutter 0.8s ease-in-out infinite;
    }

    /* smaller on very small screens and reduce motion for accessibility */
    @media (max-width: 575.98px) {
        .butterfly { width: 34px; }
        .butterfly-2 { display: none; } /* hide one to avoid clutter on phone */
    }

    @media (prefers-reduced-motion: reduce) {
        .butterfly, .butterfly::after {
            animation: none !important;
            opacity: 1 !important;
        }
    }

    @media (max-width: 991.98px) {
        .hero-slide {
            min-height: clamp(480px, 90vh, 640px);
        }

        .hero-button-bottom .btn-hero-primary {
            width: min(320px, 90vw);
        }

        .section-services .card {
            box-shadow: 0 12px 32px rgba(247, 178, 189, 0.22);
        }

        .section-services .card-body {
            padding: 2rem 1.75rem;
        }
    }

    @media (max-width: 575.98px) {
        .hero-slide {
            min-height: clamp(420px, 85vh, 560px);
        }

        .hero-overlay-text {
            letter-spacing: 0.01em;
        }

        .hero-button-bottom {
            margin-top: 1.75rem;
        }

        .quote-content p {
            margin-bottom: 1.25rem;
        }

        .section-testimonials .carousel-item {
            padding: 1rem 0 2rem;
        }

        /* Use mobile hero images for small screens */
    .hero-slide.slide-1 {
        background-image: url('{{ asset("images/hero/mobile/1.png") }}') !important;
        background-size: cover;
        background-position: center;
    }
    .hero-slide.slide-2 {
        background-image: url('{{ asset("images/hero/mobile/2.png") }}') !important;
        background-size: cover;
        background-position: center;
    }
    .hero-slide.slide-3 {
        background-image: url('{{ asset("images/hero/mobile/3.png") }}') !important;
        background-size: cover;
        background-position: center;
    }
    }
</style>
@endpush

@push('structured-data')
@php
        $currentLocale = app()->getLocale();
        $siteTagline = \App\Models\Setting::get('site_tagline');
        $structuredData = [
                '@context' => 'https://schema.org',
                '@graph' => [
                        [
                                '@type' => 'LocalBusiness',
                                '@id' => url('/') . '#business',
                                'name' => 'SSJCHRYSALIDE',
                                'description' => $siteTagline[$currentLocale] ?? 'Thérapie brève en Martinique - Sophrologie, PNL, Hypnose',
                                'url' => url('/'),
                                'telephone' => '+596 696 103 622',
                                'email' => 'contact@ssjchrysalide.com',
                                'address' => [
                                        '@type' => 'PostalAddress',
                                        'addressLocality' => 'Martinique',
                                        'addressRegion' => 'Martinique',
                                        'addressCountry' => 'FR',
                                ],
                                'geo' => [
                                        '@type' => 'GeoCoordinates',
                                        'latitude' => '14.641528',
                                        'longitude' => '-61.024174',
                                ],
                                'sameAs' => [
                                        'https://instagram.com/ssjchrysalide',
                                        'https://ssjchrysalide.com',
                                ],
                                'serviceType' => [
                                        'Sophrologie',
                                        'Hypnothérapie',
                                        'PNL',
                                        'Thérapie brève',
                                        'Développement personnel',
                                ],
                                'medicalSpecialty' => [
                                        'Sophrology',
                                        'Hypnotherapy',
                                        'NLP Coaching',
                                ],
                                'areaServed' => [
                                        '@type' => 'Place',
                                        'name' => 'Martinique, French West Indies',
                                ],
                        ],
                        [
                                '@type' => 'Person',
                                '@id' => url('/') . '#person',
                                'name' => 'Sandrine',
                                'jobTitle' => 'Sophrologue RNCP, Praticienne Hypnose et PNL',
                                'description' => 'Sophrologue certifiée RNCP et praticienne en Hypnose et PNL certifiée IN',
                                'url' => url('/'),
                                'telephone' => '+596 696 103 622',
                                'email' => 'contact@ssjchrysalide.com',
                                'address' => [
                                        '@type' => 'PostalAddress',
                                        'addressLocality' => 'Martinique',
                                        'addressRegion' => 'Martinique',
                                        'addressCountry' => 'FR',
                                ],
                                'sameAs' => [
                                        'https://instagram.com/ssjchrysalide',
                                ],
                                'knowsAbout' => [
                                        'Sophrologie',
                                        'Hypnose',
                                        'PNL',
                                        'Thérapie brève',
                                        'Gestion du stress',
                                        'Troubles du sommeil',
                                        'Développement personnel',
                                ],
                                'hasCredential' => [
                                        'RNCP Sophrologue',
                                        'Praticienne Hypnose certifiée IN',
                                        'Praticienne PNL certifiée IN',
                                ],
                        ],
                        [
                                '@type' => 'MedicalBusiness',
                                '@id' => url('/') . '#medical',
                                'name' => 'SSJCHRYSALIDE',
                                'description' => 'Centre de thérapie brève spécialisé en sophrologie, hypnose et PNL en Martinique',
                                'medicalSpecialty' => [
                                        'Sophrology',
                                        'Hypnotherapy',
                                        'NLP Therapy',
                                ],
                                'serviceType' => [
                                        'Gestion du stress',
                                        'Troubles du sommeil',
                                        'Blocages personnels',
                                        'Fatigue émotionnelle',
                                        'Développement personnel',
                                ],
                                'address' => [
                                        '@type' => 'PostalAddress',
                                        'addressLocality' => 'Martinique',
                                        'addressRegion' => 'Martinique',
                                        'addressCountry' => 'FR',
                                ],
                                'telephone' => '+596 696 103 622',
                                'email' => 'contact@ssjchrysalide.com',
                        ],
                ],
        ];
@endphp
<script type="application/ld+json">
{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush
