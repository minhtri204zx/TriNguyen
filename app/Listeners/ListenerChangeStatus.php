<?php

namespace App\Listeners;

use App\Events\ChangeStatusLink;
use App\Models\account;
use App\Notifications\StatusLinkNotification;
use App\Notifications\StatusNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerChangeStatus
{
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
     * @param  \App\Events\ChangeStatusLink  $event
     * @return void
     */
    public function handle(ChangeStatusLink $event)
    {
        $event = $event->data;
        $user = account::find($event->account_id);
        $user->notify(new StatusLinkNotification("link $event->shorten : $event->status",$event->account_id));
    }
}
