<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;


//bankend routes
Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
Route::post('/backend/register', [AuthController::class, 'register'])->name('register'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::post('/backend/login', [AuthController::class, 'loing'])->name('login'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::post('/backend/forgot', [AuthController::class, 'forgot'])->name('forgot'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::post('/backend/verifyotp', [AuthController::class, 'verifyOTPCheck'])->name('verifyOTPCheck'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::post('/backend/resetpassword', [AuthController::class, 'resetPassword'])->name('resetPassword'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
Route::get('/backend/logout', [AuthController::class, 'logout'])->name('logout'); // রেজিস্ট্রেশন পেজ রেন্ডার করা



//frontend routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('registerView');
Route::get('/login', [AuthController::class, 'showLogin'])->name('loginView');
Route::get('/forgot', [AuthController::class, 'showForgot'])->name('forgotView');
Route::get('/verifyotp', [AuthController::class, 'verifyOTP'])->name('verifyotpView');
Route::get('/passwordreset', [AuthController::class, 'showPasswordReset'])->name('passwordResetView');









Route::get('/toastr', function () {
    return view('toastr');
});