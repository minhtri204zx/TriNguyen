<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\account;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{

    public function manageAccount()
    {
        $stt = 1;
        if (isset($_GET['popular'])) {

            $listLinks = link::where('account_id', Auth::id())
                ->orderBy('click', 'desc')
                ->get();
        } else if (isset($_GET['oldest'])) {

            $listLinks = link::where('account_id', Auth::id())
                ->orderBy('created_at', 'asc')
                ->get();
        } else {

            $listLinks = link::where('account_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $date = new DateTime();
        return view('manageAccount', ['listLinks' => $listLinks, 'stt' => $stt, 'date' => $date]);
    }


    public function email(string $id)
    {
        $email = account::where('maxacthuc', $id)->first();
        if (isset($email)) {
            echo "Xác thực thành công";
            account::where('maxacthuc', $id)->update(['verifyEmail' => 'Đã xác thực', 'maxacthuc' => NULL]);
        } else {
            echo "Xác thực thất bại";
        }
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

    public function index()
    {
        return view('update-account');
    }

    // public function update(Request $request, int $id)
    // {
    //     account::where('id', $id)->update(['vip' => $request->vip]);
    //     return redirect('/');
    // }

    public function link()
    {
        $stt = 0;
        $id = Auth::id();
        $listLink = link::where('account_id', $id)->get();
        return view('ListLink', ['list' => $listLink, 'stt' => $stt]);
    }
}
