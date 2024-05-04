<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\link;
use Illuminate\Support\Facades\Http;

class StartServerListener extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        session_start();
        if (isset($_SESSION['status'])) {
            foreach ($_SESSION['status'] as $status) {
                $time = $status['time']->diff(now())->format('%I');
                if ($time >= 5) {
                    $_SESSION['status'] = [];
                    $links = Link::get();
                    foreach ($links as $link) {
                        $response = Http::head($link->link);
                        if (!$response->failed()) {
                            $_SESSION['status'][] = ['id' => $link->id, 'badge' => 'success', 'status' => 'alive', 'time' => now()];
                        } else {
                            $_SESSION['status'][] = ['id' => $link->id, 'badge' => 'danger', 'status' => 'die', 'time' => now()];
                        }
                    }
                }
                break;
            }
        }else{
            $_SESSION['status'] = [];
            $links = Link::get();
            foreach ($links as $link) {
                $response = Http::head($link->link);
                if (!$response->failed()) {
                    $_SESSION['status'][] = ['id' => $link->id, 'badge' => 'success', 'status' => 'alive', 'time' => now()];
                } else {
                    $_SESSION['status'][] = ['id' => $link->id, 'badge' => 'danger', 'status' => 'die', 'time' => now()];
                }
            }
        }
        $arrStatus = $_SESSION['status'];

        view()->composer('dashboard.dashboard', function ($view) use ($arrStatus) {
            $view->with('arrStatus', $arrStatus);
        });
    }
}
