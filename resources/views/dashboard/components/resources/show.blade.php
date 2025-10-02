@extends('dashboard.layouts.dashboard')

@section('title', 'View Resource - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Resource Details</h6>
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
            <li class="fw-medium">View</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row gy-4">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Resource Information</h5>
                </div>
                <div class="card-body">
                    {{-- Resource ID Badge --}}
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center gap-2 bg-neutral-200 px-16 py-8 radius-8">
                            <iconify-icon icon="solar:hashtag-linear" class="icon text-xl"></iconify-icon>
                            <span class="fw-semibold">Resource ID:</span>
                            <span class="badge bg-secondary">{{ $resource->id }}</span>
                        </div>
                    </div>

                    {{-- Resource Details --}}
                    <div class="border radius-8 p-3">
                        <div class="row gy-3">
                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3 pb-3 border-bottom">
                                    <div class="flex-shrink-0">
                                        <iconify-icon icon="solar:box-linear" class="icon text-xxl text-primary-600"></iconify-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-secondary-light text-sm d-block mb-1">Name</span>
                                        <h6 class="fw-semibold mb-0">{{ $resource->name }}</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3 pb-3 border-bottom">
                                    <div class="flex-shrink-0">
                                        <iconify-icon icon="solar:tag-linear" class="icon text-xxl text-info-600"></iconify-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-secondary-light text-sm d-block mb-1">Type</span>
                                        <span class="bg-info-focus text-info-main px-16 py-6 radius-4 fw-medium text-md">{{ $resource->type }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3 pb-3 border-bottom">
                                    <div class="flex-shrink-0">
                                        <iconify-icon icon="solar:chart-linear" class="icon text-xxl text-success-600"></iconify-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-secondary-light text-sm d-block mb-1">Quantity</span>
                                        <span class="bg-success-focus text-success-main px-20 py-8 radius-4 fw-semibold text-lg">{{ $resource->quantity }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3 pb-3 border-bottom">
                                    <div class="flex-shrink-0">
                                        <iconify-icon icon="solar:calendar-add-linear" class="icon text-xxl text-neutral-600"></iconify-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-secondary-light text-sm d-block mb-1">Created At</span>
                                        <p class="mb-0 fw-medium">
                                            {{ $resource->created_at->format('l, F j, Y \a\t g:i A') }}
                                            <br>
                                            <small class="text-secondary-light">({{ $resource->created_at->diffForHumans() }})</small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <iconify-icon icon="solar:calendar-mark-linear" class="icon text-xxl text-neutral-600"></iconify-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="text-secondary-light text-sm d-block mb-1">Last Updated</span>
                                        <p class="mb-0 fw-medium">
                                            {{ $resource->updated_at->format('l, F j, Y \a\t g:i A') }}
                                            <br>
                                            <small class="text-secondary-light">({{ $resource->updated_at->diffForHumans() }})</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex align-items-center justify-content-between gap-3 mt-24">
                        <a href="{{ route('resources.index') }}" class="btn btn-outline-neutral radius-8 px-20 py-11">
                            <iconify-icon icon="ep:back" class="icon"></iconify-icon>
                            Back to List
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('resources.edit', $resource) }}" class="btn btn-warning radius-8 px-20 py-11">
                                <iconify-icon icon="lucide:edit" class="icon"></iconify-icon>
                                Edit
                            </a>
                            <form action="{{ route('resources.destroy', $resource) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this resource?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger radius-8 px-20 py-11">
                                    <iconify-icon icon="fluent:delete-24-regular" class="icon"></iconify-icon>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
