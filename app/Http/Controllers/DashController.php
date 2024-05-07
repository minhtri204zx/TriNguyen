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
                  ->paginate(6);
        } else if (isset($request->oldest)) {

            $links = link::where('account_id', Auth::id())
                ->orderBy('created_at', 'asc')
                  ->paginate(6);
        } else {

            $links = link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                  ->paginate(6);
        }
        
        return view('dashboard.dashboard', ['links' => $links]);
    }
}
