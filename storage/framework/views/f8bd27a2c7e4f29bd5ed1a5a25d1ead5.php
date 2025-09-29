

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><?php echo e(__('Admin Dashboard')); ?></h4>
                </div>

                <div class="card-body">
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo e($stats['services']); ?></h3>
                                            <p class="mb-0">Services</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-concierge-bell fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo e($stats['appointments']); ?></h3>
                                            <p class="mb-0">Total Appointments</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar-alt fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo e($stats['pending_appointments']); ?></h3>
                                            <p class="mb-0">Pending Appointments</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo e($stats['testimonials']); ?></h3>
                                            <p class="mb-0">Testimonials</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-star fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Quick Actions</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-concierge-bell"></i> <span class="d-none d-sm-inline">Manage Services</span>
                                </a>
                                <a href="<?php echo e(route('admin.appointments.index')); ?>" class="btn btn-outline-success">
                                    <i class="fas fa-calendar-alt"></i> <span class="d-none d-sm-inline">View Appointments</span>
                                </a>
                                <a href="<?php echo e(route('admin.settings')); ?>" class="btn btn-outline-info">
                                    <i class="fas fa-cog"></i> <span class="d-none d-sm-inline">Settings</span>
                                </a>
                                <a href="<?php echo e(route('admin.change-password')); ?>" class="btn btn-outline-warning">
                                    <i class="fas fa-key"></i> <span class="d-none d-sm-inline">Change Password</span>
                                </a>
                                <a href="<?php echo e(url('/fr')); ?>" class="btn btn-outline-secondary" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> <span class="d-none d-sm-inline">View Site</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Appointments -->
                    <?php if($recent_appointments->count() > 0): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Recent Appointments</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $recent_appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo e($appointment->client_name); ?></strong><br>
                                                <small class="text-muted"><?php echo e($appointment->client_email); ?></small>
                                            </td>
                                            <td>
                                                <?php if($appointment->service): ?>
                                                    <?php echo e($appointment->service->getTranslation('name', 'fr')); ?>

                                                <?php else: ?>
                                                    <span class="text-muted">N/A</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($appointment->appointment_datetime->format('d/m/Y H:i')); ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo e($appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger')); ?>">
                                                    <?php echo e(ucfirst($appointment->status)); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.appointments.show', $appointment)); ?>" class="btn btn-sm btn-outline-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>