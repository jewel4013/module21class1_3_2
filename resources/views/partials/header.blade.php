<!-- মূল নেভবার -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary sticky-top">
    <div class="container-fluid px-4">
        
        <!-- ১. মোবাইল/স্মল ডিভাইসের জন্য বাম পাশে সাইডবার টগল বাটন (ট্রিগার) -->
        <button class="btn btn-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ব্র্যান্ড লোগো এবং নাম -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-success me-auto" href="{{ route('dashboard') }}">
            <span class="fs-4 me-2">🛒</span> SHWAPNO <span class="badge bg-success ms-2 fs-6">POS</span>
        </a>

        <!-- ২. ডেক্সটপ বা বড় ডিভাইসের জন্য রেগুলার মেনু (মোবাইলে এটি হাইড থাকবে) -->
        <div class="collapse navbar-collapse d-none d-lg-flex" id="desktopNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link">Sales</a></li>
                <li class="nav-item"><a class="nav-link">Stock</a></li>
                <li class="nav-item"><a class="nav-link">Invoices</a></li>
            </ul>

            <!-- ডেক্সটপ প্রোফাইল ড্রপডাউন -->
            <div class="d-flex align-items-center gap-3">
                <span class="text-white-50 small">Outlet: <strong class="text-white">Mirpur-10</strong></span>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <img src="" alt="DP" class="bg-success rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Store Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="" method="POST" class="d-inline">
                                @csrf <!-- লারাভেলের সিকিউরিটি টোকেন -->
                                <button type="submit" class="dropdown-item">
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ৩. মোবাইল বা ছোট ডিভাইসের জন্য ডান পাশে শুধুমাত্র প্রোফাইল ব্যাজ (ক্লিক করলে সাইডবার খুলবে) -->
        <div class="d-flex d-lg-none align-items-center" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" style="cursor: pointer;">
            <div class="bg-success rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">JR</div>
        </div>

    </div>
</nav>

<!-- ====================================================
     ৪. মোবাইল সাইডবার অংশ (Offcanvas - শুধুমাত্র ছোট স্ক্রিনে দেখাবে)
     ==================================================== -->
<div class="offcanvas offcanvas-start bg-dark text-white d-lg-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel" style="width: 280px;">
    <!-- সাইডবার হেডার -->
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title text-success fw-bold" id="mobileSidebarLabel">🛒 SHWAPNO POS</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dispatch="offcanvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <!-- সাইডবার বডি/মেনু লিংকসমূহ -->
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <!-- ইউজার ইনফো কার্ড -->
            <div class="d-flex align-items-center gap-3 p-3 bg-secondary bg-opacity-25 rounded mb-4">
                <img src="" alt="DP" class="bg-success rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-5" style="width: 45px; height: 45px;">
                <div>
                    <h6 class="mb-0 fw-bold"></h6>
                    <small class="text-white-50">Outlet: Mirpur-10</small>
                </div>
            </div>

            <!-- মেনু লিংকস -->
            <ul class="nav nav-pills flex-column mb-auto gap-1">
                <li class="nav-item">
                    <a href=""><span class="me-2">📊</span> Dashboard</a>
                </li>
                <li>
                    <a href="}}"><span class="me-2">💰</span> Sales Management</a>
                </li>
                <li>
                    <a href=""><span class="me-2">📦</span> Stock Management</a>
                </li>
                <li>
                    <a href=""><span class="me-2">🧾</span> Invoice Management</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white py-2.5 opacity-75"><span class="me-2">👤</span> My Profile</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white py-2.5 opacity-75"><span class="me-2">⚙️</span> Store settings</a>
                </li>
            </ul>
        </div>

        <!-- নিচে লগআউট বাটন -->
        <div class="border-top border-secondary pt-3">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf <!-- লারাভেলের সিকিউরিটি টোকেন -->
                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                    <span >Logout</span>
                </button>
            </form>

        </div>
    </div>
</div>
