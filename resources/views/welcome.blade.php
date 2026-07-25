@extends('layouts.app')
@section('title', 'Dashboard')
@section('PageHeader', 'User Dashboard')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm p-4 bg-white border-start border-success border-4 rounded-3">
                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Today's Sales</span>
                <h2 class="fw-extrabold text-dark mb-0">৳0.00</h2>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm p-4 bg-white border-start border-primary border-4 rounded-3">
                <span class="text-muted small text-uppercase fw-bold d-block mb-1">This Month Sales</span>
                <h2 class="fw-extrabold text-dark mb-0">৳0.00</h2>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 min-vh-50">
                <h5 class="fw-bold text-dark mb-3">Recent Activities</h5>
                <p class="text-muted small">Your sales transactions and invoice logs will appear here live using Axios.</p>
            </div>
        </div>
    </div> 
    
@endpush

@push('script')
    <script>
        getDashboardData();
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