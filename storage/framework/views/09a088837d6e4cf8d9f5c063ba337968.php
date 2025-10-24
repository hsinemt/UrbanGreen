<?php $__env->startSection('title', 'Paiement Réussi'); ?>

<?php $__env->startSection('content'); ?>
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('frontOffice/img/page_heading_bg.jpg')); ?>">
  <div class="container">
    <h1 class="cs_fs_51 cs_white_color cs_mb_11">Merci pour votre donation</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo e(route('donations.index')); ?>">Donations</a></li>
      <li class="breadcrumb-item active">Succès</li>
    </ol>
  </div>
</section>

<section class="cs_shape_wrap">
  <div class="cs_height_140 cs_height_lg_70"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="cs_white_bg cs_shadow_1 cs_padding_large text-center">
          <div class="mb-4">
            <i class="fas fa-check-circle text-success" style="font-size:64px;"></i>
          </div>
          <h2 class="cs_fs_36 cs_mb_15">Paiement confirmé</h2>
          <p class="cs_mb_30">Votre donation a été enregistrée avec succès. Merci pour votre soutien.</p>

          <div class="cs_white_bg cs_shadow_1 cs_padding_medium text-start">
            <p><strong>Montant:</strong> <?php echo e(number_format($donation->amount, 2)); ?> <?php echo e($donation->currency); ?></p>
            <p><strong>Date:</strong> <?php echo e(\Carbon\Carbon::parse($donation->date)->format('d/m/Y')); ?></p>
            <p><strong>Méthode:</strong> <?php echo e($donation->payment_method); ?></p>
            <?php if($donation->wallet): ?>
            <p><strong>Wallet:</strong> <?php echo e($donation->wallet->name); ?> (<?php echo e($donation->wallet->event->name ?? 'N/A'); ?>)</p>
            <?php endif; ?>

          </div>

          <div class="mt-4">
            <a href="<?php echo e(route('donations.index')); ?>" class="cs_btn cs_style_1">Voir mes donations</a>
            <a href="<?php echo e(route('home')); ?>" class="cs_btn cs_style_2">Retour à l'accueil</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/donations/payment_success.blade.php ENDPATH**/ ?>