@extends('frontOffice.layouts.app')

@section('title', 'Event Feedback - ' . $event->name)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Event
            </a>
        </div>

        <!-- Event Info Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $event->name }}</h1>
                    <p class="text-gray-600">{{ $event->location }} • {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                </div>
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-32 h-32 object-cover rounded-lg">
                @endif
            </div>
        </div>

        <!-- Rating Summary -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Event Rating</h2>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Average Rating -->
                <div class="text-center">
                    <div class="text-5xl font-bold text-blue-600 mb-2">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div class="flex justify-center mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($averageRating))
                                <svg class="w-8 h-8 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @elseif($i - 0.5 <= $averageRating)
                                <svg class="w-8 h-8 text-yellow-400" viewBox="0 0 20 20">
                                    <defs>
                                        <linearGradient id="half-fill">
                                            <stop offset="50%" stop-color="#FBBF24"/>
                                            <stop offset="50%" stop-color="#E5E7EB"/>
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#half-fill)" d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <p class="text-gray-600">Based on {{ $totalFeedbackCount }} reviews</p>
                </div>

                <!-- Rating Distribution -->
                <div>
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center mb-2">
                            <span class="w-12 text-sm text-gray-600">{{ $i }} star</span>
                            <div class="flex-1 mx-4">
                                <div class="bg-gray-200 rounded-full h-3">
                                    @php
                                        $percentage = $totalFeedbackCount > 0 ? ($ratingDistribution[$i] / $totalFeedbackCount) * 100 : 0;
                                    @endphp
                                    <div class="bg-yellow-400 h-3 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                            <span class="w-12 text-sm text-gray-600 text-right">{{ $ratingDistribution[$i] }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Feedback Form -->
        @auth
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-xl font-bold mb-4">Leave Your Feedback</h3>

                <form action="{{ route('feedback.store', $event->id) }}" method="POST" id="feedbackForm">
                    @csrf

                    <!-- Star Rating -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Your Rating</label>
                        <div class="flex items-center space-x-2">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="hidden star-input" required>
                                <label for="star{{ $i }}" class="cursor-pointer star-label">
                                    <svg class="w-10 h-10 text-gray-300 hover:text-yellow-400 transition-colors fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div class="mb-4">
                        <label for="comment" class="block text-gray-700 font-medium mb-2">Your Comment</label>
                        <textarea
                            name="comment"
                            id="comment"
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Share your experience about this event..."
                            required
                        ></textarea>
                        @error('comment')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition-colors">
                        Submit Feedback
                    </button>
                </form>
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                <p class="text-yellow-700">
                    <a href="{{ route('login') }}" class="font-medium underline">Login</a> to leave feedback for this event.
                </p>
            </div>
        @endauth

        <!-- Feedback List -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-2xl font-bold mb-6">User Feedback ({{ $totalFeedbackCount }})</h3>

            @forelse($topLevelFeedback as $feedback)
                <div class="border-b border-gray-200 pb-6 mb-6 last:border-b-0" id="feedback-{{ $feedback->id }}">
                    <!-- Feedback Header -->
                    <div class="flex items-start">
                        <img src="{{ $feedback->user->avatar_url }}" alt="{{ $feedback->user->display_name }}" class="w-12 h-12 rounded-full mr-4">

                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $feedback->user->display_name }}</h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $feedback->created_at->diffForHumans() }}
                                        @if($feedback->is_edited)
                                            <span class="text-gray-400">(edited)</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                @auth
                                    @if($feedback->user_id === auth()->id())
                                        <div class="flex space-x-2">
                                            <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this feedback?')" class="text-red-600 hover:text-red-800 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <!-- Rating Stars -->
                            @if($feedback->rating)
                                <div class="flex mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                            @endif

                            <!-- Comment -->
                            <p class="text-gray-700 mb-3">{{ $feedback->comment }}</p>

                            <!-- Like and Reply Buttons -->
                            <div class="flex items-center space-x-4">
                                @auth
                                    <form action="{{ route('feedback.like', $feedback->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="flex items-center text-gray-600 hover:text-blue-600">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                            </svg>
                                            <span>{{ $feedback->likes_count }}</span>
                                        </button>
                                    </form>

                                    <button onclick="toggleReplyForm({{ $feedback->id }})" class="flex items-center text-gray-600 hover:text-blue-600">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                        </svg>
                                        Reply
                                    </button>
                                @endauth

                                <span class="text-gray-500 text-sm">{{ $feedback->replies->count() }} replies</span>
                            </div>

                            <!-- Reply Form -->
                            @auth
                                <div id="reply-form-{{ $feedback->id }}" class="hidden mt-4">
                                    <form action="{{ route('feedback.store', $event->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parent_feedback_id" value="{{ $feedback->id }}">

                                        <textarea
                                            name="comment"
                                            rows="3"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2"
                                            placeholder="Write your reply..."
                                            required
                                        ></textarea>

                                        <div class="flex space-x-2">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                                Post Reply
                                            </button>
                                            <button type="button" onclick="toggleReplyForm({{ $feedback->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endauth

                            <!-- Replies -->
                            @if($feedback->replies->count() > 0)
                                <div class="mt-4 space-y-4">
                                    @foreach($feedback->replies as $reply)
                                        <div class="flex items-start pl-8 border-l-2 border-gray-200">
                                            <img src="{{ $reply->user->avatar_url }}" alt="{{ $reply->user->display_name }}" class="w-10 h-10 rounded-full mr-3">

                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-1">
                                                    <div>
                                                        <h5 class="font-semibold text-gray-900 text-sm">{{ $reply->user->display_name }}</h5>
                                                        <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                                    </div>

                                                    @auth
                                                        @if($reply->user_id === auth()->id())
                                                            <form action="{{ route('feedback.destroy', $reply->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Delete this reply?')" class="text-red-600 hover:text-red-800 text-xs">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endauth
                                                </div>

                                                <p class="text-gray-700 text-sm">{{ $reply->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">No feedback yet. Be the first to share your thoughts!</p>
                </div>
            @endforelse

            <!-- Pagination -->
            <div class="mt-8">
                {{ $topLevelFeedback->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Star rating interaction
            document.querySelectorAll('.star-input').forEach(input => {
                input.addEventListener('change', function() {
                    const rating = this.value;
                    document.querySelectorAll('.star-label svg').forEach((star, index) => {
                        if (index < rating) {
                            star.classList.remove('text-gray-300');
                            star.classList.add('text-yellow-400');
                        } else {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-gray-300');
                        }
                    });
                });
            });

            // Toggle reply form
            function toggleReplyForm(feedbackId) {
                const form = document.getElementById(`reply-form-${feedbackId}`);
                form.classList.toggle('hidden');
            }
        </script>
    @endpush
@endsection
