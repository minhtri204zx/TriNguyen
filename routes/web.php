<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\linkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\ShortenLinkController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [\App\Http\Controllers\linkController::class, 'index']); //photos
Route::post('/store', [\App\Http\Controllers\linkController::class, 'store']);   //store
Route::get('/{id}/edit', [\App\Http\Controllers\linkController::class, 'edit']);  // /photos/{photo}/edit

Route::get('login',[LoginController::class,'index']);  //	/photos
Route::post('login',[LoginController::class, 'store']);  // /photos
Route::get('logout',[LoginController::class,'destroy']);  // destroy

Route::get('signup',[SignUpController::class,'index']);
Route::post('signup',[SignUpController::class,'store']);



Route::get('/{code}/verifyEmail',[AccountController::class,'email']);

Route::get('updateAccount',[AccountController::class, 'index']);

Route::patch('updateAccount/{id}/edit',[AccountController::class, 'update']);

Route::patch('/shortenLink/{id}',[ShortenLinkController::class, 'edit']);
Route::get('/{id}/shorten',[linkController::class, 'index']);

Route::get('manageAccount',[AccountController::class, 'manageAccount']);

Route::get('deleteLink/{id}',[linkController::class, 'deleteLink']);




Route::get('/qr', function () {
    $data = [
        "id"=> 21,
        "name"=> "Ngân hàng TMCP Quân đội",
        "code"=> "MB",
        "bin"=> "970422",
        "shortName"=> "MBBank",
        "logo"=> "https=>//api.vietqr.io/img/MB.png",
        "transferSupported"=> 1,
        "lookupSupported"=> 1,
        "short_name"=> "MBBank",
        "support"=> 3,
        "isTransfer"=> 1
    ];
    $jsonPaymentInfo = json_encode($data);
     $qr= QrCode::size(300)->generate($jsonPaymentInfo);
     $qr_email = QrCode::email('trinmph36953@fpt.edu.vn', 'testthoi', 'chacogi');
     $qr_phone= QrCode::phoneNumber('0984484683');
     return view('qr-code',['qr'=>$qr_phone]);
});


Route::get('abc',function (){
    return view('qrcode');
});


