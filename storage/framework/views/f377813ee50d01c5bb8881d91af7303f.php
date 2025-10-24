<?php $__env->startSection('title', 'Projects'); ?>

<?php $__env->startSection('content'); ?>
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('assets/img/page_heading_bg.jpg')); ?>">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Projects</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Projects</li>
      </ol>
    </div>
  </section>

  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <?php if(session('success')): ?>
      <div class="cs_notice cs_style_1 cs_green_bg cs_white_color cs_mb_30"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="row cs_mb_30">
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #28a745;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5"><?php echo e($stats['total']); ?></h3>
            <p class="cs_mb_0">Total Projects</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #f39c12;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5"><?php echo e($stats['in_progress_count']); ?></h3>
            <p class="cs_mb_0">In Progress</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #28a745;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5"><?php echo e($stats['completed_count']); ?></h3>
            <p class="cs_mb_0">Completed</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 cs_mb_20">
        <div class="cs_card cs_style_1 cs_white_bg" style="border-left: 4px solid #007bff;">
          <div class="cs_card_in text-center">
            <h3 class="cs_fs_32 cs_semibold cs_accent_color cs_mb_5"><?php echo e(number_format($stats['total_budget'], 0)); ?> DT</h3>
            <p class="cs_mb_0">Total Budget</p>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center cs_mb_30">
      <h2 class="cs_fs_38 cs_semibold mb-0">Project List</h2>
      <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->isAssociation() || Auth::user()->isPartner()): ?>
          <a href="<?php echo e(route('projects.create')); ?>" class="cs_btn cs_style_1">
            Add Project
            <i>
              <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </i>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <form method="GET" class="cs_mb_30" id="projectsFilterForm">
      <div class="d-flex align-items-end gap-2">
        <input type="text" class="cs_form_input" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search by name or description" style="min-width:260px">
        <select name="status" class="cs_form_input" onchange="document.getElementById('projectsFilterForm').submit()">
          <option value="">All statuses</option>
          <?php $__currentLoopData = \App\Models\Projet::allowedStatuses(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($st); ?>" <?php echo e(request('status')===$st ? 'selected' : ''); ?>><?php echo e(ucfirst(str_replace('_',' ',$st))); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="date" class="cs_form_input" name="start_date" value="<?php echo e(request('start_date')); ?>" onchange="document.getElementById('projectsFilterForm').submit()">
        <input type="date" class="cs_form_input" name="end_date" value="<?php echo e(request('end_date')); ?>" onchange="document.getElementById('projectsFilterForm').submit()">
        <button type="submit" class="d-none">Apply</button>
      </div>
    </form>

    <div class="row cs_gap_y_50">
      <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-6">
          <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
           
            <div class="cs_card_info">
              <div class="d-flex justify-content-between align-items-start cs_mb_10">
                <h2 class="cs_fs_38 cs_mb_10 cs_semibold" style="line-height:1.2;"><?php echo e($projet->name); ?></h2>
                <span class="cs_badge" style="
                  background-color: <?php echo e(match($projet->status) {
                    'planned' => '#0d6efd',
                    'in_progress' => '#f39c12',
                    'completed' => '#28a745',
                    'cancelled' => '#dc3545',
                    default => '#6c757d'
                  }); ?>;
                  color:#fff; white-space:nowrap;">
                  <?php echo e(ucfirst(str_replace('_', ' ', $projet->status))); ?>

                </span>
              </div>

              <h5 class="cs_mb_14"><?php echo e(\Illuminate\Support\Str::limit($projet->description, 180)); ?></h5>
              <?php if(!empty($projet->tags)): ?>
                <div class="cs_mb_10">
                  <?php $__currentLoopData = (array) $projet->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="cs_badge cs_badge_secondary" style="background:#e9ecef;color:#212529;">#<?php echo e($tag); ?></span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php endif; ?>

              <div class="d-flex justify-content-between cs_mb_10">
                <p class="cs_fs_21 cs_semibold mb-0">Start : <?php echo e(optional($projet->start_date)->format('Y-m-d')); ?></p>
                <p class="cs_fs_21 cs_semibold mb-0">End : <?php echo e(optional($projet->end_date)->format('Y-m-d') ?? '-'); ?></p>
              </div>
              <div class="cs_mb_10">
                <p class="mb-0">Created by: <strong><?php echo e(optional($projet->user)->name ?? '—'); ?></strong></p>
              </div>
              <div class="cs_progress_wrap">
                <div class="cs_progress" data-progress="<?php echo e((int) $projet->progress_percentage); ?>">
                  <div class="cs_progress_in cs_accent_bg"><span><?php echo e((int) $projet->progress_percentage); ?>%</span></div>
                </div>
              </div>
              <div class="cs_progress_heading cs_mb_28">
                <h3 class="cs_fs_21 cs_semibold mb-0">Budget : <?php echo e(number_format((float) $projet->budget, 0)); ?> DT</h3>
              </div>
              <div class="d-flex gap-2">
                <a href="<?php echo e(route('projects.show', $projet)); ?>" class="cs_btn cs_style_1">
                  View Details
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </i>
                </a>
                <?php if(auth()->guard()->check()): ?>
                  <?php if((Auth::user()->isAssociation() || Auth::user()->isPartner()) && $projet->user_id == Auth::id()): ?>
                    <a href="<?php echo e(route('projects.edit', $projet)); ?>" class="cs_btn cs_style_1">
                      Edit
                    </a>
                    <form action="<?php echo e(route('projects.destroy', $projet)); ?>" method="POST" onsubmit="return confirm('Are you sure to delete this project?')">
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
        <div class="col-12">
          <div class="cs_notice cs_style_1">No projects found.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if(auth()->guard()->check()): ?>
    <?php if(Auth::user()->isAssociation()): ?>
      <!-- Competitions Section for Associations -->
      <div class="cs_height_50 cs_height_lg_40"></div>
      
      <div class="container">
        <div class="d-flex justify-content-between align-items-center cs_mb_30">
          <h2 class="cs_fs_38 cs_semibold mb-0">My Competitions</h2>
        </div>

        <div class="row cs_gap_y_50">
          <?php
$userCompetitions = Auth::user()->joinedCompetitions()->with(['partner', 'project'])->get();
          ?>

          <?php $__empty_1 = true; $__currentLoopData = $userCompetitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-6">
              <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
                <div class="cs_card_info">
                  <div class="d-flex justify-content-between align-items-start cs_mb_10">
                    <h2 class="cs_fs_38 cs_mb_10 cs_semibold" style="line-height:1.2;"><?php echo e($competition->reward); ?></h2>
                    <span class="cs_badge" style="background-color: #28a745; color: #fff;">
                      Competition
                    </span>
                  </div>

                  <h5 class="cs_mb_14"><?php echo e(\Illuminate\Support\Str::limit($competition->description, 180)); ?></h5>

                  <div class="d-flex justify-content-between cs_mb_10">
                    <p class="cs_fs_21 cs_semibold mb-0">Project: <strong><?php echo e($competition->project->name); ?></strong></p>
                    <p class="cs_fs_21 cs_semibold mb-0">Partner: <strong><?php echo e($competition->partner->name); ?></strong></p>
                  </div>

                  <div class="d-flex gap-2">
                    <a href="<?php echo e(route('competitions.show', $competition)); ?>" class="cs_btn cs_style_1">
                      View Competition
                      <i>
                        <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
              <div class="cs_notice cs_style_1">No competitions found.</div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="cs_height_140 cs_height_lg_70"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/projects/show.blade.php ENDPATH**/ ?>