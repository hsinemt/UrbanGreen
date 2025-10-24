@extends('dashboard.layouts.dashboard')

@section('title', 'Feedback Management - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Feedback Management</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Feedback</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex justify-content-between align-items-center">
            <h6 class="text-lg fw-semibold mb-0">All Feedback</h6>
            <a href="{{ route('back.feedback.download-pdf') }}" class="btn btn-primary-600 radius-8 px-20 py-11" target="_blank">
                <iconify-icon icon="solar:printer-minimalistic-bold" class="icon text-xl"></iconify-icon>
                Print / Save as PDF
            </a>
        </div>
        <div class="card-body p-24">
            @if($feedback->count() > 0)
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table sm-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Event</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Likes</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedback as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->user)
                                                <img src="{{ $item->user->avatar_url }}" alt="{{ $item->user->name }}" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{ $item->user->name }}</span>
                                                </div>
                                            @else
                                                <span class="text-secondary-light">Deleted User</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->event)
                                            <a href="{{ route('events.show', $item->event->id) }}" class="text-primary-600" target="_blank">
                                                {{ Str::limit($item->event->title, 30) }}
                                            </a>
                                        @else
                                            <span class="text-secondary-light">Event Deleted</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-sm">{{ Str::limit($item->comment, 50) }}</span>
                                    </td>
                                    <td>
                                        @if($item->rating)
                                            <div class="d-flex align-items-center gap-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <iconify-icon icon="material-symbols:star" class="text-{{ $i <= $item->rating ? 'warning' : 'secondary-light' }} text-md"></iconify-icon>
                                                @endfor
                                            </div>
                                        @else
                                            <span class="text-secondary-light">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge text-sm fw-semibold text-primary-600 bg-primary-100 px-20 py-9 radius-4 text-white">
                                            {{ $item->likes_count }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm">{{ $item->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        @if($item->status === 'active')
                                            <span class="badge text-sm fw-semibold text-success-600 bg-success-100 px-20 py-9 radius-4 text-white">Active</span>
                                        @elseif($item->status === 'flagged')
                                            <span class="badge text-sm fw-semibold text-warning-600 bg-warning-100 px-20 py-9 radius-4 text-white">Flagged</span>
                                        @else
                                            <span class="badge text-sm fw-semibold text-secondary-600 bg-secondary-100 px-20 py-9 radius-4 text-white">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    <span>Showing {{ $feedback->firstItem() }} to {{ $feedback->lastItem() }} of {{ $feedback->total() }} entries</span>
                    <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        {{ $feedback->links() }}
                    </ul>
                </div>
            @else
                <div class="text-center py-5">
                    <iconify-icon icon="solar:chat-round-line-outline" class="icon text-xxl text-secondary-light mb-3"></iconify-icon>
                    <p class="text-secondary-light mb-0">No feedback available yet.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
