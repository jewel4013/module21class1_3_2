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
            @include('partials.navbar')

            <!-- ➡️ ডান পাশের মূল কন্টেন্ট এরিয়া শুরু -->
            <main class="content-area"> 
                <!-- কন্টেন্ট হেডার ও ইউজার প্রোফাইল বার -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary border-opacity-10">
                    <div>
                        <h3 class="fw-bold text-dark mb-1">
                            @yield('PageHeader')
                        </h3>
                        <p class="text-muted small mb-0 d-none d-sm-block">Welcome back! Manage your outlets live data.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown-toggle border-white m-lg-1" data-bs-toggle="dropdown">
                            Log in as: <span id="userName" class="text-dark fw-bold" role="button">Jewel R</span>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profileShow') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Others</a></li>
                        </ul>
                        <div class="container-fluid">
                            <div class="navbar-brand" href="#">
                                <img id="userAvatar" src="" alt="Logo" style="width:40px;" class="rounded-pill">
                            </div>
                        </div>
                    </div>
                </div>

            
                @stack('mainSection')

            </main>
            <!-- ডান পাশের মূল কন্টেন্ট এরিয়া শেষ -->

        </div> 

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@1.18.1/dist/axios.min.js"></script>
        @stack('script')

        <script>
            document.addEventListener('DOMContentLoaded', function(){
                let user = JSON.parse(localStorage.getItem('user'));
                document.getElementById('userAvatar').src = user.avatar;
                document.getElementById('userName').innerHTML = user.name;
            });
        </script>
        
    </body>
</html>