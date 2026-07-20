@extends('layout.app')

@push('styles')
<style>
    /* ড্যাশবোর্ড কার্ড স্টাইল */
    .stat-card {
        border-radius: 16px;
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
    }
    /* লগইন ফর্ম সেন্টার স্টাইল */
    .login-box {
        max-width: 420px;
        margin: 80px auto;
    }
</style>
@endpush

@section('mainSection')
<div class="container-fluid min-vh-100 bg-light py-4">

    {{-- 🔒 শর্ত ১: ইউজার যদি অলরেডি লগইন থাকে (Authenticated Dashboard View) --}}
    @auth
        <!-- ড্যাশবোর্ড হেডার -->
        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <div>
                <h2 class="fw-bold text-dark mb-1">Welcome back, !</h2>
                <p class="text-muted small mb-0">Outlet performance overview for today.</p>
            </div>
            <div>
                <!-- লগআউট বাটন (POST মেথড সিকিউরিটি স্ট্যান্ডার্ড) -->
                <form action="" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger rounded-3 px-3 fw-semibold shadow-sm">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- কাউন্টার কার্ডস গ্রিড -->
        <div class="row g-4 mb-4 px-2">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm stat-card p-3 bg-white border-start border-success border-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Today's Sales</span>
                            <h3 class="fw-extrabold text-dark mb-0">৳</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 fs-3">📊</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm stat-card p-3 bg-white border-start border-primary border-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">This Month Sales</span>
                            <h3 class="fw-extrabold text-dark mb-0">৳</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 fs-3">💰</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm stat-card p-3 bg-white border-start border-danger border-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Low Stock Alert</span>
                            <h3 class="fw-extrabold text-danger mb-0">Items</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 fs-3">⚠️</div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    {{-- 🔑 শর্ত ২: ইউজার যদি লগইন না থাকে (Guest Login Form View) --}}
    @guest
        <div class="login-box">
            <div class="card bg-white border-0 rounded-4 p-4 p-sm-5 shadow-sm text-dark">
                
                <div class="text-center mb-4">
                    <span class="fs-1">🛒</span>
                    <h3 class="fw-bold text-success mt-2 mb-1">SHWAPNO POS</h3>
                    <p class="text-muted small">Sign in to access your outlet dashboard</p>
                </div>

                <!-- লগইন ফর্ম সাবমিশন -->
                <form action="" method="POST">
                    @csrf {{-- লারাভেল সিকিউরিটি টোকেন --}}

                    <!-- ইমেইল ফিল্ড -->
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="form-control bg-light border-0 rounded-3 py-2" 
                               placeholder="name@shwapno.com" required>
                    </div>

                    <!-- পাসওয়ার্ড ফিল্ড -->
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Password</label>
                        <input type="password" name="password" 
                               class="form-control bg-light border-0 rounded-3 py-2" 
                               placeholder="••••••••" required>
                    </div>

                    <!-- সাবমিট বাটন -->
                    <button type="submit" class="btn btn-success w-100 rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm">
                        Secure Login 🔐
                    </button>
                </form>

            </div>
        </div>
    @endguest

</div>
@endsection
