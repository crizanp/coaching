

<?php $__env->startSection('title'); ?>
<?php echo e(__('messages.practices.title')); ?> - <?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e(__('messages.practices.description')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('keywords'); ?>
sophrologie, PNL, hypnose, thérapie brève, Martinique, relaxation, développement personnel, stress, émotions
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<!-- Practices Hero Section -->
<section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="fade-in">
                    <h1 class="section-title"><?php echo e(__('messages.practices.title')); ?></h1>
                    <p class="lead mb-4"><?php echo e(__('messages.practices.subtitle')); ?></p>
                    <blockquote class="blockquote">
                        <p class="mb-0">"<?php echo e(__('messages.practices.description')); ?>"</p>
                    </blockquote>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fade-in">
                    <div class="practices-image-slider">
                        <div class="slider-container">
                            <div class="slide active">
                                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                     alt="Sophrologie" class="img-fluid rounded-circle slider-image">
                            </div>
                            <div class="slide">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                     alt="PNL" class="img-fluid rounded-circle slider-image">
                            </div>
                            <div class="slide">
                                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                     alt="Hypnose" class="img-fluid rounded-circle slider-image">
                            </div>
                        </div>
                        <div class="slider-dots">
                            <span class="dot active" data-slide="0"></span>
                            <span class="dot" data-slide="1"></span>
                            <span class="dot" data-slide="2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Approach Section -->
<section class="section-padding" style="background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="fade-in text-center mb-5">
                    <h2 class="section-title"><?php echo e(__('messages.practices.approach.title')); ?></h2>
                </div>
                
                <div class="approach-steps">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="approach-step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5><?php echo e(app()->getLocale() === 'fr' ? 'Première rencontre' : 'First meeting'); ?></h5>
                                    <p><?php echo e(app()->getLocale() === 'fr' ? 'Nous prenons le temps d\'échanger sur ce que vous traversez. Sans pression, juste de l\'écoute.' : 'We take the time to discuss what you are going through. Without pressure, just listening.'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="approach-step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5><?php echo e(app()->getLocale() === 'fr' ? 'Un objectif clair' : 'A clear goal'); ?></h5>
                                    <p><?php echo e(app()->getLocale() === 'fr' ? 'Ensemble nous définissons ce que vous souhaitez transformer.' : 'Together we define what you wish to transform.'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="approach-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5><?php echo e(app()->getLocale() === 'fr' ? 'À votre rythme' : 'At your own pace'); ?></h5>
                                    <p><?php echo e(app()->getLocale() === 'fr' ? 'Pas de formule magique, juste des outils concrets, une présence bienveillante et le respect de qui vous êtes.' : 'No magic formula, just concrete tools, a caring presence, and respect for who you are.'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="approach-step">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h5><?php echo e(app()->getLocale() === 'fr' ? 'Un espace sécurisé' : 'A safe space'); ?></h5>
                                    <p><?php echo e(app()->getLocale() === 'fr' ? 'Tout ce que vous partagez reste confidentiel – ce moment vous appartient.' : 'Everything you share remains confidential – this moment is yours.'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="approach-step approach-step-centered">
                                <div class="step-number">5</div>
                                <div class="step-content">
                                    <h5><?php echo e(app()->getLocale() === 'fr' ? 'Une transformation en douceur' : 'Gentle transformation'); ?></h5>
                                    <p><?php echo e(app()->getLocale() === 'fr' ? 'Pas à pas, vous (re)découvrez vos ressources et votre liberté intérieure.' : 'Step by step, you (re)discover your resources and inner freedom.'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practices Section -->
<section class="section-padding" style="background-color: #F8E8EA;">
    <div class="container">
        <div class="row">
            <!-- Sophrology -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.practices.sophrology.title')); ?></h4>
                        </div>
                    </div>
                    <p class="practice-description mb-4"><?php echo e(__('messages.practices.sophrology.description')); ?></p>
                    
                    <div class="practice-benefits mb-4">
                        <h5><?php echo e(__('messages.practices.benefits')); ?>:</h5>
                        <ul class="practice-list">
                            <?php $__currentLoopData = __('messages.practices.sophrology.benefits'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($benefit); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    
                    <div class="practice-techniques">
                        <h5><?php echo e(__('messages.practices.techniques')); ?>:</h5>
                        <p class="small text-muted"><?php echo e(__('messages.practices.sophrology.techniques')); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- NLP -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.practices.nlp.title')); ?></h4>
                        </div>
                    </div>
                    <p class="practice-description mb-4"><?php echo e(__('messages.practices.nlp.description')); ?></p>
                    
                    <div class="practice-benefits mb-4">
                        <h5><?php echo e(__('messages.practices.benefits')); ?>:</h5>
                        <ul class="practice-list">
                            <?php $__currentLoopData = __('messages.practices.nlp.benefits'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($benefit); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    
                    <div class="practice-techniques">
                        <h5><?php echo e(__('messages.practices.techniques')); ?>:</h5>
                        <p class="small text-muted"><?php echo e(__('messages.practices.nlp.techniques')); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Hypnosis -->
            <div class="col-lg-4 mb-4">
                <div class="practice-card-textured h-100">
                    <div class="practice-card-body">
                        <div class="practice-icon-left">
                            <i class="fas fa-moon"></i>
                        </div>
                        <div class="practice-card-content">
                            <h4><?php echo e(__('messages.practices.hypnosis.title')); ?></h4>
                        </div>
                    </div>
                    <p class="practice-description mb-4"><?php echo e(__('messages.practices.hypnosis.description')); ?></p>
                    
                    <div class="practice-benefits mb-4">
                        <h5><?php echo e(__('messages.practices.benefits')); ?>:</h5>
                        <ul class="practice-list">
                            <?php $__currentLoopData = __('messages.practices.hypnosis.benefits'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($benefit); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    
                    <div class="practice-techniques">
                        <h5><?php echo e(__('messages.practices.techniques')); ?>:</h5>
                        <p class="small text-muted"><?php echo e(__('messages.practices.hypnosis.techniques')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Transformation Section -->
<section class="section-padding" style="background: var(--light-pink);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="fade-in text-center mb-5">
                    <h2 class="section-title"><?php echo e(__('messages.practices.transformation.title')); ?></h2>
                    <p class="lead"><?php echo e(__('messages.practices.transformation.subtitle')); ?></p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="practice-card-textured text-center">
                    <div class="practice-icon-center mb-4">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h4><?php echo e(__('messages.practices.transformation.multipack.title')); ?></h4>
                    <p><?php echo e(__('messages.practices.transformation.multipack.description')); ?></p>
                    
                    <div class="multipack-benefits mt-4">
                        <div class="row text-start">
                            <?php
                                $benefits = __('messages.practices.transformation.multipack.benefits');
                                $benefits = is_array($benefits) ? $benefits : ['Holistic approach', 'Faster results', 'Personalized blend', 'Lasting transformation'];
                            ?>
                            <?php $__currentLoopData = $benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <span><?php echo e($benefit); ?></span>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section-padding" style="background: white;">
    <div class="container text-center">
        <div class="fade-in">
            <h2 class="section-title"><?php echo e(__('messages.practices.cta.title')); ?></h2>
            <p class="lead mb-5"><?php echo e(__('messages.practices.cta.description')); ?></p>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-buttons">
                        <a href="<?php echo e(route('booking.index', app()->getLocale())); ?>" class="btn btn-primary btn-lg me-3 mb-3">
                            <i class="fas fa-calendar-check me-2"></i><?php echo e(__('messages.practices.cta.book')); ?>

                        </a>
                        <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="btn btn-outline-primary btn-lg mb-3">
                            <i class="fas fa-envelope me-2"></i><?php echo e(__('messages.practices.cta.contact')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('structured-data'); ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MedicalBusiness",
  "name": "SSJCHRYSALIDE",
  "description": "<?php echo e(__('messages.practices.description')); ?>",
  "url": "<?php echo e(url()->current()); ?>",
  "telephone": "+596 696 103 622",
  "email": "contact@ssjchrysalide.com",
    "address": {
        "@type": "PostalAddress",
    "addressRegion": "Martinique",
    "addressCountry": "FR"
  },
    "geo": {
        "@type": "GeoCoordinates",
    "latitude": "14.641528",
    "longitude": "-61.024174"
  },
  "medicalSpecialty": [
    "Sophrology",
    "Hypnotherapy", 
    "NLP Coaching"
  ],
  "serviceType": [
    "Brief Therapy",
    "Stress Management",
    "Personal Development"
  ]
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Ensure all containers match navbar width */
    .container {
        max-width: 1345px;
        margin: 0 auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .practices-image-slider {
        text-align: center;
        position: relative;
    }
    
    .slider-container {
        position: relative;
        width: 300px;
        height: 300px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
    }
    
    .slide {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .slide.active {
        opacity: 1;
    }
    
    .slider-image {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 15px 35px rgba(247, 178, 189, 0.3);
        transition: transform 0.3s ease;
    }
    
    .slider-image:hover {
        transform: scale(1.05);
    }
    
    .slider-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    
    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(247, 178, 189, 0.4);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .dot.active {
        background-color: var(--primary-pink);
    }
    
    .dot:hover {
        background-color: rgba(247, 178, 189, 0.8);
    }
    
    .blockquote {
        border-left: 4px solid var(--primary-pink);
        padding-left: 20px;
        font-style: italic;
        font-size: 1.2rem;
        color: var(--text-dark);
        margin: 2rem 0;
    }
    
    /* Light practice card: white background, black border, no shadows */
    .practice-card-textured {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        text-align: left;
        border: 1px solid #000000;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease;
        color: var(--text-dark);
    }

    .practice-card-textured::before {
        /* very subtle paper grain */
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: repeating-linear-gradient(
            45deg,
            rgba(0,0,0,0.01),
            rgba(0,0,0,0.01) 12px,
            rgba(255,255,255,0.01) 12px,
            rgba(255,255,255,0.01) 24px
        );
        opacity: 0.08;
        pointer-events: none;
    }

    .practice-card-textured:hover {
        transform: translateY(-4px);
        border-color: rgba(0,0,0,0.85);
    }

    /* Icon: black glyph on transparent background (no heavy white circle), no shadow */
    .practice-icon-left {
        width: 60px;
        height: 60px;
        background: transparent;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #000000;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
        box-shadow: none;
    }

    .practice-card-textured h4 {
        color: #1e1d1dff;
        font-weight: 600;
        font-size: 1.3rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .practice-card-textured h5 {
        color: #1e1d1dff;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .practice-card-textured p {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .practice-card-textured .small {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    /* Layout: icon left, content right */
    .practice-card-body {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 20px;
    }

    .practice-card-content {
        flex: 1 1 auto;
    }

    .practice-list {
        list-style: none;
        padding-left: 0;
        position: relative;
        z-index: 1;
    }

    .practice-list li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
        color: #6c757d;
    }

    .practice-list li:before {
        content: "✨";
        position: absolute;
        left: 0;
        color: #F7B2BD;
    }
    
    /* Centered icon for transformation section */
    .practice-icon-center {
        width: 80px;
        height: 80px;
        background: rgba(247, 178, 189, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #D63384;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    .multipack-benefits .fas {
        font-size: 1rem;
    }
    
    .cta-buttons .btn {
        min-width: 200px;
    }
    
    /* Approach Steps Styling */
    .approach-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .approach-step {
        background: linear-gradient(145deg, #fff 0%, #fef8f9 100%);
        border: 2px solid rgba(247, 178, 189, 0.2);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .approach-step::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            135deg,
            rgba(247, 178, 189, 0.05) 0%,
            rgba(215, 51, 132, 0.05) 100%
        );
        pointer-events: none;
    }

    .approach-step:hover {
        transform: translateY(-8px);
        border-color: rgba(247, 178, 189, 0.4);
        box-shadow: 0 15px 35px rgba(247, 178, 189, 0.15);
    }

    .approach-step-number {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-pink) 0%, #D63384 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 auto 1.5rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 25px rgba(247, 178, 189, 0.3);
    }

    .approach-step h4 {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .approach-step p {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    /* Responsive grid for approach steps */
    @media (max-width: 991px) {
        .approach-steps {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .approach-step {
            padding: 1.5rem;
        }
        
        .approach-step-number {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 767px) {
        .practice-card-body {
            flex-direction: column;
            gap: 12px;
        }
        .practice-icon-left {
            width: 56px;
            height: 56px;
            font-size: 1.6rem;
        }
        
        .cta-buttons .btn {
            min-width: auto;
            width: 100%;
        }
        
        .slider-container {
            width: 250px;
            height: 250px;
        }
        
        .slider-image {
            width: 250px;
            height: 250px;
        }
        
        .approach-steps {
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .approach-step {
            padding: 1.5rem;
        }
        
        .approach-step-number {
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
        }
        
        .approach-step h4 {
            font-size: 1.1rem;
        }
        
        .approach-step p {
            font-size: 0.9rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Show current slide
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        
        currentSlide = index;
    }

    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function startSlideshow() {
        slideInterval = setInterval(nextSlide, 4000); // Change slide every 4 seconds
    }

    function stopSlideshow() {
        clearInterval(slideInterval);
    }

    // Add click event to dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            stopSlideshow();
            startSlideshow(); // Restart the slideshow
        });
    });

    // Pause slideshow on hover
    const sliderContainer = document.querySelector('.practices-image-slider');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', stopSlideshow);
        sliderContainer.addEventListener('mouseleave', startSlideshow);
    }

    // Start the slideshow
    startSlideshow();
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/practices.blade.php ENDPATH**/ ?>