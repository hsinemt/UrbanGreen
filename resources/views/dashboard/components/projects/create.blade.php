@extends('dashboard.layouts.dashboard')
@section('title', 'Create Project')

@section('breadcrumb')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Create Project</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="{{ route('back.projects.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                Projects
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Create</li>
    </ul>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h4 class="fw-semibold mb-0">Create New Project</h4>
            </div>
            <div class="card-body p-24">
                <form action="{{ route('back.projects.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Project Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control radius-8 @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Owner
                            </label>
                            <select class="form-control radius-8 @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">Select Owner</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Description <span class="text-danger-600">*</span>
                        </label>
                        <textarea class="form-control radius-8 @error('description') is-invalid @enderror" 
                                  name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Status <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-control radius-8 @error('status') is-invalid @enderror" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Progress (%) <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" class="form-control radius-8 @error('progress_percentage') is-invalid @enderror" 
                                   name="progress_percentage" value="{{ old('progress_percentage', 0) }}" 
                                   min="0" max="100" required>
                            @error('progress_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Budget ($) <span class="text-danger-600">*</span>
                            </label>
                            <input type="number" class="form-control radius-8 @error('budget') is-invalid @enderror" 
                                   name="budget" value="{{ old('budget') }}" 
                                   min="0" step="0.01" required>
                            @error('budget')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Start Date <span class="text-danger-600">*</span>
                            </label>
                            <input type="date" class="form-control radius-8 @error('start_date') is-invalid @enderror" 
                                   name="start_date" value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                End Date
                            </label>
                            <input type="date" class="form-control radius-8 @error('end_date') is-invalid @enderror" 
                                   name="end_date" value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Priority
                            </label>
                            <select class="form-control radius-8 @error('priority') is-invalid @enderror" name="priority">
                                <option value="">Select Priority</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('priority') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? '(Lowest)' : ($i == 5 ? '(Highest)' : '') }}
                                    </option>
                                @endfor
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Visibility
                            </label>
                            <select class="form-control radius-8 @error('visibility') is-invalid @enderror" name="visibility">
                                <option value="">Select Visibility</option>
                                <option value="public" {{ old('visibility') == 'public' ? 'selected' : '' }}>Public</option>
                                <option value="private" {{ old('visibility') == 'private' ? 'selected' : '' }}>Private</option>
                            </select>
                            @error('visibility')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                            Tags
                        </label>
                        <input type="text" class="form-control radius-8 @error('tags') is-invalid @enderror" 
                               name="tags" value="{{ old('tags') }}" 
                               placeholder="Enter tags separated by commas">
                        <small class="form-text text-muted">Separate multiple tags with commas</small>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('back.projects.index') }}" class="btn btn-secondary">
                            <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                            Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
