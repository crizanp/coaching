

<?php $__env->startSection('page-title', 'Event Applications'); ?>

<?php $__env->startSection('content'); ?>
<div class="fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Event Applications</h2>
            <p class="text-muted">Manage event registrations and participants</p>
        </div>
        <div class="d-flex gap-2">
            <?php if(request('event')): ?>
                <?php $event = \App\Models\Event::find(request('event')) ?>
                <?php if($event): ?>
                    <a href="<?php echo e(route('admin.events.show', $event)); ?>" class="btn-admin btn-admin-outline">
                        <i class="fas fa-arrow-left"></i>
                        Back to Event
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo e(route('admin.events.index')); ?>" class="btn-admin btn-admin-outline">
                <i class="fas fa-calendar"></i>
                All Events
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 col-xl-2 mb-3 mb-xl-0">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h3 class="mb-1"><?php echo e($applications->total()); ?></h3>
                    <p class="text-muted mb-0">Total Applications</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xl-2 mb-3 mb-xl-0">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h3 class="mb-1"><?php echo e($confirmedCount); ?></h3>
                    <p class="text-muted mb-0">Confirmed</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xl-2 mb-3 mb-xl-0">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h3 class="mb-1"><?php echo e($pendingCount); ?></h3>
                    <p class="text-muted mb-0">Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xl-2 mb-3 mb-xl-0">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                    <h3 class="mb-1"><?php echo e($cancelledCount); ?></h3>
                    <p class="text-muted mb-0">Cancelled</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xl-2">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-hourglass-half fa-2x text-info mb-2"></i>
                    <h3 class="mb-1"><?php echo e($waitlistCount); ?></h3>
                    <p class="text-muted mb-0">Waitlist</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Event</label>
                    <select name="event" class="form-control">
                        <option value="">All Events</option>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($eventOption->id); ?>" <?php echo e(request('event') == $eventOption->id ? 'selected' : ''); ?>>
                                <?php echo e($eventOption->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                        <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        <option value="waitlist" <?php echo e(request('status') === 'waitlist' ? 'selected' : ''); ?>>Waitlist</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Name, email, phone..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Date From</label>
                    <input type="date" name="date_from" class="form-control" value="<?php echo e(request('date_from')); ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="<?php echo e(route('admin.event-applications.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bulk Actions -->
    <?php if($applications->count() > 0): ?>
        <div class="admin-card mb-4">
            <div class="card-body">
                <form id="bulk-actions-form" method="POST" action="<?php echo e(route('admin.event-applications.bulk-action')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-2">
                            <label class="form-label">Select Action</label>
                            <select name="action" class="form-control" required>
                                <option value="">Choose action...</option>
                                <option value="confirm">Confirm Selected</option>
                                <option value="cancel">Cancel Selected</option>
                                <option value="waitlist">Move to Waitlist</option>
                                <option value="delete">Delete Selected</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to perform this action on selected applications?')">
                                <i class="fas fa-bolt"></i>
                                Apply Action
                            </button>
                        </div>
                        <div class="col-md-8 text-end">
                            <button type="button" class="btn btn-link btn-sm" onclick="selectAll()">Select All</button>
                            <button type="button" class="btn btn-link btn-sm" onclick="selectNone()">Select None</button>
                            <span id="selected-count" class="text-muted">0 selected</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Applications Table -->
    <div class="admin-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Applications
                <?php if(request('event') && isset($event)): ?>
                    for "<?php echo e($event->title); ?>"
                <?php endif; ?>
            </h3>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportApplications()">
                    <i class="fas fa-download"></i>
                    Export
                </button>
            </div>
        </div>

        <?php if($applications->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="30">
                                <input type="checkbox" class="form-check-input" id="select-all">
                            </th>
                            <th>Participant</th>
                            <th>Event</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Applied</th>
                            <th>Notes</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                     <input type="checkbox" class="form-check-input application-checkbox" 
                         name="applications[]" value="<?php echo e($application->id); ?>" 
                                           form="bulk-actions-form">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold"><?php echo e($application->name); ?></div>
                                            <?php if($application->company): ?>
                                                <small class="text-muted"><?php echo e($application->company); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold"><?php echo e($application->event->title); ?></div>
                                        <small class="text-muted">
                                            <?php if($application->event->event_date): ?>
                                                <?php echo e($application->event->event_date->format('M d, Y')); ?>

                                            <?php else: ?>
                                                Date TBA
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div><i class="fas fa-envelope text-muted me-1"></i><?php echo e($application->email); ?></div>
                                        <?php if($application->phone): ?>
                                            <div><i class="fas fa-phone text-muted me-1"></i><?php echo e($application->phone); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($application->status === 'confirmed' ? 'success' : ($application->status === 'pending' ? 'warning' : ($application->status === 'cancelled' ? 'danger' : ($application->status === 'waitlist' ? 'info' : 'secondary')))); ?>">
                                        <?php echo e(ucfirst($application->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <div><?php echo e($application->created_at->format('M d, Y')); ?></div>
                                        <small class="text-muted"><?php echo e($application->created_at->diffForHumans()); ?></small>
                                    </div>
                                </td>
                                <td>
                                    <?php if($application->notes): ?>
                                        <i class="fas fa-comment text-primary" title="<?php echo e($application->notes); ?>"></i>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo e(route('admin.event-applications.show', $application)); ?>" 
                                           class="btn btn-outline-primary btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-success btn-sm dropdown-toggle" 
                                                    data-bs-toggle="dropdown" title="Quick Actions">
                                                <i class="fas fa-bolt"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if($application->status !== 'confirmed'): ?>
                                                    <li>
                                                        <form method="POST" action="<?php echo e(route('admin.event-applications.update-status', $application)); ?>" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-check text-success me-1"></i>
                                                                Confirm
                                                            </button>
                                                        </form>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($application->status !== 'cancelled'): ?>
                                                    <li>
                                                        <form method="POST" action="<?php echo e(route('admin.event-applications.update-status', $application)); ?>" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-times text-danger me-1"></i>
                                                                Cancel
                                                            </button>
                                                        </form>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($application->status !== 'waitlist'): ?>
                                                    <li>
                                                        <form method="POST" action="<?php echo e(route('admin.event-applications.update-status', $application)); ?>" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <input type="hidden" name="status" value="waitlist">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-clock text-info me-1"></i>
                                                                Waitlist
                                                            </button>
                                                        </form>
                                                    </li>
                                                <?php endif; ?>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form method="POST" action="<?php echo e(route('admin.event-applications.send-confirmation', $application)); ?>" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-envelope text-primary me-1"></i>
                                                            Send Email
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-body border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Showing <?php echo e($applications->firstItem()); ?> to <?php echo e($applications->lastItem()); ?> 
                        of <?php echo e($applications->total()); ?> applications
                    </div>
                    <?php echo e($applications->appends(request()->query())->links()); ?>

                </div>
            </div>
        <?php else: ?>
            <div class="card-body text-center py-5">
                <i class="fas fa-users text-muted fa-4x mb-3"></i>
                <h5 class="text-muted">No Applications Found</h5>
                <p class="text-muted">
                    <?php if(request()->hasAny(['search', 'status', 'event'])): ?>
                        No applications match your current filters.
                        <a href="<?php echo e(route('admin.event-applications.index')); ?>" class="btn btn-link p-0">Clear filters</a>
                    <?php else: ?>
                        No event applications have been submitted yet.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Select all functionality
function selectAll() {
    document.querySelectorAll('.application-checkbox').forEach(checkbox => {
        checkbox.checked = true;
    });
    updateSelectedCount();
}

function selectNone() {
    document.querySelectorAll('.application-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateSelectedCount();
}

// Select all header checkbox
document.getElementById('select-all').addEventListener('change', function() {
    const isChecked = this.checked;
    document.querySelectorAll('.application-checkbox').forEach(checkbox => {
        checkbox.checked = isChecked;
    });
    updateSelectedCount();
});

// Individual checkboxes
document.querySelectorAll('.application-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

function updateSelectedCount() {
    const selectedCount = document.querySelectorAll('.application-checkbox:checked').length;
    document.getElementById('selected-count').textContent = selectedCount + ' selected';
    
    // Update header checkbox state
    const allCheckboxes = document.querySelectorAll('.application-checkbox');
    const headerCheckbox = document.getElementById('select-all');
    
    if (selectedCount === 0) {
        headerCheckbox.indeterminate = false;
        headerCheckbox.checked = false;
    } else if (selectedCount === allCheckboxes.length) {
        headerCheckbox.indeterminate = false;
        headerCheckbox.checked = true;
    } else {
        headerCheckbox.indeterminate = true;
    }
}

// Export functionality
function exportApplications() {
    const params = new URLSearchParams(window.location.search);
    params.set('export', 'csv');
    window.location.href = '<?php echo e(route("admin.event-applications.index")); ?>?' + params.toString();
}

// Initialize count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateSelectedCount();
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/event-applications/index.blade.php ENDPATH**/ ?>