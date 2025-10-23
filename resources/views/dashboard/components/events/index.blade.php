@extends('dashboard.layouts.dashboard')

@section('title', 'Events - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Events</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Events</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
            <h6 class="text-lg fw-semibold mb-0">Events List</h6>
            <a href="{{ route('back.events.create') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Add New Event
            </a>
        </div>

        <div class="card-body p-24">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="akar-icons:circle-check" class="icon text-xl"></iconify-icon>
                        {{ session('success') }}
                    </div>
                    <button class="remove-button text-success-600 text-xxl line-height-1" type="button" data-bs-dismiss="alert" aria-label="Close">
                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                    </button>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start border-width-4-px px-24 py-13 mb-3 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="akar-icons:circle-x" class="icon text-xl"></iconify-icon>
                        {{ session('error') }}
                    </div>
                    <button class="remove-button text-danger-600 text-xxl line-height-1" type="button" data-bs-dismiss="alert" aria-label="Close">
                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                    </button>
                </div>
            @endif

            {{-- Search --}}
            <div class="row mb-24">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('back.events.index') }}" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Search events..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                        </button>
                    </form>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('back.events.index') }}" class="btn btn-outline-secondary">
                        <iconify-icon icon="solar:refresh-linear"></iconify-icon>
                        Clear Filters
                    </a>
                </div>
            </div>

            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Project</th>
                        <th scope="col">Activities</th>
                        <th scope="col">Created At</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">#{{ $event->id }}</span>
                            </td>
                            <td>
                                <div>
                                    <span class="text-md mb-0 fw-semibold text-primary-600">{{ $event->name }}</span>
                                    @if($event->description)
                                        <br><small class="text-secondary-light">{{ Str::limit($event->description, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">{{ $event->date->format('Y-m-d') }}</span>
                                <br><small class="text-secondary-light">{{ $event->date->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">{{ $event->location }}</span>
                            </td>
                            <td>
                                @if($event->budget)
                                    <span class="bg-success-focus text-success-main px-16 py-4 radius-4 fw-medium text-sm">
                                        ${{ number_format($event->budget, 2) }}
                                    </span>
                                @else
                                    <span class="text-secondary-light">-</span>
                                @endif
                            </td>
                            <td>
                                @if($event->project)
                                    <span class="bg-primary-focus text-primary-main px-16 py-4 radius-4 fw-medium text-sm">
                                        {{ $event->project->name }}
                                    </span>
                                @else
                                    <span class="text-secondary-light">-</span>
                                @endif
                            </td>
                            <td>
                                @if($event->activities && $event->activities->count() > 0)
                                    <span class="bg-info-focus text-info-main px-16 py-4 radius-4 fw-medium text-sm">
                                        {{ $event->activities->count() }} activity(ies)
                                    </span>
                                @else
                                    <span class="text-secondary-light">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-md mb-0 fw-normal text-secondary-light">{{ $event->created_at->format('Y-m-d') }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="{{ route('back.events.show', $event) }}"
                                       class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                       title="View">
                                        <iconify-icon icon="solar:eye-linear" class="icon text-xl"></iconify-icon>
                                    </a>
                                    <a href="{{ route('back.events.edit', $event) }}"
                                       class="bg-warning-focus bg-hover-warning-200 text-warning-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                       title="Edit">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </a>
                                    <form action="{{ route('back.events.destroy', $event) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle border-0"
                                                title="Delete">
                                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="py-4">
                                    <iconify-icon icon="solar:inbox-line-broken" class="icon text-xxl text-secondary-light mb-2"></iconify-icon>
                                    <p class="mb-0 text-secondary-light">No events found. Click "Add New Event" to create one.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($events->hasPages())
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} entries</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{ $events->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
