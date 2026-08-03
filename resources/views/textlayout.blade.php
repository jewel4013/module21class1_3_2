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
                /* গ্লোবাল এবং ব্যাকগ্রাউন্ড স্টাইল */
                body {
                background-color: #f5f7fa; /* ইমেজের মতো হালকা নীলচে-ধূসর ব্যাকগ্রাউন্ড */
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                overflow-x: hidden;
                }

                /* টপ নেভিগেশন বার */
                .top-navbar {
                height: 65px;
                background-color: #ffffff;
                border-bottom: 1px solid #e3e8ef;
                z-index: 1030;
                }
                .search-box {
                max-width: 300px;
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                }

                /* সাইডবার স্টাইল */
                .sidebar {
                width: 260px;
                height: calc(100vh - 65px);
                position: fixed;
                top: 65px;
                left: 0;
                background-color: #ffffff;
                border-right: 1px solid #e3e8ef;
                overflow-y: auto;
                z-index: 1020;
                transition: all 0.3s ease;
                }

                /* মেনুর হেডিং (যেমন: APPS) */
                .sidebar .menu-heading {
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #a0aec0;
                padding: 1.25rem 1.5rem 0.5rem;
                font-weight: 700;
                }

                /* প্রধান মেনু লিঙ্ক */
                .sidebar .nav-link {
                color: #4a5568;
                font-weight: 500;
                padding: 0.6rem 1.25rem;
                display: flex;
                align-items: center;
                border-radius: 6px;
                margin: 2px 12px;
                text-decoration: none;
                transition: background-color 0.15s ease;
                }

                .sidebar .nav-link:hover {
                background-color: #f8fafc;
                color: #3874ff;
                }

                /* একটিভ বা সিলেক্টেড মেনু */
                .sidebar .nav-link.active {
                color: #3874ff;
                font-weight: 600;
                }

                /* ড্রপডাউন তীর চিহ্নের অ্যানিমেশন */
                .arrow-icon {
                font-size: 0.7rem;
                color: #a0aec0;
                transition: transform 0.2s ease;
                }
                /* মেনু ওপেন হলে তীরটি ৯০ ডিগ্রি ঘুরে নিচে মুখ করবে */
                .sidebar .nav-link:not(.collapsed) .arrow-icon {
                transform: rotate(90deg);
                color: #3874ff;
                }

                /* সাব-মেনু ও কন্টেইনার স্টাইল */
                .submenu-container, .nested-submenu-list {
                display: flex;
                flex-direction: column;
                padding-left: 2.7rem; /* টেক্সটগুলোকে ডানে সরানোর জন্য */
                margin-top: 2px;
                margin-bottom: 6px;
                }

                .sidebar .sub-link {
                font-size: 0.88rem;
                color: #4a5568;
                text-decoration: none;
                padding: 0.4rem 0;
                font-weight: 500;
                display: block;
                transition: color 0.15s ease;
                }

                .sidebar .sub-link:hover, .sidebar .sub-link.active {
                color: #3874ff;
                }

                /* মাল্টি-লেভেল (Admin/Customer) এর ভেতরের ২য় স্তরের লিঙ্ক */
                .nested-nav-link {
                color: #4a5568;
                text-decoration: none;
                font-size: 0.88rem;
                padding: 0.4rem 0;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 6px;
                }
                .nested-nav-link:hover {
                color: #3874ff;
                }
                .nested-submenu-list {
                padding-left: 1.2rem;
                }

                /* কাস্টম অরেঞ্জ NEW ব্যাজ */
                .badge-new {
                background-color: #fff3e0;
                color: #fb8c00;
                border: 1px solid #ffe0b2;
                font-size: 0.65rem;
                font-weight: 700;
                padding: 2px 6px;
                border-radius: 4px;
                }

                /* মেইন কন্টেন্ট এরিয়া */
                .main-content {
                margin-left: 260px;
                padding: 85px 2rem 2rem 2rem;
                min-height: 100vh;
                }

                /* রেসপন্সিভনেস (মোবাইল স্ক্রিনের জন্য) */
                @media (max-width: 991.98px) {
                .sidebar {
                    left: -260px;
                }
                .sidebar.show {
                    left: 0;
                }
                .main-content {
                    margin-left: 0;
                }
                }

            </style>
    </head>
    <body>


  <!-- ১. টপ নেভিগেশন বার (Top Navbar) -->
  <nav class="navbar top-navbar fixed-top px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      
      <!-- বাম অংশ: লোগো এবং মোবাইল মেনু বাটন -->
      <div class="d-flex align-items-center gap-3">
        <button class="btn d-lg-none p-0 border-0" id="sidebarToggle">
          <i class="bi bi-list fs-3"></i>
        </button>
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark" href="#">
          <i class="bi bi-fire text-warning fs-4"></i> phoenix
        </a>
      </div>

      <!-- মাঝের অংশ: টপ লিংকসমূহ -->
      <div class="d-none d-lg-flex align-items-center gap-4 text-muted small fw-semibold">
        <a href="#" class="text-decoration-none text-dark">Home</a>
        <a href="#" class="text-decoration-none text-secondary">Apps</a>
        <a href="#" class="text-decoration-none text-secondary">Pages</a>
        <a href="#" class="text-decoration-none text-secondary">Modules</a>
        <a href="#" class="text-decoration-none text-secondary">Documentation</a>
      </div>

      <!-- ডান অংশ: সার্চ, নোটিফিকেশন ও প্রোফাইল -->
      <div class="d-flex align-items-center gap-3">
        <div class="input-group search-box d-none d-md-flex rounded-pill px-2 py-1 align-items-center">
          <i class="bi bi-search text-muted ms-1"></i>
          <input type="text" class="form-control border-0 bg-transparent shadow-none py-0 small" placeholder="Search...">
        </div>
        <button class="btn btn-link text-secondary position-relative p-1">
          <i class="bi bi-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
        </button>
        <img src="https://unsplash.com" alt="Profile" class="rounded-circle border" width="35" height="35">
      </div>

    </div>
  </nav>

  <!-- ২. সাইডবার নেভিগেশন (Dropdown Sidebar) -->
  <aside class="sidebar" id="sidebarMenu">
    <div class="py-2">
      
      <!-- হোম লিংক -->
      <a href="#" class="nav-link active">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-caret-right-fill opacity-0 small"></i> 
          <i class="bi bi-house-door"></i> Home
        </div>
      </a>

      <div class="menu-heading">Apps</div>

      <!-- ই-কমার্স (মাল্টি-লেভেল ড্রপডাউন) -->
      <div class="nav-item-dropdown">
        <a class="nav-link collapsed justify-content-between" data-bs-toggle="collapse" href="#ecommerceCollapse" role="button" aria-expanded="false">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-caret-right-fill arrow-icon"></i>
            <i class="bi bi-cart3"></i> E commerce
          </div>
        </a>
        <div class="collapse" id="ecommerceCollapse">
          <div class="submenu-container">
            <div>
              <a class="nested-nav-link collapsed" data-bs-toggle="collapse" href="#adminCollapse" role="button" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-icon"></i> Admin
              </a>
              <div class="collapse" id="adminCollapse">
                <div class="nested-submenu-list">
                  <a href="#" class="sub-link">Dashboard</a>
                  <a href="#" class="sub-link">Products</a>
                </div>
              </div>
            </div>
            <div>
              <a class="nested-nav-link collapsed" data-bs-toggle="collapse" href="#customerCollapse" role="button" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-icon"></i> Customer
              </a>
              <div class="collapse" id="customerCollapse">
                <div class="nested-submenu-list">
                  <a href="#" class="sub-link">Overview</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- সিআরএম (CRM) -->
      <div class="nav-item-dropdown">
        <a class="nav-link collapsed justify-content-between" data-bs-toggle="collapse" href="#crmCollapse" role="button" aria-expanded="false">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-caret-right-fill arrow-icon"></i>
            <i class="bi bi-telephone"></i> CRM
          </div>
        </a>
        <div class="collapse" id="crmCollapse">
          <div class="submenu-container">
            <a href="#" class="sub-link">Analytics</a>
            <a href="#" class="sub-link">Deals</a>
          </div>
        </div>
      </div>

      <!-- প্রোজেক্ট ম্যানেজমেন্ট (ডিফল্ট ওপেন) -->
      <div class="nav-item-dropdown">
        <a class="nav-link justify-content-between" data-bs-toggle="collapse" href="#projectCollapse" role="button" aria-expanded="true">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-caret-right-fill arrow-icon"></i>
            <i class="bi bi-clipboard"></i> Project management
          </div>
        </a>
        <div class="collapse show" id="projectCollapse">
          <div class="submenu-container">
            <a href="#" class="sub-link">Create new</a>
            <a href="#" class="sub-link">Project list view</a>
            <a href="#" class="sub-link">Project card view</a>
            <a href="#" class="sub-link">Project board view</a>
            <a href="#" class="sub-link">Todo list</a>
            <a href="#" class="sub-link">Project details</a>
          </div>
        </div>
      </div>

      <!-- স্টক (NEW ব্যাজসহ) -->
      <div class="nav-item-dropdown">
        <a class="nav-link collapsed justify-content-between" data-bs-toggle="collapse" href="#stockCollapse" role="button" aria-expanded="false">
          <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-caret-right-fill arrow-icon"></i>
              <i class="bi bi-currency-dollar"></i> Stock
            </div>
            <span class="badge badge-new me-2">NEW</span>
          </div>
        </a>
        <div class="collapse" id="stockCollapse">
          <div class="submenu-container">
            <a href="#" class="sub-link">Inventory</a>
          </div>
        </div>
      </div>

      <a href="#" class="nav-link">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-caret-right-fill opacity-0 small"></i>
          <i class="bi bi-chat-left-dots"></i> Chat
        </div>
      </a>

      <a href="#" class="nav-link">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-caret-right-fill opacity-0 small"></i>
          <i class="bi bi-envelope"></i> Email
        </div>
      </a>

    </div>
  </aside>

  <!-- ৩. মেইন কন্টেন্ট এরিয়া -->
  <main class="main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <div>
        <h1 class="h2 fw-bold text-dark mb-1">Ecommerce Dashboard</h1>
        <p class="text-muted small">Here's what's going on at your business right now.</p>
      </div>
    </div>
    
    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 12px;">
      <h5 class="fw-bold text-secondary mb-2">লেআউট সফলভাবে সেটআপ হয়েছে!</h5>
      <p class="text-muted m-0 small">ফাইল দুটি আলাদা করার কারণে কোড এখন একদম পরিষ্কার। সাইডবার টেস্ট করে দেখুন।</p>
    </div>
  </main>






  
        <!-- মোবাইল মেনু টগল স্ক্রিপ্ট -->
        <script>
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarMenu = document.getElementById('sidebarMenu');

            sidebarToggle.addEventListener('click', () => {
            sidebarMenu.classList.toggle('show');
            });
        </script>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@1.18.1/dist/axios.min.js"></script>
                
    </body>
</html>