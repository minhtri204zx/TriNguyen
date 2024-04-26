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
use App\Models\Viewer;
use Illuminate\Console\View\Components\Task;

class LinkController extends Controller
{
    public function show(Request $request, int $id){
        $data = $request->except('page');

            $viewers = Viewer::where($data)
            ->where('link_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(4);
      
        return view('links.detail', compact('viewers','id'));
    }
    public function index(Request $request)
    {

            if (isset($request->popular)) {
                $links = Link::where('account_id', Auth::id())
                ->orderBy('click', 'desc')
                ->paginate(4);
            } else if (isset($request->oldest)) {
    
                $links = Link::where('account_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->paginate(4);
            } else {
                $links = Link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(4);
            }
        return view('links.index', compact('links'));
    }



    public function store(LinkRequest $request)
    {
        $Link = $request->input('Link');
        $short = $this->RanDom();
      
        Link::create([
            'link' => $Link,
            'shorten' => $short,
            'account_id' =>  Auth::id(),
            'click' => 0,
        ]);

        return back();
    }

    public function update(Request $request, int $id)
    {
        $link = Link::findOrFail($id);

        $link->update(['shorten' => $request->shorten]);

        return back();
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

    public function destroy(Request $request, int $id)
    {
        $link = Link::findOrFail($id);

        $link->delete();
        
        return back();
    }

}
