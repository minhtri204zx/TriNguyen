<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestLaravelMail;

class SignUpController extends Controller
{
    public function index(Request $request)
    {
        return view('sign-up');
    }
    
    public function store(LoginRequest $request)
    {
        $maxacthuc = $this->Random(6);
        $pass = Hash::make($request->password);
        $user = Account::create([
            'email' => $request->email,
            'password' => $pass,
            'maxacthuc' => $maxacthuc
        ]);
        Mail::to($user->email)
            ->send(new TestLaravelMail($user->email, $maxacthuc));
        return redirect('login');
    }
}
