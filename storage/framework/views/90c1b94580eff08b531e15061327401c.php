<?php $__env->startSection('title', $projet->exists ? 'Edit Project' : 'Add Project'); ?>

<?php $__env->startSection('content'); ?>
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('assets/img/page_heading_bg.jpg')); ?>">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11"><?php echo e($projet->exists ? 'Edit Project' : 'Add Project'); ?></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>">Projects</a></li>
        <li class="breadcrumb-item active"><?php echo e($projet->exists ? 'Edit' : 'Add'); ?></li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <?php if($errors->any()): ?>
      <div class="cs_notice cs_style_1 cs_red_bg cs_white_color cs_mb_30">
        <ul class="mb-0">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="<?php echo e($projet->exists ? route('projects.update', $projet) : route('projects.store')); ?>" method="POST" class="cs_form">
      <?php echo csrf_field(); ?>
      <?php if($projet->exists): ?>
        <?php echo method_field('PUT'); ?>
      <?php endif; ?>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Name</label>
        <input type="text" name="name" value="<?php echo e(old('name', $projet->name)); ?>" class="cs_form_input" required>
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Description</label>
        <textarea name="description" class="cs_form_input" rows="5" required><?php echo e(old('description', $projet->description)); ?></textarea>
      </div>

      <div class="cs_form_group cs_mb_20">
        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Status</label>
        <select name="status" class="cs_form_input" required>
          <option value="">Select status</option>
          <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($status); ?>" <?php echo e(old('status', $projet->status) === $status ? 'selected' : ''); ?>>
              <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Start Date</label>
          <input type="date" name="start_date" value="<?php echo e(old('start_date', optional($projet->start_date)->format('Y-m-d'))); ?>" class="cs_form_input" required>
        </div>
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">End Date (optional)</label>
          <input type="date" name="end_date" value="<?php echo e(old('end_date', optional($projet->end_date)->format('Y-m-d'))); ?>" class="cs_form_input">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Progress Percentage</label>
          <input type="number" name="progress_percentage" min="0" max="100" value="<?php echo e(old('progress_percentage', $projet->progress_percentage)); ?>" class="cs_form_input" required>
        </div>
        <div class="col-md-6 cs_mb_20">
          <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Budget</label>
          <input type="number" step="0.01" min="0" name="budget" value="<?php echo e(old('budget', $projet->budget)); ?>" class="cs_form_input" required>
        </div>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="cs_btn cs_style_1"><?php echo e($projet->exists ? 'Update' : 'Create'); ?></button>
        <a href="<?php echo e(route('projects.index')); ?>" class="cs_btn cs_style_2">Cancel</a>
      </div>
    </form>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/projects/form.blade.php ENDPATH**/ ?>