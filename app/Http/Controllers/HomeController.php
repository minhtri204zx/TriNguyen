<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\link;
use DateTime;

class HomeController extends Controller
{
    public function show(Request $request, $id = '')
    {
        if (Auth::check()) {
            $links = Link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $links = Link::where('account_id', null)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('home', compact('links'));
    }
}
