<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;


use App\Models\link;
use Illuminate\Http\Client\ConnectionException;

class CheckLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

      /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 1;

    protected $link;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($link, $id)
    {
        $this->link = $link;
        $this->id = $id;
       
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       try {
        $response = Http::head($this->link);
        $status = $response->failed() ? 'die' : 'alive';
        Link::where('id', $this->id)->update(['status' => $status]);
       } catch (ConnectionException $e) {
        $status ='die';
        Link::where('id', $this->id)->update(['status' => $status]);
       }
    }
}
