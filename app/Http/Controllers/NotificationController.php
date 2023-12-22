<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Events\DatabaseChanged;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function update(Request $request, $id)
    {
        // Logic to update the existing record in the database
        $notification = Notification::findOrFail($id);
        $notification->update(['data' => 'new_data']); // Update this line with your actual logic
        // Redirect or respond as needed
        Log::info('Notification updated: ' . $id);
    }


    public function via(object $notifiable): array
    {
        return $notifiable->prefers_sms ? ['vonage'] : ['mail', 'database'];
    }
    public function fetchNotifications()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications; // Adjust the logic to get notifications as needed

        // Mark notifications as read if necessary
        // $user->unreadNotifications->markAsRead();

        $notificationsCount = $notifications->count();

        return response()->json([
            'notificationsCount' => $notificationsCount,
            'notificationsHtml' => view('notifications.index', compact('notifications'))->render(),
        ]);
    }
}
