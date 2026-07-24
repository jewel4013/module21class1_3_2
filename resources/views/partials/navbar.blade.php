 <!-- 💻 ⬅️ বড় স্ক্রিনের জন্য স্থায়ী সাইডবার (d-none d-md-block দিয়ে ছোট স্ক্রিনে হাইড করা হয়েছে) -->
            <nav class="sidebar shadow d-none d-md-block">
                <div class="sidebar-brand text-success">
                    <span>🛒</span> SHWAPNO <span class="badge bg-success ms-2 text-white" style="font-size: 11px;">POS</span>
                </div>
                <ul class="sidebar-menu">
                    <li class="sidebar-item active"><a href="/dashboard"><span>📊</span> <span class="ms-2">Dashboard</span></a></li>
                    <li class="sidebar-item"><a href="/sales"><span>💰</span> <span class="ms-2">Sales Register</span></a></li>
                    <li class="sidebar-item"><a href="/stock"><span>📦</span> <span class="ms-2">Stock Inventory</span></a></li>
                    <li class="sidebar-item"><a href="/invoices"><span>🛍️</span> <span class="ms-2">Products</span></a></li>
                    <li class="sidebar-item"><a href="/invoices"><span>📋</span> <span class="ms-2">Invoices</span></a></li>
                    <li class="sidebar-item"><a href="/invoices"><span>✒️</span> <span class="ms-2">Report</span></a></li>
                    <li class="sidebar-item"><a href="/invoices"><span>📈</span> <span class="ms-2">Statstic</span></a></li>
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
                        <li class="sidebar-item"><a href="/invoices"><span>👥</span> <span class="ms-2">Customers</span></a></li>
                        <li class="sidebar-item"><a href="/sales"><span>💰</span> <span class="ms-2">Sales Register</span></a></li>
                        <li class="sidebar-item"><a href="/stock"><span>📦</span> <span class="ms-2">Stock Inventory</span></a></li>
                        <li class="sidebar-item"><a href="/invoices"><span>🛍️</span> <span class="ms-2">Products</span></a></li>
                        <li class="sidebar-item"><a href="/invoices"><span>📋</span> <span class="ms-2">Invoices</span></a></li>
                        <li class="sidebar-item"><a href="/invoices"><span>✒️</span> <span class="ms-2">Report</span></a></li>
                        <li class="sidebar-item"><a href="/invoices"><span>📈</span> <span class="ms-2">Statstic</span></a></li>
                    </ul>
                </div>
                <div class="position-absolute bottom-0 w-100 p-3 border-top border-secondary border-opacity-25">
                    <a href="/logout" class="btn btn-outline-danger w-100 btn-sm rounded-3 fw-bold">🚪 Logout</a>
                </div>
            </div>