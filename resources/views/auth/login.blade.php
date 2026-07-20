@extends('layout.app', ['hidePartials' => true]) 


<div class="bg-dark d-flex align-items-center justify-content-center vh-100" style="margin: 0;">
    <div class="container" style="max-width: 560px;">
        <div class="card bg-secondary bg-opacity-10 border-secondary border-opacity-25 rounded-4 px-5 px-sm-5 py-sm-3 text-white shadow-lg">
            
            <!-- ব্র্যান্ড হেডার -->
            <div class="text-center mb-4">
                <span class="fs-1">🛒</span>
                <h3 class="fw-bold text-success mt-2 mb-1">SHWAPNO POS</h3>
                <p class="text-white-50 small">Sign in to manage your outlet inventory</p>
            </div>

            <!-- লগইন ফর্ম -->
            <form action="{{ route('login') }}" method="POST">
                @csrf <!-- লারাভেলের সিকিউরিটি টোকেন -->

                <!-- ইমেইল ইনপুট -->
                <div class="mb-3">
                    <label class="form-label text-white-50 small">Store Keeper Email</label>
                    <input type="email" name="email" class="form-control bg-dark border-secondary border-opacity-50 text-white rounded-3 py-2" placeholder="name@shwapno.com" required>
                </div>

                <!-- পাসওয়ার্ড ইনপুট -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label text-white-50 small mb-0">Password</label>
                        <a href="#" class="text-success text-decoration-none small">Forgot?</a>
                    </div>
                    <input type="password" name="password" class="form-control bg-dark border-secondary border-opacity-50 text-white rounded-3 py-2" placeholder="••••••••" required>
                </div>

                <!-- রিমেম্বার মি -->
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input bg-dark border-secondary" id="rememberMe">
                    <label class="form-check-label text-white-50 small" for="rememberMe">Keep me logged in</label>
                </div>

                <!-- সাবমিট বাটন -->
                <button type="submit" class="btn btn-success w-100 rounded-3 py-2 fw-bold text-uppercase tracking-wide shadow-sm">
                    Secure Login 🔐
                </button>
            </form>

            <p class="text-center text-white-50 small mt-3">
                Don't have an account? <a href="/register" class="text-success text-decoration-none">Register</a>
            </p>

        </div>
    </div>
</div>