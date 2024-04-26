<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\link;
use App\Http\Requests\ShortenRequest;
use DateTime;
use App\Models\Viewer;
use Illuminate\Support\Facades\Http;
use Torann\GeoIP\Facades\GeoIP;
use GuzzleHttp\Client;



class ShortenController extends Controller
{
    public function show(Request $request, string $shorten)
    {
        $response = Http::get('https://api.ipify.org');
        $Adress = Http::get('http://ip-api.com/php/'.$response);
        $Adress = unserialize($Adress);
        $link = Link::where('shorten', $shorten)->first();
        $link->update(
            [
                'click' => $link['click'] + 1,
            ],
        );
        Viewer::create([
            'link_id' => $link['id'],
            'device' => $request->header('Sec-Ch-Ua-Mobile') == '?0' ? "Computer" : "Mobile",
            'media' => $request->header('Sec-Ch-Ua'),
            'platform' => $request->header('Sec-Ch-Ua-Platform'),
            'country' => $Adress['country'],
            'ip' => $request->ip(),
            'city' =>  $Adress['city'],
            'lat' =>  $Adress['lat'],
            'lon' =>  $Adress['lon'],
        ]);
        return redirect($link['link']);
    }
}
