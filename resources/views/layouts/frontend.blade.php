<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('messages.seo.home.title'))</title>
    <meta name="description" content="@yield('description', __('messages.seo.home.description'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-pink: #F7B2BD;
            --light-pink: #F8E8EA;
            --soft-teal: #B8E0D2;
            --dark-teal: #7CCCA8;
            --cream: #FDF9F7;
            --warm-gray: #8B7D7B;
            --text-dark: #4A4A4A;
            --gradient-main: linear-gradient(135deg, var(--light-pink) 0%, var(--soft-teal) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--cream);
        }

        .gradient-bg {
            background: var(--gradient-main);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(247, 178, 189, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--text-dark) !important;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
            padding: 10px 15px !important;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background: var(--light-pink);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-pink), var(--dark-teal));
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(247, 178, 189, 0.4);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(247, 178, 189, 0.6);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-pink);
            color: var(--primary-pink);
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-pink);
            color: white;
            transform: translateY(-2px);
        }

        .hero-section {
            background: var(--gradient-main);
            min-height: 80vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.5;
        }

        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 20px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--warm-gray);
            text-align: center;
            margin-bottom: 50px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(247, 178, 189, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(247, 178, 189, 0.2);
        }

        .card-body {
            padding: 30px;
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: var(--light-pink);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary-pink);
            margin: 0 auto 30px;
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 20px;
            font-size: 4rem;
            color: var(--light-pink);
            font-family: serif;
        }

        .stars {
            color: #ffc107;
            margin-bottom: 15px;
        }

        .footer {
            background: var(--text-dark);
            color: white;
            padding: 60px 0 30px;
        }

        .language-switcher {
            background: var(--light-pink);
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 20px;
        }

        .language-switcher a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            
            .hero-section {
                min-height: 60vh;
                text-align: center;
            }
            
            .section-padding {
                padding: 50px 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home', app()->getLocale()) }}">
                <i class="fas fa-lotus"></i>
                {{ \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching' }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home', app()->getLocale()) }}">
                            {{ __('messages.nav.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.show', [app()->getLocale(), 'about']) }}">
                            {{ __('messages.nav.about') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services.index', app()->getLocale()) }}">
                            {{ __('messages.nav.services') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index', app()->getLocale()) }}">
                            {{ __('messages.nav.contact') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary nav-link text-white" href="{{ route('booking.index', app()->getLocale()) }}">
                            {{ __('messages.nav.book') }}
                        </a>
                    </li>
                </ul>
                
                <!-- Language Switcher -->
                <div class="language-switcher">
                    @if(app()->getLocale() == 'fr')
                        <a href="{{ route('lang.switch', 'en') }}">{{ __('messages.nav.language') }}</a>
                    @else
                        <a href="{{ route('lang.switch', 'fr') }}">{{ __('messages.nav.language') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 80px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>{{ \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching' }}</h5>
                    <p>{{ \App\Models\Setting::get('site_tagline')[app()->getLocale()] ?? '' }}</p>
                    <div class="social-links">
                        @if(\App\Models\Setting::get('social_facebook'))
                            <a href="{{ \App\Models\Setting::get('social_facebook') }}" class="me-3 text-light">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if(\App\Models\Setting::get('social_instagram'))
                            <a href="{{ \App\Models\Setting::get('social_instagram') }}" class="me-3 text-light">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>{{ __('messages.contact.info.title') }}</h5>
                    <p>
                        <i class="fas fa-envelope me-2"></i>
                        {{ \App\Models\Setting::get('contact_email') }}
                    </p>
                    <p>
                        <i class="fas fa-phone me-2"></i>
                        {{ \App\Models\Setting::get('contact_phone') }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ \App\Models\Setting::get('address')[app()->getLocale()] ?? '' }}
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>{{ __('messages.nav.services') }}</h5>
                    @foreach(\App\Models\Service::active()->orderBy('sort_order')->get() as $service)
                        <p>
                            <a href="{{ route('services.show', [app()->getLocale(), $service->slug]) }}" class="text-light text-decoration-none">
                                {{ $service->getTranslation('name', app()->getLocale()) }}
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching' }}. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Fade in animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>