@extends('dashboard.layouts.dashboard')

@section('title', 'Event Details - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Event Details</h6>
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
            <li class="fw-medium">Details</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Event #{{ $event->id }}</h6>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('back.events.edit', $event) }}" class="btn btn-warning btn-sm d-flex align-items-center gap-2">
                            <iconify-icon icon="lucide:edit" class="icon"></iconify-icon>
                            Edit
                        </a>
                        <form action="{{ route('back.events.destroy', $event) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this event?')">
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
                            <h4 class="fw-semibold text-primary-600 mb-2">{{ $event->name }}</h4>
                            @if($event->description)
                                <p class="text-secondary-light mb-0">{{ $event->description }}</p>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:calendar-linear" class="icon text-xxl text-primary-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Event Date</span>
                                    <p class="mb-0 fw-medium">{{ $event->date->format('Y-m-d') }}</p>
                                    <small class="text-secondary-light">{{ $event->date->format('l, F j, Y') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:map-point-linear" class="icon text-xxl text-info-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Location</span>
                                    <p class="mb-0 fw-medium">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>

                        @if($event->budget)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:dollar-linear" class="icon text-xxl text-success-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Budget</span>
                                    <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">
                                        ${{ number_format($event->budget, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:calendar-add-linear" class="icon text-xxl text-secondary-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Created At</span>
                                    <p class="mb-0 fw-medium">{{ $event->created_at->format('Y-m-d H:i') }}</p>
                                    <small class="text-secondary-light">{{ $event->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:calendar-mark-linear" class="icon text-xxl text-secondary-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Last Updated</span>
                                    <p class="mb-0 fw-medium">{{ $event->updated_at->format('Y-m-d H:i') }}</p>
                                    <small class="text-secondary-light">{{ $event->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>

                        @if($event->image)
                        <div class="col-12 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <iconify-icon icon="solar:image-linear" class="icon text-xxl text-success-600"></iconify-icon>
                                <div>
                                    <span class="text-secondary-light text-sm d-block mb-1">Event Image</span>
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-fluid radius-8" style="max-width: 300px;">
                                    <small class="text-success-light d-block mt-1">AI Generated Image</small>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($weatherData)
                        <div class="col-12 mb-3">
                            <div class="card bg-info-focus border-info-200">
                                <div class="card-body">
                                    <h6 class="fw-semibold text-info-600 mb-3">
                                        <iconify-icon icon="solar:cloud-linear" class="icon"></iconify-icon>
                                        Weather Forecast
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <iconify-icon icon="solar:temperature-linear" class="icon text-xxl text-info-600 mb-2"></iconify-icon>
                                                <p class="mb-0 fw-semibold">{{ $weatherData['temperature'] ?? 'N/A' }}°C</p>
                                                <small class="text-info-light">Temperature</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <iconify-icon icon="solar:cloud-rain-linear" class="icon text-xxl text-info-600 mb-2"></iconify-icon>
                                                <p class="mb-0 fw-semibold">{{ $weatherData['humidity'] ?? 'N/A' }}%</p>
                                                <small class="text-info-light">Humidity</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <iconify-icon icon="solar:wind-linear" class="icon text-xxl text-info-600 mb-2"></iconify-icon>
                                                <p class="mb-0 fw-semibold">{{ $weatherData['wind_speed'] ?? 'N/A' }} km/h</p>
                                                <small class="text-info-light">Wind Speed</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Related Activities</h6>
                </div>
                <div class="card-body p-24">
                    @if($event->activities && $event->activities->count() > 0)
                        @foreach($event->activities as $activity)
                            <div class="d-flex align-items-center gap-3 mb-3 p-3 bg-neutral-100 radius-8">
                                <iconify-icon icon="solar:activity-linear" class="icon text-xl text-primary-600"></iconify-icon>
                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1">{{ $activity->title }}</h6>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="bg-info-focus text-info-main px-8 py-2 radius-4 fw-medium text-xs">
                                            {{ ucfirst(str_replace('_', ' ', $activity->status)) }}
                                        </span>
                                        <span class="text-secondary-light text-sm">{{ $activity->num_persons }} persons</span>
                                    </div>
                                </div>
                                <form action="{{ route('back.events.remove-activity', $event) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Remove this activity from the event?')">
                                        <iconify-icon icon="solar:close-circle-linear" class="icon"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <iconify-icon icon="solar:activity-linear" class="icon text-xxl text-secondary-light mb-2"></iconify-icon>
                            <p class="mb-0 text-secondary-light">No related activities</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
