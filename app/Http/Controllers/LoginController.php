<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Models\Account;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestLaravelMail;
use App\Http\Requests\formLogin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
 

   
    
    public function store(formLogin $request)
    {
        
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'verifyEmail' => 'Đã xác thực',
        ])) {
            return redirect('/');
        } else {
            echo "Sai tài khoản mật khẩu";
        }
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('login.login');
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }


}
