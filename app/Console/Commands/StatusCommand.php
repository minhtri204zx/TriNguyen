<?php

namespace App\Console\Commands;

use App\Events\ChangeStatusLink;
use Illuminate\Console\Command;
use App\Models\link;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class StatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:status_links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cap nhap trang thai cua links';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $links = Link::get();
        foreach ($links as $link) {
            try {
                $response = Http::timeout(2)->head($link->link);
                $status = $response->failed() ? 'die' : 'alive';
            } catch (ConnectionException $e) {
                $status = 'die';
            }
            if ($link->status != $status) {
             event(new ChangeStatusLink($link));
            }
            Link::where('id', $link->id)->update(['status' => $status]);
        }
    }
}
