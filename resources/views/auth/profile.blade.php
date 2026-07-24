@extends('layouts.app')
@section('title', 'Profile')
@section('PageHeader', 'Profile')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
     <div class="row g-3">
                <!-- নাম -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Name</label>
            <input type="text" id="name" class="form-control bg-white border-secondary text-white rounded-3 py-2" placeholder="John Doe">
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Address</label>
            <input type="text" id="address" class="form-control bg-white border-secondary text-white rounded-3 py-2" placeholder="Dhaka, Bangladesh">
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        <!-- ইমেইল -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Phone</label>
            <input type="email" id="phone" class="form-control bg-white border-secondary text-white rounded-3 py-2" placeholder="+880-195983***">
            <div id="error-email" class="invalid-feedback"></div>
        </div>

        <!-- প্রোফাইল ছবি (Avatar) -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Profile Photo (Avatar). File type: jpg, jpeg, png</label>
            <input type="file" id="avatar" class="form-control bg-white border-secondary text-white rounded-3 py-2">
            <div id="error-avatar" class="invalid-feedback"></div>
        </div>
    </div>

    <!-- সাবমিট বোতাম (onClick ইভেন্ট চালিত) -->
    <div class="mt-4">
        <button type="button" onclick="handleProfile()" class="btn btn-success rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm" id="register">
            Save Changes 🔐
        </button>
    </div>
    

    




@endpush

@push('script')
    <script>
        getProfile();
        async function getProfile() {
            let responce = await axios.get('/backend/profile');
            console.log(responce);
            if(responce.status === 200){
                let data = responce.data.data;
                document.getElementById('name').value = data.name;
                
            }else {
                console.log(responce.data);
                toastr.error(responce.data.message);
            }
        }
    </script>
@endpush


