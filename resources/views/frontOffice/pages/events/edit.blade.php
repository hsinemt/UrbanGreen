@extends('frontOffice.layouts.app')

@section('content')
<style>
    .smooth-transition {
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    .btn {
        transition: all 0.2s ease;
    }
    .btn:hover {
        transform: scale(1.05);
    }
    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 5px;
    }
</style>

<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Edit Event</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4 smooth-transition">
                <h1 class="h3 text-dark mb-0">Edit Event</h1>
                <a href="{{ route('events.index') }}" class="btn btn-secondary smooth-transition">
                    <i class="fas fa-arrow-left me-2"></i>Back to Events
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card smooth-transition">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-dark">Update Event Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Event Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $event->date ? ($event->date instanceof \Illuminate\Support\Carbon ? $event->date->format('Y-m-d') : $event->date) : '') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $event->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter event description...">{{ old('description', $event->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="budget" class="form-label">Budget (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="budget" class="form-control @error('budget') is-invalid @enderror" id="budget" value="{{ old('budget', $event->budget) }}" min="0" step="0.01" placeholder="0.00">
                                @error('budget')
                                    <div class="invalid-feedback">{{ $error }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Enter the budget for this event (optional)</div>
                        </div>

                        <div class="mb-3">
                            <label for="project_id" class="form-label">Related Project (Optional)</label>
                            <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" id="project_id">
                                <option value="">Select a project (optional)</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $event->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }} ({{ ucfirst(str_replace('_', ' ', $project->status)) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                            <div class="form-text">Choose which project this event belongs to (optional)</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Image</label>
                            @if($event->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="Current Event Image" class="image-preview">
                                </div>
                            @endif
                            <div class="alert alert-info">
                                <i class="fas fa-magic"></i> 
                                <strong>AI Image Generation:</strong> You can regenerate the event image using AI. This may take 20-30 seconds.
                                <button type="button" class="btn btn-sm btn-outline-primary ms-2" onclick="regenerateImage()">
                                    <i class="fas fa-sync"></i> Regenerate Image
                                </button>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Note:</strong> To manage activities for this event, go to the event details page after saving.
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                                <i class="fas fa-eye"></i> View Event Details
                            </a>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary smooth-transition">Cancel</a>
                            <button type="submit" class="btn btn-success smooth-transition">
                                <i class="fas fa-save me-2"></i>Update Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Screen Overlay -->
<div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="loading-content">
        <div class="loading-spinner">
            <i class="fas fa-magic fa-spin fa-3x text-primary"></i>
        </div>
        <h3 class="loading-title">Updating Your Event</h3>
        <p class="loading-text">Regenerating AI image for your event...</p>
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
function regenerateImage() {
    if (confirm('Are you sure you want to regenerate the event image? This will replace the current image.')) {
        // Show loading overlay
        const loadingOverlay = document.getElementById('loadingOverlay');
        const progressBar = document.querySelector('.progress-bar');
        
        loadingOverlay.style.display = 'flex';
        
        // Simulate progress bar animation
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            progressBar.style.width = progress + '%';
        }, 1000);
        
        // Store interval to clear it later if needed
        window.progressInterval = progressInterval;
        
        // Add a hidden input to indicate image regeneration
        const form = document.querySelector('form');
        const regenerateInput = document.createElement('input');
        regenerateInput.type = 'hidden';
        regenerateInput.name = 'regenerate_image';
        regenerateInput.value = '1';
        form.appendChild(regenerateInput);
        
        // Submit the form
        form.submit();
    }
}

// Also add loading for regular form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const progressBar = document.querySelector('.progress-bar');
    
    form.addEventListener('submit', function() {
        // Only show loading if not regenerating image (regenerateImage function handles that)
        if (!form.querySelector('input[name="regenerate_image"]')) {
            loadingOverlay.style.display = 'flex';
            
            // Simulate progress bar animation
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 90) progress = 90;
                progressBar.style.width = progress + '%';
            }, 1000);
            
            // Store interval to clear it later if needed
            window.progressInterval = progressInterval;
        }
    });
});
</script>
@endsection