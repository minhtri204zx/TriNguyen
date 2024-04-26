<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\linkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShortenController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Http;
use App\Models\link;
use GuzzleHttp\Psr7\Request;

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

// Route::get('/', [HomeController::class, 'show']);
Route::get('/', [HomeController::class, 'show']);
Route::get('links', [LinkController::class, 'index']);
Route::post('links', [LinkController::class, 'store']);
Route::patch('links/{id}', [LinkController::class, 'update']);
Route::delete('links/{id}', [LinkController::class, 'destroy'])
    ->name('links.destroy');


Route::middleware(['login'])->group(function () {
    Route::get('links/{id}', [LinkController::class, 'show'])
    ->name('link.show');
    Route::get('logout', [LoginController::class, 'destroy']);
    Route::patch('updateAccount/{id}', [AccountController::class, 'update']);
    Route::get('dashboard', [DashController::class, 'show']);
});


Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'store']);

Route::get('signup', [SignUpController::class, 'index']);
Route::post('signup', [SignUpController::class, 'store']);
Route::get('verifyEmail/{code}', [SignUpController::class, 'verifyEmail']);  //chưa xác định được là cái j

Route::get('pricing', [PriceController::class, 'show']);

Route::get('/{shorten}', [ShortenController::class, 'show'])
    ->name('shorten.show');
