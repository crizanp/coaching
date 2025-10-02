

<?php $__env->startSection('page-title', 'Application Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Application Details</h2>
            <p class="text-muted"><?php echo e($application->name); ?> • <?php echo e($application->event->title); ?></p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.event-applications.edit', $application)); ?>" class="btn-admin btn-admin-primary">
                <i class="fas fa-edit"></i>
                Edit Application
            </a>
            <a href="<?php echo e(route('admin.event-applications.index')); ?>" class="btn-admin btn-admin-outline">
                <i class="fas fa-arrow-left"></i>
                Back to Applications
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Participant Information -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user me-2"></i>
                        Participant Information
                    </h3>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" width="120">Name:</td>
                                <td><?php echo e($application->name); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email:</td>
                                <td>
                                    <a href="mailto:<?php echo e($application->email); ?>"><?php echo e($application->email); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Phone:</td>
                                <td>
                                    <?php if($application->phone): ?>
                                        <a href="tel:<?php echo e($application->phone); ?>"><?php echo e($application->phone); ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">Not provided</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Company:</td>
                                <td><?php echo e($application->company ?: 'Not provided'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" width="120">Status:</td>
                                <td>
                                    <span class="badge bg-<?php echo e($application->status === 'confirmed' ? 'success' : ($application->status === 'pending' ? 'warning' : ($application->status === 'cancelled' ? 'danger' : ($application->status === 'waitlist' ? 'info' : 'secondary')))); ?> fs-6">
                                        <?php echo e(ucfirst($application->status)); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Applied:</td>
                                <td><?php echo e($application->created_at->format('F d, Y \a\t g:i A')); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Updated:</td>
                                <td><?php echo e($application->updated_at->format('F d, Y \a\t g:i A')); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">IP Address:</td>
                                <td><?php echo e($application->ip_address ?: 'Not recorded'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Event Information -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Event Information
                    </h3>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex">
                            <?php if($application->event->featured_image): ?>
                                <img src="<?php echo e(asset('storage/' . $application->event->featured_image)); ?>" 
                                     alt="<?php echo e($application->event->title); ?>" 
                                     class="rounded me-3" style="width: 100px; height: 80px; object-fit: cover;">
                            <?php endif; ?>
                            <div>
                                <h5 class="mb-1">
                                    <a href="<?php echo e(route('admin.events.show', $application->event)); ?>">
                                        <?php echo e($application->event->title); ?>

                                    </a>
                                </h5>
                                <p class="text-muted mb-2"><?php echo e($application->event->getTranslation('description', 'fr')); ?></p>
                                <div class="d-flex gap-3">
                                    <?php if($application->event->event_date): ?>
                                        <span><i class="fas fa-calendar text-muted me-1"></i><?php echo e($application->event->event_date->format('M d, Y')); ?></span>
                                    <?php endif; ?>
                                    <?php if($application->event->getTranslation('location', 'fr')): ?>
                                        <span><i class="fas fa-map-marker-alt text-muted me-1"></i><?php echo e($application->event->getTranslation('location', 'fr')); ?></span>
                                    <?php endif; ?>
                                    <?php if($application->event->price): ?>
                                        <span><i class="fas fa-euro-sign text-muted me-1"></i>€<?php echo e(number_format($application->event->price, 2)); ?></span>
                                    <?php else: ?>
                                        <span><i class="fas fa-euro-sign text-muted me-1"></i>On estimate</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-end">
                            <div class="mb-2">
                                <span class="badge bg-<?php echo e($application->event->status === 'active' ? 'success' : ($application->event->status === 'upcoming' ? 'primary' : ($application->event->status === 'completed' ? 'secondary' : ($application->event->status === 'cancelled' ? 'danger' : 'warning')))); ?>">
                                    <?php echo e(ucfirst($application->event->status)); ?>

                                </span>
                            </div>
                            <div class="text-muted">
                                <small>
                                    <?php echo e($application->event->applications()->where('status', 'confirmed')->count()); ?> confirmed
                                    <?php if($application->event->max_participants): ?>
                                        / <?php echo e($application->event->max_participants); ?> max
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Message -->
            <?php if($application->message): ?>
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-comment me-2"></i>
                            Application Message
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="bg-light rounded p-3">
                            <?php echo nl2br(e($application->message)); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Admin Notes -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-sticky-note me-2"></i>
                        Admin Notes
                    </h3>
                </div>
                <div class="card-body">
                    <?php if($application->notes): ?>
                        <div class="bg-warning bg-opacity-10 border border-warning rounded p-3 mb-3">
                            <?php echo nl2br(e($application->notes)); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('admin.event-applications.update-notes', $application)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="mb-3">
                            <textarea name="notes" class="form-control" rows="3" 
                                      placeholder="Add admin notes about this application..."><?php echo e($application->notes); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Notes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Activity Log -->
            <?php if($application->status_updated_at || $application->confirmed_at): ?>
                <div class="admin-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history me-2"></i>
                            Activity Log
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Application Submitted</h6>
                                    <p class="text-muted mb-0"><?php echo e($application->created_at->format('F d, Y \a\t g:i A')); ?></p>
                                </div>
                            </div>
                            
                            <?php if($application->status_updated_at && $application->status_updated_at != $application->created_at): ?>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-<?php echo e($application->status === 'confirmed' ? 'success' : ($application->status === 'cancelled' ? 'danger' : 'warning')); ?>"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Status Updated to <?php echo e(ucfirst($application->status)); ?></h6>
                                        <p class="text-muted mb-0"><?php echo e($application->status_updated_at->format('F d, Y \a\t g:i A')); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if($application->confirmed_at): ?>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Application Confirmed</h6>
                                        <p class="text-muted mb-0"><?php echo e($application->confirmed_at->format('F d, Y \a\t g:i A')); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <?php if($application->status !== 'confirmed'): ?>
                            <form method="POST" action="<?php echo e(route('admin.event-applications.update-status', $application)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check"></i>
                                    Confirm Application
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if($application->status !== 'cancelled'): ?>
                            <form method="POST" action="<?php echo e(route('admin.event-applications.update-status', $application)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-danger w-100" 
                                        onclick="return confirm('Are you sure you want to cancel this application?')">
                                    <i class="fas fa-times"></i>
                                    Cancel Application
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if($application->status !== 'waitlist'): ?>
                            <form method="POST" action="<?php echo e(route('admin.event-applications.update-status', $application)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="hidden" name="status" value="waitlist">
                                <button type="submit" class="btn btn-info w-100">
                                    <i class="fas fa-clock"></i>
                                    Move to Waitlist
                                </button>
                            </form>
                        <?php endif; ?>

                        <hr>

                        <form method="POST" action="<?php echo e(route('admin.event-applications.send-confirmation', $application)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="fas fa-envelope"></i>
                                Send Confirmation Email
                            </button>
                        </form>

                        <a href="mailto:<?php echo e($application->email); ?>" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-envelope-open"></i>
                            Email Participant
                        </a>

                        <?php if($application->phone): ?>
                            <a href="tel:<?php echo e($application->phone); ?>" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-phone"></i>
                                Call Participant
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Application Summary -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Summary
                    </h3>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Application ID</span>
                            <span class="badge bg-light text-dark"><?php echo e($application->id); ?></span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Status</span>
                            <span class="badge bg-<?php echo e($application->status === 'confirmed' ? 'success' : ($application->status === 'pending' ? 'warning' : ($application->status === 'cancelled' ? 'danger' : ($application->status === 'waitlist' ? 'info' : 'secondary')))); ?>">
                                <?php echo e(ucfirst($application->status)); ?>

                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Has Message</span>
                            <span class="badge bg-<?php echo e($application->message ? 'primary' : 'secondary'); ?>">
                                <?php echo e($application->message ? 'Yes' : 'No'); ?>

                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Has Notes</span>
                            <span class="badge bg-<?php echo e($application->notes ? 'warning' : 'secondary'); ?>">
                                <?php echo e($application->notes ? 'Yes' : 'No'); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Statistics -->
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Event Statistics
                    </h3>
                </div>
                <div class="card-body">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($application->event->applications()->count()); ?></div>
                            <div class="stat-label">Total Applications</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($application->event->applications()->where('status', 'confirmed')->count()); ?></div>
                            <div class="stat-label">Confirmed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($application->event->applications()->where('status', 'pending')->count()); ?></div>
                            <div class="stat-label">Pending</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo e($application->event->applications()->where('status', 'cancelled')->count()); ?></div>
                            <div class="stat-label">Cancelled</div>
                        </div>
                    </div>

                    <?php if($application->event->max_participants): ?>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Capacity</span>
                                <span class="text-muted">
                                    <?php echo e($application->event->applications()->where('status', 'confirmed')->count()); ?>/<?php echo e($application->event->max_participants); ?>

                                </span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: <?php echo e(($application->event->applications()->where('status', 'confirmed')->count() / $application->event->max_participants) * 100); ?>%">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -25px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primary-color);
}

.stat-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-top: 0.25rem;
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/event-applications/show.blade.php ENDPATH**/ ?>