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
        return view('login.sign-up');
    }
    
    public function store(LoginRequest $request)
    {
        $code = $this->random(6);
        $password = Hash::make($request->password);
        $user = Account::create([
            'email' => $request->email,
            'password' => $password,
            'maxacthuc' => $code
        ]);
        Mail::to($user->email)
            ->send(new TestLaravelMail($user->email, $code));
        return redirect('login');
    }

    public function verifyEmail(string $code)
    {
        $email = account::where('maxacthuc', $code)->first();
        if (isset($email)) {
            echo "Xác thực thành công";
            account::where('maxacthuc', $code)->update(['verifyEmail' => 'Đã xác thực', 'maxacthuc' => NULL]);
        } else {
            echo "Xác thực thất bại";
        }
    }

    function random($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
