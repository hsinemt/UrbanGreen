<?php if($events->count() > 0): ?>
    <!-- Select All Checkbox -->
    <div class="mb-3 p-3 bg-light rounded">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleSelectAll()">
            <label class="form-check-label" for="selectAll">
                <strong>Select All Events</strong>
            </label>
        </div>
    </div>

    <ul class="list-group list-group-flush">
        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($event && $event->id): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center smooth-transition">
                <div class="d-flex align-items-center flex-grow-1">
                    <!-- Checkbox for individual selection -->
                    <div class="form-check me-3">
                        <input class="form-check-input event-checkbox" 
                               type="checkbox" 
                               value="<?php echo e($event->id); ?>" 
                               id="event_<?php echo e($event->id); ?>"
                               onchange="updateBulkActions()">
                    </div>
                    <?php if($event->image): ?>
                        <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->name); ?>" class="me-3 event-image smooth-transition">
                    <?php else: ?>
                        <div class="me-3 event-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    <?php endif; ?>
                    <div class="flex-grow-1">
                        <a href="<?php echo e(route('events.show', $event->id)); ?>" class="text-decoration-none h5 text-dark d-block">
                            <?php echo e($event->name); ?>

                        </a>
                        <small class="text-muted">
                            <?php echo e($event->date ? ($event->date instanceof \Illuminate\Support\Carbon ? $event->date->format('M d, Y') : $event->date) : 'No date set'); ?>

                            <?php if($event->project): ?>
                                • <span class="text-primary"><?php echo e($event->project->name); ?></span>
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <a href="<?php echo e(route('events.edit', $event->id)); ?>" class="btn btn-outline-primary btn-sm smooth-transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="<?php echo e(route('events.destroy', $event->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
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
                    Event found but missing ID. This might be a database issue.
                </div>
            </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php else: ?>
    <div class="text-center py-5">
        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
        <p class="text-muted">No events found. Create one to get started!</p>
    </div>
<?php endif; ?>
<?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/events/partials/event-list.blade.php ENDPATH**/ ?>