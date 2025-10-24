<?php if($activities->count() > 0): ?>
    <!-- Select All Checkbox -->
    <div class="mb-3 p-3 bg-light rounded">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleSelectAll()">
            <label class="form-check-label" for="selectAll">
                <strong>Select All Activities</strong>
            </label>
        </div>
    </div>

    <ul class="list-group list-group-flush">
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($activity && $activity->id): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center smooth-transition">
                <div class="d-flex align-items-center flex-grow-1">
                    <!-- Checkbox for individual selection -->
                    <div class="form-check me-3">
                        <input class="form-check-input activity-checkbox" 
                               type="checkbox" 
                               value="<?php echo e($activity->id); ?>" 
                               id="activity_<?php echo e($activity->id); ?>"
                               onchange="updateBulkActions()">
                    </div>
                    
                    <!-- Activity Icon -->
                    <div class="me-3 activity-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    
                    <div class="flex-grow-1">
                        <a href="<?php echo e(route('activities.show', $activity->id)); ?>" class="text-decoration-none h5 text-dark d-block">
                            <?php echo e($activity->title); ?>

                        </a>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-badge status-<?php echo e(str_replace('_', '-', $activity->status)); ?>">
                                <?php echo e(ucwords(str_replace('_', ' ', $activity->status))); ?>

                            </span>
                            <small class="text-muted">
                                <i class="fas fa-users"></i> <?php echo e($activity->num_persons); ?> person(s)
                            </small>
                            <?php if($activity->time_to_finish): ?>
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> <?php echo e($activity->time_to_finish); ?>h
                            </small>
                            <?php endif; ?>
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> <?php echo e($activity->created_at->format('M d, Y')); ?>

                            </small>
                        </div>
                        <?php if($activity->description): ?>
                        <p class="text-muted mb-0 mt-1" style="max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?php echo e($activity->description); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <a href="<?php echo e(route('activities.edit', $activity->id)); ?>" class="btn btn-outline-primary btn-sm smooth-transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="<?php echo e(route('activities.destroy', $activity->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm smooth-transition">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </li>
            <?php else: ?>
            <li class="list-group-item">
                <div class="alert alert-warning mb-0">
                    <i class="fas fa-exclamation-triangle"></i> 
                    Activity found but missing ID. This might be a database issue.
                </div>
            </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php else: ?>
    <div class="text-center py-5">
        <div class="activity-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
            <i class="fas fa-tasks"></i>
        </div>
        <p class="text-muted">No activities found. Create one to get started!</p>
    </div>
<?php endif; ?>

<?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/activities/partials/activity-list.blade.php ENDPATH**/ ?>