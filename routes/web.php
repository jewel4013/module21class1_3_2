<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\JwtAuthMiddleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


/**
 * @param string|array $route
 * @return string
 */

//do it 
function set_active($route): string {
    if(is_array($route)){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}
//and apply it
// {{ set_active(['catagories', 'catagories/create']) }}








//publci routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('registerView');
Route::get('/login', [AuthController::class, 'showLogin'])->name('loginView');
Route::get('/forgot', [AuthController::class, 'showForgot'])->name('forgotView');
Route::get('/verifyotp', [AuthController::class, 'verifyOTP'])->name('verifyotpView');
Route::get('/passwordreset', [AuthController::class, 'showPasswordReset'])->name('passwordResetView');

Route::prefix('backend')->group(function(){
    Route::post('/register', [AuthController::class, 'register'])->name('register'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/login', [AuthController::class, 'loing'])->name('login'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/forgot', [AuthController::class, 'forgot'])->name('forgot'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/verifyotp', [AuthController::class, 'verifyOTPCheck'])->name('verifyOTPCheck'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    Route::post('/resetpassword', [AuthController::class, 'resetPassword'])->name('resetPassword'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
});


//==============================================================================================================================


// protected routes
Route::middleware(['jwtauth'])->group( function(){
    Route::prefix('backend')->group(function(){
        //Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/catagories', [CatagoryController::class, 'store'])->name('catagoriesStore');
        Route::post('/profile-update', [ProfileController::class, 'profileUpdate'])->name('profileUpdate');    
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    });
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profileShow');
    Route::get('/settings', [ProfileController::class, 'settingsShow'])->name('settingsShow');


    Route::middleware('isAdmin')->group(function(){
        Route::get('/catagories', [CatagoryController::class, 'index'])->name('catagoriesShow');
        Route::get('/catagories/create', [CatagoryController::class, 'create'])->name('catagoriesCreate');
    }); 
});
    
















Route::get('/toastr', function () {
    return view('toastr');
});