@extends('frontOffice.layouts.app')

@section('content')
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Create Event</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Create New Event</h2>
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" id="location" value="{{ old('location') }}" required>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="budget" class="form-label">Budget (Optional)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="budget" class="form-control @error('budget') is-invalid @enderror" id="budget" value="{{ old('budget') }}" min="0" step="0.01" placeholder="0.00">
                        @error('budget')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">Enter the budget for this event (optional)</div>
                </div>

                <div class="mb-3">
                    <label for="project_id" class="form-label">Related Project (Optional)</label>
                    <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" id="project_id">
                        <option value="">Select a project (optional)</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }} ({{ ucfirst(str_replace('_', ' ', $project->status)) }})
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Choose which project this event belongs to (optional)</div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-magic"></i> 
                    <strong>AI Image Generation:</strong> An image will be automatically generated for your event based on the event name, description, and location using AI technology. This may take 20-30 seconds.
                </div>

                @if($activities->count() > 0)
                    <div class="mb-3">
                        <label for="activities" class="form-label">Select Activities for this Event</label>
                        <select name="activities[]" class="form-control @error('activities') is-invalid @enderror" id="activities" multiple>
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}" {{ in_array($activity->id, old('activities', [])) ? 'selected' : '' }}>
                                    {{ $activity->title }} 
                                    ({{ ucwords(str_replace('_', ' ', $activity->status)) }})
                                    @if($activity->time_to_finish)
                                        - {{ $activity->time_to_finish }}h
                                    @endif
                                    @if($activity->num_persons)
                                        - {{ $activity->num_persons }} people
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Hold Ctrl (or Cmd on Mac) to select multiple activities. You can also assign activities later from the event details page.</div>
                        @error('activities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        <strong>No activities available!</strong> 
                        You need to create some activities first before you can assign them to events.
                        <a href="{{ route('activities.create') }}" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="fas fa-plus"></i> Create New Activity
                        </a>
                    </div>
                @endif

                <button type="submit" class="btn btn-success" id="submitBtn">
                    <span class="btn-text">Create Event</span>
                    <span class="btn-loading d-none">
                        <i class="fas fa-spinner fa-spin"></i> Creating Event...
                    </span>
                </button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
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
@endsection