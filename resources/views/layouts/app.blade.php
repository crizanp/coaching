<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', (\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE') . ' - ' . (\App\Models\Setting::get('site_tagline')[app()->getLocale()] ?? 'Thérapie Brève Martinique'))</title>
    <meta name="description" content="@yield('description', \App\Models\Setting::get('site_tagline')[app()->getLocale()] ?? 'Accompagner les personnes qui traversent des périodes de stress, de fatigue émotionnelle, de troubles du sommeil, de blocages personnels, ou qui souhaitent simplement opérer des changements et atteindre de nouveaux objectifs.')">
    <meta name="keywords" content="@yield('keywords', __('sophrologie, PNL, hypnose, thérapie brève, Martinique, stress, blocages, développement personnel'))">
    <meta name="author" content="Sandrine - SSJCHRYSALIDE">
    <meta name="robots" content="index, follow">
    
    <!-- Geo Location Meta -->
    <meta name="geo.region" content="MQ">
    <meta name="geo.placename" content="Martinique">
    <meta name="geo.position" content="14.641528;-61.024174">
    <meta name="ICBM" content="14.641528, -61.024174">
    
    <!-- Multilingual Meta -->
    @if(app()->getLocale() == 'fr')
        <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">
        <link rel="alternate" hreflang="fr" href="{{ url()->current() }}?lang=fr">
    @else
        <link rel="alternate" hreflang="fr" href="{{ url()->current() }}?lang=fr">
        <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">
    @endif
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og:title', \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE')">
    <meta property="og:description" content="@yield('og:description', \App\Models\Setting::get('site_tagline')[app()->getLocale()] ?? 'Thérapie Brève en Martinique')">
    <meta property="og:type" content="@yield('og:type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og:image', asset('images/og-image.jpg'))">
    <meta property="og:site_name" content="SSJCHRYSALIDE">
    <meta property="og:locale" content="{{ app()->getLocale() == 'fr' ? 'fr_FR' : 'en_US' }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter:title', \App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE')">
    <meta name="twitter:description" content="@yield('twitter:description', \App\Models\Setting::get('site_tagline')[app()->getLocale()] ?? 'Thérapie Brève en Martinique')">
    <meta name="twitter:image" content="@yield('twitter:image', asset('images/og-image.jpg'))">
    <meta name="twitter:site" content="@ssjchrysalide">
    
    <!-- Favicon and App Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#d4b3d6">
    <meta name="msapplication-TileColor" content="#d4b3d6">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Structured Data -->
    @stack('structured-data')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        .navbar-logo-symbol {
            height: 25px;
            width: auto;
            max-width: 32px;
            object-fit: contain;
        }

        .navbar-logo-text {
            height: 18px;
            width: auto;
            max-width: 100px;
            object-fit: contain;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/assets/SSJchrysalis-first.png') }}" alt="SSJ Symbol" class="navbar-logo-symbol me-2">
                    <img src="{{ asset('images/assets/SSJchrysalis-second.png') }}" alt="Chrysalide" class="navbar-logo-text">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-dashboard"></i> Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.services.index') }}"><i class="fas fa-concierge-bell"></i> Services</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.appointments.index') }}"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i> Settings</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.change-password') }}"><i class="fas fa-key"></i> Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ url('/fr') }}" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- Registration disabled for admin-only system --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
