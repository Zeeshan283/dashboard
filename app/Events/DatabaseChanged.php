<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\InvoicePaid;
use App\Models\User; // Import the User model if not already imported

class DatabaseChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public $invoice;

    public function __construct($user, $invoice)
    {
        $this->user = $user;
        $this->invoice = $invoice;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Use a meaningful channel name based on your application's needs
        return new Channel('database_changed');
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        // Ensure that $this->user is a User instance and is not null
        if ($this->user instanceof User && $this->user !== null) {
            // Trigger the notification
            $this->user->notify(new InvoicePaid($this->invoice));
        }
    }
}
