 <!-- 💻 ⬅️ বড় স্ক্রিনের জন্য স্থায়ী সাইডবার (d-none d-md-block দিয়ে ছোট স্ক্রিনে হাইড করা হয়েছে) -->
            <nav class="sidebar shadow d-none d-md-block">
                <div class="sidebar-brand text-success">
                    <span>🛒</span> SHWAPNO <span class="badge bg-success ms-2 text-white" style="font-size: 11px;">POS</span>
                </div>
                <ul class="sidebar-menu">
                    <span id="adminNavbar" style="display: none">
                        <li class="sidebar-item {{ set_active('/') }}"><a href="/"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                        <li class="sidebar-item {{ set_active(['sales', 'sales/*']) }}"><a href="/sales"><span>💰</span> <span class="ms-2">Sales</span></a></li>
                        <li class="sidebar-item {{ set_active(['products', 'products/*',]) }}"><a href="/products"><span>🛍️</span> <span class="ms-2">Products</span></a></li>
                        <li class="sidebar-item {{ set_active(['catagories', 'catagories/create']) }}"><a href="/catagories"><span>📇</span> <span class="ms-2">Catagory</span></a></li>
                        <li class="sidebar-item {{ set_active(['brands', 'brands/create']) }}"><a href="/brands"><span>👥</span> <span class="ms-2">Brands</span></a></li>
                        <li class="sidebar-item {{ set_active(['customers','customers/*']) }}"><a href="/customers"><span>👥</span> <span class="ms-2">Customers</span></a></li>
                        <li class="sidebar-item {{ Request::is('stock') ?  'active' : '' }}"><a href="/stock"><span>📦</span> <span class="ms-2">Stock Inventory</span></a></li>
                        <li class="sidebar-item {{ Request::is('invoices') ?  'active' : '' }}"><a href="/invoices"><span>📋</span> <span class="ms-2">Invoices</span></a></li>                        
                        <li class="sidebar-item {{ Request::is('report') ?  'active' : '' }}"><a href="/report"><span>✒️</span> <span class="ms-2">Report</span></a></li>
                        <li class="sidebar-item {{ Request::is('statstic') ?  'active' : '' }}"><a href="/statstic"><span>📈</span> <span class="ms-2">Statstic</span></a></li>
                        <li class="sidebar-item {{ Request::is('complains') ?  'active' : '' }}"><a href="/complains"><span>🗣️</span> <span class="ms-2">Complains</span></a></li>
                        <li class="sidebar-item {{ Request::is('peoples') ?  'active' : '' }}"><a href="/peoples"><span>🙎🏻</span> <span class="ms-2">Peoples</span></a></li>
                        <li class="sidebar-item {{ set_active('settings') }}"><a href="/settings"><span>⚙️</span> <span class="ms-2">Settings</span></a></li>                        
                        <li class="sidebar-item {{ set_active('layout') }}"><a href="/layout"><span>⚙️</span> <span class="ms-2">TestLayout</span></a></li>                        
                    </span>
                    <span id="customerNavbar" style="display: none">
                        <li class="sidebar-item {{ Request::is('/') ?  'active' : '' }}"><a href="/"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                        <li class="sidebar-item {{ Request::is('sales') ?  'active' : '' }}"><a href="/sales"><span>💰</span> <span class="ms-2">Sales Register</span></a></li>                        
                        <li class="sidebar-item {{ Request::is('products') ?  'active' : '' }}"><a href="/products"><span>🛍️</span> <span class="ms-2">Products</span></a></li>
                        <li class="sidebar-item {{ Request::is('invoice') ?  'active' : '' }}"><a href="/invoice"><span>📋</span> <span class="ms-2">Invoices</span></a></li>
                    </span>
                    
                </ul>
                <div class="bottom-0 w-100 p-3 border-top border-secondary border-opacity-25">
                    <button onclick="logout()" class="btn btn-outline-danger w-100 btn-sm rounded-3 fw-bold">🚪 Logout</button>
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
                        <span id="adminNavbarTogole" style="display: none">
                        <li class="sidebar-item {{ set_active('/') }}"><a href="/"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                        <li class="sidebar-item {{ set_active(['sales', 'sales/*']) }}"><a href="/sales"><span>💰</span> <span class="ms-2">Sales</span></a></li>
                        <li class="sidebar-item {{ set_active(['products', 'products/*',]) }}"><a href="/products"><span>🛍️</span> <span class="ms-2">Products</span></a></li>
                        <li class="sidebar-item {{ set_active(['catagories', 'catagories/create']) }}"><a href="/catagories"><span>📇</span> <span class="ms-2">Catagory</span></a></li>
                        <li class="sidebar-item {{ set_active(['brands', 'brands/create']) }}"><a href="/brands"><span>👥</span> <span class="ms-2">Brands</span></a></li>
                        <li class="sidebar-item {{ set_active(['customers','customers/*']) }}"><a href="/customers"><span>👥</span> <span class="ms-2">Customers</span></a></li>
                        <li class="sidebar-item {{ Request::is('stock') ?  'active' : '' }}"><a href="/stock"><span>📦</span> <span class="ms-2">Stock Inventory</span></a></li>
                        <li class="sidebar-item {{ Request::is('invoices') ?  'active' : '' }}"><a href="/invoices"><span>📋</span> <span class="ms-2">Invoices</span></a></li>                        
                        <li class="sidebar-item {{ Request::is('report') ?  'active' : '' }}"><a href="/report"><span>✒️</span> <span class="ms-2">Report</span></a></li>
                        <li class="sidebar-item {{ Request::is('statstic') ?  'active' : '' }}"><a href="/statstic"><span>📈</span> <span class="ms-2">Statstic</span></a></li>
                        <li class="sidebar-item {{ Request::is('complains') ?  'active' : '' }}"><a href="/complains"><span>🗣️</span> <span class="ms-2">Complains</span></a></li>
                        <li class="sidebar-item {{ Request::is('peoples') ?  'active' : '' }}"><a href="/peoples"><span>🙎🏻</span> <span class="ms-2">Peoples</span></a></li>
                        <li class="sidebar-item {{ Request::is('settings') ?  'active' : '' }}"><a href="/settings"><span>⚙️</span> <span class="ms-2">Settings</span></a></li>
                        <li class="sidebar-item {{ set_active('layout') }}"><a href="/layout"><span>⚙️</span> <span class="ms-2">TestLayout</span></a></li>
                    </span>
                    <span id="customerNavbarTogole" style="display: none">
                        <li class="sidebar-item {{ Request::is('/') ?  'active' : '' }}"><a href="/"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                        <li class="sidebar-item {{ Request::is('sales') ?  'active' : '' }}"><a href="/sales"><span>💰</span> <span class="ms-2">Sales Register</span></a></li>                        
                        <li class="sidebar-item {{ Request::is('products') ?  'active' : '' }}"><a href="/products"><span>🛍️</span> <span class="ms-2">Products</span></a></li>
                        <li class="sidebar-item {{ Request::is('invoice') ?  'active' : '' }}"><a href="/invoice"><span>📋</span> <span class="ms-2">Invoices</span></a></li>
                    </span>
                    </ul>
                </div>
                <div class="bottom-0 w-100 p-3 border-top border-secondary border-opacity-25">
                    <button onclick="logout()" class="btn btn-outline-danger w-100 btn-sm rounded-3 fw-bold">🚪 Logout</button>
                </div>
            </div>



    <script>
        document.addEventListener('DOMContentLoaded', function(){
            let user = JSON.parse(localStorage.getItem('user'));
            let role = user.role;
            if(role === 'admin'){
                document.getElementById('adminNavbar').style.display = 'block';
                document.getElementById('customerNavbar').style.display = 'none';
                document.getElementById('adminNavbarTogole').style.display = 'block';
                document.getElementById('customerNavbarTogole').style.display = 'none';
            }else{
                document.getElementById('adminNavbar').style.display = 'none';
                document.getElementById('customerNavbar').style.display = 'block';
                document.getElementById('adminNavbarTogole').style.display = 'none';
                document.getElementById('customerNavbarTogole').style.display = 'block';
            }            
        });


        function toggleSidebarMenu(element) {
        const parentLi = element.closest('.custom-toggle-menu');
        const currentSubMenu = parentLi.querySelector('.submenu-list');
        const currentArrow = parentLi.querySelector('.arrow-icon');
        
        // অন্য কোনো ওপেন থাকা ড্রপডাউন বন্ধ করা
        document.querySelectorAll('.custom-toggle-menu').forEach(li => {
            if (li !== parentLi && li.classList.contains('menu-open')) {
                li.classList.remove('menu-open');
                li.querySelector('.submenu-list').classList.add('display-none');
                li.querySelector('.arrow-icon').style.transform = 'rotate(0deg)';
            }
        });

        // বর্তমান আইটেম টগল লক করা
        if (parentLi.classList.contains('menu-open')) {
            parentLi.classList.remove('menu-open');
            currentSubMenu.classList.add('display-none');
            currentArrow.style.transform = 'rotate(0deg)';
        } else {
            parentLi.classList.add('menu-open');
            currentSubMenu.classList.remove('display-none');
            currentArrow.style.transform = 'rotate(180deg)';
        }
    }









        async function logout() {
            let response = await axios.post('/backend/logout');
            if(response.status === 200){
                toastr.success(response.data.message);
                setTimeout(() => {
                    window.location.href = '/login';                    
                }, 2000);
            }else{
                toastr.error("Something went wrong.");
            }                      
        }
    </script>
