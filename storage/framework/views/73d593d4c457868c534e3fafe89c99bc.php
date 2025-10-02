

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?php echo e(__('Appointments Management')); ?></h4>
                        <div>
                            <a href="<?php echo e(route('admin.appointments.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> New Appointment
                            </a>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary">
                                <i class="fas fa-dashboard"></i> Dashboard
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($appointments->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Service</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Language</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($appointment->id); ?></td>
                                        <td>
                                            <strong><?php echo e($appointment->client_name); ?></strong><br>
                                            <small class="text-muted"><?php echo e($appointment->client_email); ?></small>
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
                                            <form method="POST" action="<?php echo e(route('admin.appointments.status', $appointment)); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="pending" <?php echo e($appointment->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                                    <option value="confirmed" <?php echo e($appointment->status === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                                    <option value="completed" <?php echo e($appointment->status === 'completed' ? 'selected' : ''); ?>>Completed</option>
                                                    <option value="cancelled" <?php echo e($appointment->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo e($appointment->preferred_language === 'fr' ? 'primary' : 'success'); ?>">
                                                <?php echo e(strtoupper($appointment->preferred_language)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo e(route('admin.appointments.show', $appointment)); ?>" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('admin.appointments.edit', $appointment)); ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="<?php echo e(route('admin.appointments.destroy', $appointment)); ?>" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
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
                        <div class="d-flex justify-content-center">
                            <?php echo e($appointments->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No appointments found</h5>
                            <p class="text-muted">Create your first appointment or wait for clients to book.</p>
                            <a href="<?php echo e(route('admin.appointments.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create First Appointment
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>