@extends('layouts.app')
@section('title', 'Catagories')
@section('PageHeader')
    <span class="d-none d-sm-inline">Product</span> Catagories
@endsection

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-dark">
    
    <!-- 🚀 ১. ওপরের ডাইনামিক অ্যাকশন বাটন জোন (হুবহু ইমেজের মতো রঙিন) -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="/catagories/create" class="btn btn-primary rounded-2 fw-semibold px-3 btn-sm">➕ Add Category</a>
        <button class="btn btn-purple text-white rounded-2 fw-semibold px-3 btn-sm" style="background-color: #6f42c1;">📥 Import Category</button>
        <button class="btn btn-info text-white rounded-2 fw-semibold px-3 btn-sm">Active Home</button>
        <button class="btn btn-warning text-dark rounded-2 fw-semibold px-3 btn-sm">De-Active Home</button>
        <button class="btn btn-teal text-white rounded-2 fw-semibold px-3 btn-sm" style="background-color: #20c997;">Active Menu</button>
        <button class="btn btn-orange text-white rounded-2 fw-semibold px-3 btn-sm" style="background-color: #fd7e14;">De-Active Menu</button>
    </div>

    <!-- 🔍 ২. ফিল্টারিং এবং সার্চ বার জোন -->
    <div class="row g-3 align-items-center justify-content-between mb-3" style="font-size: 13px;">
        <div class="col-auto d-flex align-items-center gap-2">
            <span>Show</span>
            <select id="perPage" class="form-select form-select-sm bg-light" style="width: 70px;">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50" selected>50</option>
            </select>
            <span>records per page</span>
        </div>
        
        <div class="col-auto d-flex align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted fw-bold">Search</label>
                <input type="text" id="tableSearch" class="form-control form-control-sm bg-light" style="width: 200px;">
            </div>
            <!-- এক্সপোর্ট টুলস আইকন গ্রুপ (ইমেজের ডান কোণার বাটনসমূহ) -->
            <div class="btn-group btn-group-sm">
                <button class="btn btn-danger" title="Copy">📋</button>
                <button class="btn btn-secondary" title="CSV">📄</button>
                <button class="btn btn-warning text-white" title="Excel">📊</button>
                <button class="btn btn-info text-white" title="PDF">📕</button>
                <button class="btn btn-primary" title="Print">🖨️</button>
            </div>
        </div>
    </div>

    <!-- 📊 ৩. মূল রেসপনসিভ ডাটা টেবিল -->
    <div class="table-responsive">
        <table class="table table-hover align-middle border-top" style="font-size: 13px; color: #495057;">
            <thead class="table-light text-secondary fw-semibold">
                <tr>
                    <th style="width: 40px;"><input type="checkbox" class="form-check-input"></th>
                    <th>Action</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Desctiption</th>                    
                    <th>Number of Product</th>
                    <th>Stock Quantity</th>
                    <th>Stock Worth (Price/Cost)</th>
                    <th>Show Home</th>
                    <th>Show Menu</th>
                </tr>
            </thead>
            <tbody id="categoryTableBody">
                <!-- আইটেম ১ -->
                @foreach ($catagories as $catagory )
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle py-1 px-2" type="button" data-bs-toggle="dropdown">Action</button>
                                <ul class="dropdown-menu shadow-sm">
                                    <li><a class="dropdown-menu-item p-2 text-decoration-none d-block text-dark small" href="#" onclick="editCategory(1)">✏️ Edit</a></li>
                                    <li><a class="dropdown-menu-item p-2 text-decoration-none d-block text-danger small" href="#" onclick="deleteCategory(1)">🗑️ Delete</a></li>
                                </ul>
                            </div>
                        </td>
                        <td >{{$catagory->name}}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $catagory->imageUrl }}" class="rounded border" alt="img" style="width: 38px; height: 38px; object-fit: cover; display: block;">
                            </div>
                        </td>
                        <td>{{$catagory->description}}</td>
                        <td>150</td>
                        <td>2540</td>
                        <td>254000</td>
                        <td><span class="text-success">{{$catagory->show_home ? 'yes' : '-'}}</span></td>
                        <td><span class="text-success">{{$catagory->show_menu ? 'yes' : '-'}}</span></td>
                    </tr>                    
                @endforeach
                
                                 
            </tbody>
        </table>
    </div>

    <!-- 📑 ৪. নিচের পেজিনেশন এবং ডাটা রেকর্ড ইনফো বার -->
    <div class="d-flex justify-content-between align-items-center mt-3" style="font-size: 13px;">
        <div class="text-muted">
            Showing <span class="fw-bold">1 - 5</span> of <span class="fw-bold">5</span> records
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-item-link p-2 border text-muted text-decoration-none rounded-start small" href="#">&lt;</a></li>
                <li class="page-item active"><a class="page-item-link p-2 bg-success text-white text-decoration-none small" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-item-link p-2 border text-muted text-decoration-none rounded-end small" href="#">&gt;</a></li>
            </ul>
        </nav>
    </div>

</div>

 
    
@endpush

@push('script')
    <script>
        
        //getDashboardData();
        async function getDashboardData() {
            try {                
                let response = await axios.get('/backend/profile');
                console.log(response);

                if(response.status === 200){
                    let data = response.data.data;
                    document.getElementById('userAvatar').src = data.avatar;
                    document.getElementById('userName').innerHTML = data.name;

                } else {
                    console.log(response.data);                    
                    toastr.error(response.data.message || "Failed to load dashboard data.");
                }
            } catch (error) {
                console.error(error);
                if (error.response && error.response.data) {
                    toastr.error(error.response.data.message);
                } else {
                    toastr.error("Something went wrong while fetching dashboard data.");
                }
            }
        }
    </script>
@endpush