@extends('dashboard.layouts.dashboard')

@section('title', 'Create Event - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Create Event</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">
                <a href="{{ route('back.events.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    Events
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Create</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24">
            <h6 class="text-lg fw-semibold mb-0">Create New Event</h6>
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

            <form action="{{ route('back.events.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Event Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" name="name" class="form-control radius-8 @error('name') is-invalid @enderror" 
                                   placeholder="e.g., Community Tree Planting" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Description
                            </label>
                            <textarea name="description" class="form-control radius-8 @error('description') is-invalid @enderror" 
                                      rows="4" placeholder="Describe the event...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Event Date <span class="text-danger-600">*</span>
                                    </label>
                                    <input type="date" name="date" class="form-control radius-8 @error('date') is-invalid @enderror" 
                                           value="{{ old('date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Location <span class="text-danger-600">*</span>
                                    </label>
                                    <input type="text" name="location" class="form-control radius-8 @error('location') is-invalid @enderror" 
                                           placeholder="e.g., Central Park" value="{{ old('location') }}" required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Budget
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="budget" class="form-control radius-8 @error('budget') is-invalid @enderror" 
                                       placeholder="0.00" value="{{ old('budget') }}" min="0" step="0.01">
                                @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Related Project
                            </label>
                            <select name="project_id" class="form-select radius-8 @error('project_id') is-invalid @enderror">
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
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Related Activities
                            </label>
                            <div class="activity-selection-container">
                                @foreach($activities as $activity)
                                    <div class="form-check mb-2 p-3 border radius-8 hover-bg-neutral-100">
                                        <input class="form-check-input" type="checkbox" name="activities[]" value="{{ $activity->id }}" id="activity_{{ $activity->id }}" 
                                               {{ in_array($activity->id, old('activities', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label w-100" for="activity_{{ $activity->id }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="fw-semibold text-primary-600">{{ $activity->title }}</span>
                                                    <br>
                                                    <small class="text-secondary-light">
                                                        <iconify-icon icon="solar:users-group-linear" class="icon text-sm"></iconify-icon>
                                                        {{ $activity->num_persons }} people
                                                        @if($activity->time_to_finish)
                                                            • <iconify-icon icon="solar:clock-linear" class="icon text-sm"></iconify-icon>
                                                            {{ $activity->time_to_finish }}h
                                                        @endif
                                                    </small>
                                                </div>
                                                <div>
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'bg-warning-focus text-warning-main',
                                                            'in_progress' => 'bg-info-focus text-info-main',
                                                            'completed' => 'bg-success-focus text-success-main'
                                                        ];
                                                    @endphp
                                                    <span class="px-12 py-2 radius-4 fw-medium text-xs {{ $statusColors[$activity->status] }}">
                                                        {{ ucfirst(str_replace('_', ' ', $activity->status)) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('activities')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-primary-focus border-primary-200">
                            <div class="card-body">
                                <h6 class="fw-semibold text-primary-600 mb-3">
                                    <iconify-icon icon="solar:info-circle-linear" class="icon"></iconify-icon>
                                    Event Information
                                </h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center gap-2 mb-2">
                                        <iconify-icon icon="solar:calendar-linear" class="icon text-sm text-primary-600"></iconify-icon>
                                        <small class="text-primary-light">Events organize environmental activities</small>
                                    </li>
                                    <li class="d-flex align-items-center gap-2 mb-2">
                                        <iconify-icon icon="solar:map-point-linear" class="icon text-sm text-primary-600"></iconify-icon>
                                        <small class="text-primary-light">Specify the event location</small>
                                    </li>
                                    <li class="d-flex align-items-center gap-2 mb-2">
                                        <iconify-icon icon="solar:activity-linear" class="icon text-sm text-primary-600"></iconify-icon>
                                        <small class="text-primary-light">Link related activities</small>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if($activities->count() > 0)
                        <div class="card bg-info-focus border-info-200 mt-3">
                            <div class="card-body">
                                <h6 class="fw-semibold text-info-600 mb-3">
                                    <iconify-icon icon="solar:activity-linear" class="icon"></iconify-icon>
                                    Available Activities
                                </h6>
                                <div class="d-flex flex-column gap-2">
                                    @foreach($activities->take(5) as $activity)
                                        <div class="d-flex align-items-center gap-2">
                                            <iconify-icon icon="solar:activity-linear" class="icon text-sm text-info-600"></iconify-icon>
                                            <small class="text-info-light">{{ $activity->title }}</small>
                                        </div>
                                    @endforeach
                                    @if($activities->count() > 5)
                                        <small class="text-info-light">... and {{ $activities->count() - 5 }} more</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mt-24">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="ic:baseline-plus" class="icon"></iconify-icon>
                        Create Event
                    </button>
                    <a href="{{ route('back.events.index') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:arrow-left-linear" class="icon"></iconify-icon>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
.activity-selection-container {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 10px;
    background-color: #f8f9fa;
}

.activity-selection-container .form-check {
    transition: all 0.2s ease;
    cursor: pointer;
}

.activity-selection-container .form-check:hover {
    background-color: #e9ecef !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.activity-selection-container .form-check-input:checked + .form-check-label {
    background-color: #d1ecf1;
}

.activity-selection-container .form-check-input {
    margin-top: 0.5rem;
}

.activity-selection-container .form-check-label {
    cursor: pointer;
    padding: 0;
}
</style>
@endpush
