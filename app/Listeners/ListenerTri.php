<?php

namespace App\Listeners;

use App\Events\Tri;
use App\Models\Noti;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerTri
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
     * @param  \App\Events\Tri  $event
     * @return void
     */
    public function handle(Tri $event)
    {
        $event = $event->data;
        Noti::create([
            'content'=> "link ".$event->shorten." của bạn đã ".$event->status,
            'account_id'=> $event->account_id,
        ]);
    }
}
