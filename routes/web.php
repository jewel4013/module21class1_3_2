<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\JwtAuthMiddleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


/**
 * @param string|array $route
 * @return string
 */

//do it 
// function set_active($route): string {
//     if(is_array($route)){
//         return in_array(Request::path(), $route) ? 'active' : '';
//     }
//     return Request::path() == $route ? 'active' : '';
// }
//and apply it
// {{ set_active(['catagories', 'catagories/create']) }}

function set_active($route): string {
    // 🚀 লারাভেলের অফিশিয়াল Request::is() মেথড স্টার (*) প্যাটার্ন নিখুঁতভাবে রিড করতে পারে
    if (is_array($route)) {
        foreach ($route as $r) {
            if (Request::is($r)) {
                return 'active';
            }
        }
        return '';
    }    
    return Request::is($route) ? 'active' : '';
}
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
        Route::post('/profile-update', [ProfileController::class, 'profileUpdate'])->name('profileUpdate');    
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // রেজিস্ট্রেশন পেজ রেন্ডার করা
    });
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profileShow');
    Route::get('/settings', [ProfileController::class, 'settingsShow'])->name('settingsShow');


    Route::middleware('isAdmin')->group(function(){
        Route::get('/brands', [BrandController::class, 'index'])->name('brandsShow');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('brandsCreate');
        Route::post('/backend/brands/create', [BrandController::class, 'store'])->name('brandsStore');
        
        
        
        Route::get('/catagories', [CatagoryController::class, 'index'])->name('catagoriesShow');
        Route::get('/catagories/create', [CatagoryController::class, 'create'])->name('catagoriesCreate');
        Route::post('/catagories/create', [CatagoryController::class, 'store'])->name('catagoriesStore');

        Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('customersCreate');
        Route::post('/customers/create', [CustomerController::class, 'store'])->name('customersStore');
        Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customersShow');
        Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customersEdit');
        Route::post('/customers/{customer}/update', [CustomerController::class, 'update'])->name('customersUpdate');
        Route::delete('/customers/{customer}/delete', [CustomerController::class, 'destroy'])->name('customersDestroy');

        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('productsCreate');
        Route::post('/products/store', [ProductController::class, 'store'])->name('productsStore');
        Route::get('/products/{slug}', [ProductController::class, 'show'])->name('productShow');
        Route::get('/products/{slug}/edit', [ProductController::class, 'edit'])->name('productEdit');
        Route::post('/products/{slug}/update', [ProductController::class, 'update'])->name('productUpdate');
        
        
        Route::get('/sales', [SaleController::class, 'index'])->name('sales');
        Route::get('/sales/create', [SaleController::class, 'create'])->name('salesCreate');
        Route::post('/sales/store', [SaleController::class, 'store'])->name('salesStore');
        Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('saleShow');
        Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])->name('saleEdit');
        Route::post('/sales/{sale}/update', [SaleController::class, 'update'])->name('saleUpdate');
        Route::delete('/sales/{sale}/delete', [SaleController::class, 'destroy'])->name('saleDestroy');
        Route::get('/productssearching', [SaleController::class, 'searchProducts'])->name('searchProducts');

        Route::get('/sales/invoice/{sale}', [SaleController::class, 'invoice'])->name('invoiceShow');
    }); 
});
    



Route::get('/layout', function () {
    return view('textlayout');
});














Route::get('/toastr', function () {
    return view('toastr');
});