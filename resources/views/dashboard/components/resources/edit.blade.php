@extends('dashboard.layouts.dashboard')

@section('title', 'Edit Resource - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Edit Resource</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">
                <a href="{{ route('resources.index') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    Resources
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Edit</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row gy-4">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Resource #{{ $resource->id }}</h5>
                </div>
                <div class="card-body">
                    {{-- Error Summary --}}
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4" role="alert">
                            <div class="d-flex align-items-start gap-2">
                                <iconify-icon icon="akar-icons:circle-x" class="icon text-xl mt-1"></iconify-icon>
                                <div>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Resource ID Info --}}
                    <div class="alert alert-info bg-info-100 text-info-600 border-info-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:info-circle-linear" class="icon text-xl"></iconify-icon>
                            Editing Resource ID: <strong>{{ $resource->id }}</strong>
                        </div>
                    </div>

                    <form action="{{ route('resources.update', $resource) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row gy-3">
                            {{-- Name Field --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Resource Name <span class="text-danger-600">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       class="form-control radius-8 @error('name') is-invalid @enderror"
                                       value="{{ old('name', $resource->name) }}"
                                       placeholder="e.g., Solar Panels, Water Tanks"
                                       required
                                       autofocus>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Type Field --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Resource Type <span class="text-danger-600">*</span>
                                </label>
                                <input type="text"
                                       name="type"
                                       class="form-control radius-8 @error('type') is-invalid @enderror"
                                       value="{{ old('type', $resource->type) }}"
                                       placeholder="e.g., Equipment, Material, Tool"
                                       required>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Quantity Field --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">
                                    Quantity <span class="text-danger-600">*</span>
                                </label>
                                <input type="number"
                                       name="quantity"
                                       class="form-control radius-8 @error('quantity') is-invalid @enderror"
                                       value="{{ old('quantity', $resource->quantity) }}"
                                       min="0"
                                       placeholder="Enter quantity"
                                       required>
                                @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Timestamps Info --}}
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <span class="text-secondary-light text-sm">
                                            <iconify-icon icon="solar:calendar-add-linear" class="icon"></iconify-icon>
                                            <strong>Created:</strong> {{ $resource->created_at->format('Y-m-d H:i:s') }}
                                        </span>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <span class="text-secondary-light text-sm">
                                            <iconify-icon icon="solar:calendar-mark-linear" class="icon"></iconify-icon>
                                            <strong>Updated:</strong> {{ $resource->updated_at->format('Y-m-d H:i:s') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between gap-3 mt-24">
                                    <a href="{{ route('resources.index') }}" class="btn btn-outline-neutral radius-8 px-20 py-11">
                                        <iconify-icon icon="ep:back" class="icon"></iconify-icon>
                                        Back to List
                                    </a>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('resources.show', $resource) }}" class="btn btn-info radius-8 px-20 py-11">
                                            <iconify-icon icon="solar:eye-linear" class="icon"></iconify-icon>
                                            View
                                        </a>
                                        <button type="submit" class="btn btn-warning radius-8 px-20 py-11">
                                            Update Resource
                                            <iconify-icon icon="solar:save-linear" class="icon"></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
