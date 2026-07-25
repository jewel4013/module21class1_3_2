<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\JwtAuthMiddleware;
use Illuminate\Support\Facades\Route;


//bankend routes
Route::group(['prefix'=>'backend'], function(){
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile-update', [ProfileController::class, 'profileUpdate'])->name('profileUpdate');
    Route::post('/register', [AuthController::class, 'register'])->name('register'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/login', [AuthController::class, 'loing'])->name('login'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/forgot', [AuthController::class, 'forgot'])->name('forgot'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/verifyotp', [AuthController::class, 'verifyOTPCheck'])->name('verifyOTPCheck'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/resetpassword', [AuthController::class, 'resetPassword'])->name('resetPassword'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
})->middleware(JwtAuthMiddleware::class);
    
Route::get('/', [dashboardController::class, 'index'])->name('dashboard')->middleware(JwtAuthMiddleware::class);




//frontend routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profileShow')->middleware(JwtAuthMiddleware::class);
Route::get('/register', [AuthController::class, 'showRegister'])->name('registerView');
Route::get('/login', [AuthController::class, 'showLogin'])->name('loginView');
Route::get('/forgot', [AuthController::class, 'showForgot'])->name('forgotView');
Route::get('/verifyotp', [AuthController::class, 'verifyOTP'])->name('verifyotpView');
Route::get('/passwordreset', [AuthController::class, 'showPasswordReset'])->name('passwordResetView');









Route::get('/toastr', function () {
    return view('toastr');
});