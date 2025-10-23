@extends('frontOffice.layouts.app')

@section('content')
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
    .event-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .event-placeholder {
        width: 100%;
        height: 300px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 3rem;
    }
    .weather-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
        border-radius: 10px;
        padding: 15px;
        border: 1px solid #e0e0e0;
    }
    .weather-temp {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1976d2;
        margin-right: 10px;
    }
    .weather-desc {
        font-size: 0.9rem;
        text-transform: capitalize;
    }
    .weather-icon {
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.8);
        padding: 5px;
    }
    .weather-details {
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
</style>

<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Event Details</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4 smooth-transition">
                <h1 class="display-4 text-dark">{{ $event->name }}</h1>
                <div class="btn-group" role="group">
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary smooth-transition">
                        <i class="fas fa-edit"></i> Edit Event
                    </a>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary smooth-transition">
                        <i class="fas fa-arrow-left"></i> Back to Events
                    </a>
                </div>
            </div>

            <div class="card smooth-transition">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-image mb-4 rounded smooth-transition">
                            @else
                                <div class="event-placeholder mb-4 rounded">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">
                                        <i class="fas fa-info-circle"></i> Event Details
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <strong><i class="fas fa-calendar text-primary"></i> Date:</strong>
                                        <p class="mb-0 text-muted">
                                            {{ $event->date ? ($event->date instanceof \Illuminate\Support\Carbon ? $event->date->format('F d, Y') : $event->date) : 'No date set' }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <strong><i class="fas fa-map-marker-alt text-primary"></i> Location:</strong>
                                        <p class="mb-0 text-muted">{{ $event->location ?? 'No location specified' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <strong><i class="fas fa-clock text-primary"></i> Created:</strong>
                                        <p class="mb-0 text-muted">{{ $event->created_at->format('M d, Y') }}</p>
                                    </div>

                                    @if($weatherData)
                                        <div class="mb-3">
                                            <strong><i class="fas fa-thermometer-half text-primary"></i> Weather:</strong>
                                            <div class="weather-info mt-2">
                                                <div class="d-flex align-items-center mb-2">
                                                    <img src="{{ (new \App\Services\WeatherService())->getWeatherIconUrl($weatherData['icon']) }}" 
                                                         alt="{{ $weatherData['description'] }}" 
                                                         class="weather-icon me-2" 
                                                         style="width: 40px; height: 40px;">
                                                    <div>
                                                        <span class="weather-temp">{{ $weatherData['temperature'] }}°C</span>
                                                        <span class="weather-desc text-muted">{{ $weatherData['description'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="weather-details">
                                                    <small class="text-muted">
                                                        <i class="fas fa-eye"></i> Feels like {{ $weatherData['feels_like'] }}°C
                                                        @if($weatherData['humidity'])
                                                            • <i class="fas fa-tint"></i> {{ $weatherData['humidity'] }}% humidity
                                                        @endif
                                                        @if($weatherData['wind_speed'])
                                                            • <i class="fas fa-wind"></i> {{ $weatherData['wind_speed'] }} m/s
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($event->location && $event->date)
                                        <div class="mb-3">
                                            <strong><i class="fas fa-thermometer-half text-primary"></i> Weather:</strong>
                                            <div class="weather-info mt-2">
                                                <div class="text-center text-muted">
                                                    <i class="fas fa-cloud-rain fa-2x mb-2"></i>
                                                    <p class="mb-0">Weather data unavailable</p>
                                                    <small>Unable to fetch weather for {{ $event->location }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($event->description)
                        <div class="mt-4">
                            <h4 class="text-dark mb-3">
                                <i class="fas fa-align-left text-primary"></i> Description
                            </h4>
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <p class="text-muted mb-0" style="white-space: pre-line;">{{ $event->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($event->activities->count() > 0)
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-dark mb-0">
                                    <i class="fas fa-tasks text-primary"></i> Associated Activities
                                </h4>
                            </div>
                            <div class="row">
                                @foreach($event->activities as $activity)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="activity-icon me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                                                        <i class="fas fa-tasks"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">{{ $activity->title }}</h6>
                                                        <span class="status-badge status-{{ str_replace('_', '-', $activity->status) }}" style="font-size: 0.7rem;">
                                                            {{ ucwords(str_replace('_', ' ', $activity->status)) }}
                                                        </span>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="{{ route('activities.show', $activity->id) }}"><i class="fas fa-eye"></i> View</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('activities.edit', $activity->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('events.remove-activity', $event->id) }}" method="POST" style="display:inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Remove this activity from the event?')">
                                                                        <i class="fas fa-unlink"></i> Remove from Event
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between text-muted small">
                                                    <span><i class="fas fa-users"></i> {{ $activity->num_persons }} people</span>
                                                    @if($activity->time_to_finish)
                                                        <span><i class="fas fa-clock"></i> {{ $activity->time_to_finish }}h</span>
                                                    @endif
                                                </div>
                                                @if($activity->description)
                                                    <p class="text-muted small mt-2 mb-0" style="max-height: 40px; overflow: hidden;">
                                                        {{ Str::limit($activity->description, 80) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-dark mb-0">
                                    <i class="fas fa-tasks text-primary"></i> Activities
                                </h4>
                            </div>
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-tasks text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="text-muted mt-3">No activities assigned yet</h5>
                                    <p class="text-muted">Activities were assigned during event creation.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 text-center">
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger smooth-transition">
                        <i class="fas fa-trash"></i> Delete Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection