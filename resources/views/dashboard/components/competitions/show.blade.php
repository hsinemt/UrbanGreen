@extends('dashboard.layouts.dashboard')
@section('title', 'Competition Details')

@section('breadcrumb')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Competition Details</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="{{ route('back.competitions.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                Competitions
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">{{ $competition->reward }}</li>
    </ul>
</div>
@endsection

@section('content')
<div class="row gy-4">
    <!-- Competition Info -->
    <div class="col-xxl-8">
        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <h4 class="fw-semibold mb-0">{{ $competition->reward }}</h4>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('back.competitions.edit', $competition) }}" class="btn btn-warning btn-sm">
                        <iconify-icon icon="solar:pen-outline"></iconify-icon>
                        Edit
                    </a>
                    <form action="{{ route('back.competitions.destroy', $competition) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this competition?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <iconify-icon icon="solar:trash-bin-outline"></iconify-icon>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body p-24">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:user-outline" class="icon text-xxl text-primary-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Partner</span>
                                <h6 class="fw-medium mb-0">{{ $competition->partner->name ?? 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:folder-outline" class="icon text-xxl text-success-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Project</span>
                                <h6 class="fw-medium mb-0">{{ $competition->project->name ?? 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:calendar-outline" class="icon text-xxl text-info-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Created</span>
                                <p class="mb-0 fw-medium">{{ $competition->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <iconify-icon icon="solar:users-group-outline" class="icon text-xxl text-warning-600"></iconify-icon>
                            <div>
                                <span class="text-secondary-light text-sm d-block mb-1">Participating Associations</span>
                                <p class="mb-0 fw-medium">{{ $competition->associations->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($competition->description)
                <div class="mt-4">
                    <h6 class="fw-semibold mb-2">Description</h6>
                    <p class="text-secondary-light">{{ $competition->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Competition Stats & Associations -->
    <div class="col-xxl-4">
        <div class="row gy-4">
            <!-- Competition Stats -->
            <div class="col-12">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h5 class="fw-semibold mb-0">Competition Statistics</h5>
                    </div>
                    <div class="card-body p-24">
                        <div class="text-center mb-3">
                            <h3 class="text-primary">{{ $competition->associations->count() }}</h3>
                            <p class="text-muted mb-0">Participating Associations</p>
                        </div>
                        <div class="text-center mb-3">
                            <h3 class="text-success">1</h3>
                            <p class="text-muted mb-0">Project Involved</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-info">{{ $competition->created_at->diffInDays(now()) }}</h3>
                            <p class="text-muted mb-0">Days Active</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participating Associations -->
            @if($competition->associations->count() > 0)
            <div class="col-12">
                <div class="card h-100 p-0 radius-12">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h5 class="fw-semibold mb-0">Participating Associations</h5>
                    </div>
                    <div class="card-body p-24">
                        @foreach($competition->associations as $association)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="w-40-px h-40-px rounded-circle bg-primary-100 d-flex align-items-center justify-content-center">
                                    <iconify-icon icon="solar:user-outline" class="icon text-primary-600"></iconify-icon>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $association->name }}</h6>
                                    <small class="text-muted">{{ $association->email }}</small>
                                </div>
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
