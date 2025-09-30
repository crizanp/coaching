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

    <!-- Admin Black Theme Styles -->
    @auth
    <style>
        /* Black Theme for Admin Panel */
        body.admin-theme {
            background-color: #0a0a0a !important;
            color: #e9e9e9 !important;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Navbar Black Theme */
        body.admin-theme .navbar {
            background-color: #1a1a1a !important;
            border-bottom: 1px solid #333 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
        }

        body.admin-theme .navbar-brand {
            color: #fff !important;
        }

        body.admin-theme .navbar-nav .nav-link {
            color: #e9e9e9 !important;
        }

        body.admin-theme .navbar-nav .nav-link:hover {
            color: #fff !important;
        }

        body.admin-theme .dropdown-menu {
            background-color: #2d2d2d !important;
            border: 1px solid #444 !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4) !important;
        }

        body.admin-theme .dropdown-item {
            color: #e9e9e9 !important;
        }

        body.admin-theme .dropdown-item:hover {
            background-color: #404040 !important;
            color: #fff !important;
        }

        body.admin-theme .dropdown-divider {
            border-color: #555 !important;
        }

        /* Container & Card Styles */
        body.admin-theme .container {
            background-color: transparent !important;
        }

        body.admin-theme .card {
            background-color: #1a1a1a !important;
            border: 1px solid #333 !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3) !important;
        }

        body.admin-theme .card-header {
            background-color: #2d2d2d !important;
            border-bottom: 1px solid #444 !important;
            color: #fff !important;
            font-weight: 600 !important;
        }

        body.admin-theme .card-body {
            background-color: #1a1a1a !important;
            color: #e9e9e9 !important;
        }

        /* Stats Cards */
        body.admin-theme .card.bg-primary {
            background: linear-gradient(135deg, #0056b3, #007bff) !important;
            border: none !important;
        }

        body.admin-theme .card.bg-success {
            background: linear-gradient(135deg, #155724, #28a745) !important;
            border: none !important;
        }

        body.admin-theme .card.bg-warning {
            background: linear-gradient(135deg, #856404, #ffc107) !important;
            border: none !important;
        }

        body.admin-theme .card.bg-info {
            background: linear-gradient(135deg, #0c5460, #17a2b8) !important;
            border: none !important;
        }

        /* Tables */
        body.admin-theme .table {
            color: #e9e9e9 !important;
            background-color: transparent !important;
        }

        body.admin-theme .table th {
            background-color: #2d2d2d !important;
            border-color: #444 !important;
            color: #fff !important;
            font-weight: 600 !important;
        }

        body.admin-theme .table td {
            border-color: #333 !important;
        }

        body.admin-theme .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255,255,255,0.02) !important;
        }

        body.admin-theme .table-striped tbody tr:hover {
            background-color: rgba(255,255,255,0.05) !important;
        }

        body.admin-theme .table-borderless td,
        body.admin-theme .table-borderless th {
            border: 0 !important;
        }

        /* Forms */
        body.admin-theme .form-control {
            background-color: #2d2d2d !important;
            border: 1px solid #444 !important;
            color: #e9e9e9 !important;
        }

        body.admin-theme .form-control:focus {
            background-color: #2d2d2d !important;
            border-color: #007bff !important;
            color: #e9e9e9 !important;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25) !important;
        }

        body.admin-theme .form-control::placeholder {
            color: #999 !important;
        }

        body.admin-theme .form-label {
            color: #e9e9e9 !important;
            font-weight: 500 !important;
        }

        body.admin-theme .form-select {
            background-color: #2d2d2d !important;
            border: 1px solid #444 !important;
            color: #e9e9e9 !important;
        }

        body.admin-theme .form-check-input {
            background-color: #2d2d2d !important;
            border: 1px solid #444 !important;
        }

        body.admin-theme .form-check-input:checked {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        body.admin-theme .form-check-label {
            color: #e9e9e9 !important;
        }

        /* Buttons */
        body.admin-theme .btn-primary {
            background: linear-gradient(135deg, #0056b3, #007bff) !important;
            border: none !important;
            color: #fff !important;
        }

        body.admin-theme .btn-primary:hover {
            background: linear-gradient(135deg, #004085, #0056b3) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(0,123,255,0.3) !important;
        }

        body.admin-theme .btn-secondary {
            background: linear-gradient(135deg, #495057, #6c757d) !important;
            border: none !important;
            color: #fff !important;
        }

        body.admin-theme .btn-secondary:hover {
            background: linear-gradient(135deg, #343a40, #495057) !important;
            transform: translateY(-1px) !important;
        }

        body.admin-theme .btn-success {
            background: linear-gradient(135deg, #155724, #28a745) !important;
            border: none !important;
        }

        body.admin-theme .btn-success:hover {
            background: linear-gradient(135deg, #0e4e1f, #1e7e34) !important;
            transform: translateY(-1px) !important;
        }

        body.admin-theme .btn-danger {
            background: linear-gradient(135deg, #721c24, #dc3545) !important;
            border: none !important;
        }

        body.admin-theme .btn-danger:hover {
            background: linear-gradient(135deg, #5a161c, #c82333) !important;
            transform: translateY(-1px) !important;
        }

        body.admin-theme .btn-warning {
            background: linear-gradient(135deg, #856404, #ffc107) !important;
            border: none !important;
            color: #212529 !important;
        }

        body.admin-theme .btn-warning:hover {
            background: linear-gradient(135deg, #664d03, #e0a800) !important;
            transform: translateY(-1px) !important;
        }

        body.admin-theme .btn-info {
            background: linear-gradient(135deg, #0c5460, #17a2b8) !important;
            border: none !important;
        }

        body.admin-theme .btn-info:hover {
            background: linear-gradient(135deg, #062c33, #138496) !important;
            transform: translateY(-1px) !important;
        }

        body.admin-theme .btn-outline-primary {
            color: #007bff !important;
            border-color: #007bff !important;
            background: transparent !important;
        }

        body.admin-theme .btn-outline-primary:hover {
            background-color: #007bff !important;
            color: #fff !important;
        }

        body.admin-theme .btn-outline-secondary {
            color: #6c757d !important;
            border-color: #6c757d !important;
            background: transparent !important;
        }

        body.admin-theme .btn-outline-secondary:hover {
            background-color: #6c757d !important;
            color: #fff !important;
        }

        body.admin-theme .btn-outline-danger {
            color: #dc3545 !important;
            border-color: #dc3545 !important;
            background: transparent !important;
        }

        body.admin-theme .btn-outline-danger:hover {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        /* Alerts */
        body.admin-theme .alert {
            border: none !important;
            border-radius: 6px !important;
        }

        body.admin-theme .alert-success {
            background: linear-gradient(135deg, #155724, #28a745) !important;
            color: #fff !important;
        }

        body.admin-theme .alert-info {
            background: linear-gradient(135deg, #0c5460, #17a2b8) !important;
            color: #fff !important;
        }

        body.admin-theme .alert-warning {
            background: linear-gradient(135deg, #856404, #ffc107) !important;
            color: #212529 !important;
        }

        body.admin-theme .alert-danger {
            background: linear-gradient(135deg, #721c24, #dc3545) !important;
            color: #fff !important;
        }

        /* Badges */
        body.admin-theme .badge {
            color: #fff !important;
        }

        body.admin-theme .badge.bg-primary {
            background: linear-gradient(135deg, #0056b3, #007bff) !important;
        }

        body.admin-theme .badge.bg-success {
            background: linear-gradient(135deg, #155724, #28a745) !important;
        }

        body.admin-theme .badge.bg-warning {
            background: linear-gradient(135deg, #856404, #ffc107) !important;
            color: #212529 !important;
        }

        body.admin-theme .badge.bg-danger {
            background: linear-gradient(135deg, #721c24, #dc3545) !important;
        }

        body.admin-theme .badge.badge-success {
            background: linear-gradient(135deg, #155724, #28a745) !important;
        }

        body.admin-theme .badge.badge-warning {
            background: linear-gradient(135deg, #856404, #ffc107) !important;
            color: #212529 !important;
        }

        body.admin-theme .badge.badge-danger {
            background: linear-gradient(135deg, #721c24, #dc3545) !important;
        }

        /* Text Colors */
        body.admin-theme .text-muted {
            color: #999 !important;
        }

        body.admin-theme .text-primary {
            color: #66b3ff !important;
        }

        body.admin-theme .text-success {
            color: #4dd4ac !important;
        }

        body.admin-theme .text-warning {
            color: #ffd43b !important;
        }

        body.admin-theme .text-danger {
            color: #ff6b7a !important;
        }

        body.admin-theme .text-info {
            color: #4dd4f0 !important;
        }

        /* Pagination */
        body.admin-theme .pagination .page-link {
            background-color: #2d2d2d !important;
            border-color: #444 !important;
            color: #e9e9e9 !important;
        }

        body.admin-theme .pagination .page-link:hover {
            background-color: #404040 !important;
            border-color: #555 !important;
            color: #fff !important;
        }

        body.admin-theme .pagination .page-item.active .page-link {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        /* Invalid Feedback */
        body.admin-theme .invalid-feedback {
            color: #ff6b7a !important;
        }

        body.admin-theme .is-invalid {
            border-color: #dc3545 !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body.admin-theme .container {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            body.admin-theme .card {
                margin-bottom: 20px !important;
            }

            body.admin-theme .btn {
                width: 100% !important;
                margin-bottom: 10px !important;
            }

            body.admin-theme .btn:last-child {
                margin-bottom: 0 !important;
            }

            body.admin-theme .table-responsive {
                border: 1px solid #333 !important;
                border-radius: 6px !important;
            }

            body.admin-theme .d-flex.justify-content-between {
                flex-direction: column !important;
                gap: 15px !important;
            }

            body.admin-theme .d-flex.justify-content-between .btn {
                width: auto !important;
            }
        }

        /* Additional responsive utilities */
        @media (max-width: 576px) {
            body.admin-theme .col-md-3,
            body.admin-theme .col-md-6,
            body.admin-theme .col-md-8,
            body.admin-theme .col-md-10,
            body.admin-theme .col-md-12 {
                margin-bottom: 20px !important;
            }

            body.admin-theme .navbar-brand {
                font-size: 1rem !important;
            }

            body.admin-theme .card-header h4 {
                font-size: 1.2rem !important;
            }

            body.admin-theme .d-flex.gap-2 {
                flex-direction: column !important;
            }

            body.admin-theme .d-flex.gap-2 .btn {
                margin-bottom: 10px !important;
            }

            body.admin-theme .card-header .d-flex {
                flex-direction: column !important;
                gap: 15px !important;
            }

            body.admin-theme .btn-group {
                flex-direction: column !important;
            }

            body.admin-theme .btn-group .btn {
                border-radius: 0.375rem !important;
                margin-bottom: 5px !important;
            }
        }

        /* Enhanced mobile responsiveness */
        @media (max-width: 992px) {
            body.admin-theme .container-fluid {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            body.admin-theme .navbar-collapse {
                background-color: #1a1a1a !important;
                margin-top: 10px !important;
                padding: 15px !important;
                border-radius: 6px !important;
                border: 1px solid #333 !important;
            }
        }

        /* Table responsive enhancements */
        @media (max-width: 768px) {
            body.admin-theme .table-responsive {
                font-size: 0.875rem !important;
            }

            body.admin-theme .table th,
            body.admin-theme .table td {
                padding: 0.5rem !important;
                vertical-align: middle !important;
            }

            body.admin-theme .btn-sm {
                font-size: 0.75rem !important;
                padding: 0.25rem 0.5rem !important;
            }
        }

        /* Smooth transitions */
        body.admin-theme .btn,
        body.admin-theme .card,
        body.admin-theme .form-control,
        body.admin-theme .table tr {
            transition: all 0.3s ease !important;
        }

        /* Custom scrollbar for dark theme */
        body.admin-theme ::-webkit-scrollbar {
            width: 8px;
        }

        body.admin-theme ::-webkit-scrollbar-track {
            background: #2d2d2d;
        }

        body.admin-theme ::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 4px;
        }

        body.admin-theme ::-webkit-scrollbar-thumb:hover {
            background: #777;
        }
    </style>
    @endauth

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="@auth admin-theme @endauth">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="@auth {{ route('admin.dashboard') }} @else {{ url('/') }} @endauth">
                    <img src="{{ asset('images/assets/SSJchrysalis-first.png') }}" alt="SSJ Symbol" class="navbar-logo-symbol me-2">
                    <img src="{{ asset('images/assets/SSJchrysalis-second.png') }}" alt="Chrysalide" class="navbar-logo-text">
                    @auth
                        <span class="ms-3 d-none d-md-inline-block text-muted small">Admin Panel</span>
                    @endauth
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
                                    <li><a class="dropdown-item" href="{{ route('admin.blogs.index') }}"><i class="fas fa-blog"></i> Blog Posts</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.guides.index') }}"><i class="fas fa-book"></i> Guides</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.guide-downloads.index') }}"><i class="fas fa-download"></i> Guide Downloads</a></li>
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
