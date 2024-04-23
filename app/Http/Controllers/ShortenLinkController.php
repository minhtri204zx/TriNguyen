<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class ShortenLinkController extends Controller
{
    public function edit(Request $request, int $id)
    {
        Link::where('id', $id)->update(['shorten' => $request->shorten]);
        return redirect('/');
    }

}
