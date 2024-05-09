<?php

namespace App\Http\Middleware;

use App\Models\Noti;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareNoti
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $notis = $user->unreadNotifications;
            $counts = $notis->count();
            // $notis= json_decode($notis);
            View::share('notis', $notis);
            View::share('counts', $counts);
        }
        return $next($request);

       
    }
}
