<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard - UrbanGreen'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('backOffice-assets/images/favicon.png')); ?>" sizes="16x16">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/remixicon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/apexcharts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/flatpickr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/full-calendar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/jquery-jvectormap-2.0.5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/lib/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backOffice-assets/css/style.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<!-- Theme Customization -->
<?php echo $__env->make('dashboard.partials.theme-customization', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Sidebar -->
<?php echo $__env->make('dashboard.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main class="dashboard-main">
    <!-- Header -->
    <?php echo $__env->make('dashboard.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <div class="dashboard-main-body">
        <?php echo $__env->yieldContent('breadcrumb'); ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Footer -->
    <?php echo $__env->make('dashboard.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</main>

<!-- JavaScript Files -->
<script src="<?php echo e(asset('backOffice-assets/js/lib/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/iconify-icon.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/jquery-jvectormap-2.0.5.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/magnifc-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/lib/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('backOffice-assets/js/app.js')); ?>"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/dashboard/layouts/dashboard.blade.php ENDPATH**/ ?>