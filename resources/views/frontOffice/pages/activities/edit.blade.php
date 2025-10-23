@extends('frontOffice.layouts.app')

@section('content')
<section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
        <h1 class="cs_fs_51 cs_white_color cs_mb_11">Edit Activity</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('activities.index') }}">Activities</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</section>

<div class="cs_height_150 cs_height_lg_80"></div>
<style>
    .smooth-transition {
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
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
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4 smooth-transition">
                <h1 class="h3 text-dark mb-0">Edit Activity</h1>
                <a href="{{ route('activities.index') }}" class="btn btn-secondary smooth-transition">
                    <i class="fas fa-arrow-left me-2"></i>Back to Activities
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card smooth-transition">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-dark">Update Activity Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('activities.update', $activity->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Activity Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $activity->title) }}" required placeholder="Enter activity title...">
                            @error('title')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter activity description...">{{ old('description', $activity->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="pending" {{ old('status', $activity->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ old('status', $activity->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ old('status', $activity->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $error }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="time_to_finish" class="form-label">Time to Finish (hours)</label>
                                    <input type="number" class="form-control @error('time_to_finish') is-invalid @enderror" id="time_to_finish" name="time_to_finish" value="{{ old('time_to_finish', $activity->time_to_finish) }}" min="1" placeholder="Enter estimated hours...">
                                    @error('time_to_finish')
                                        <div class="invalid-feedback">{{ $error }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="num_persons" class="form-label">Number of People Required</label>
                            <input type="number" class="form-control @error('num_persons') is-invalid @enderror" id="num_persons" name="num_persons" value="{{ old('num_persons', $activity->num_persons) }}" min="1"  required placeholder="Enter number of people...">
                            @error('num_persons')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- Events selection removed for frontOffice edit (not used) to avoid undefined $events error. --}}

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary smooth-transition">Cancel</a>
                            <button type="submit" class="btn btn-success smooth-transition">
                                <i class="fas fa-save me-2"></i>Update Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
