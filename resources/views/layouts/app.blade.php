<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- 🚀 আপনার নিজস্ব ও ওয়ার্কিং বুটস্ট্র্যাপ এবং টোস্টার সিএসএস লিংকসমূহ -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    
    <style>
        .main-wrapper {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        /* 🎯 ফিক্সড সাইডবার সিএসএস (বড় স্ক্রিনের জন্য) */
        .sidebar {
            width: 260px;
            min-width: 260px;
            background-color: #212529;
            color: #ffffff;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1000;
        }
        .sidebar-brand {
            padding: 24px;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }
        .sidebar-item a {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #adb5bd;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar-item a:hover, .sidebar-item.active a {
            color: #ffffff;
            background-color: #198754;
            border-left: 4px solid #ffffff;
        }
        .content-area {
            flex-grow: 1;
            padding: 30px;
            overflow-x: hidden;
        }
    </style>
    @stack('style')
</head>

    <body>

        <!-- place navbar here -->
        @if(!isset($hidePartials))
            @include('partials.header')
        @endif
        <div class="main-wrapper">
        
        <!-- 💻 ⬅️ বড় স্ক্রিনের জন্য স্থায়ী সাইডবার (d-none d-md-block দিয়ে ছোট স্ক্রিনে হাইড করা হয়েছে) -->
        <nav class="sidebar shadow d-none d-md-block">
            <div class="sidebar-brand text-success">
                <span>🛒</span> SHWAPNO <span class="badge bg-success ms-2 text-white" style="font-size: 11px;">POS</span>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item active"><a href="/dashboard"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                <li class="sidebar-item"><a href="/sales"><span>💰</span> <span class="ms-2">Sales Register</span></a></li>
                <li class="sidebar-item"><a href="/stock"><span>📦</span> <span class="ms-2">Stock Inventory</span></a></li>
                <li class="sidebar-item"><a href="/invoices"><span>📄</span> <span class="ms-2">Invoices</span></a></li>
            </ul>
            <div class="position-absolute bottom-0 w-100 p-3 border-top border-secondary border-opacity-25">
                <a href="/logout" class="btn btn-outline-danger w-100 btn-sm rounded-3 fw-bold">🚪 Logout</a>
            </div>
        </nav>

        <!-- 📱 ⬅️ ছোট স্ক্রিনের জন্য অফ-ক্যানভাস সাইডবার ড্রয়ার -->
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar" style="width: 260px;">
            <div class="offcanvas-header border-bottom border-secondary border-opacity-25">
                <h5 class="offcanvas-title text-success fw-bold">🛒 SHWAPNO POS</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-with-dismiss="offcanvas" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="sidebar-menu">
                    <li class="sidebar-item active"><a href="/dashboard"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                    <li class="sidebar-item"><a href="/sales"><span>💰</span> <span class="ms-2">Sales Register</span></a></li>
                    <li class="sidebar-item"><a href="/stock"><span>📦</span> <span class="ms-2">Stock Inventory</span></a></li>
                    <li class="sidebar-item"><a href="/invoices"><span>📄</span> <span class="ms-2">Invoices</span></a></li>
                </ul>
            </div>
        </div>
        <!-- ➡️ ডান পাশের মূল কন্টেন্ট এরিয়া শুরু -->
        <main class="content-area">
            
            <!-- কন্টেন্ট হেডার ও ইউজার প্রোফাইল বার -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary border-opacity-10">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Central Dashboard</h3>
                    <p class="text-muted small mb-0 d-none d-sm-block">Welcome back! Manage your outlets live data.</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-muted me-2 small d-none d-md-block">Logged in as: <strong>Store Keeper</strong></span>
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">SK</div>
                </div>
            </div>

           
            @stack('mainSection')

        </main>
        <!-- ডান পাশের মূল কন্টেন্ট এরিয়া শেষ -->

    </div>
    

       

        


       <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>

</body>
</html>