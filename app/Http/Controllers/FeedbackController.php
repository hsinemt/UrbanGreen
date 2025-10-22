<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Remove the __construct() method entirely since we're using middleware in routes

    /**
     * Get all feedback for an event (API).
     */
    public function index(Event $event)
    {
        $feedback = $event->feedback()
            ->topLevel()
            ->active()
            ->latest()
            ->with(['user', 'replies.user'])
            ->paginate(15);

        return response()->json($feedback);
    }

    /**
     * Display feedback for an event on the show page.
     */
    public function show(Event $event)
    {
        $topLevelFeedback = $event->feedback()
            ->topLevel()
            ->active()
            ->latest()
            ->with(['user', 'replies' => function ($query) {
                $query->with('user');
            }])
            ->paginate(10);

        $averageRating = Feedback::getAverageRatingForEvent($event->id);
        $ratingDistribution = Feedback::getRatingDistributionForEvent($event->id);
        $totalFeedbackCount = $event->feedback()->active()->count();

        return view('frontOffice.pages.events.feedback', compact(
            'event',
            'topLevelFeedback',
            'averageRating',
            'ratingDistribution',
            'totalFeedbackCount'
        ));
    }

    /**
     * Store a new feedback (comment or reply).
     */
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate(Feedback::validationRulesCreate());

        $feedback = $event->feedback()->create([
            'user_id' => auth()->id(),
            'comment' => $validated['comment'],
            'rating' => $validated['rating'] ?? null,
            'parent_feedback_id' => $validated['parent_feedback_id'] ?? null,
            'status' => 'active',
            'likes_count' => 0,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Feedback posted successfully!',
                'feedback' => $feedback->load('user'),
            ], 201);
        }

        return redirect()->back()->with('success', 'Your feedback has been posted!');
    }

    /**
     * Update a feedback (only by owner).
     */
    public function update(Request $request, Feedback $feedback)
    {
        if ($feedback->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($feedback->trashed()) {
            abort(400, 'This feedback has been deleted');
        }

        $validated = $request->validate(Feedback::validationRulesUpdate());

        $feedback->update([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'] ?? $feedback->rating,
        ]);

        $feedback->markAsEdited();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Feedback updated successfully!',
                'feedback' => $feedback->refresh(),
            ]);
        }

        return redirect()->back()->with('success', 'Feedback updated successfully!');
    }

    /**
     * Delete a feedback (soft delete).
     */
    public function destroy(Feedback $feedback)
    {
        // Only the comment owner can delete their comment
        if ($feedback->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $feedback->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Feedback deleted successfully!',
            ]);
        }

        return redirect()->back()->with('success', 'Feedback deleted successfully!');
    }

    /**
     * Like a feedback.
     */
    public function like(Feedback $feedback)
    {
        $feedback->incrementLikes();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'likes_count' => $feedback->likes_count,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Unlike a feedback.
     */
    public function unlike(Feedback $feedback)
    {
        if ($feedback->likes_count > 0) {
            $feedback->decrementLikes();
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'likes_count' => $feedback->likes_count,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Report inappropriate feedback.
     */
    public function report(Request $request, Feedback $feedback)
    {
        $request->validate([
            'reason' => 'required|string|in:spam,offensive,irrelevant,other',
            'description' => 'nullable|string|max:500',
        ]);

        $feedback->update(['status' => 'flagged']);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your report. We will review it shortly.',
            ]);
        }

        return redirect()->back()->with('success', 'Report submitted successfully!');
    }
}
