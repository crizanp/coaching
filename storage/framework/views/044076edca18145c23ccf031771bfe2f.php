<?php $__env->startSection('title', __('messages.seo.home.title')); ?>
<?php $__env->startSection('description', __('messages.seo.home.description')); ?>

<?php $__env->startSection('content'); ?>
<!-- Meditative Hero Slider -->
<section class="hero-slider">
    <div id="meditativeSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Slides -->
        <div class="carousel-inner">
            <!-- Slide 1: Appointment -->
            <div class="carousel-item active">
                <div class="hero-slide" style="background: url('<?php echo e(asset('images/hero/1.png')); ?>'); background-size: cover; background-position: center;">
                    <div class="container h-100 position-relative">
                        <!-- Text overlay -->
                        <div class="hero-text-overlay">
                            <h1 class="hero-overlay-text"><?php echo __('messages.home.hero.slide1.text'); ?></h1>
                        </div>
                        
                        <!-- Button at bottom -->
                        <div class="hero-button-bottom">
                            <div class="text-center">
                                <button onclick="openLocationModal()" class="btn btn-hero-primary">
                                    <?php echo e(__('messages.home.hero.slide1.button')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: All Services -->
            <div class="carousel-item">
                <div class="hero-slide" style="background: url('<?php echo e(asset('images/hero/2.png')); ?>'); background-size: cover; background-position: center;">
                    <div class="container h-100 position-relative">
                        <!-- Text overlay -->
                        <div class="hero-text-overlay">
                            <h1 class="hero-overlay-text"><?php echo __('messages.home.hero.slide2.text'); ?></h1>
                        </div>
                        
                        <!-- Button at bottom -->
                        <div class="hero-button-bottom">
                            <div class="text-center">
                                <a href="<?php echo e(route('services.index', app()->getLocale())); ?>" class="btn btn-hero-primary">
                                    <?php echo e(__('messages.home.hero.slide2.button')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Contact Us -->
            <div class="carousel-item">
                <div class="hero-slide" style="background: url('<?php echo e(asset('images/hero/3.png')); ?>'); background-size: cover; background-position: center;">
                    <div class="container h-100 position-relative">
                        <!-- Text overlay -->
                        <div class="hero-text-overlay">
                            <h1 class="hero-overlay-text"><?php echo __('messages.home.hero.slide3.text'); ?></h1>
                        </div>
                        
                        <!-- Button at bottom -->
                        <div class="hero-button-bottom">
                            <div class="text-center">
                                <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="btn btn-hero-primary">
                                    <?php echo e(__('messages.home.hero.slide3.button')); ?>

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
<section class="section-padding" style="background-color: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="fade-in">
                    <h2 class="section-title mb-4" style="color: #333; font-style: italic; font-size: 3.2rem; line-height: 1.4;">
                        "<?php echo e(__('messages.home.quote.title')); ?>"
                    </h2>
                    <div class="quote-content" style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem; color: #555;">
                        <p class="mb-4"><?php echo e(__('messages.home.quote.subtitle')); ?></p>
                        <p class="mb-4"><?php echo e(__('messages.home.quote.description')); ?></p>
                        <p class="mb-0" style="font-style: italic; color: #F7B2BD;">
                            → <?php echo e(__('messages.home.quote.welcome')); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding" style="background-color: #F8E8EA;">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title"><?php echo e(__('messages.home.services.title')); ?></h2>
            <p class="section-subtitle"><?php echo e(__('messages.home.services.subtitle')); ?></p>
        </div>
        
        <div class="row">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 col-md-6 mb-4 fade-in">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon">
                            <?php switch($service->icon):
                                case ('leaf'): ?>
                                    <i class="fas fa-leaf"></i>
                                    <?php break; ?>
                                <?php case ('moon'): ?>
                                    <i class="fas fa-moon"></i>
                                    <?php break; ?>
                                <?php case ('brain'): ?>
                                    <i class="fas fa-brain"></i>
                                    <?php break; ?>
                                <?php case ('palette'): ?>
                                    <i class="fas fa-palette"></i>
                                    <?php break; ?>
                                <?php default: ?>
                                    <i class="fas fa-heart"></i>
                            <?php endswitch; ?>
                        </div>
                        <h4 class="mb-3"><?php echo e($service->getLocalizedTranslation('name', app()->getLocale())); ?></h4>
                        <p class="text-muted mb-4"><?php echo e($service->getLocalizedTranslation('description', app()->getLocale())); ?></p>
                        
                        <?php if($service->price_individual > 0): ?>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark">
                                <?php echo e(__('messages.services.price_individual')); ?>: <?php echo e(number_format($service->price_individual, 0)); ?>€
                            </span>
                        </div>
                        <?php elseif($service->slug === 'accompagnement-sur-mesure'): ?>
                        <div class="mb-3">
                            <span class="badge bg-light text-dark">
                                <?php echo e(__('messages.services.customized_pricing')); ?>

                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('services.show', [app()->getLocale(), $service->slug])); ?>" class="btn btn-outline-primary">
                            <?php echo e(__('messages.services.learn_more')); ?>

                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<?php if($testimonials->count() > 0): ?>
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title"><?php echo e(__('messages.home.testimonials.title')); ?></h2>
            <p class="section-subtitle"><?php echo e(__('messages.home.testimonials.subtitle')); ?></p>
        </div>
        
        <!-- Testimonials Carousel -->
        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <?php $__currentLoopData = $testimonials->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="testimonial-card text-center">
                                <div class="stars mb-3">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $testimonial->rating): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <p class="mb-4 fs-5"><?php echo e($testimonial->getLocalizedTranslation('testimonial', app()->getLocale())); ?></p>
                                <div class="testimonial-author">
                                    <strong class="d-block"><?php echo e($testimonial->client_name); ?></strong>
                                    <?php if($testimonial->client_location): ?>
                                        <small class="text-muted"><?php echo e($testimonial->client_location); ?></small>
                                    <?php endif; ?>
                                    <?php if($testimonial->service): ?>
                                        <br><small class="text-muted"><?php echo e($testimonial->service->getLocalizedTranslation('name', app()->getLocale())); ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- Carousel Controls -->
            <?php if($testimonials->take(6)->count() > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FAQ Section -->
<section class="section-padding" style="background-color: #F8E8EA;">
    <div class="container">
        <div class="fade-in">
            <h2 class="section-title"><?php echo e(__('messages.home.faq.title')); ?></h2>
            <p class="section-subtitle"><?php echo e(__('messages.home.faq.subtitle')); ?></p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <?php
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
                    ?>
                    
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo e($index); ?>">
                            <button class="accordion-button <?php echo e($index === 0 ? '' : 'collapsed'); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($index); ?>" aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>" aria-controls="collapse<?php echo e($index); ?>">
                                <?php echo e($faq['question']); ?>

                            </button>
                        </h2>
                        <div id="collapse<?php echo e($index); ?>" class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>" aria-labelledby="heading<?php echo e($index); ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?php echo e($faq['answer']); ?>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding" style="background: white;">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title"><?php echo e(__('messages.home.cta.title')); ?></h2>
            <p class="section-subtitle"><?php echo e(__('messages.home.cta.subtitle')); ?></p>
            <button onclick="openLocationModal()" class="btn btn-primary btn-lg">
                <?php echo e(__('messages.home.cta.button')); ?>

            </button>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Hero Text Overlay Styles */
    .hero-text-overlay {
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
        width: 100%;
        padding: 0 2rem;
    }
    
    .hero-overlay-text {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        font-weight: 900;
        color: #000000;
        text-align: center;
        line-height: 1.1;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        text-shadow: none;
        margin: 0;
        padding: 0;
    }
    
    /* Hero Button Positioning */
    .hero-button-bottom {
        position: absolute;
        top: 72%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        width: 100%;
    }
    
    /* Button Styling */
    .btn-hero-primary {
        background: white;
        border: 2px solid #F7B2BD;
        color: #D63384;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
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
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .hero-overlay-text {
            font-size: 3.5rem;
        }
        
        .hero-button-bottom {
            top: 64%;
        }
    }
    
    @media (max-width: 768px) {
        .hero-overlay-text {
            font-size: 2.5rem;
            padding: 0 1rem;
        }
        
        .hero-text-overlay {
            padding: 0 1rem;
            top: 42%;
        }
        
        .hero-button-bottom {
            top: 58%;
        }
        
        .btn-hero-primary {
            padding: 0.8rem 2rem;
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .hero-overlay-text {
            font-size: 2rem;
        }
        
        .hero-text-overlay {
            top: 40%;
        }
        
        .hero-button-bottom {
            top: 55%;
        }
        
        .btn-hero-primary {
            padding: 0.7rem 1.5rem;
            font-size: 0.9rem;
        }
    }
    
    /* Ensure proper slide height */
    .hero-slide {
        min-height: 100vh;
        position: relative;
    }
    
    .hero-slider .container {
        position: relative;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('structured-data'); ?>
<?php
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
?>
<script type="application/ld+json">
<?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/home.blade.php ENDPATH**/ ?>