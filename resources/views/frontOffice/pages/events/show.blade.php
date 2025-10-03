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
</style>

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