@if($activities->count() > 0)
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
        @foreach($activities as $activity)
            @if($activity && $activity->id)
            <li class="list-group-item d-flex justify-content-between align-items-center smooth-transition">
                <div class="d-flex align-items-center flex-grow-1">
                    <!-- Checkbox for individual selection -->
                    <div class="form-check me-3">
                        <input class="form-check-input activity-checkbox" 
                               type="checkbox" 
                               value="{{ $activity->id }}" 
                               id="activity_{{ $activity->id }}"
                               onchange="updateBulkActions()">
                    </div>
                    
                    <!-- Activity Icon -->
                    <div class="me-3 activity-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    
                    <div class="flex-grow-1">
                        <a href="{{ route('activities.show', $activity->id) }}" class="text-decoration-none h5 text-dark d-block">
                            {{ $activity->title }}
                        </a>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-badge status-{{ str_replace('_', '-', $activity->status) }}">
                                {{ ucwords(str_replace('_', ' ', $activity->status)) }}
                            </span>
                            <small class="text-muted">
                                <i class="fas fa-users"></i> {{ $activity->num_persons }} person(s)
                            </small>
                            @if($activity->time_to_finish)
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> {{ $activity->time_to_finish }}h
                            </small>
                            @endif
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $activity->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        @if($activity->description)
                        <p class="text-muted mb-0 mt-1" style="max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $activity->description }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-outline-primary btn-sm smooth-transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm smooth-transition">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </li>
            @else
            <li class="list-group-item">
                <div class="alert alert-warning mb-0">
                    <i class="fas fa-exclamation-triangle"></i> 
                    Activity found but missing ID. This might be a database issue.
                </div>
            </li>
            @endif
        @endforeach
    </ul>
@else
    <div class="text-center py-5">
        <div class="activity-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
            <i class="fas fa-tasks"></i>
        </div>
        <p class="text-muted">No activities found. Create one to get started!</p>
    </div>
@endif

