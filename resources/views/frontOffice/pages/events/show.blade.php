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
        .supplier-action-card {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
        }
        .supplier-action-card:hover {
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.6);
            transform: translateY(-2px);
        }
        .rating-stars {
            color: #ffc107;
            font-size: 1.2rem;
        }
        .star-rating-input {
            display: inline-flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating-input input[type="radio"] {
            display: none;
        }
        .star-rating-input label {
            cursor: pointer;
            font-size: 2rem;
            color: #ddd;
            transition: color 0.2s;
            margin: 0 2px;
        }
        .star-rating-input label:hover,
        .star-rating-input label:hover ~ label,
        .star-rating-input input[type="radio"]:checked ~ label {
            color: #ffc107;
        }
        .feedback-item {
            border-left: 3px solid #667eea;
            padding-left: 15px;
            margin-bottom: 20px;
        }
        .reply-item {
            border-left: 3px solid #ddd;
            padding-left: 15px;
            margin-left: 40px;
            margin-top: 10px;
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
                        @auth
                            @if(!Auth::user()->isSupplier())
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary smooth-transition">
                                    <i class="fas fa-edit"></i> Edit Event
                                </a>
                            @endif
                        @endauth
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary smooth-transition">
                            <i class="fas fa-arrow-left"></i> Back to Events
                        </a>
                    </div>
                </div>

                <!-- Supplier Action Card -->
                @auth
                    @if(Auth::user()->isSupplier())
                        <div class="card supplier-action-card mb-4 smooth-transition">
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <i class="fas fa-box fa-3x"></i>
                                </div>
                                <h4 class="mb-3">
                                    <i class="fas fa-store"></i> Supplier Actions
                                </h4>
                                <p class="mb-4">Help us to make this space green</p>
                                <a href="{{ route('resources.add-to-event', $event->id) }}" class="btn btn-light btn-lg smooth-transition">
                                    <i class="fas fa-plus-circle"></i> Add Resources to Event
                                </a>
                            </div>
                        </div>
                    @endif
                @endauth

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

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

                                        @if(isset($averageRating) && $averageRating > 0)
                                            <div class="mb-3 pt-3 border-top">
                                                <strong><i class="fas fa-star text-warning"></i> Rating:</strong>
                                                <div class="d-flex align-items-center mt-2">
                                                    <div class="rating-stars me-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= floor($averageRating))
                                                                <i class="fas fa-star"></i>
                                                            @elseif($i - 0.5 <= $averageRating)
                                                                <i class="fas fa-star-half-alt"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="text-muted">
                                                        <strong>{{ number_format($averageRating, 1) }}</strong>
                                                        ({{ $totalFeedbackCount ?? 0 }} {{ ($totalFeedbackCount ?? 0) == 1 ? 'review' : 'reviews' }})
                                                    </span>
                                                </div>
                                            </div>
                                        @endif

                                        @auth
                                            @if(Auth::user()->isSupplier())
                                                <div class="mt-4 pt-3 border-top">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                                        <small class="text-muted">Viewing as Supplier</small>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
    
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

                        <!-- Event Feedback Section (SINGLE VERSION - NOT DUPLICATED) -->
                        <div class="mt-4">
                            <h4 class="text-dark mb-3">
                                <i class="fas fa-comments text-primary"></i> Event Feedback & Reviews
                            </h4>

                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <!-- Display All Feedbacks -->
                                    <h5 class="mb-4">
                                        All Feedback
                                        @if(isset($topLevelFeedback))
                                            ({{ $topLevelFeedback->total() }})
                                        @endif
                                    </h5>

                                    @if(isset($topLevelFeedback) && $topLevelFeedback->count() > 0)
                                        @foreach($topLevelFeedback as $feedback)
                                            <div class="feedback-item mb-4">
                                                <div class="d-flex align-items-start">
                                                    <!-- User Avatar -->
                                                    <img src="{{ $feedback->user->avatar_url ?? 'https://ui-avatars.com/api/?name=User&size=50&background=4CAF50&color=fff' }}"
                                                         alt="User Avatar"
                                                         class="rounded-circle me-3"
                                                         width="50"
                                                         height="50"
                                                         style="width:50px; height:50px; object-fit: cover;">

                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <div>
                                                                <!-- Display User Name -->
                                                                <h6 class="mb-0 fw-bold">
                                                                    {{ $feedback->user->full_name ?? 'Unknown User' }}
                                                                </h6>
                                                                <small class="text-muted">
                                                                    {{ $feedback->created_at->diffForHumans() }}
                                                                    @if($feedback->is_edited)
                                                                        <span>(edited)</span>
                                                                    @endif
                                                                </small>
                                                            </div>

                                                            <!-- Delete button for owner -->
                                                            @auth
                                                                @if($feedback->user_id === auth()->id())
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                                                            <i class="fas fa-ellipsis-v"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li>
                                                                                <button type="button" class="dropdown-item" onclick="toggleEdit({{ $feedback->id }})">
                                                                                    <i class="fas fa-edit"></i> Edit
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Delete this feedback?')">
                                                                                        <i class="fas fa-trash"></i> Delete
                                                                                    </button>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            @endauth
                                                        </div>

                                                        <!-- Rating Stars -->
                                                        @if($feedback->rating)
                                                            <div class="mb-2">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $feedback->rating)
                                                                        <i class="fas fa-star text-warning"></i>
                                                                    @else
                                                                        <i class="far fa-star text-warning"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        @endif

                                                        <!-- Comment Text -->
                                                        <p class="mb-2">{{ $feedback->comment }}</p>

                                                        <!-- Edit Form (Hidden by default) -->
                                                        @auth
                                                            @if($feedback->user_id === auth()->id())
                                                                <div id="edit-form-{{ $feedback->id }}" class="mt-3" style="display: none;">
                                                                    <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-2">
                                                                            <label class="form-label fw-bold">Update Rating (optional):</label>
                                                                            <div class="star-rating-input">
                                                                                <input type="radio" name="rating" value="5" id="edit-star5-{{ $feedback->id }}" {{ $feedback->rating == 5 ? 'checked' : '' }}>
                                                                                <label for="edit-star5-{{ $feedback->id }}" title="5 stars">★</label>
                                                                                <input type="radio" name="rating" value="4" id="edit-star4-{{ $feedback->id }}" {{ $feedback->rating == 4 ? 'checked' : '' }}>
                                                                                <label for="edit-star4-{{ $feedback->id }}" title="4 stars">★</label>
                                                                                <input type="radio" name="rating" value="3" id="edit-star3-{{ $feedback->id }}" {{ $feedback->rating == 3 ? 'checked' : '' }}>
                                                                                <label for="edit-star3-{{ $feedback->id }}" title="3 stars">★</label>
                                                                                <input type="radio" name="rating" value="2" id="edit-star2-{{ $feedback->id }}" {{ $feedback->rating == 2 ? 'checked' : '' }}>
                                                                                <label for="edit-star2-{{ $feedback->id }}" title="2 stars">★</label>
                                                                                <input type="radio" name="rating" value="1" id="edit-star1-{{ $feedback->id }}" {{ $feedback->rating == 1 ? 'checked' : '' }}>
                                                                                <label for="edit-star1-{{ $feedback->id }}" title="1 star">★</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <textarea name="comment" rows="3" class="form-control" required>{{ old('comment', $feedback->comment) }}</textarea>
                                                                        </div>
                                                                        <div class="d-flex gap-2">
                                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                                <i class="fas fa-save"></i> Save
                                                                            </button>
                                                                            <button type="button" class="btn btn-sm btn-secondary" onclick="toggleEdit({{ $feedback->id }})">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endauth

                                                        <!-- Like and Reply Buttons -->
                                                        <div class="d-flex gap-3 align-items-center">
                                                            @auth
                                                                <!-- Like Button -->
                                                                <form action="{{ route('feedback.like', $feedback->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-link text-muted p-0 text-decoration-none">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        <strong>{{ $feedback->likes_count }}</strong>
                                                                    </button>
                                                                </form>

                                                                <!-- Reply Button -->
                                                                <button class="btn btn-sm btn-link text-muted p-0 text-decoration-none" onclick="toggleReply({{ $feedback->id }})">
                                                                    <i class="fas fa-reply"></i> Reply
                                                                </button>
                                                            @endauth

                                                            @if($feedback->replies->count() > 0)
                                                                <small class="text-muted">
                                                                    {{ $feedback->replies->count() }} {{ $feedback->replies->count() == 1 ? 'reply' : 'replies' }}
                                                                </small>
                                                            @endif
                                                        </div>

                                                        <!-- Reply Form (Hidden by default) -->
                                                        @auth
                                                            <div id="reply-form-{{ $feedback->id }}" class="mt-3" style="display: none;">
                                                                <form action="{{ route('feedback.store', $event->id) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="parent_feedback_id" value="{{ $feedback->id }}">
                                                                    <div class="d-flex gap-2">
                                                                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->full_name) . '&size=35&background=4CAF50&color=fff' }}"
                                                                             alt="Your Avatar"
                                                                             class="rounded-circle"
                                                                             width="35"
                                                                             height="35"
                                                                             style="width:35px; height:35px; object-fit: cover;">
                                                                        <div class="flex-grow-1">
                                                                            <textarea
                                                                                name="comment"
                                                                                rows="2"
                                                                                class="form-control form-control-sm mb-2"
                                                                                placeholder="Write your reply..."
                                                                                required
                                                                            ></textarea>
                                                                            <div class="d-flex gap-2">
                                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                                    <i class="fas fa-paper-plane"></i> Post
                                                                                </button>
                                                                                <button type="button" class="btn btn-sm btn-secondary" onclick="toggleReply({{ $feedback->id }})">
                                                                                    Cancel
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endauth

                                                        <!-- Display Replies -->
                                                        @if($feedback->replies->count() > 0)
                                                            <div class="mt-3">
                                                                @foreach($feedback->replies as $reply)
                                                                    <div class="reply-item mb-3">
                                                                        <div class="d-flex align-items-start gap-2">
                                                                            <img src="{{ $reply->user->avatar_url ?? 'https://ui-avatars.com/api/?name=User&size=35&background=4CAF50&color=fff' }}"
                                                                                 alt="User Avatar"
                                                                                 class="rounded-circle"
                                                                                 width="35"
                                                                                 height="35"
                                                                                 style="width:35px; height:35px; object-fit: cover;">
                                                                            <div class="flex-grow-1">
                                                                                <div class="d-flex justify-content-between align-items-start">
                                                                                    <div>
                                                                                        <!-- Display Reply User Name -->
                                                                                        <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">
                                                                                            {{ $reply->user->full_name ?? 'Unknown User' }}
                                                                                        </h6>
                                                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                                                            {{ $reply->created_at->diffForHumans() }}
                                                                                        </small>
                                                                                    </div>
                                                                                    @auth
                                                                                        @if($reply->user_id === auth()->id())
                                                                                            <div class="d-flex align-items-center gap-2">
                                                                                                <button type="button" class="btn btn-sm btn-link p-0" onclick="toggleReplyEdit({{ $reply->id }})" title="Edit reply">
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
                                                                                                <form action="{{ route('feedback.destroy', $reply->id) }}" method="POST">
                                                                                                    @csrf
                                                                                                    @method('DELETE')
                                                                                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Delete this reply?')">
                                                                                                        <i class="fas fa-trash"></i>
                                                                                                    </button>
                                                                                                </form>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endauth
                                                                                </div>
                                                                                <p class="mb-0 mt-1" style="font-size: 0.9rem;">{{ $reply->comment }}</p>

                                                                                <!-- Reply Edit Form (Hidden by default) -->
                                                                                @auth
                                                                                    @if($reply->user_id === auth()->id())
                                                                                        <div id="reply-edit-form-{{ $reply->id }}" class="mt-2" style="display: none;">
                                                                                            <form action="{{ route('feedback.update', $reply->id) }}" method="POST">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <div class="mb-2">
                                                                                                    <textarea name="comment" rows="2" class="form-control form-control-sm" required>{{ old('comment', $reply->comment) }}</textarea>
                                                                                                </div>
                                                                                                <div class="d-flex gap-2">
                                                                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                                                                        <i class="fas fa-save"></i> Save
                                                                                                    </button>
                                                                                                    <button type="button" class="btn btn-sm btn-secondary" onclick="toggleReplyEdit({{ $reply->id }})">Cancel</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    @endif
                                                                                @endauth
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Pagination -->
                                        <div class="mt-4">
                                            {{ $topLevelFeedback->links() }}
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No feedback yet. Be the first to share your thoughts!</p>
                                        </div>
                                    @endif

                                    <!-- Leave Feedback Form (At the bottom) -->
                                    @auth
                                        <div class="mt-4 pt-4 border-top">
                                            <h6 class="mb-3">Leave Your Feedback</h6>
                                            <form action="{{ route('feedback.store', $event->id) }}" method="POST">
                                                @csrf

                                                <div class="d-flex gap-3">
                                                    <!-- Current User Avatar -->
                                                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->full_name) . '&size=50&background=4CAF50&color=fff' }}"
                                                         alt="Your Avatar"
                                                         class="rounded-circle"
                                                         width="50"
                                                         height="50"
                                                         style="width:50px; height:50px; object-fit: cover;">

                                                    <div class="flex-grow-1">
                                                        <!-- Star Rating -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Your Rating:</label>
                                                            <div class="star-rating-input">
                                                                <input type="radio" name="rating" value="5" id="star5">
                                                                <label for="star5" title="5 stars">★</label>
                                                                <input type="radio" name="rating" value="4" id="star4">
                                                                <label for="star4" title="4 stars">★</label>
                                                                <input type="radio" name="rating" value="3" id="star3">
                                                                <label for="star3" title="3 stars">★</label>
                                                                <input type="radio" name="rating" value="2" id="star2">
                                                                <label for="star2" title="2 stars">★</label>
                                                                <input type="radio" name="rating" value="1" id="star1">
                                                                <label for="star1" title="1 star">★</label>
                                                            </div>
                                                            @error('rating')
                                                            <small class="text-danger d-block">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!-- Comment Textarea -->
                                                        <div class="mb-3">
                                                            <textarea
                                                                name="comment"
                                                                id="comment"
                                                                rows="3"
                                                                class="form-control"
                                                                placeholder="Share your experience about this event..."
                                                                required
                                                            >{{ old('comment') }}</textarea>
                                                            @error('comment')
                                                            <small class="text-danger d-block">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-paper-plane"></i> Submit Feedback
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="alert alert-warning mt-4">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Please <a href="{{ route('login') }}" class="alert-link fw-bold">login</a> to leave feedback for this event.
                                        </div>
                                    @endauth
                                </div>
            
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

                        <!-- Event Resources Section -->
                        @if(isset($eventResources) && $eventResources->count() > 0)
                            <div class="mt-4">
                                <h4 class="text-dark mb-3">
                                    <i class="fas fa-boxes text-primary"></i> Event Resources
                                </h4>
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th><i class="fas fa-box"></i> Resource Name</th>
                                                    <th><i class="fas fa-tag"></i> Type</th>
                                                    <th><i class="fas fa-sort-numeric-up"></i> Quantity</th>
                                                    <th><i class="fas fa-user"></i> Supplier</th>
                                                    <th><i class="fas fa-calendar"></i> Added</th>
                                                    @auth
                                                        @if(Auth::user()->isSupplier())
                                                            <th><i class="fas fa-cog"></i> Actions</th>
                                                        @endif
                                                    @endauth
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($eventResources as $resource)
                                                    <tr>
                                                        <td><strong>{{ $resource->name }}</strong></td>
                                                        <td><span class="badge bg-info">{{ $resource->type }}</span></td>
                                                        <td><span class="badge bg-success">{{ $resource->quantity }}</span></td>
                                                        <td>
                                                            @if($resource->supplier)
                                                                <strong>{{ $resource->supplier->full_name }}</strong>
                                                            @else
                                                                <span class="text-muted">Unknown</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $resource->created_at->format('M d, Y') }}</td>
                                                        @auth
                                                            @if(Auth::user()->isSupplier() && $resource->supplier_id === Auth::id())
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <a href="{{ route('resources.edit-supplier', $resource->id) }}"
                                                                           class="btn btn-sm btn-outline-primary"
                                                                           title="Edit Resource">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <form action="{{ route('resources.destroy-supplier', $resource->id) }}"
                                                                              method="POST"
                                                                              style="display: inline;"
                                                                              onsubmit="return confirm('Are you sure you want to delete this resource?')">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Resource">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            @elseif(Auth::user()->isSupplier())
                                                                <td><span class="text-muted small">Not your resource</span></td>
                                                            @endif
                                                        @endauth
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @auth
                    @if(!Auth::user()->isSupplier())
                        <div class="mt-4 text-center">
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger smooth-transition">
                                    <i class="fas fa-trash"></i> Delete Event
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <script>
        function toggleReply(feedbackId) {
            const replyForm = document.getElementById('reply-form-' + feedbackId);
            if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        }
    </script>
@endsection


<script>
    function toggleReply(id) {
        var el = document.getElementById('reply-form-' + id);
        if (el) {
            el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
        }
    }
    function toggleEdit(id) {
        var el = document.getElementById('edit-form-' + id);
        if (el) {
            el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
        }
    }
    function toggleReplyEdit(id) {
        var el = document.getElementById('reply-edit-form-' + id);
        if (el) {
            el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
        }
    }
</script>
