<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', __('messages.seo.home.title')); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', __('messages.seo.home.description')); ?>">
    
    <!-- SEO Meta Tags -->
    <meta name="keywords" content="sophrologie, hypnose, coaching, PNL, bien-être, relaxation, développement personnel">
    <meta name="author" content="<?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching'); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', __('messages.seo.home.title')); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description', __('messages.seo.home.description')); ?>">
    <meta property="og:locale" content="<?php echo e(app()->getLocale() == 'fr' ? 'fr_FR' : 'en_US'); ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta property="twitter:title" content="<?php echo $__env->yieldContent('title', __('messages.seo.home.title')); ?>">
    <meta property="twitter:description" content="<?php echo $__env->yieldContent('description', __('messages.seo.home.description')); ?>">

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
                margin-left: -20px;
        }

        .navbar-logo-symbol {
            height: 68px;
            width: auto;
            max-width: 75px;
            object-fit: contain;
            margin-right: -11px;
        }

        .navbar-logo-text {
            height: 55px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
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

        /* Navbar Layout: Logo left, Menu center-left, Book+Language right */
        .language-switcher {
            margin-left: 0;
        }

        .btn-primary {
            background: #F7B2BD;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            color: #131313ff;
            box-shadow: 0 4px 15px rgba(214, 169, 164, 0.4);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            color: #362c2cff;
            background: #F7B2BD;
            box-shadow: 0 8px 25px rgba(214, 169, 164, 0.6);
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
            border: none;
        }

        /* Meditative Hero Slider Styles */
        .hero-slider {
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .hero-slide {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            text-align: center;
            z-index: 10;
            position: relative;
            animation: fadeInUp 1s ease-out;
        }

        .meditation-icon {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.9);
            animation: float 3s ease-in-out infinite;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            margin-bottom: 2.5rem;
            font-weight: 300;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: rgba(255, 255, 255, 0.9);
            color: #2c3e50;
            border: none;
            border-radius: 50px;
            padding: 15px 35px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-hero-primary:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
            color: #2c3e50;
        }

        .btn-hero-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 50px;
            padding: 13px 35px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.9);
            color: #2c3e50;
            border-color: white;
            transform: translateY(-3px);
        }

        /* Carousel Custom Styles */
        .carousel-indicators {
            bottom: 30px;
            margin-bottom: 0;
        }

        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.8);
            background: transparent;
            margin: 0 8px;
            transition: all 0.3s ease;
        }

        .carousel-indicators .active {
            background: white;
            transform: scale(1.2);
        }

        .carousel-control-prev, .carousel-control-next {
            width: 60px;
            height: 60px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.4);
            border-radius: 50%;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .carousel-control-prev {
            left: 30px;
        }

        .carousel-control-next {
            right: 30px;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.6);
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 24px;
            height: 24px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .meditation-icon {
                font-size: 3rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero-primary, .btn-hero-outline {
                width: 250px;
                text-align: center;
            }
            
            .carousel-control-prev, .carousel-control-next {
                width: 45px;
                height: 45px;
            }
            
            .carousel-control-prev {
                left: 15px;
            }
            
            .carousel-control-next {
                right: 15px;
            }
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
            border: 2px solid transparent;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(247, 178, 189, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            /* transform: translateY(-10px); */
            box-shadow: 0 20px 40px rgba(247, 178, 189, 0.2);
            /* border-color: #0da9c2; */
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
            color: #000000;
            margin: 0 auto 30px;
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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

        /* Testimonials Carousel Styles */
        #testimonialsCarousel .carousel-item {
            padding: 40px 0;
        }

        #testimonialsCarousel .testimonial-card {
            max-width: 100%;
            margin: 0 auto;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .testimonial-author {
            margin-top: 20px;
        }

        #testimonialsCarousel .carousel-control-prev,
        #testimonialsCarousel .carousel-control-next {
            width: 50px;
            height: 50px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.4);
            border-radius: 50%;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        #testimonialsCarousel .carousel-control-prev:hover,
        #testimonialsCarousel .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.6);
        }

        #testimonialsCarousel .carousel-control-prev {
            left: 15px;
        }

        #testimonialsCarousel .carousel-control-next {
            right: 15px;
        }

        #testimonialsCarousel .carousel-indicators {
            bottom: -50px;
            margin-bottom: 0;
        }

        #testimonialsCarousel .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid var(--primary-pink);
            background: transparent;
            margin: 0 8px;
            transition: all 0.3s ease;
        }

        #testimonialsCarousel .carousel-indicators .active {
            background: var(--primary-pink);
            transform: scale(1.2);
        }

        .testimonial-author {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            #testimonialsCarousel .carousel-control-prev {
                left: 10px;
            }
            
            #testimonialsCarousel .carousel-control-next {
                right: 10px;
            }
        }

        /* FAQ Accordion Styles */
        .accordion {
            --bs-accordion-border-radius: 15px;
            --bs-accordion-border-color: rgba(247, 178, 189, 0.2);
        }

        .accordion-item {
            border: 1px solid rgba(247, 178, 189, 0.2);
            border-radius: 15px !important;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(247, 178, 189, 0.1);
            overflow: hidden;
        }

        .accordion-item:not(:first-of-type) {
            border-top: 1px solid rgba(247, 178, 189, 0.2);
        }

        .accordion-header {
            border-radius: 15px;
        }

        .accordion-button {
            background: white;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1.1rem;
            padding: 20px 25px;
            border: none;
            border-radius: 15px;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .accordion-button:not(.collapsed) {
            background: var(--primary-pink);
            color: white;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(247, 178, 189, 0.3);
            border: none;
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23666'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transition: transform 0.3s ease;
        }

        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transform: rotate(180deg);
        }

        .accordion-collapse {
            border-top: 1px solid rgba(247, 178, 189, 0.2);
        }

        .accordion-body {
            background: white;
            padding: 25px;
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-muted);
        }

        .footer {
            background: black;
            color: white;
            padding: 60px 0 30px;
        }

        /* Ensure footer container matches navbar container width */
        .footer .container,
        .navbar .container {
            max-width: 1345px;;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .language-switcher {
            background: rgba(0, 0, 0, 1);
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 20px;
        }.language-switcher:hover{
            background: rgba(50, 49, 49, 1);
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 20px;
        }

        .language-switcher a {
            color: white;
            
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
            
            .section-padding {
                padding: 50px 0;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home', app()->getLocale())); ?>">
                <img src="<?php echo e(asset('images/assets/SSJchrysalis-first.png')); ?>" alt="SSJ Symbol" class="navbar-logo-symbol">
                <img src="<?php echo e(asset('images/assets/SSJchrysalis-second.png')); ?>" alt="Chrysalide" class="navbar-logo-text">
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu + Right Side Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Main Navigation Menu -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.home')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('about', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.about')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('services.index', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.services')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('events.index', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.events')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('blog.index', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.blog')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('guides.index', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.guides')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('contact.index', app()->getLocale())); ?>">
                            <?php echo e(__('messages.nav.contact')); ?>

                        </a>
                    </li>
                </ul>
                
                <!-- Right Side: Book Now -->
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary" onclick="openLocationModal()">
                        <?php echo e(__('messages.nav.book')); ?>

                    </button>
                </div>
            </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 0;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <h5><?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching'); ?></h5>
                    <p><?php echo e(\App\Models\Setting::get('site_tagline')[app()->getLocale()] ?? ''); ?></p>
                    <div class="social-links">
                        <?php if(\App\Models\Setting::get('social_facebook')): ?>
                            <a href="<?php echo e(\App\Models\Setting::get('social_facebook')); ?>" class="me-3 text-light">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if(\App\Models\Setting::get('social_instagram')): ?>
                            <a href="<?php echo e(\App\Models\Setting::get('social_instagram')); ?>" class="me-3 text-light">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5><?php echo e(__('messages.contact.info.title')); ?></h5>
                    <p>
                        <i class="fas fa-envelope me-2"></i>
                        <?php echo e(\App\Models\Setting::get('contact_email')); ?>

                    </p>
                    <p>
                        <i class="fas fa-phone me-2"></i>
                        <?php echo e(\App\Models\Setting::get('contact_phone')); ?>

                    </p>
                    <?php if(\App\Models\Setting::get('site_website')): ?>
                    <p>
                        <i class="fas fa-globe me-2"></i>
                        <a href="<?php echo e(\App\Models\Setting::get('site_website')); ?>" class="text-light text-decoration-none">
                            <?php echo e(str_replace(['https://', 'http://'], '', \App\Models\Setting::get('site_website'))); ?>

                        </a>
                    </p>
                    <?php endif; ?>
                    <p>
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo e(\App\Models\Setting::get('address')[app()->getLocale()] ?? ''); ?>

                    </p>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5><?php echo e(__('messages.nav.services')); ?></h5>
                    <?php $__currentLoopData = \App\Models\Service::active()->orderBy('sort_order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p>
                            <a href="<?php echo e(route('services.show', [app()->getLocale(), $service->slug])); ?>" class="text-light text-decoration-none">
                                <?php echo e($service->getTranslation('name', app()->getLocale())); ?>

                            </a>
                        </p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5><?php echo e(__('messages.footer.links')); ?></h5>
                    <p>
                        <a href="<?php echo e(route('practices', app()->getLocale())); ?>" class="text-light text-decoration-none">
                            <?php echo e(__('messages.footer.my_practices')); ?>

                        </a>
                    </p>
                    <p>
                        <a href="<?php echo e(route('privacy-policy', app()->getLocale())); ?>" class="text-light text-decoration-none">
                            <?php echo e(__('messages.footer.privacy_policy')); ?>

                        </a>
                    </p>
                    <p>
                        <a href="<?php echo e(route('terms-conditions', app()->getLocale())); ?>" class="text-light text-decoration-none">
                            <?php echo e(__('messages.footer.terms_conditions')); ?>

                        </a>
                    </p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'Coaching'); ?>. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!-- Language Switcher -->
                    <div class="language-switcher d-inline-block">
                        <?php
                            $currentRoute = request()->route()->getName();
                            $routeParams = request()->route()->parameters();
                            $otherLocale = app()->getLocale() == 'fr' ? 'en' : 'fr';
                            
                            // Generate URL for same page in other language
                            if ($currentRoute && $currentRoute !== 'lang.switch') {
                                unset($routeParams['locale']);
                                $switchUrl = route($currentRoute, array_merge(['locale' => $otherLocale], $routeParams));
                            } else {
                                $switchUrl = url("/{$otherLocale}");
                            }
                        ?>
                        <a href="<?php echo e($switchUrl); ?>" class="language-link">
                            <?php if(app()->getLocale() == 'fr'): ?>
                                🌐 English
                            <?php else: ?>
                                🌐 Français
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <!-- Location Selection Modal -->
    <?php echo $__env->make('partials.location-selection-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH D:\client-fiverr\coaching\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>