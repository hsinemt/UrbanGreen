<?php $__env->startSection('content'); ?>
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

<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="<?php echo e(asset('frontOffice/img/page_heading_bg.jpg')); ?>">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Event Details</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('events.index')); ?>">Events</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4 smooth-transition">
                    <h1 class="display-4 text-dark"><?php echo e($event->name); ?></h1>
                    <div class="btn-group" role="group">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(!Auth::user()->isSupplier()): ?>
                                <a href="<?php echo e(route('events.edit', $event->id)); ?>" class="btn btn-outline-primary smooth-transition">
                                    <i class="fas fa-edit"></i> Edit Event
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="<?php echo e(route('events.index')); ?>" class="btn btn-outline-secondary smooth-transition">
                            <i class="fas fa-arrow-left"></i> Back to Events
                        </a>
                    </div>
                </div>

                <!-- Supplier Action Card -->
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isSupplier()): ?>
                        <div class="card supplier-action-card mb-4 smooth-transition">
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <i class="fas fa-box fa-3x"></i>
                                </div>
                                <h4 class="mb-3">
                                    <i class="fas fa-store"></i> Supplier Actions
                                </h4>
                                <p class="mb-4">Help us to make this space green</p>
                                <a href="<?php echo e(route('resources.add-to-event', $event->id)); ?>" class="btn btn-light btn-lg smooth-transition">
                                    <i class="fas fa-plus-circle"></i> Add Resources to Event
                                </a>
                                <button onclick="getSuggestedResources()" class="btn btn-outline-light btn-lg smooth-transition mt-2">
                                    <i class="fas fa-lightbulb"></i> Get Resource Suggestions
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Resource Suggestions Section -->
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isSupplier()): ?>
                        <div id="suggestions-container" style="display: none;" class="card mb-4 smooth-transition">
                            <div class="card-body">
                                <h4 class="text-dark mb-3">
                                    <i class="fas fa-lightbulb text-warning"></i> AI-Powered Resource Suggestions
                                </h4>

                                <!-- Loading State -->
                                <div id="suggestions-loading" style="display: none;" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-3 text-muted">Analyzing event and generating suggestions...</p>
                                </div>

                                <!-- Error State -->
                                <div id="suggestions-error" style="display: none;" class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle"></i> <span id="suggestions-error-message"></span>
                                </div>

                                <!-- Suggestions Display -->
                                <div id="suggestions-display" style="display: none;">
                                    <div class="alert alert-info mb-3">
                                        <i class="fas fa-info-circle"></i> Overall Confidence: <strong><span id="overall-confidence"></span>%</strong>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th><i class="fas fa-box"></i> Resource Name</th>
                                                    <th><i class="fas fa-chart-line"></i> Confidence</th>
                                                    <th><i class="fas fa-check"></i> Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="suggestions-list">
                                                <!-- Suggestions will be populated here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card smooth-transition">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <?php if($event->image): ?>

                                    <img src="<?php echo e(asset('storage/events/' . basename($event->image))); ?>" alt="<?php echo e($event->name); ?>" class="event-image mb-4 rounded smooth-transition">
                                <?php else: ?>
                                    <div class="event-placeholder mb-4 rounded">
                                        <i class="fas fa-image"></i>
                                    </div>
                                <?php endif; ?>
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
                                                <?php echo e($event->date ? ($event->date instanceof \Illuminate\Support\Carbon ? $event->date->format('F d, Y') : $event->date) : 'No date set'); ?>

                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <strong><i class="fas fa-map-marker-alt text-primary"></i> Location:</strong>
                                            <p class="mb-0 text-muted"><?php echo e($event->location ?? 'No location specified'); ?></p>
                                        </div>

                                        <div class="mb-3">
                                            <strong><i class="fas fa-clock text-primary"></i> Created:</strong>
                                            <p class="mb-0 text-muted"><?php echo e($event->created_at->format('M d, Y')); ?></p>
                                        </div>

                                        <?php if(isset($averageRating) && $averageRating > 0): ?>
                                            <div class="mb-3 pt-3 border-top">
                                                <strong><i class="fas fa-star text-warning"></i> Rating:</strong>
                                                <div class="d-flex align-items-center mt-2">
                                                    <div class="rating-stars me-2">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <?php if($i <= floor($averageRating)): ?>
                                                                <i class="fas fa-star"></i>
                                                            <?php elseif($i - 0.5 <= $averageRating): ?>
                                                                <i class="fas fa-star-half-alt"></i>
                                                            <?php else: ?>
                                                                <i class="far fa-star"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <span class="text-muted">
                                                        <strong><?php echo e(number_format($averageRating, 1)); ?></strong>
                                                        (<?php echo e($totalFeedbackCount ?? 0); ?> <?php echo e(($totalFeedbackCount ?? 0) == 1 ? 'review' : 'reviews'); ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(Auth::user()->isSupplier()): ?>
                                                <div class="mt-4 pt-3 border-top">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                                        <small class="text-muted">Viewing as Supplier</small>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php if($weatherData): ?>
                                        <div class="mb-3">
                                            <strong><i class="fas fa-thermometer-half text-primary"></i> Weather:</strong>
                                            <div class="weather-info mt-2">
                                                <div class="d-flex align-items-center mb-2">
                                                    <img src="<?php echo e((new \App\Services\WeatherService())->getWeatherIconUrl($weatherData['icon'])); ?>"
                                                         alt="<?php echo e($weatherData['description']); ?>"
                                                         class="weather-icon me-2"
                                                         style="width: 40px; height: 40px;">
                                                    <div>
                                                        <span class="weather-temp"><?php echo e($weatherData['temperature']); ?>°C</span>
                                                        <span class="weather-desc text-muted"><?php echo e($weatherData['description']); ?></span>
                                                    </div>
                                                </div>
                                                <div class="weather-details">
                                                    <small class="text-muted">
                                                        <i class="fas fa-eye"></i> Feels like <?php echo e($weatherData['feels_like']); ?>°C
                                                        <?php if($weatherData['humidity']): ?>
                                                            • <i class="fas fa-tint"></i> <?php echo e($weatherData['humidity']); ?>% humidity
                                                        <?php endif; ?>
                                                        <?php if($weatherData['wind_speed']): ?>
                                                            • <i class="fas fa-wind"></i> <?php echo e($weatherData['wind_speed']); ?> m/s
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif($event->location && $event->date): ?>
                                        <div class="mb-3">
                                            <strong><i class="fas fa-thermometer-half text-primary"></i> Weather:</strong>
                                            <div class="weather-info mt-2">
                                                <div class="text-center text-muted">
                                                    <i class="fas fa-cloud-rain fa-2x mb-2"></i>
                                                    <p class="mb-0">Weather data unavailable</p>
                                                    <small>Unable to fetch weather for <?php echo e($event->location); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                </div>
                            </div>
                        </div>

                        <?php if($event->description): ?>
                            <div class="mt-4">
                                <h4 class="text-dark mb-3">
                                    <i class="fas fa-align-left text-primary"></i> Description
                                </h4>
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <p class="text-muted mb-0" style="white-space: pre-line;"><?php echo e($event->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- AI Comment Summary Section -->
                        <div class="mt-4" id="summary-section">
                            <h4 class="text-dark mb-3">
                                <i class="fas fa-robot text-primary"></i> AI Comment Summary
                            </h4>

                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <?php
                                        $mainCommentsCount = isset($topLevelFeedback) ? $topLevelFeedback->total() : 0;
                                        $hasEnoughComments = $mainCommentsCount >= 5;
                                    ?>

                                        <!-- Summary Button -->
                                    <div id="summary-button-container" class="text-center py-3">
                                        <button id="summarize-btn"
                                                class="btn btn-primary btn-lg"
                                                onclick="generateSummary()"
                                            <?php echo e(!$hasEnoughComments ? 'disabled' : ''); ?>>
                                            <i class="fas fa-magic me-2"></i> Summarize Comments
                                        </button>

                                        <p class="text-muted small mt-2 mb-0">
                                            <i class="fas fa-info-circle"></i> Minimum 5 main comments required (replies not counted)
                                        </p>

                                        <p class="small mb-0 <?php echo e($hasEnoughComments ? 'text-success' : 'text-warning'); ?>">
                                            Current main comments: <strong><?php echo e($mainCommentsCount); ?></strong>
                                        </p>

                                        <?php if(!$hasEnoughComments): ?>
                                            <div class="alert alert-warning mt-3 mb-0">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Need at least 5 comments to generate summary
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Loading Spinner -->
                                    <div id="summary-loading" class="text-center py-4" style="display: none;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mt-3 text-muted"><strong>Analyzing comments with AI...</strong></p>
                                        <p class="text-muted small">This typically takes 20-30 seconds. Please wait...</p>
                                    </div>

                                    <!-- Error Message -->
                                    <div id="summary-error" class="alert alert-warning" style="display: none;">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <span id="error-message"></span>
                                    </div>

                                    <!-- Summary Display -->
                                    <div id="summary-display" style="display: none;">
                                        <!-- Summary Text -->
                                        <div class="mb-4">
                                            <h5 class="text-dark mb-3">
                                                <i class="fas fa-file-alt text-primary"></i> Summary
                                            </h5>
                                            <p id="summary-text" class="text-muted"></p>
                                        </div>

                                        <!-- Sentiment Analysis -->
                                        <div class="mb-4">
                                            <h5 class="text-dark mb-3">
                                                <i class="fas fa-chart-pie text-primary"></i> Sentiment Analysis
                                            </h5>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span class="text-success"><i class="fas fa-smile"></i> Positive</span>
                                                    <span id="positive-percent" class="fw-bold">0%</span>
                                                </div>
                                                <div class="progress" style="height: 20px;">
                                                    <div id="positive-bar" class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span class="text-secondary"><i class="fas fa-meh"></i> Neutral</span>
                                                    <span id="neutral-percent" class="fw-bold">0%</span>
                                                </div>
                                                <div class="progress" style="height: 20px;">
                                                    <div id="neutral-bar" class="progress-bar bg-secondary" role="progressbar" style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span class="text-danger"><i class="fas fa-frown"></i> Negative</span>
                                                    <span id="negative-percent" class="fw-bold">0%</span>
                                                </div>
                                                <div class="progress" style="height: 20px;">
                                                    <div id="negative-bar" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- What Worked Well -->
                                        <div class="mb-4" id="praised-section">
                                            <h5 class="text-dark mb-3">
                                                <i class="fas fa-thumbs-up text-success"></i> What Worked Well
                                            </h5>
                                            <ul id="praised-list" class="list-unstyled">
                                                <!-- Will be populated by JavaScript -->
                                            </ul>
                                        </div>

                                        <!-- Suggestions -->
                                        <div class="mb-4" id="suggestions-section">
                                            <h5 class="text-dark mb-3">
                                                <i class="fas fa-lightbulb text-warning"></i> Suggestions for Improvement
                                            </h5>
                                            <ul id="suggestions-list" class="list-unstyled">
                                                <!-- Will be populated by JavaScript -->
                                            </ul>
                                        </div>

                                        <!-- Footer Info -->
                                        <div class="border-top pt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <small class="text-muted">
                                                        <i class="fas fa-comments"></i>
                                                        Based on <span id="comments-analyzed" class="fw-bold">0</span> comments
                                                    </small>
                                                </div>






                                            </div>
                                            <p class="text-muted small mt-2 mb-0">
                                                <i class="fas fa-info-circle"></i> AI-generated summary - view comments below for full details
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        <?php if(isset($topLevelFeedback) && isset($totalFeedbackCount)): ?>
                                            <span class="text-muted">(<?php echo e($topLevelFeedback->total()); ?> main comments, <?php echo e($totalFeedbackCount); ?> total including replies)</span>
                                        <?php elseif(isset($topLevelFeedback)): ?>
                                            (<?php echo e($topLevelFeedback->total()); ?>)
                                        <?php endif; ?>
                                    </h5>

                                    <?php if(isset($topLevelFeedback) && $topLevelFeedback->count() > 0): ?>
                                        <?php $__currentLoopData = $topLevelFeedback; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="feedback-item mb-4">
                                                <div class="d-flex align-items-start">
                                                    <!-- User Avatar -->
                                                    <img src="<?php echo e($feedback->user->avatar_url ?? 'https://ui-avatars.com/api/?name=User&size=50&background=4CAF50&color=fff'); ?>"
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
                                                                    <?php echo e($feedback->user->full_name ?? 'Unknown User'); ?>

                                                                </h6>
                                                                <small class="text-muted">
                                                                    <?php echo e($feedback->created_at->diffForHumans()); ?>

                                                                    <?php if($feedback->is_edited): ?>
                                                                        <span>(edited)</span>
                                                                    <?php endif; ?>
                                                                </small>
                                                            </div>

                                                            <!-- Delete button for owner -->
                                                            <?php if(auth()->guard()->check()): ?>
                                                                <?php if($feedback->user_id === auth()->id()): ?>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                                                            <i class="fas fa-ellipsis-v"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li>
                                                                                <button type="button" class="dropdown-item" onclick="toggleEdit(<?php echo e($feedback->id); ?>)">
                                                                                    <i class="fas fa-edit"></i> Edit
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <form action="<?php echo e(route('feedback.destroy', $feedback->id)); ?>" method="POST">
                                                                                    <?php echo csrf_field(); ?>
                                                                                    <?php echo method_field('DELETE'); ?>
                                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Delete this feedback?')">
                                                                                        <i class="fas fa-trash"></i> Delete
                                                                                    </button>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- Rating Stars -->
                                                        <?php if($feedback->rating): ?>
                                                            <div class="mb-2">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <?php if($i <= $feedback->rating): ?>
                                                                        <i class="fas fa-star text-warning"></i>
                                                                    <?php else: ?>
                                                                        <i class="far fa-star text-warning"></i>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- Comment Text -->
                                                        <p class="mb-2"><?php echo e($feedback->comment); ?></p>

                                                        <!-- Edit Form (Hidden by default) -->
                                                        <?php if(auth()->guard()->check()): ?>
                                                            <?php if($feedback->user_id === auth()->id()): ?>
                                                                <div id="edit-form-<?php echo e($feedback->id); ?>" class="mt-3" style="display: none;">
                                                                    <form action="<?php echo e(route('feedback.update', $feedback->id)); ?>" method="POST">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('PUT'); ?>
                                                                        <div class="mb-2">
                                                                            <label class="form-label fw-bold">Update Rating (optional):</label>
                                                                            <div class="star-rating-input">
                                                                                <input type="radio" name="rating" value="5" id="edit-star5-<?php echo e($feedback->id); ?>" <?php echo e($feedback->rating == 5 ? 'checked' : ''); ?>>
                                                                                <label for="edit-star5-<?php echo e($feedback->id); ?>" title="5 stars">★</label>
                                                                                <input type="radio" name="rating" value="4" id="edit-star4-<?php echo e($feedback->id); ?>" <?php echo e($feedback->rating == 4 ? 'checked' : ''); ?>>
                                                                                <label for="edit-star4-<?php echo e($feedback->id); ?>" title="4 stars">★</label>
                                                                                <input type="radio" name="rating" value="3" id="edit-star3-<?php echo e($feedback->id); ?>" <?php echo e($feedback->rating == 3 ? 'checked' : ''); ?>>
                                                                                <label for="edit-star3-<?php echo e($feedback->id); ?>" title="3 stars">★</label>
                                                                                <input type="radio" name="rating" value="2" id="edit-star2-<?php echo e($feedback->id); ?>" <?php echo e($feedback->rating == 2 ? 'checked' : ''); ?>>
                                                                                <label for="edit-star2-<?php echo e($feedback->id); ?>" title="2 stars">★</label>
                                                                                <input type="radio" name="rating" value="1" id="edit-star1-<?php echo e($feedback->id); ?>" <?php echo e($feedback->rating == 1 ? 'checked' : ''); ?>>
                                                                                <label for="edit-star1-<?php echo e($feedback->id); ?>" title="1 star">★</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <textarea name="comment" rows="3" class="form-control" required><?php echo e(old('comment', $feedback->comment)); ?></textarea>
                                                                        </div>
                                                                        <div class="d-flex gap-2">
                                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                                <i class="fas fa-save"></i> Save
                                                                            </button>
                                                                            <button type="button" class="btn btn-sm btn-secondary" onclick="toggleEdit(<?php echo e($feedback->id); ?>)">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <!-- Like and Reply Buttons -->
                                                        <div class="d-flex gap-3 align-items-center">
                                                            <?php if(auth()->guard()->check()): ?>
                                                                <!-- Like Button -->
                                                                <form action="<?php echo e(route('feedback.like', $feedback->id)); ?>" method="POST" class="d-inline">
                                                                    <?php echo csrf_field(); ?>
                                                                    <button type="submit" class="btn btn-sm btn-link text-muted p-0 text-decoration-none">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        <strong><?php echo e($feedback->likes_count); ?></strong>
                                                                    </button>
                                                                </form>

                                                                <!-- Reply Button -->
                                                                <button class="btn btn-sm btn-link text-muted p-0 text-decoration-none" onclick="toggleReply(<?php echo e($feedback->id); ?>)">
                                                                    <i class="fas fa-reply"></i> Reply
                                                                </button>
                                                            <?php endif; ?>

                                                            <?php if($feedback->replies->count() > 0): ?>
                                                                <small class="text-muted">
                                                                    <?php echo e($feedback->replies->count()); ?> <?php echo e($feedback->replies->count() == 1 ? 'reply' : 'replies'); ?>

                                                                </small>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- Reply Form (Hidden by default) -->
                                                        <?php if(auth()->guard()->check()): ?>
                                                            <div id="reply-form-<?php echo e($feedback->id); ?>" class="mt-3" style="display: none;">
                                                                <form action="<?php echo e(route('feedback.store', $event->id)); ?>" method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="parent_feedback_id" value="<?php echo e($feedback->id); ?>">
                                                                    <div class="d-flex gap-2">
                                                                        <img src="<?php echo e(auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->full_name) . '&size=35&background=4CAF50&color=fff'); ?>"
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
                                                                                <button type="button" class="btn btn-sm btn-secondary" onclick="toggleReply(<?php echo e($feedback->id); ?>)">
                                                                                    Cancel
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                             </div>
                                                        <?php endif; ?>

                                                        <!-- Display Replies -->
                                                        <?php if($feedback->replies->count() > 0): ?>
                                                            <div class="mt-3">
                                                                <?php $__currentLoopData = $feedback->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="reply-item mb-3">
                                                                        <div class="d-flex align-items-start gap-2">
                                                                            <img src="<?php echo e($reply->user->avatar_url ?? 'https://ui-avatars.com/api/?name=User&size=35&background=4CAF50&color=fff'); ?>"
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
                                                                                            <?php echo e($reply->user->full_name ?? 'Unknown User'); ?>

                                                                                        </h6>
                                                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                                                            <?php echo e($reply->created_at->diffForHumans()); ?>

                                                                                        </small>
                                                                                    </div>
                                                                                    <?php if(auth()->guard()->check()): ?>
                                                                                        <?php if($reply->user_id === auth()->id()): ?>
                                                                                            <div class="d-flex align-items-center gap-2">
                                                                                                <button type="button" class="btn btn-sm btn-link p-0" onclick="toggleReplyEdit(<?php echo e($reply->id); ?>)" title="Edit reply">
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
                                                                                                <form action="<?php echo e(route('feedback.destroy', $reply->id)); ?>" method="POST">
                                                                                                    <?php echo csrf_field(); ?>
                                                                                                    <?php echo method_field('DELETE'); ?>
                                                                                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Delete this reply?')">
                                                                                                        <i class="fas fa-trash"></i>
                                                                                                    </button>
                                                                                                </form>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <p class="mb-0 mt-1" style="font-size: 0.9rem;"><?php echo e($reply->comment); ?></p>

                                                                                <!-- Reply Edit Form (Hidden by default) -->
                                                                                <?php if(auth()->guard()->check()): ?>
                                                                                    <?php if($reply->user_id === auth()->id()): ?>
                                                                                        <div id="reply-edit-form-<?php echo e($reply->id); ?>" class="mt-2" style="display: none;">
                                                                                            <form action="<?php echo e(route('feedback.update', $reply->id)); ?>" method="POST">
                                                                                                <?php echo csrf_field(); ?>
                                                                                                <?php echo method_field('PUT'); ?>
                                                                                                <div class="mb-2">
                                                                                                    <textarea name="comment" rows="2" class="form-control form-control-sm" required><?php echo e(old('comment', $reply->comment)); ?></textarea>
                                                                                                </div>
                                                                                                <div class="d-flex gap-2">
                                                                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                                                                        <i class="fas fa-save"></i> Save
                                                                                                    </button>
                                                                                                    <button type="button" class="btn btn-sm btn-secondary" onclick="toggleReplyEdit(<?php echo e($reply->id); ?>)">Cancel</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Pagination -->
                                        <div class="mt-4">
                                            <?php echo e($topLevelFeedback->links()); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-5">
                                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No feedback yet. Be the first to share your thoughts!</p>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Leave Feedback Form (At the bottom) -->
                                    <?php if(auth()->guard()->check()): ?>
                                        <div class="mt-4 pt-4 border-top">
                                            <h6 class="mb-3">Leave Your Feedback</h6>
                                            <form action="<?php echo e(route('feedback.store', $event->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>

                                                <div class="d-flex gap-3">
                                                    <!-- Current User Avatar -->
                                                    <img src="<?php echo e(auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->full_name) . '&size=50&background=4CAF50&color=fff'); ?>"
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
                                                            <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <small class="text-danger d-block"><?php echo e($message); ?></small>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                                            ><?php echo e(old('comment')); ?></textarea>
                                                            <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <small class="text-danger d-block"><?php echo e($message); ?></small>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-paper-plane"></i> Submit Feedback
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning mt-4">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Please <a href="<?php echo e(route('login')); ?>" class="alert-link fw-bold">login</a> to leave feedback for this event.
                                        </div>
                                    <?php endif; ?>
                                </div>

                    <?php if($event->activities->count() > 0): ?>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-dark mb-0">
                                    <i class="fas fa-tasks text-primary"></i> Associated Activities
                                </h4>
                            </div>
                            <div class="row">
                                <?php $__currentLoopData = $event->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="activity-icon me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                                                        <i class="fas fa-tasks"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0"><?php echo e($activity->title); ?></h6>
                                                        <span class="status-badge status-<?php echo e(str_replace('_', '-', $activity->status)); ?>" style="font-size: 0.7rem;">
                                                            <?php echo e(ucwords(str_replace('_', ' ', $activity->status))); ?>

                                                        </span>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="<?php echo e(route('activities.show', $activity->id)); ?>"><i class="fas fa-eye"></i> View</a></li>
                                                            <li><a class="dropdown-item" href="<?php echo e(route('activities.edit', $activity->id)); ?>"><i class="fas fa-edit"></i> Edit</a></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="<?php echo e(route('events.remove-activity', $event->id)); ?>" method="POST" style="display:inline">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
                                                                    <input type="hidden" name="activity_id" value="<?php echo e($activity->id); ?>">
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Remove this activity from the event?')">
                                                                        <i class="fas fa-unlink"></i> Remove from Event
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between text-muted small">
                                                    <span><i class="fas fa-users"></i> <?php echo e($activity->num_persons); ?> people</span>
                                                    <?php if($activity->time_to_finish): ?>
                                                        <span><i class="fas fa-clock"></i> <?php echo e($activity->time_to_finish); ?>h</span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($activity->description): ?>
                                                    <p class="text-muted small mt-2 mb-0" style="max-height: 40px; overflow: hidden;">
                                                        <?php echo e(Str::limit($activity->description, 80)); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
                        </div>

                        <!-- Event Resources Section -->
                        <?php if(isset($eventResources) && $eventResources->count() > 0): ?>
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
                                                    <?php if(auth()->guard()->check()): ?>
                                                        <?php if(Auth::user()->isSupplier()): ?>
                                                            <th><i class="fas fa-cog"></i> Actions</th>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $eventResources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><strong><?php echo e($resource->name); ?></strong></td>
                                                        <td><span class="badge bg-info"><?php echo e($resource->type); ?></span></td>
                                                        <td><span class="badge bg-success"><?php echo e($resource->quantity); ?></span></td>
                                                        <td>
                                                            <?php if($resource->supplier): ?>
                                                                <strong><?php echo e($resource->supplier->full_name); ?></strong>
                                                            <?php else: ?>
                                                                <span class="text-muted">Unknown</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($resource->created_at->format('M d, Y')); ?></td>
                                                        <?php if(auth()->guard()->check()): ?>
                                                            <?php if(Auth::user()->isSupplier() && $resource->supplier_id === Auth::id()): ?>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <a href="<?php echo e(route('resources.edit-supplier', $resource->id)); ?>"
                                                                           class="btn btn-sm btn-outline-primary"
                                                                           title="Edit Resource">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <form action="<?php echo e(route('resources.destroy-supplier', $resource->id)); ?>"
                                                                              method="POST"
                                                                              style="display: inline;"
                                                                              onsubmit="return confirm('Are you sure you want to delete this resource?')">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('DELETE'); ?>
                                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Resource">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            <?php elseif(Auth::user()->isSupplier()): ?>
                                                                <td><span class="text-muted small">Not your resource</span></td>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(!Auth::user()->isSupplier()): ?>
                        <div class="mt-4 text-center">
                            <form action="<?php echo e(route('events.destroy', $event->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger smooth-transition">
                                    <i class="fas fa-trash"></i> Delete Event
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // AI Summary Generation
        function generateSummary() {
            const eventId = <?php echo e($event->id); ?>;
            const summaryBtn = document.getElementById('summarize-btn');
            const buttonContainer = document.getElementById('summary-button-container');
            const loadingDiv = document.getElementById('summary-loading');
            const errorDiv = document.getElementById('summary-error');
            const displayDiv = document.getElementById('summary-display');

            // Show loading state
            buttonContainer.style.display = 'none';
            errorDiv.style.display = 'none';
            displayDiv.style.display = 'none';
            loadingDiv.style.display = 'block';

            // Create AbortController for timeout
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 35000); // 35 second timeout

            // Make API call with timeout
            fetch(`/events/${eventId}/summary`, {
                signal: controller.signal
            })
                .then(response => {
                    clearTimeout(timeoutId);
                    return response.json();
                })
                .then(data => {
                    loadingDiv.style.display = 'none';

                    if (data.success) {
                        displaySummary(data.data);
                        displayDiv.style.display = 'block';
                    } else {
                        document.getElementById('error-message').textContent = data.message || 'Failed to generate summary';
                        errorDiv.style.display = 'block';
                        buttonContainer.style.display = 'block';
                    }
                })
                .catch(error => {
                    clearTimeout(timeoutId);
                    console.error('Error:', error);
                    loadingDiv.style.display = 'none';
                    errorDiv.style.display = 'block';
                    buttonContainer.style.display = 'block';

                    if (error.name === 'AbortError') {
                        document.getElementById('error-message').textContent = 'Request timed out. Please try again or check your connection.';
                    } else {
                        document.getElementById('error-message').textContent = 'Failed to generate summary. Please try again.';
                    }
                });
        }


        function displaySummary(data) {
            // Validate data structure
            if (!data || typeof data !== 'object') {
                console.error('Invalid data structure', data);
                document.getElementById('error-message').textContent = 'Invalid response format';
                document.getElementById('summary-error').style.display = 'block';
                return;
            }

            // Summary text with fallback
            const summaryText = data.summary || 'No summary available';
            const summaryTextElement = document.getElementById('summary-text');
            if (summaryTextElement) {
                summaryTextElement.textContent = summaryText;
            }

            // Safely access sentiment data
            const sentiment = data.sentiment || {};
            const positive = sentiment.positive || 0;
            const neutral = sentiment.neutral || 0;
            const negative = sentiment.negative || 0;

            // Update sentiment bars with null checks
            const positivePercent = document.getElementById('positive-percent');
            const positiveBar = document.getElementById('positive-bar');
            if (positivePercent && positiveBar) {
                positivePercent.textContent = positive + '%';
                positiveBar.style.width = positive + '%';
            }

            const neutralPercent = document.getElementById('neutral-percent');
            const neutralBar = document.getElementById('neutral-bar');
            if (neutralPercent && neutralBar) {
                neutralPercent.textContent = neutral + '%';
                neutralBar.style.width = neutral + '%';
            }

            const negativePercent = document.getElementById('negative-percent');
            const negativeBar = document.getElementById('negative-bar');
            if (negativePercent && negativeBar) {
                negativePercent.textContent = negative + '%';
                negativeBar.style.width = negative + '%';
            }

            // What worked well
            const praisedList = document.getElementById('praised-list');
            const praisedSection = document.getElementById('praised-section');
            if (praisedList && praisedSection) {
                praisedList.innerHTML = '';
                const praisedItems = data.praised || [];

                if (praisedItems.length > 0) {
                    praisedItems.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'mb-2';
                        li.innerHTML = `<i class="fas fa-check-circle text-success me-2"></i>${item}`;
                        praisedList.appendChild(li);
                    });
                    praisedSection.style.display = 'block';
                } else {
                    praisedSection.style.display = 'none';
                }
            }

            // Suggestions
            const suggestionsList = document.getElementById('suggestions-list');
            const suggestionsSection = document.getElementById('suggestions-section');
            if (suggestionsList && suggestionsSection) {
                suggestionsList.innerHTML = '';
                const suggestionsItems = data.suggestions || [];

                if (suggestionsItems.length > 0) {
                    suggestionsItems.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'mb-2';
                        li.innerHTML = `<i class="fas fa-arrow-right text-warning me-2"></i>${item}`;
                        suggestionsList.appendChild(li);
                    });
                    suggestionsSection.style.display = 'block';
                } else {
                    suggestionsSection.style.display = 'none';
                }
            }

            // Footer info with safe defaults
            const commentsAnalyzed = document.getElementById('comments-analyzed');
            if (commentsAnalyzed) {
                commentsAnalyzed.textContent = data.total_comments_analyzed || 0;
            }

            const hoursAgo = document.getElementById('hours-ago');
            if (hoursAgo) {
                hoursAgo.textContent = data.hours_ago || 0;
            }
        }



        function toggleReply(feedbackId) {
            const replyForm = document.getElementById('reply-form-' + feedbackId);
            if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        }

        // Resource Suggestion System
        function getSuggestedResources() {
            const eventId = <?php echo e($event->id); ?>;
            const container = document.getElementById('suggestions-container');
            const loadingDiv = document.getElementById('suggestions-loading');
            const errorDiv = document.getElementById('suggestions-error');
            const displayDiv = document.getElementById('suggestions-display');

            // Show container and loading state
            container.style.display = 'block';
            loadingDiv.style.display = 'block';
            errorDiv.style.display = 'none';
            displayDiv.style.display = 'none';

            // Make API call
            fetch(`/events/${eventId}/suggest-resources`)
                .then(response => response.json())
                .then(data => {
                    loadingDiv.style.display = 'none';

                    // Check for success and access nested data structure
                    if (data.success && data.data && data.data.suggestions && data.data.suggestions.length > 0) {
                        displayResourceSuggestions(data.data);
                        displayDiv.style.display = 'block';
                    } else {
                        const errorMessage = data.message || 'No suggestions available for this event.';
                        document.getElementById('suggestions-error-message').textContent = errorMessage;
                        errorDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingDiv.style.display = 'none';
                    document.getElementById('suggestions-error-message').textContent = 'Failed to fetch suggestions. Please try again.';
                    errorDiv.style.display = 'block';
                });
        }

        function displayResourceSuggestions(data) {
            // Update overall confidence
            document.getElementById('overall-confidence').textContent = data.confidence_score || 0;

            // Populate suggestions list
            const listElement = document.getElementById('suggestions-list');
            listElement.innerHTML = '';

            data.suggestions.forEach(suggestion => {
                const row = document.createElement('tr');

                // Resource name
                const nameCell = document.createElement('td');
                nameCell.innerHTML = `<strong>${suggestion.name}</strong>`;

                // Confidence badge
                const confidenceCell = document.createElement('td');
                const confidenceClass = suggestion.confidence >= 70 ? 'success' :
                                       suggestion.confidence >= 40 ? 'warning' : 'secondary';
                confidenceCell.innerHTML = `<span class="badge bg-${confidenceClass}">${suggestion.confidence}%</span>`;

                // Status (check if resource already exists)
                const statusCell = document.createElement('td');
                if (suggestion.id) {
                    statusCell.innerHTML = `<span class="badge bg-info"><i class="fas fa-check"></i> Already Added</span>`;
                } else {
                    // Create a clickable button that navigates to add-resource page with pre-filled name
                    const addUrl = `/events/<?php echo e($event->id); ?>/add-resource?suggested_name=${encodeURIComponent(suggestion.name)}`;
                    statusCell.innerHTML = `<a href="${addUrl}" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add Resource</a>`;
                }

                row.appendChild(nameCell);
                row.appendChild(confidenceCell);
                row.appendChild(statusCell);

                listElement.appendChild(row);
            });
        }
    </script>
<?php $__env->stopSection(); ?>


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

<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/events/show.blade.php ENDPATH**/ ?>