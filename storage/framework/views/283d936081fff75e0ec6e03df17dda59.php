

<?php $__env->startSection('page-title', 'Events & Workshops'); ?>

<?php $__env->startSection('content'); ?>
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Events & Workshops</h2>
            <p class="text-muted">Manage your workshops and events</p>
        </div>
        <a href="<?php echo e(route('admin.events.create')); ?>" class="btn-admin btn-admin-primary">
            <i class="fas fa-plus"></i>
            Create New Event
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-value"><?php echo e($events->total()); ?></div>
                <div class="stat-label">Total Events</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value"><?php echo e($events->where('status', 'active')->count()); ?></div>
                <div class="stat-label">Active Events</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value"><?php echo e($events->where('status', 'upcoming')->count()); ?></div>
                <div class="stat-label">Upcoming Events</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo e($events->sum('current_participants')); ?></div>
                <div class="stat-label">Total Participants</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card mb-4">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
                    <option value="upcoming" <?php echo e(request('status') === 'upcoming' ? 'selected' : ''); ?>>Upcoming</option>
                    <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                    <option value="completed" <?php echo e(request('status') === 'completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <option value="workshop" <?php echo e(request('type') === 'workshop' ? 'selected' : ''); ?>>Workshop</option>
                    <option value="practical" <?php echo e(request('type') === 'practical' ? 'selected' : ''); ?>>Practical</option>
                    <option value="online" <?php echo e(request('type') === 'online' ? 'selected' : ''); ?>>Online</option>
                    <option value="hybrid" <?php echo e(request('type') === 'hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Search events..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="<?php echo e(route('admin.events.index')); ?>" class="btn-admin btn-admin-outline">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Events Table -->
    <div class="admin-table">
        <div class="table-header">
            <h3 class="card-title">Events List</h3>
            <div class="d-flex gap-2">
                <select class="form-control form-control-sm" id="bulkAction" style="width: auto;">
                    <option value="">Bulk Actions</option>
                    <option value="activate">Activate</option>
                    <option value="deactivate">Deactivate</option>
                    <option value="delete">Delete</option>
                </select>
                <button type="button" class="btn-admin btn-admin-outline btn-sm" id="applyBulk">Apply</button>
            </div>
        </div>

        <?php if($events->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Participants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="event-checkbox" value="<?php echo e($event->id); ?>">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if($event->featured_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $event->featured_image)); ?>" 
                                             alt="<?php echo e($event->getTranslation('title', 'fr')); ?>"
                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-calendar-alt text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <strong><?php echo e($event->getTranslation('title', 'fr')); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo e(Str::limit($event->getTranslation('description', 'fr'), 50)); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-info"><?php echo e(ucfirst($event->type)); ?></span>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo e($event->status === 'active' ? 'success' : 
                                    ($event->status === 'upcoming' ? 'warning' : 
                                    ($event->status === 'completed' ? 'info' : 'danger'))); ?>">
                                    <?php echo e(ucfirst($event->status)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($event->event_date): ?>
                                    <?php echo e($event->event_date->format('d/m/Y H:i')); ?>

                                <?php else: ?>
                                    <span class="text-muted">Not set</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="text-center">
                                    <strong><?php echo e($event->current_participants); ?></strong>
                                    <?php if($event->max_participants): ?>
                                        / <?php echo e($event->max_participants); ?>

                                    <?php endif; ?>
                                    <br>
                                    <?php if($event->max_participants): ?>
                                        <small class="text-muted">
                                            <?php echo e($event->available_spots); ?> spots left
                                        </small>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('admin.events.show', $event)); ?>" 
                                       class="btn-admin btn-admin-outline btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.events.edit', $event)); ?>" 
                                       class="btn-admin btn-admin-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.events.toggle-status', $event)); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" 
                                                class="btn-admin btn-admin-<?php echo e($event->is_active ? 'warning' : 'success'); ?> btn-sm"
                                                title="<?php echo e($event->is_active ? 'Deactivate' : 'Activate'); ?>">
                                            <i class="fas fa-<?php echo e($event->is_active ? 'pause' : 'play'); ?>"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('admin.events.duplicate', $event)); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-admin btn-admin-info btn-sm" title="Duplicate">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>" 
                                          class="d-inline delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-admin btn-admin-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($events->appends(request()->query())->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h4>No events found</h4>
                <p class="text-muted">Create your first event to get started.</p>
                <a href="<?php echo e(route('admin.events.create')); ?>" class="btn-admin btn-admin-primary">
                    <i class="fas fa-plus"></i>
                    Create Event
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.event-checkbox');
    
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Bulk actions
    document.getElementById('applyBulk').addEventListener('click', function() {
        const action = document.getElementById('bulkAction').value;
        const selectedIds = Array.from(document.querySelectorAll('.event-checkbox:checked'))
                                .map(cb => cb.value);

        if (!action || selectedIds.length === 0) {
            alert('Please select an action and at least one event.');
            return;
        }

        if (confirm(`Are you sure you want to ${action} ${selectedIds.length} event(s)?`)) {
            // Implement bulk action logic here
            console.log('Bulk action:', action, 'IDs:', selectedIds);
        }
    });

    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/events/index.blade.php ENDPATH**/ ?>