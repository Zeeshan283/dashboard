<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\DatabaseChangeEvent;
use App\Models\Notification;

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
        $notification->update(['your_column' => 'new_value']); // Update this line with your actual logic
        // Redirect or respond as needed
        \Log::info('Notification updated: ' . $id);

    }

    public function showNotifications()
    {
        // Your logic to retrieve notifications from the database
        $notifications = Notification::where('user_id', auth()->id())->get();

        // Trigger the event if the user is an admin
        if (auth()->user()->is_admin) {
            event(new DatabaseChangeEvent($notifications));
        }

        // Other logic for displaying the view
        return view('path.to.your.view', ['notifications' => $notifications]);
    }

    public function store(Request $request)
    {
        // Logic to store the new record in the database
    
        // Replace this with the actual data you want to pass
        $data = ['key' => 'value'];
    
        // Trigger the event when a new record is created
        event(new DatabaseChangeEvent($data));
    
        // Redirect or respond as needed
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    
}
