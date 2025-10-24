<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);

        return response()->json($notifications);
    }

    public function unread()
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $notifications = $user->unreadNotifications()->get();
        \Log::info('Unread notifications for user '.$user->id.': '.$notifications->count());

        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function count()
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $count = $user->unreadNotifications()->count();
        \Log::info('Notification count for user '.$user->id.': '.$count);

        return response()->json(['count' => $count]);
    }
}
