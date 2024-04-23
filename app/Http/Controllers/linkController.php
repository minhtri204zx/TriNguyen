<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Link;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\LinkRequest;


class LinkController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = '')
    {
        if (Auth::check()) {
            $listLinks = Link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $listLinks = Link::where('account_id', null)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $url = $request->url();
        $date = new DateTime();
        return view('index', compact('listLinks', 'url', 'date', 'id'));
    }

    public function store(LinkRequest $request)
    {
        if (!Auth::check()) {
            $id = null;
        } else {
            $id = Auth::id();
        }
        $url = $request->url();
        $Link = $request->input('Link');
        $short = $this->RanDom();
        Link::create([
            'link' => $Link,
            'shorten' => $short,
            'account_id' => $id,
            'click' => 0
        ]);
        $shorten = $url . '/' . $short;

        return Redirect('/');
    }

    public function edit(Request $request, string $id)
    {
        $tri = $request->url();
        $tri = explode('/', $tri);
        $Link = Link::where('shorten', $tri[3])->first();
        Link::where('id', $Link['id'])->update(['click' => $Link['click'] + 1]);
        return redirect($Link['link']);
    }

    function RanDom($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function deleteLink($id)
    {
        Link::where('id', $id)->delete();
        return redirect('manageAccount');
    }
}
