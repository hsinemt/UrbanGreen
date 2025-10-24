<?php $__env->startSection('title', 'Dashboard - UrbanGreen'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="<?php echo e(route('back.home')); ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Home</li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>



























































<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/homeTwoChart.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('dashboard.layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/dashboard/home.blade.php ENDPATH**/ ?>