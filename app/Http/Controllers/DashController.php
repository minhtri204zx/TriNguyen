<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\link;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function show(Request $request)
    {
        if (isset($request->popular)) {
            $links = link::where('account_id', Auth::id())
                ->orderBy('click', 'desc')
                ->get();
        } else if (isset($request->oldest)) {

            $links = link::where('account_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->get();
        } else {

            $links = link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('dashboard.dashboard', ['links' => $links]);
    }
}
