@extends('dashboard.layouts.dashboard')

@section('title', 'Edit Activity - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Edit Activity</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">
                <a href="{{ route('back.activities.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    Activities
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Edit</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24">
            <h6 class="text-lg fw-semibold mb-0">Edit Activity #{{ $activity->id }}</h6>
        </div>

        <div class="card-body p-24">
            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="akar-icons:circle-x" class="icon text-xl"></iconify-icon>
                        {{ session('error') }}
                    </div>
                    <button class="remove-button text-danger-600 text-xxl line-height-1" type="button" data-bs-dismiss="alert" aria-label="Close">
                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                    </button>
                </div>
            @endif

            <form action="{{ route('back.activities.update', $activity) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Activity Title <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="title" class="form-control radius-8 @error('title') is-invalid @enderror" 
                                   placeholder="e.g., Tree Planting" value="{{ old('title', $activity->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Description
                            </label>
                            <textarea name="description" class="form-control radius-8 @error('description') is-invalid @enderror" 
                                      rows="4" placeholder="Describe the activity...">{{ old('description', $activity->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Status <span class="text-danger-600">*</span>
                                    </label>
                                    <select name="status" class="form-select radius-8 @error('status') is-invalid @enderror" required>
                                        <option value="">Select Status</option>
                                        <option value="pending" {{ old('status', $activity->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ old('status', $activity->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status', $activity->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Number of Persons <span class="text-danger-600">*</span>
                                    </label>
                                    <input type="number" name="num_persons" class="form-control radius-8 @error('num_persons') is-invalid @enderror" 
                                           placeholder="e.g., 5" value="{{ old('num_persons', $activity->num_persons) }}" min="1" required>
                                    @error('num_persons')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Time to Finish (hours)
                            </label>
                            <input type="number" name="time_to_finish" class="form-control radius-8 @error('time_to_finish') is-invalid @enderror" 
                                   placeholder="e.g., 2" value="{{ old('time_to_finish', $activity->time_to_finish) }}" min="1">
                            @error('time_to_finish')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-info-focus border-info-200">
                            <div class="card-body">
                                <h6 class="fw-semibold text-info-600 mb-3">
                                    <iconify-icon icon="solar:info-circle-linear" class="icon"></iconify-icon>
                                    Activity Details
                                </h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center gap-2 mb-2">
                                        <iconify-icon icon="solar:hashtag-linear" class="icon text-sm text-info-600"></iconify-icon>
                                        <small class="text-info-light">ID: {{ $activity->id }}</small>
                                    </li>
                                    <li class="d-flex align-items-center gap-2 mb-2">
                                        <iconify-icon icon="solar:calendar-add-linear" class="icon text-sm text-info-600"></iconify-icon>
                                        <small class="text-info-light">Created: {{ $activity->created_at->format('Y-m-d') }}</small>
                                    </li>
                                    <li class="d-flex align-items-center gap-2 mb-2">
                                        <iconify-icon icon="solar:calendar-mark-linear" class="icon text-sm text-info-600"></iconify-icon>
                                        <small class="text-info-light">Updated: {{ $activity->updated_at->format('Y-m-d') }}</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mt-24">
                    <button type="submit" class="btn btn-warning d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-circle-linear" class="icon"></iconify-icon>
                        Update Activity
                    </button>
                    <a href="{{ route('back.activities.index') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:arrow-left-linear" class="icon"></iconify-icon>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
