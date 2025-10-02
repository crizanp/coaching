

<?php $__env->startSection('page-title', $event->title); ?>

<?php $__env->startSection('content'); ?>
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><?php echo e($event->title); ?></h2>
            <p class="text-muted">
                <span class="badge bg-<?php echo e($event->status === 'active' ? 'success' : ($event->status === 'upcoming' ? 'primary' : ($event->status === 'completed' ? 'secondary' : ($event->status === 'cancelled' ? 'danger' : 'warning')))); ?>">
                    <?php echo e(ucfirst($event->status)); ?>

                </span>
                •
                <?php echo e($event->type ? ucfirst($event->type) : 'Workshop'); ?>

                <?php if($event->event_date): ?>
                    • <?php echo e($event->event_date->format('M d, Y')); ?>

                <?php endif; ?>
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="btn-admin btn-admin-primary">
                <i class="fas fa-edit"></i>
                Edit Event
            </a>
            <a href="<?php echo e(route('admin.events.index')); ?>" class="btn-admin btn-admin-outline">
                <i class="fas fa-arrow-left"></i>
                Back to Events
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Event Overview -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Event Overview
                    </h3>
                </div>

                <?php if($event->featured_image): ?>
                    <div class="mb-4">
                        <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                             alt="<?php echo e($event->title); ?>" class="img-fluid rounded">
                    </div>
                <?php endif; ?>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Description (French)</h5>
                        <p><?php echo e($event->getTranslation('description', 'fr')); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h5>Description (English)</h5>
                        <p><?php echo e($event->getTranslation('description', 'en') ?: 'Not available'); ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Content (French)</h5>
                        <div class="content-preview">
                            <?php echo nl2br(e($event->getTranslation('content', 'fr'))); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Content (English)</h5>
                        <div class="content-preview">
                            <?php echo $event->getTranslation('content', 'en') ? nl2br(e($event->getTranslation('content', 'en'))) : 'Not available'; ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Event Details
                    </h3>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold">Type:</td>
                                <td><?php echo e($event->type ? ucfirst($event->type) : 'Workshop'); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Duration:</td>
                                <td><?php echo e($event->duration ?: 'Variable'); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Price:</td>
                                <td>
                                    <?php if($event->price): ?>
                                        €<?php echo e(number_format($event->price, 2)); ?>

                                    <?php else: ?>
                                        On estimate
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Max Participants:</td>
                                <td><?php echo e($event->max_participants ?: 'Unlimited'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold">Event Date:</td>
                                <td><?php echo e($event->event_date ? $event->event_date->format('M d, Y H:i') : 'Not set'); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Registration Deadline:</td>
                                <td><?php echo e($event->registration_deadline ? $event->registration_deadline->format('M d, Y H:i') : 'Not set'); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Location (FR):</td>
                                <td><?php echo e($event->getTranslation('location', 'fr') ?: 'Not specified'); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Location (EN):</td>
                                <td><?php echo e($event->getTranslation('location', 'en') ?: 'Not specified'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Applications -->
            <div class="admin-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>
                        Applications (<?php echo e($event->applications()->count()); ?>)
                    </h3>
                    <?php if($event->applications()->count() > 0): ?>
                        <a href="<?php echo e(route('admin.event-applications.index', ['event' => $event->id])); ?>" class="btn btn-sm btn-primary">
                            Manage Applications
                        </a>
                    <?php endif; ?>
                </div>

                <?php if($event->applications()->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Applied</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $event->applications()->latest()->limit(10)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold"><?php echo e($application->name); ?></div>
                                        </td>
                                        <td><?php echo e($application->email); ?></td>
                                        <td><?php echo e($application->phone ?: '-'); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($application->status === 'confirmed' ? 'success' : ($application->status === 'pending' ? 'warning' : ($application->status === 'cancelled' ? 'danger' : 'secondary'))); ?>">
                                                <?php echo e(ucfirst($application->status)); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($application->created_at->diffForHumans()); ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?php echo e(route('admin.event-applications.show', $application)); ?>" 
                                                   class="btn btn-outline-primary btn-sm" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('admin.event-applications.edit', $application)); ?>" 
                                                   class="btn btn-outline-secondary btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if($event->applications()->count() > 10): ?>
                        <div class="text-center pt-3">
                            <a href="<?php echo e(route('admin.event-applications.index', ['event' => $event->id])); ?>" class="btn btn-link">
                                View all <?php echo e($event->applications()->count()); ?> applications →
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-users text-muted fa-3x mb-3"></i>
                        <p class="text-muted">No applications yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Statistics -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Statistics
                    </h3>
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-value"><?php echo e($event->applications()->count()); ?></div>
                        <div class="stat-label">Total Applications</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?php echo e($event->applications()->where('status', 'confirmed')->count()); ?></div>
                        <div class="stat-label">Confirmed</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?php echo e($event->applications()->where('status', 'pending')->count()); ?></div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?php echo e($event->applications()->where('status', 'cancelled')->count()); ?></div>
                        <div class="stat-label">Cancelled</div>
                    </div>
                </div>

                <?php if($event->max_participants): ?>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Capacity</span>
                            <span class="text-muted">
                                <?php echo e($event->applications()->where('status', 'confirmed')->count()); ?>/<?php echo e($event->max_participants); ?>

                            </span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?php echo e(($event->applications()->where('status', 'confirmed')->count() / $event->max_participants) * 100); ?>%">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Event Settings -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog me-2"></i>
                        Settings
                    </h3>
                </div>

                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Active</span>
                        <span class="badge bg-<?php echo e($event->is_active ? 'success' : 'secondary'); ?>">
                            <?php echo e($event->is_active ? 'Yes' : 'No'); ?>

                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Featured</span>
                        <span class="badge bg-<?php echo e($event->is_featured ? 'primary' : 'secondary'); ?>">
                            <?php echo e($event->is_featured ? 'Yes' : 'No'); ?>

                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Allow Registration</span>
                        <span class="badge bg-<?php echo e($event->allow_registration ? 'success' : 'danger'); ?>">
                            <?php echo e($event->allow_registration ? 'Yes' : 'No'); ?>

                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Sort Order</span>
                        <span class="badge bg-light text-dark"><?php echo e($event->sort_order); ?></span>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <?php if($event->getTranslation('seo_title', 'fr') || $event->getTranslation('seo_description', 'fr')): ?>
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search me-2"></i>
                            SEO Information
                        </h3>
                    </div>

                    <?php if($event->getTranslation('seo_title', 'fr')): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Title (French)</label>
                            <p class="text-muted"><?php echo e($event->getTranslation('seo_title', 'fr')); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if($event->getTranslation('seo_title', 'en')): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Title (English)</label>
                            <p class="text-muted"><?php echo e($event->getTranslation('seo_title', 'en')); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if($event->getTranslation('seo_description', 'fr')): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Description (French)</label>
                            <p class="text-muted"><?php echo e($event->getTranslation('seo_description', 'fr')); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if($event->getTranslation('seo_description', 'en')): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">SEO Description (English)</label>
                            <p class="text-muted"><?php echo e($event->getTranslation('seo_description', 'en')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Quick Actions -->
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h3>
                </div>

                <div class="d-grid gap-2">
                    <form method="POST" action="<?php echo e(route('admin.events.toggle-status', $event)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="btn-admin btn-admin-outline w-100">
                            <i class="fas fa-toggle-<?php echo e($event->is_active ? 'off' : 'on'); ?>"></i>
                            <?php echo e($event->is_active ? 'Deactivate' : 'Activate'); ?> Event
                        </button>
                    </form>

                    <form method="POST" action="<?php echo e(route('admin.events.duplicate', $event)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-admin btn-admin-outline w-100">
                            <i class="fas fa-copy"></i>
                            Duplicate Event
                        </button>
                    </form>

                    <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>" 
                          onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-admin btn-admin-danger w-100">
                            <i class="fas fa-trash"></i>
                            Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.content-preview {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    max-height: 200px;
    overflow-y: auto;
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
    font-size: 2rem;
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/events/show.blade.php ENDPATH**/ ?>