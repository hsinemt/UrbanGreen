@extends('dashboard.layouts.dashboard')
@section('title', 'Project Details')

@section('breadcrumb')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Project Details</h6>
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
        <li class="fw-medium">{{ $projet->name }}</li>
    </ul>
</div>
@endsection

@section('content')
<div class="row gy-4">
    <!-- Project Info -->
    <div class="col-xxl-8">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <h4 class="fw-semibold mb-0">{{ $projet->name }}</h4>
                @if(auth()->user()->isAdmin() || (auth()->user()->isAssociation() || auth()->user()->isPartner()) && $projet->user_id == auth()->id())
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('back.projects.edit', $projet) }}" class="btn btn-warning btn-sm">
                        <iconify-icon icon="solar:pen-outline"></iconify-icon>
                        Edit
                    </a>
                    <form action="{{ route('back.projects.destroy', $projet) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <iconify-icon icon="solar:trash-bin-outline"></iconify-icon>
                            Delete
                        </button>
                    </form>
                </div>
                @endif
            </div>
            <div class="card-body p-24">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:user-outline" class="icon text-xxl text-primary-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Owner</span>
                                <h6 class="fw-medium mb-0">{{ $projet->user ? $projet->user->name : 'No Owner' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:flag-outline" class="icon text-xxl text-success-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Status</span>
                                <span class="badge badge-{{ $projet->status === 'completed' ? 'success' : ($projet->status === 'in_progress' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $projet->status)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:calendar-outline" class="icon text-xxl text-info-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Start Date</span>
                                <p class="mb-0 fw-medium">{{ $projet->start_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:calendar-mark-outline" class="icon text-xxl text-warning-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">End Date</span>
                                <p class="mb-0 fw-medium">{{ $projet->end_date ? $projet->end_date->format('M d, Y') : 'Ongoing' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:dollar-outline" class="icon text-xxl text-success-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Budget</span>
                                <p class="mb-0 fw-medium">${{ number_format($projet->budget) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:chart-outline" class="icon text-xxl text-primary-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Progress</span>
                                <div class="progress" style="width: 150px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $projet->progress_percentage }}%">
                                        {{ $projet->progress_percentage }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h6 class="fw-semibold mb-2">Description</h6>
                    <p class="text-secondary-light">{{ $projet->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Stats & Related -->
    <div class="col-xxl-4">
        <div class="row gy-4">
            <!-- Project Stats -->
            <div class="col-12">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h5 class="fw-semibold mb-0">Project Statistics</h5>
                    </div>
                    <div class="card-body p-24">
                        <div class="text-center mb-3">
                            <h3 class="text-primary">{{ $projet->progress_percentage }}%</h3>
                            <p class="text-muted mb-0">Completion</p>
                        </div>
                        <div class="text-center mb-3">
                            <h3 class="text-success">${{ number_format($projet->budget) }}</h3>
                            <p class="text-muted mb-0">Total Budget</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-info">{{ $projet->created_at->diffInDays(now()) }}</h3>
                            <p class="text-muted mb-0">Days Active</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Projects -->
            @if($relatedProjects->count() > 0)
            <div class="col-12">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h5 class="fw-semibold mb-0">Related Projects</h5>
                    </div>
                    <div class="card-body p-24">
                        @foreach($relatedProjects as $related)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $related->name }}</h6>
                                    <small class="text-muted">{{ $related->user->name }}</small>
                                </div>
                                <span class="badge badge-{{ $related->status === 'completed' ? 'success' : ($related->status === 'in_progress' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $related->status)) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
