<?php $__env->startSection('title', 'Competitions'); ?>

<?php $__env->startSection('content'); ?>
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('assets/img/page_heading_bg.jpg')); ?>">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Competitions</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Competitions</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center cs_mb_30">
      <h2 class="cs_fs_38 cs_semibold mb-0">Competition List</h2>
      <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->isPartner()): ?>
          <a href="<?php echo e(route('competitions.create')); ?>" class="cs_btn cs_style_1">Create Competition</a>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <form method="GET" class="cs_mb_30" id="competitionsFilterForm">
      <div class="d-flex align-items-end gap-2">
        <input type="text" class="cs_form_input" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search by reward or description" style="min-width:260px">
        <button type="submit" class="cs_btn cs_style_2">Filter</button>
      </div>
    </form>

    <div class="row cs_gap_y_50">
      <?php $__empty_1 = true; $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-6">
          <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
            <div class="cs_card_info">
              <h2 class="cs_fs_32 cs_semibold cs_mb_10">Reward: <?php echo e($competition->reward); ?></h2>
              <p class="cs_mb_10">Project: <strong><?php echo e(optional($competition->project)->name); ?></strong></p>
              <p class="cs_mb_10">Partner: <strong><?php echo e(optional($competition->partner)->name); ?></strong></p>
              <p class="cs_mb_10">Associations:
                <?php $__currentLoopData = $competition->associations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span class="cs_badge cs_badge_secondary" style="background:#e9ecef;color:#212529;"><?php echo e($assoc->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </p>
              <p class="cs_mb_14"><?php echo e(\Illuminate\Support\Str::limit($competition->description, 180)); ?></p>
              <div class="d-flex gap-2">
                <a href="<?php echo e(route('competitions.show', $competition)); ?>" class="cs_btn cs_style_1">View</a>
                <?php if(auth()->guard()->check()): ?>
                  <?php if(Auth::user()->isPartner() && $competition->partner_id === Auth::id()): ?>
                    <a href="<?php echo e(route('competitions.edit', $competition)); ?>" class="cs_btn cs_style_1">Edit</a>
                    <form action="<?php echo e(route('competitions.destroy', $competition)); ?>" method="POST" onsubmit="return confirm('Delete competition?')">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button type="submit" class="cs_btn cs_style_2">Delete</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12"><div class="cs_notice cs_style_1">No competitions found.</div></div>
      <?php endif; ?>
    </div>

    <div class="cs_mt_30">
      <?php echo e($competitions->withQueryString()->links()); ?>

    </div>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/competitions/index.blade.php ENDPATH**/ ?>