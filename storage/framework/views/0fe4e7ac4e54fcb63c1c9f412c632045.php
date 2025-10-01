<!-- Location Selection Modal -->
<div class="modal fade" id="locationSelectionModal" tabindex="-1" aria-labelledby="locationSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationSelectionModalLabel">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <?php echo e(__('messages.booking.location.modal.title')); ?>

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">
                    <?php echo e(__('messages.booking.location.modal.subtitle')); ?>

                </p>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="location-card" onclick="selectLocation('fort-de-france')">
                            <div class="location-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h6><?php echo e(__('messages.booking.location.fort_de_france')); ?></h6>
                            <p class="text-muted">Centre-ville de Fort-de-France</p>
                            <button type="button" class="btn btn-primary btn-sm">
                                <?php echo e(__('messages.booking.location.choose')); ?>

                            </button>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="location-card" onclick="selectLocation('riviere-salee')">
                            <div class="location-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <h6><?php echo e(__('messages.booking.location.riviere_salee')); ?></h6>
                            <p class="text-muted">Cabinet à Rivière Salée</p>
                            <button type="button" class="btn btn-primary btn-sm">
                                <?php echo e(__('messages.booking.location.choose')); ?>

                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        <?php echo e(__('messages.booking.location.info')); ?>

                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?php echo e(__('messages.booking.location.cancel')); ?>

                </button>
                <a href="<?php echo e(route('booking.index', app()->getLocale())); ?>" class="btn btn-outline-primary">
                    <i class="fas fa-form me-1"></i>
                    <?php echo e(__('messages.booking.location.classic_form')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

<style>
.location-card {
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 100%;
}

.location-card:hover {
    border-color: var(--primary-color);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.location-icon {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.location-card h6 {
    color: var(--dark-color);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.location-card p {
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.location-card .btn {
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.location-card:hover .btn {
    opacity: 1;
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