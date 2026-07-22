<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//bankend routes
Route::post('/backend/register', [AuthController::class, 'register'])->name('register'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::post('/backend/forgot', [AuthController::class, 'forgot'])->name('forgot'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::post('/backend/verifyotp', [AuthController::class, 'verifyOTPCheck'])->name('verifyOTPCheck'); // রেজিস্ট্রেশন পেজ রেন্ডার করা


//frontend routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/forgot', [AuthController::class, 'showForgot'])->name('forgot');
Route::get('/verifyotp', [AuthController::class, 'verifyOTP'])->name('verifyotp');
Route::get('/passwordreset', [AuthController::class, 'showPasswordReset'])->name('passwordreset');









Route::get('/toastr', function () {
    return view('toastr');
});