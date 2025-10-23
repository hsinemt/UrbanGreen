@extends('frontOffice.layouts.app')

@section('content')
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Activity Details</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('activities.index') }}">Activities</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>
<style>
    .smooth-transition {
        transition: all 0.3s ease-in-out;
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
    .activity-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        margin: 0 auto;
    }
    .status-badge {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
    }
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-in_progress {
        background-color: #cce5ff;
        color: #004085;
    }
    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4 smooth-transition">
                <h1 class="display-4 text-dark">{{ $activity->title }}</h1>
                <div class="btn-group" role="group">
                    <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-outline-primary smooth-transition">
                        <i class="fas fa-edit"></i> Edit Activity
                    </a>
                    <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary smooth-transition">
                        <i class="fas fa-arrow-left"></i> Back to Activities
                    </a>
                </div>
            </div>

            <div class="card smooth-transition">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="activity-icon mb-4">
                                <i class="fas fa-tasks"></i>
                            </div>
                            
                            <div class="mb-4">
                                <h5 class="text-dark mb-3">
                                    <i class="fas fa-info-circle text-primary"></i> Activity Information
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-tag text-primary"></i> Status:</strong>
                                            <div class="mt-1">
                                                <span class="status-badge status-{{ str_replace('_', '-', $activity->status) }}">
                                                    {{ ucwords(str_replace('_', ' ', $activity->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-users text-primary"></i> People Required:</strong>
                                            <p class="mb-0 text-muted">{{ $activity->num_persons }} person(s)</p>
                                        </div>
                                    </div>
                                </div>

                                @if($activity->time_to_finish)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-clock text-primary"></i> Estimated Time:</strong>
                                            <p class="mb-0 text-muted">{{ $activity->time_to_finish }} hour(s)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong><i class="fas fa-calendar text-primary"></i> Created:</strong>
                                            <p class="mb-0 text-muted">{{ $activity->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="fas fa-chart-pie"></i> Activity Stats
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Progress:</span>
                                            <span>
                                                @if($activity->status === 'pending')
                                                    <span class="badge bg-warning">0%</span>
                                                @elseif($activity->status === 'in_progress')
                                                    <span class="badge bg-info">50%</span>
                                                @else
                                                    <span class="badge bg-success">100%</span>
                                                @endif
                                            </span>
                                        </div>
                                        @php
                                            $progressWidth = $activity->status === 'pending' ? '0%' : ($activity->status === 'in_progress' ? '50%' : '100%');
                                            $progressClass = $activity->status === 'pending' ? 'bg-warning' : ($activity->status === 'in_progress' ? 'bg-info' : 'bg-success');
                                        @endphp
                                        <div class="progress mt-2" style="height: 8px;">
                                            <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $progressWidth }}"></div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span><i class="fas fa-users text-primary"></i> Team Size:</span>
                                            <span class="fw-bold">{{ $activity->num_persons }}</span>
                                        </div>
                                    </div>

                                    @if($activity->time_to_finish)
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span><i class="fas fa-clock text-primary"></i> Duration:</span>
                                            <span class="fw-bold">{{ $activity->time_to_finish }}h</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($activity->description)
                        <div class="mt-4">
                            <h4 class="text-dark mb-3">
                                <i class="fas fa-align-left text-primary"></i> Description
                            </h4>
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <p class="text-muted mb-0" style="white-space: pre-line;">{{ $activity->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($activity->events->count() > 0)
                        <div class="mt-4">
                            <h4 class="text-dark mb-3">
                                <i class="fas fa-calendar text-primary"></i> Associated Events
                            </h4>
                            <div class="row">
                                @foreach($activity->events as $event)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    @if($event->image)
                                                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="me-3" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                                    @else
                                                        <div class="me-3" style="width: 40px; height: 40px; background-color: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d;">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    @endif
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">{{ $event->name }}</h6>
                                                        <small class="text-muted">
                                                            <i class="fas fa-calendar"></i> {{ $event->date ? $event->date->format('M d, Y') : 'No date set' }}
                                                        </small>
                                                    </div>
                                                </div>
                                                @if($event->location)
                                                    <div class="text-muted small">
                                                        <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                                                    </div>
                                                @endif
                                                @if($event->description)
                                                    <p class="text-muted small mt-2 mb-0" style="max-height: 40px; overflow: hidden;">
                                                        {{ Str::limit($event->description, 80) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 text-center">
                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this activity? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger smooth-transition">
                        <i class="fas fa-trash"></i> Delete Activity
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
