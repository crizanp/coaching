

<?php $__env->startSection('page-title', 'Contact Messages'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Contact Messages</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($messages->count()): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Interested Service</th>
                                <th>Message</th>
                                <th>Received At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($message->name); ?></td>
                                <td>
                                    <a href="mailto:<?php echo e($message->email); ?>" class="text-decoration-none">
                                        <?php echo e($message->email); ?>

                                    </a>
                                </td>
                                <td>
                                    <?php if($message->phone): ?>
                                        <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $message->phone)); ?>" class="text-decoration-none">
                                            <?php echo e($message->phone); ?>

                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($message->service): ?>
                                        <?php echo e($message->service->getTranslation('name', app()->getLocale()) ?? $message->service->name); ?>

                                    <?php else: ?>
                                        <span class="text-muted">Not specified</span>
                                    <?php endif; ?>
                                </td>
                                <td style="white-space: pre-wrap; min-width: 250px;"><?php echo e($message->message); ?></td>
                                <td><?php echo e($message->created_at->timezone(config('app.timezone'))->format('Y-m-d H:i')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        Showing <?php echo e($messages->firstItem()); ?> to <?php echo e($messages->lastItem()); ?> of <?php echo e($messages->total()); ?> messages
                    </div>
                    <?php echo e($messages->links('pagination::bootstrap-5')); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-envelope-open-text fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No contact messages yet</h5>
                    <p class="text-muted mb-0">Messages from your contact form will show up here once visitors reach out.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\client-fiverr\coaching\resources\views/admin/contact-messages.blade.php ENDPATH**/ ?>