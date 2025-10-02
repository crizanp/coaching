

<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="fade-in">
    <!-- Stats Grid -->
    <div class="stats-grid mb-4">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['services']); ?></div>
            <div class="stat-label">Services</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>Active services</span>
            </div>
        </div>

        <div class="stat-card info">
            <div class="stat-icon info">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['appointments']); ?></div>
            <div class="stat-label">Total Appointments</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up"></i>
                <span>All time</span>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['pending_appointments']); ?></div>
            <div class="stat-label">Pending Appointments</div>
            <div class="stat-change">
                <i class="fas fa-clock"></i>
                <span>Awaiting confirmation</span>
            </div>
        </div>

        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['events'] ?? 0); ?></div>
            <div class="stat-label">Events & Workshops</div>
            <div class="stat-change positive">
                <i class="fas fa-plus"></i>
                <span>Active events</span>
            </div>
        </div>

        <div class="stat-card secondary">
            <div class="stat-icon secondary">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['testimonials']); ?></div>
            <div class="stat-label">Testimonials</div>
            <div class="stat-change positive">
                <i class="fas fa-thumbs-up"></i>
                <span>Customer feedback</span>
            </div>
        </div>

        <div class="stat-card accent">
            <div class="stat-icon accent">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['total_participants'] ?? 0); ?></div>
            <div class="stat-label">Event Participants</div>
            <div class="stat-change positive">
                <i class="fas fa-user-plus"></i>
                <span>Confirmed</span>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="d-flex flex-column gap-2">
                    <a href="<?php echo e(route('admin.events.create')); ?>" class="btn-admin btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        Create New Workshop
                    </a>
                    <a href="<?php echo e(route('admin.services.create')); ?>" class="btn-admin btn-admin-outline">
                        <i class="fas fa-heart"></i>
                        Add New Service
                    </a>
                    <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn-admin btn-admin-outline">
                        <i class="fas fa-blog"></i>
                        Write Blog Post
                    </a>
                    <a href="<?php echo e(url('/')); ?>" class="btn-admin btn-admin-outline" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        View Website
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-6 mb-3">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line me-2"></i>
                        Activity Overview
                    </h3>
                </div>
                <div style="height: 300px; position: relative;">
                    <canvas id="appointmentsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <!-- Recent Appointments -->
        <div class="col-lg-6 mb-4">
            <div class="admin-table">
                <div class="table-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-check me-2"></i>
                        Recent Appointments
                    </h3>
                    <a href="<?php echo e(route('admin.appointments.index')); ?>" class="btn-admin btn-admin-outline btn-sm">
                        View All
                    </a>
                </div>
                <?php if($recent_appointments->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recent_appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div>
                                            <strong><?php echo e($appointment->client_name); ?></strong><br>
                                            <small class="text-muted"><?php echo e($appointment->client_email); ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($appointment->service): ?>
                                            <?php echo e($appointment->service->getTranslation('name', 'fr')); ?>

                                        <?php else: ?>
                                            <span class="text-muted">Service deleted</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($appointment->appointment_datetime->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo e($appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger')); ?>">
                                            <?php echo e(ucfirst($appointment->status)); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent appointments found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Event Applications -->
        <div class="col-lg-6 mb-4">
            <div class="admin-table">
                <div class="table-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-plus me-2"></i>
                        Recent Event Applications
                    </h3>
                    <a href="<?php echo e(route('admin.event-applications.index')); ?>" class="btn-admin btn-admin-outline btn-sm">
                        View All
                    </a>
                </div>
                <?php if(isset($recent_event_applications) && $recent_event_applications->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Participant</th>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recent_event_applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div>
                                            <strong><?php echo e($application->name); ?></strong><br>
                                            <small class="text-muted"><?php echo e($application->email); ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($application->event): ?>
                                            <?php echo e($application->event->getTranslation('title', 'fr')); ?>

                                        <?php else: ?>
                                            <span class="text-muted">Event deleted</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($application->created_at->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo e($application->status === 'confirmed' ? 'success' : ($application->status === 'pending' ? 'warning' : 'danger')); ?>">
                                            <?php echo e(ucfirst($application->status)); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-user-times fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent event applications found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie me-2"></i>
                        Content Overview
                    </h3>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 text-center mb-3">
                        <div class="content-stat">
                            <div class="content-stat-icon bg-primary">
                                <i class="fas fa-blog"></i>
                            </div>
                            <h4 class="content-stat-value"><?php echo e($stats['blogs'] ?? 0); ?></h4>
                            <p class="content-stat-label">Blog Posts</p>
                            <a href="<?php echo e(route('admin.blogs.index')); ?>" class="btn btn-outline-primary btn-sm">Manage</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center mb-3">
                        <div class="content-stat">
                            <div class="content-stat-icon bg-info">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h4 class="content-stat-value"><?php echo e($stats['blog_gift_requests'] ?? 0); ?></h4>
                            <p class="content-stat-label">Blog Gift Requests</p>
                            <a href="<?php echo e(route('admin.blog-gift-requests.index')); ?>" class="btn btn-outline-success btn-sm">Review</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center mb-3">
                        <div class="content-stat">
                            <div class="content-stat-icon bg-warning">
                                <i class="fas fa-cog"></i>
                            </div>
                            <h4 class="content-stat-value"><i class="fas fa-tools"></i></h4>
                            <p class="content-stat-label">Settings</p>
                            <a href="<?php echo e(route('admin.settings')); ?>" class="btn btn-outline-warning btn-sm">Configure</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.content-stat {
    padding: 1.5rem;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.content-stat:hover {
    transform: translateY(-2px);
    background: rgba(255, 255, 255, 0.06);
}

.content-stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.content-stat-value {
    font-size: 2rem;
    font-weight: bold;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.content-stat-label {
    color: var(--text-muted);
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }
    
    .content-stat {
        padding: 1rem;
    }
    
    .content-stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .content-stat-value {
        font-size: 1.5rem;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Appointments Chart
    const ctx = document.getElementById('appointmentsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chart_data['labels'] ?? []); ?>,
                datasets: [{
                    label: 'Appointments',
                    data: <?php echo json_encode($chart_data['appointments'] ?? []); ?>,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Event Applications',
                    data: <?php echo json_encode($chart_data['events'] ?? []); ?>,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#e9e9e9',
                            font: {
                                family: 'Inter'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#333',
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#a0a0a0',
                            font: {
                                family: 'Inter'
                            }
                        },
                        grid: {
                            color: '#333'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#a0a0a0',
                            font: {
                                family: 'Inter'
                            }
                        },
                        grid: {
                            color: '#333'
                        }
                    }
                }
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>