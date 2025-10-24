<?php $__env->startSection('content'); ?>
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('frontOffice/img/page_heading_bg.jpg')); ?>">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Create Event</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('events.index')); ?>">Events</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Create New Event</h2>
            <form action="<?php echo e(route('events.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" value="<?php echo e(old('name')); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date" value="<?php echo e(old('date')); ?>" required>
                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="location" value="<?php echo e(old('location')); ?>" required>
                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description" rows="4"><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label for="budget" class="form-label">Budget (Optional)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="budget" class="form-control <?php $__errorArgs = ['budget'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="budget" value="<?php echo e(old('budget')); ?>" min="0" step="0.01" placeholder="0.00">
                        <?php $__errorArgs = ['budget'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-text">Enter the budget for this event (optional)</div>
                </div>

                <div class="mb-3">
                    <label for="project_id" class="form-label">Related Project (Optional)</label>
                    <select name="project_id" class="form-select <?php $__errorArgs = ['project_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="project_id">
                        <option value="">Select a project (optional)</option>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($project->id); ?>" <?php echo e(old('project_id') == $project->id ? 'selected' : ''); ?>>
                                <?php echo e($project->name); ?> (<?php echo e(ucfirst(str_replace('_', ' ', $project->status))); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['project_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-text">Choose which project this event belongs to (optional)</div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-magic"></i> 
                    <strong>AI Image Generation:</strong> An image will be automatically generated for your event based on the event name, description, and location using AI technology. This may take 20-30 seconds.
                </div>

                <?php if($activities->count() > 0): ?>
                    <div class="mb-3">
                        <label for="activities" class="form-label">Select Activities for this Event</label>
                        <select name="activities[]" class="form-control <?php $__errorArgs = ['activities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="activities" multiple>
                            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($activity->id); ?>" <?php echo e(in_array($activity->id, old('activities', [])) ? 'selected' : ''); ?>>
                                    <?php echo e($activity->title); ?> 
                                    (<?php echo e(ucwords(str_replace('_', ' ', $activity->status))); ?>)
                                    <?php if($activity->time_to_finish): ?>
                                        - <?php echo e($activity->time_to_finish); ?>h
                                    <?php endif; ?>
                                    <?php if($activity->num_persons): ?>
                                        - <?php echo e($activity->num_persons); ?> people
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="form-text">Hold Ctrl (or Cmd on Mac) to select multiple activities. You can also assign activities later from the event details page.</div>
                        <?php $__errorArgs = ['activities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        <strong>No activities available!</strong> 
                        You need to create some activities first before you can assign them to events.
                        <a href="<?php echo e(route('activities.create')); ?>" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="fas fa-plus"></i> Create New Activity
                        </a>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-success" id="submitBtn">
                    <span class="btn-text">Create Event</span>
                    <span class="btn-loading d-none">
                        <i class="fas fa-spinner fa-spin"></i> Creating Event...
                    </span>
                </button>
                <a href="<?php echo e(route('events.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<!-- Loading Screen Overlay -->
<div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="loading-content">
        <div class="loading-spinner">
            <i class="fas fa-magic fa-spin fa-3x text-primary"></i>
        </div>
        <h3 class="loading-title">Creating Your Event</h3>
        <p class="loading-text">Generating AI image for your event...</p>
        <div class="loading-progress">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
            </div>
            <small class="loading-subtext">This may take 20-30 seconds. Please don't close this page.</small>
        </div>
    </div>
</div>

<style>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.95);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
}

.loading-content {
    text-align: center;
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 90%;
}

.loading-spinner {
    margin-bottom: 2rem;
}

.loading-title {
    color: #333;
    margin-bottom: 1rem;
    font-weight: 600;
}

.loading-text {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.loading-progress {
    margin-top: 2rem;
}

.loading-subtext {
    color: #888;
    margin-top: 1rem;
    display: block;
}

.progress {
    height: 8px;
    border-radius: 4px;
    background-color: #f0f0f0;
}

.progress-bar {
    background: linear-gradient(45deg, #007bff, #28a745);
    border-radius: 4px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const progressBar = document.querySelector('.progress-bar');
    
    form.addEventListener('submit', function() {
        // Show loading overlay
        loadingOverlay.style.display = 'flex';
        
        // Disable the submit button
        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
        
        // Simulate progress bar animation
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            progressBar.style.width = progress + '%';
        }, 1000);
        
        // Store interval to clear it later if needed
        window.progressInterval = progressInterval;
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/events/create.blade.php ENDPATH**/ ?>