<?php

namespace App\Listeners;

use App\Events\DatabaseChangeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DatabaseChangeListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DatabaseChangeEvent  $event
     * @return void
     */
    public function handle(DatabaseChangeEvent $event)
    {
        \Log::info('Handling DatabaseChangeEvent for Notification ID: ' . $event->notification->id);

        // Add your notification logic here

        // For testing, you can also log the contents of $event->notification
        \Log::info($event->notification->toArray());
    }
}
