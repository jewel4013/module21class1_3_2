@extends('layouts.app')
@section('title', 'Customers')
@section('PageHeader')
    Customers
@endsection

@push('style')
    <style>
        .table-responsive {
            overflow: visible !important;
        }
    </style>
@endpush

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-dark">
    
    <!-- 🚀 ১. ওপরের ডাইনামিক অ্যাকশন বাটন জোন (হুবহু ইমেজের মতো রঙিন) -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="/customers/create" class="btn btn-success rounded-2 fw-semibold px-3 btn-sm">➕ Add Customer</a>
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
                    <th>Name</th>
                    <th>Phone</th>                    
                    <th>Email</th>
                    <th>Address</th>
                    <th>Thana</th>                    
                    <th>District</th>
                </tr>
            </thead>
            <tbody id="categoryTableBody">
                <!-- আইটেম ১ -->
                @foreach ($customers as $customer)
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle py-1 px-2" type="button"  data-bs-toggle="dropdown">Action</button>
                                <ul class="dropdown-menu shadow-sm"  data-bs-popper="static" style="z-index: 1050;">
                                    <li><a class="dropdown-menu-item p-2 text-decoration-none d-block text-dark small link-primary" href="{{route('customersEdit', $customer->id)}}" >✏️ Edit</a></li>
                                    <li><a class="dropdown-menu-item p-2 text-decoration-none d-block text-danger small link-primary" href="" onclick="event.preventDefault(); handleCustomerDelete({{ $customer->id }})" >🗑️ Delete</a></li>
                                </ul>
                            </div>
                        </td>
                        <td >{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->address}}</td>
                        <td>{{$customer->thana}}</td>
                        <td>{{$customer->district}}</td>
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





<!-- সুন্দর অ্যানিমেটেড কনফার্মেশন মডাল -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- স্ক্রিনের ঠিক মাঝখানে আনার জন্য modal-dialog-centered -->
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <!-- অ্যানিমেটেড ওয়ার্নিং আইকন -->
                <div class="text-danger mb-3">
                    <i class="fas fa-exclamation-circle fa-3x animate__animated animate__pulse animate__infinite"></i>
                </div>
                <h5>Are you sure?</h5>
                <p class="text-muted small mb-4">You won't be able to revert this customer data!</p>
                
                <button type="button" class="btn btn-secondary btn-sm px-3 me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm px-3">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>


 
    
@endpush

@push('script')
    <script>
        
        // //getDashboardData();
        // async function getDashboardData() {
        //     try {                
        //         let response = await axios.get('/backend/profile');
        //         console.log(response);

        //         if(response.status === 200){
        //             let data = response.data.data;
        //             document.getElementById('userAvatar').src = data.avatar;
        //             document.getElementById('userName').innerHTML = data.name;

        //         } else {
        //             console.log(response.data);                    
        //             toastr.error(response.data.message || "Failed to load dashboard data.");
        //         }
        //     } catch (error) {
        //         console.error(error);
        //         if (error.response && error.response.data) {
        //             toastr.error(error.response.data.message);
        //         } else {
        //             toastr.error("Something went wrong while fetching dashboard data.");
        //         }
        //     }
        // }

        
        // ডিলিট করার জন্য একটি গ্লোবাল ভ্যারিয়েবল
        let customerIdToDelete = null;
        let deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

        // ১. বাটনে ক্লিক করলে মডাল ওপেন হবে এবং আইডি সেভ হবে
        function handleCustomerDelete(customerId) {
            customerIdToDelete = customerId;
            deleteModal.show(); // মডালটি মাঝখানে ভেসে উঠবে
        }

        // ২. মডালের 'Yes, Delete' বাটনে ক্লিক করলে এই ইভেন্টটি রান হবে
        document.getElementById('confirmDeleteBtn').addEventListener('click', async function() {
            try {
                let response = await axios.delete('/customers/' + customerIdToDelete + '/delete');

                if (response.status === 201 && response.data.status === true) {
                    deleteModal.hide(); // মডালটি বন্ধ হবে
                    
                    // আপনার অলরেডি সেটআপ করা টোস্টার নোটিফিকেশন
                    toastr.success(response.data.message); 
                    
                    // ১ সেকেন্ড পর পেজ রিলোড হবে
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error("Could not delete customer.");
                }
            } catch (err) {
                toastr.error("Something went wrong. Please try again.");
            }
        });

    </script>
@endpush
               