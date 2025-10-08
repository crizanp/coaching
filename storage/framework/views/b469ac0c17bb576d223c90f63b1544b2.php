

<?php $__env->startSection('title'); ?>
    <?php echo e(__('messages.events.title')); ?> - <?php echo e(\App\Models\Setting::get('site_name')[app()->getLocale()] ?? 'SSJCHRYSALIDE'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
    <?php echo e(__('messages.events.description')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('keywords'); ?>
    atelier, événement, groupe, émotions, communication, partage, Martinique, développement personnel
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Events Hero Section -->
    <section class="section-padding" style="background: var(--light-pink); margin-top: 94px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="fade-in">
                        <div class="hero-icon mb-4">
                            <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--primary-pink);"></i>
                        </div>
                        <h1 class="section-title"><?php echo e(__('messages.events.hero.title')); ?></h1>
                        <p class="lead mb-4"><?php echo e(__('messages.events.hero.subtitle')); ?></p>
                        <!-- Workshop Highlights (moved to its own white section) -->
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="past-event-card mb-4 fade-in position-relative">
                        <div class="past-event-photo" aria-hidden="true">
                            <img src="<?php echo e(asset('images/assets/julyworkshop.png')); ?>" alt="July Workshop" class="img-fluid">
                            <div class="price-badge">20€</div>
                        </div>

                        <div class="past-event-body text-center">
                            <div class="past-event-meta">
                                <div class="past-event-title"><?php echo e(__('messages.events.past.title')); ?></div>
                                <div class="past-event-sub"><?php echo e(__('messages.events.past.subtitle')); ?></div>
                            </div>

                            <ul class="past-event-list mx-auto" style="max-width:640px;">
                                <li><?php echo e(__('messages.events.past.intro')); ?></li>
                                <li>– <?php echo e(__('messages.events.past.benefit1')); ?></li>
                                <li>– <?php echo e(__('messages.events.past.benefit2')); ?></li>
                                <li>– <?php echo e(__('messages.events.past.benefit3')); ?></li>
                            </ul>

                            <div class="past-event-cta d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm vvv-open-detail"><?php echo e(__('messages.events.past.detail_button')); ?></button>
                                <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="btn btn-primary btn-sm"><?php echo e(__('messages.events.contact_us')); ?></a>
                            </div>

                            <div class="past-event-note mt-3 text-success"><?php echo e(__('messages.events.past.note_completed')); ?></div>
                        </div>

                        <div class="past-event-mark"><?php echo e(__('messages.events.past.past_mark')); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Past Event Detail Modal -->
        <div class="vvv-modal" id="vvv-modal" aria-hidden="true">
            <div class="vvv-modal-backdrop" data-close></div>
            <div class="vvv-modal-panel" role="dialog" aria-modal="true" aria-labelledby="vvv-modal-title">
                <button class="vvv-modal-close" aria-label="Fermer" data-close>&times;</button>

                <div class="vvv-modal-grid">
                    <div class="vvv-modal-image">
                        <img src="<?php echo e(asset('images/assets/julyworkshop.png')); ?>" alt="event image" id="vvv-modal-image">
                        <div class="vvv-modal-price" id="vvv-modal-price">20€</div>
                    </div>
                    <div class="vvv-modal-content text-left">
                        <h3 id="vvv-modal-title"><?php echo e(__('messages.events.past.title')); ?></h3>
                        <p class="text-muted mb-3" id="vvv-modal-sub"><?php echo e(__('messages.events.past.subtitle')); ?></p>

                        <div id="vvv-modal-description">
                            <p><?php echo e(__('messages.events.past.intro')); ?></p>
                            <ul class="past-event-list mb-3">
                                <li><?php echo e(__('messages.events.past.benefit1')); ?></li>
                                <li><?php echo e(__('messages.events.past.benefit2')); ?></li>
                                <li><?php echo e(__('messages.events.past.benefit3')); ?></li>
                            </ul>

                            <p class="text-success"><strong><?php echo e(__('messages.events.past.note_completed')); ?></strong></p>
                            <p><?php echo e(__('messages.events.past.more_info')); ?></p>
                        </div>

                        <div class="vvv-modal-actions">
                            <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="btn btn-primary me-2"><?php echo e(__('messages.events.contact_us')); ?></a>
                            <button class="btn btn-outline-secondary" data-close><?php echo e(__('messages.common.close')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workshop Highlights Full White Row
    <section class="section-padding" style="background: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="highlight-card">
                        <h3 class="mb-4" style="color: var(--primary-pink); font-weight: 600;">
                            <i class="fas fa-sparkles me-2"></i>
                            Ateliers riches en découvertes
                        </h3>
                        <p class="mb-4" style="font-size: 1.1rem; color: #6c757d;">
                            Chacun repart avec les clés pour mieux vivre ses relations
                        </p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="highlight-item">
                                    <i class="fas fa-heart mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                    <h5 style="color: var(--text-dark); font-weight: 600;">Reconnaître</h5>
                                    <p class="mb-0" style="color: #6c757d;">ses émotions et les accueillir</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="highlight-item">
                                    <i class="fas fa-search mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                    <h5 style="color: var(--text-dark); font-weight: 600;">Comprendre</h5>
                                    <p class="mb-0" style="color: #6c757d;">les besoins cachés derrière</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="highlight-item">
                                    <i class="fas fa-comments mb-3" style="color: var(--primary-pink); font-size: 2rem;"></i>
                                    <h5 style="color: var(--text-dark); font-weight: 600;">Communiquer</h5>
                                    <p class="mb-0" style="color: #6c757d;">avec vos proches et collègues</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

        <!-- Upcoming Workshops Section -->
        <?php if($upcomingWorkshops->count() > 0): ?>
            <section class="section-padding" style="background: var(--light-pink);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center mb-5 fade-in">
                                <h2 class="section-title"><?php echo e(__('messages.events.upcoming.title')); ?></h2>
                                <p class="lead mb-4"><?php echo e(__('messages.events.upcoming.subtitle')); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php $__currentLoopData = $upcomingWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 mb-4">
                                <div class="practice-card-textured h-100">
                                    <div class="position-relative">
                                        <?php if($event->featured_image && file_exists(storage_path('app/public/' . $event->featured_image))): ?>
                                            <div class="practice-image">
                                                <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>"
                                                    alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
                                                    class="w-100"
                                                    style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="badge bg-success position-absolute top-0 end-0 m-3">
                                            <?php echo e(__('messages.events.status.upcoming')); ?>

                                        </div>
                                    </div>

                                    <div class="practice-card-body">
                                        <div class="practice-icon-left">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="practice-card-content">
                                            <h4><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h4>
                                        </div>
                                    </div>

                                    <p class="service-description mb-4">
                                        <?php echo e(Str::limit($event->getLocalizedTranslation('description', app()->getLocale()), 100)); ?>

                                    </p>

                                    <div class="service-details mb-4">
                                        <?php if($event->event_date): ?>
                                            <div class="service-detail-item mb-2">
                                                <strong><?php echo e(__('messages.events.date')); ?>:</strong>
                                                <?php echo e($event->event_date->format('d/m/Y H:i')); ?>

                                            </div>
                                        <?php endif; ?>

                                        <?php if($event->max_participants): ?>
                                            <div class="service-detail-item mb-2">
                                                <strong><?php echo e(__('messages.events.spots_available')); ?>:</strong>
                                                <?php echo e($event->available_spots); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="service-detail-item mb-2">
                                            <strong><?php echo e(__('messages.events.price')); ?>:</strong>
                                            <?php if($event->price): ?>
                                                <?php echo e(number_format((float) $event->price, 2)); ?>€
                                            <?php else: ?>
                                                <?php echo e(__('messages.events.tba')); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="service-actions">
                                        <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>"
                                            class="btn btn-outline-primary btn-sm me-2 mb-2">
                                            <?php echo e(__('messages.events.learn_more')); ?>

                                        </a>
                                        <?php if($event->can_register): ?>
                                            <a href="<?php echo e(route('events.apply', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>"
                                                class="btn btn-primary btn-sm mb-2">
                                                <i class="fas fa-user-plus me-1"></i><?php echo e(__('messages.events.register')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <!-- No Upcoming Workshops Notice -->
            <section class="section-padding" style="background: var(--light-pink);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center fade-in">
                                <i class="fas fa-calendar-times mb-4"
                                    style="font-size: 3rem; color: var(--warm-gray); opacity: 0.6;"></i>
                                <h3 class="mb-3"><?php echo e(__('messages.events.no_upcoming.title')); ?></h3>
                                <p class="lead mb-4"><?php echo e(__('messages.events.no_upcoming.description')); ?></p>
                                <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>" class="btn btn-primary btn-lg">
                                    <i class="fas fa-envelope me-2"></i><?php echo e(__('messages.events.no_upcoming.contact')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Workshop On Demand Section -->
        <?php if($activeWorkshops->count() > 0): ?>
            <section class="section-padding" style="background: white;">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center mb-5 fade-in">
                                <h2 class="section-title"><?php echo e(__('messages.events.workshops.title')); ?></h2>
                                <p class="lead mb-4"><?php echo e(__('messages.events.workshops.subtitle')); ?></p>

                                <!-- Workshop Benefits Banner -->

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php $__currentLoopData = $activeWorkshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6 mb-4">
                                <div class="practice-card-textured h-100">
                                    <div class="position-relative">
                                        <?php if($event->featured_image && file_exists(storage_path('app/public/' . $event->featured_image))): ?>
                                            <div class="practice-image">
                                                <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>"
                                                    alt="<?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?>"
                                                    class="w-100"
                                                    style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="badge bg-info position-absolute top-0 end-0 m-3">
                                            <?php echo e(__('messages.events.status.on_demand')); ?>

                                        </div>
                                    </div>

                                    <div class="practice-card-body">
                                        <div class="practice-icon-left">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="practice-card-content">
                                            <h4><?php echo e($event->getLocalizedTranslation('title', app()->getLocale())); ?></h4>
                                        </div>
                                    </div>

                                    <p class="service-description mb-4">
                                        <?php echo e($event->getLocalizedTranslation('description', app()->getLocale())); ?></p>

                                    <?php if($event->gallery && (is_array($event->gallery) ? count($event->gallery) : !empty($event->gallery)) > 0): ?>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-2">
                                                <i class="fas fa-images me-1"></i>
                                                <?php echo e(__('messages.events.gallery_available')); ?>

                                            </small>
                                        </div>
                                    <?php endif; ?>

                                    <div class="service-details mb-4">
                                        <?php if($event->duration): ?>
                                            <div class="service-detail-item mb-2">
                                                <strong><?php echo e(__('messages.events.duration')); ?>:</strong> <?php echo e($event->duration); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="service-detail-item mb-2">
                                            <strong><?php echo e(__('messages.events.price')); ?>:</strong>
                                            <?php if($event->price): ?>
                                                <?php echo e(number_format((float) $event->price, 2)); ?>€
                                            <?php else: ?>
                                                <?php echo e(__('messages.events.tba')); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="service-actions">
                                        <a href="<?php echo e(route('events.show', ['locale' => app()->getLocale(), 'event' => $event->slug])); ?>"
                                            class="btn btn-outline-primary btn-sm me-2 mb-2">
                                            <?php echo e(__('messages.events.learn_more')); ?>

                                        </a>
                                        <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>"
                                            class="btn btn-primary btn-sm mb-2">
                                            <i class="fas fa-envelope me-1"></i><?php echo e(__('messages.events.request')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Call to Action Section -->
        <section class="section-padding" style="background: var(--light-pink);">
            <div class="container text-center">
                <div class="fade-in">
                    <h2 class="section-title"><?php echo e(__('messages.events.cta.title')); ?></h2>
                    <p class="lead mb-5"><?php echo e(__('messages.events.cta.description')); ?></p>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="cta-buttons">
                                <a href="<?php echo e(route('contact.index', app()->getLocale())); ?>"
                                    class="btn btn-primary btn-lg me-3 mb-3">
                                    <i class="fas fa-envelope me-2"></i><?php echo e(__('messages.events.cta.contact')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $__env->startPush('structured-data'); ?>
            
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('styles'); ?>
            <style>
                /* Core card styles */
                .practice-card-textured { background: #ffffff; border-radius: 20px; padding: clamp(22px, 3vw, 30px); text-align: left; border: 1px solid rgba(0,0,0,0.06); position: relative; overflow: hidden; transition: transform 0.25s ease; color: var(--text-dark); }
                .practice-card-textured::before { content: ''; position: absolute; inset: 0; background-image: repeating-linear-gradient(45deg, rgba(0,0,0,0.01) 0, rgba(0,0,0,0.01) 12px, rgba(255,255,255,0.01) 12px, rgba(255,255,255,0.01) 24px); opacity: 0.06; pointer-events: none; }
                .practice-card-textured:hover { transform: translateY(-4px); border-color: rgba(0,0,0,0.12); }

                .practice-card-textured h4 { color: #1e1d1d; font-weight: 600; font-size: clamp(1.15rem, 2.2vw, 1.3rem); margin-bottom: 15px; }
                .practice-card-body { display:flex; gap:16px; align-items:center; margin-bottom:20px; }
                .practice-card-content { flex:1; }
                .practice-icon-left { width:60px; height:60px; display:flex; align-items:center; justify-content:center; border-radius:50%; font-size:1.8rem; color:#000; }

                .service-description { color:#6c757d; font-size:clamp(0.95rem,2.1vw,1rem); line-height:1.7; margin-bottom:20px; }
                .service-detail-item { color:#6c757d; font-size:clamp(0.9rem,2vw,0.95rem); }

                /* Past Event Card */
                .past-event-card { display:flex; gap:22px; align-items:stretch; background: linear-gradient(180deg,#ffffff,#fffafc); border-radius:18px; padding:18px; box-shadow:0 12px 30px rgba(16,24,40,0.06); border:1px solid rgba(0,0,0,0.06); }
                .past-event-photo { flex:0 0 260px; border-radius:14px; overflow:hidden; position:relative; }
                .past-event-photo img { width:100%; height:100%; object-fit:cover; display:block; }
                .price-badge { position:absolute; left:12px; bottom:12px; background: linear-gradient(90deg,var(--primary-pink),#ff8aa3); color:#fff; padding:8px 12px; border-radius:999px; font-weight:700; }
                .past-event-body { flex:1 1 auto; display:flex; flex-direction:column; justify-content:space-between; }
                .past-event-title { font-size:1.25rem; font-weight:700; color:var(--text-dark); margin-bottom:6px; }
                .past-event-sub { color:#6c757d; font-size:0.95rem; margin-bottom:12px; }
                .past-event-list { list-style:none; padding:0; margin:0 0 14px 0; color:#495057; }
                .past-event-list li { padding:6px 0; border-bottom:1px dashed rgba(0,0,0,0.03); }
                .past-event-cta .btn { border-radius:10px; }

                @media (max-width:991px){ .past-event-card{ flex-direction:column; } .past-event-photo{ width:100%; height:220px; } }

                /* Modal styles */
                .vvv-modal{ display:none; position:fixed; inset:0; z-index:1100; }
                .vvv-modal[aria-hidden="false"]{ display:block; }
                .vvv-modal-backdrop{ position:absolute; inset:0; background:rgba(8,10,14,0.55); backdrop-filter:blur(3px); }
                .vvv-modal-panel{ position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); width:min(1100px,calc(100% - 40px)); background:#fff; border-radius:14px; overflow:hidden; box-shadow:0 30px 80px rgba(2,6,23,0.35); }
                .vvv-modal-close{ position:absolute; right:12px; top:8px; z-index:3; border:none; background:transparent; font-size:2rem; color:#333; }
                .vvv-modal-grid{ display:grid; grid-template-columns:380px 1fr; gap:22px; padding:28px; align-items:start; }
                .vvv-modal-image{ position:relative; border-radius:10px; overflow:hidden; }
                .vvv-modal-image img{ width:100%; height:100%; object-fit:cover; display:block; }
                .vvv-modal-price{ position:absolute; left:12px; bottom:12px; background:var(--primary-pink); color:#fff; padding:8px 12px; border-radius:999px; font-weight:700; }
                .vvv-modal-content h3{ margin-top:0; margin-bottom:8px; font-size:1.4rem; }
                .vvv-modal-content p{ color:#6c757d; }
                .vvv-modal-actions{ margin-top:18px; }
                @media (max-width:767px){ .vvv-modal-grid{ grid-template-columns:1fr; } .vvv-modal-image{ height:210px; } }
                /* Centering and special mark */
                .past-event-card { text-align: center; }
                .past-event-body { align-items: center; }
                .past-event-list { margin-left: 0; }
                .past-event-mark { position: absolute; right: 18px; top: 18px; background: rgba(0,0,0,0.06); color: #333; padding: 6px 10px; border-radius: 8px; font-weight:600; font-size:0.85rem; }
                .past-event-note { font-weight:600; }
            </style>
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('scripts'); ?>
            <script>
                (function(){
                    function qs(sel, ctx){ return (ctx||document).querySelector(sel); }
                    function qsa(sel, ctx){ return Array.from((ctx||document).querySelectorAll(sel)); }

                    const modal = qs('#vvv-modal');
                    if(!modal) return;

                    const modalImage = qs('#vvv-modal-image');
                    const modalTitle = qs('#vvv-modal-title');
                    const modalSub = qs('#vvv-modal-sub');
                    const modalList = qs('#vvv-modal-list');
                    const modalPrice = qs('#vvv-modal-price');

                    function openModalFromCard(card){
                        try{
                            const img = card.querySelector('.past-event-photo img');
                            const title = card.querySelector('.past-event-title');
                            const sub = card.querySelector('.past-event-sub');
                            const items = card.querySelectorAll('.past-event-list li');
                            const price = card.querySelector('.price-badge');

                            if(img && modalImage) modalImage.src = img.src;
                            if(title && modalTitle) modalTitle.textContent = title.textContent.trim();
                            if(sub && modalSub) modalSub.textContent = sub.textContent.trim();
                            if(price && modalPrice) modalPrice.textContent = price.textContent.trim();

                            if(modalList){ modalList.innerHTML = ''; items.forEach(li => modalList.appendChild(li.cloneNode(true))); }

                            modal.setAttribute('aria-hidden','false');
                            document.documentElement.style.overflow = 'hidden';
                        }catch(e){ console.error(e); }
                    }

                    function closeModal(){ modal.setAttribute('aria-hidden','true'); document.documentElement.style.overflow = ''; }

                    qsa('.vvv-open-detail').forEach(btn => btn.addEventListener('click', function(e){ const card = e.target.closest('.past-event-card'); if(card) openModalFromCard(card); }));
                    qsa('[data-close]').forEach(el => el.addEventListener('click', closeModal));
                    document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });
                })();
            </script>
        <?php $__env->stopPush(); ?>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/events/index.blade.php ENDPATH**/ ?>