<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\account;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    public function update(Request $request, int $id)
    {
        $account = account::where('id',$id);
        $account->update(['vip' => $request->vip]);
        return redirect('/');
    }

}
