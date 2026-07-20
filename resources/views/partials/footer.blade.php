@push('style')
    <style>
        @keyframes pulse {
            0% { transform: scale(0.95); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.5; }
        }
        .animate-pulse {
            animation: pulse 2s infinite ease-in-out;
        }
        .hover-success:hover {
            color: #198754 !important;
            transition: color 0.2s ease-in-out;
        }
    </style>    
@endpush

<footer class="bg-white border-top border-light py-4 mt-auto">
    <div class="container-fluid px-4">
        <div class="row g-4 align-items-center">
            
            <!-- ১. বাম পাশে: সিস্টেম ইনফো ও কপিরাইট -->
            <div class="col-12 col-md-4 text-center text-md-start">
                <p class="mb-1 text-dark fw-bold small text-uppercase tracking-wider">
                    <span class="text-success">🛒</span> Shwapno <span class="fw-light text-muted">Core POS</span>
                </p>
                <p class="mb-0 text-muted small">
                    &copy; 2026 Shwapno Retail Ltd. All rights reserved.
                </p>
            </div>

            <!-- ২. মাঝখানে: লাইভ আউটলেট স্ট্যাটাস (তথ্যবহুল অংশ) -->
            <div class="col-12 col-md-4 text-center">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 bg-light rounded-pill border border-secondary border-opacity-10">
                    <span class="d-inline-block bg-success rounded-circle animate-pulse" style="width: 8px; height: 8px;"></span>
                    <span class="text-muted small">
                        Connected Outlet: <strong class="text-dark">'Mirpur-10'</strong>
                    </span>
                </div>
            </div>

            <!-- ৩. ডান পাশে: কুইক সিস্টেম লিংক ও হেলথ ড্যাশবোর্ড -->
            <div class="col-12 col-md-4 text-center text-md-end">
                <ul class="list-inline mb-0 small">
                    <li class="list-inline-item">
                        <a href="#" class="text-muted text-decoration-none hover-success me-3">Support Desk</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-muted text-decoration-none hover-success me-3">API Status</a>
                    </li>
                    <li class="list-inline-item">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-2 px-2 py-1">
                            v1.13.0
                        </span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>
