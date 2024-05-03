<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LinkRequest;
use App\Models\Viewer;

class LinkController extends Controller
{
    public function show(Request $request, int $id)
    {
        $countries = Link::findOrFail($id)->viewers()
            ->select('country', 'link_id')
            ->distinct('country')
            ->get();

        $devices = Link::findOrFail($id)->viewers()
            ->select('device', 'link_id')
            ->distinct('device')
            ->get();

        $endDate = $request->end;
        $startDate = $request->created_at;

        $data = $request->except('page', 'created_at', 'end');

        $viewers = Link::findOrFail($id)->viewers()
            ->where($data)
            ->orderBy('created_at', 'desc')
            ->when($request->has('end') && $request->has('created_at'), function ($query) use ($endDate, $startDate) {
                return $query->where(
                    [
                        ['created_at', '>=', $startDate],
                        ['created_at', '<=', $endDate]
                    ]
                );
            })
            ->when($request->has('created_at') && !$request->has('end'), function ($query) use ($startDate) {
                return $query->where(
                    'created_at',
                    '>=',
                    $startDate
                );
            })
            ->when($request->has('end') && !$request->has('created_at'), function ($query) use ($endDate) {
                return $query->where(
                    'created_at',
                    '<=',
                    $endDate
                );
            })
            ->paginate(8);

        return view('links.detail', compact('viewers', 'id', 'countries', 'devices'));
    }
    public function index(Request $request)
    {
        if (isset($request->oldest)) {
            $links = Link::where('account_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->paginate(4);
        } else {
            $links = Link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(4);
        }

        return view('links.index', compact('links',));
    }

    public function store(LinkRequest $request)
    {
        $Link = $request->input('Link');
        $short = $this->ranDom();

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

    function ranDom($length = 6)
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
