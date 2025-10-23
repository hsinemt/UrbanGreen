@extends('dashboard.layouts.dashboard')

@section('title', 'Activity Details - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Activity Details</h6>
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
            <li class="fw-medium">Details</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Activity #{{ $activity->id }}</h6>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('back.activities.edit', $activity) }}" class="btn btn-warning btn-sm d-flex align-items-center gap-2">
                            <iconify-icon icon="lucide:edit" class="icon"></iconify-icon>
                            Edit
                        </a>
                        <form action="{{ route('back.activities.destroy', $activity) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this activity?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-2">
                                <iconify-icon icon="fluent:delete-24-regular" class="icon"></iconify-icon>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body p-24">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h4 class="fw-semibold text-primary-600 mb-2">{{ $activity->title }}</h4>
                            @if($activity->description)
                                <p class="text-secondary-light mb-0">{{ $activity->description }}</p>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:activity-linear" class="icon text-xxl text-primary-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Status</span>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-warning-focus text-warning-main',
                                            'in_progress' => 'bg-info-focus text-info-main',
                                            'completed' => 'bg-success-focus text-success-main'
                                        ];
                                    @endphp
                                    <span class="px-16 py-4 radius-4 fw-medium text-sm {{ $statusColors[$activity->status] }}">
                                        {{ ucfirst(str_replace('_', ' ', $activity->status)) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:users-group-linear" class="icon text-xxl text-info-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Number of Persons</span>
                                    <span class="bg-info-focus text-info-main px-16 py-4 radius-4 fw-medium text-sm">{{ $activity->num_persons }}</span>
                                </div>
                            </div>
                        </div>

                        @if($activity->time_to_finish)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:clock-linear" class="icon text-xxl text-success-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Time to Finish</span>
                                    <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">{{ $activity->time_to_finish }} hours</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:calendar-add-linear" class="icon text-xxl text-secondary-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Created At</span>
                                    <p class="mb-0 fw-medium">{{ $activity->created_at->format('Y-m-d H:i') }}</p>
                                    <small class="text-secondary-light">{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:calendar-mark-linear" class="icon text-xxl text-secondary-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Last Updated</span>
                                    <p class="mb-0 fw-medium">{{ $activity->updated_at->format('Y-m-d H:i') }}</p>
                                    <small class="text-secondary-light">{{ $activity->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Related Events</h6>
                </div>
                <div class="card-body p-24">
                    @if($activity->events && $activity->events->count() > 0)
                        @foreach($activity->events as $event)
                            <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-neutral-100 radius-8">
                                <iconify-icon icon="solar:calendar-linear" class="icon text-xl text-primary-600"></iconify-icon>
                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1">{{ $event->name }}</h6>
                                    <small class="text-secondary-light">{{ $event->date->format('Y-m-d') }} at {{ $event->location }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <iconify-icon icon="solar:calendar-linear" class="icon text-xxl text-secondary-light mb-2"></iconify-icon>
                            <p class="mb-0 text-secondary-light">No related events</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
