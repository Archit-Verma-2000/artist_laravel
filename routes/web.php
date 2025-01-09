<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\UserLoggedIn;
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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/products',function(){
    return view('Customer.Pages.product-detail');
})->name('products');

Route::post('/Login', [LoginController::class,'Login'])->name('Login');

Route::post('/register', [RegisterController::class,'Register'])->name('RegisterRequest');

Route::get('/login', [RegisterController::class,'login'])->name('login');
Route::get('/register', [RegisterController::class,'registerView'])->name('register');
Route::get('/Logout', [RegisterController::class,'logout'])->name('logout');



