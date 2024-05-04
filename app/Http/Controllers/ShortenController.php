<?php

namespace App\Http\Controllers;

use App\Models\link;
use App\Models\Viewer;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShortenController extends Controller
{
    public function show(Request $request, string $shorten)
    {
        $link = Link::where('shorten', $shorten)->firstOrFail();
        if ($link['pass'] != NULL) {
            return view('links.check-pass', ['shorten' => $link['shorten']]);
        } else {
            $response = Http::get('https://api.ipify.org');
            $address = Http::get('http://ip-api.com/php/' . $response);
            $address = unserialize($address);
            Viewer::create([
                'link_id' => $link['id'],
                'device' => $request->header('Sec-Ch-Ua-Mobile') == '?0' ? "Computer" : "Mobile",
                'media' => $request->header('Sec-Ch-Ua'),
                'platform' => $request->header('Sec-Ch-Ua-Platform'),
                'country' => $address['country'],
                'ip' => $request->ip(),
                'city' =>  $address['city'],
                'lat' =>  $address['lat'],
                'lon' =>  $address['lon'],
            ]);
            return redirect($link['link']);
        }
    }

    public function checkPass(PassRequest $request, string $shorten)
    {
        $link = Link::where('shorten', $shorten)->firstOrFail();
        if ($request->pass==$link['password']) {
        return redirect($link['link']);
        }else{
           return back()->withErrors(['pass'=>'Sai mật khẩu']);
        }
    }
}
