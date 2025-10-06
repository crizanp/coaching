<!-- Location Selection Modal -->
<div class="modal fade" id="locationSelectionModal" tabindex="-1" aria-labelledby="locationSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content location-modal">
            <div class="modal-header border-0 pb-0">
                <div class="d-flex justify-content-between align-items-start w-100 gap-3">
                    <div>
                        <h5 class="modal-title d-flex align-items-center gap-2 mb-2" id="locationSelectionModalLabel">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <?php echo e(__('messages.booking.location.modal.title')); ?>

                        </h5>
                        <p class="modal-subtitle text-muted mb-0">
                            <?php echo e(__('messages.booking.location.modal.subtitle')); ?>

                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body pt-4">
                <div class="location-options">
                    <button type="button" class="location-card" onclick="selectLocation('fort-de-france')">
                        <span class="location-icon location-icon-primary">
                            <i class="fas fa-building"></i>
                        </span>
                        <div class="location-content">
                            <h6 class="location-title"><?php echo e(__('messages.booking.location.fort_de_france')); ?></h6>
                            <p class="location-description"><?php echo e(__('messages.booking.location.fort_de_france_desc')); ?></p>
                        </div>
                        <span class="location-action">
                            <?php echo e(__('messages.booking.location.choose')); ?>

                            <i class="fas fa-chevron-right ms-2"></i>
                        </span>
                    </button>

                    <button type="button" class="location-card" onclick="selectLocation('riviere-salee')">
                        <span class="location-icon location-icon-success">
                            <i class="fas fa-home"></i>
                        </span>
                        <div class="location-content">
                            <h6 class="location-title"><?php echo e(__('messages.booking.location.riviere_salee')); ?></h6>
                            <p class="location-description"><?php echo e(__('messages.booking.location.riviere_salee_desc')); ?></p>
                        </div>
                        <span class="location-action">
                            <?php echo e(__('messages.booking.location.choose')); ?>

                            <i class="fas fa-chevron-right ms-2"></i>
                        </span>
                    </button>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?php echo e(__('messages.booking.location.cancel')); ?>

                </button>
                <a href="<?php echo e(route('booking.index', app()->getLocale())); ?>" class="btn btn-outline-primary">
                    <i class="fas fa-clipboard-list me-1"></i>
                    <?php echo e(__('messages.booking.location.classic_form')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

<style>
.location-modal {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.2);
}

.modal-subtitle {
    font-size: 0.95rem;
    line-height: 1.5;
}

.location-options {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.location-card {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.25rem 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    text-align: left;
    cursor: pointer;
    transition: all 0.25s ease;
    color: inherit;
}

.location-card:hover,
.location-card:focus {
    background: #ffffff;
    border-color: #cbd5f5;
    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
    transform: translateY(-2px);
}

.location-card:focus {
    outline: 3px solid rgba(59, 130, 246, 0.3);
    outline-offset: 2px;
}

.location-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 16px;
    font-size: 1.6rem;
}

.location-icon-primary {
    background: rgba(59, 130, 246, 0.12);
    color: #2563eb;
}

.location-icon-success {
    background: rgba(16, 185, 129, 0.12);
    color: #0f9d58;
}

.location-content {
    flex: 1;
}

.location-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #0f172a;
}

.location-description {
    margin: 0;
    color: #64748b;
    font-size: 0.9rem;
}

.location-action {
    display: inline-flex;
    align-items: center;
    font-weight: 600;
    color: #ec4899;
    transition: color 0.25s ease;
}

.location-card:hover .location-action {
    color: #db2777;
}

@media (max-width: 575px) {
    .modal-dialog {
        margin: 1rem;
    }

    .location-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .location-action {
        margin-top: 0.25rem;
    }
}
</style>

<script>
function selectLocation(location) {
    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    let serviceId = urlParams.get('service');
    
    // Check if serviceId was passed to the function
    if (window.selectedServiceId) {
        serviceId = window.selectedServiceId;
    }
    
    // Build the URL for the location-specific booking page
    let bookingUrl = `<?php echo e(url(app()->getLocale() . '/booking')); ?>/${location}`;
    
    // Add service parameter if it exists
    if (serviceId) {
        bookingUrl += `?service=${serviceId}`;
    }
    
    // Redirect to the location-specific booking page
    window.location.href = bookingUrl;
}

function openLocationModal(serviceId = null) {
    // Store service ID for use in selectLocation function
    if (serviceId) {
        window.selectedServiceId = serviceId;
    }
    
    const modal = new bootstrap.Modal(document.getElementById('locationSelectionModal'));
    modal.show();
}
</script><?php /**PATH D:\client-fiverr\coaching\resources\views/partials/location-selection-modal.blade.php ENDPATH**/ ?>