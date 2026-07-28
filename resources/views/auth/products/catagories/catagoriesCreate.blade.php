@extends('layouts.app')
@section('title', 'Catagory Create')
@section('PageHeader', 'Catagory Create')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
     <div class="row g-3">
                <!-- নাম -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Name</label>
            <input type="text" id="name" class="form-control bg-white border-secondary rounded-3 py-2" placeholder="John Doe">
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Address</label>
            <input type="text" id="address" class="form-control bg-white border-secondary rounded-3 py-2" placeholder="Dhaka, Bangladesh">
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        <!-- ইমেইল -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Phone</label>
            <input type="email" id="phone" class="form-control bg-white border-secondary rounded-3 py-2" placeholder="+880-195983***">
            <div id="error-email" class="invalid-feedback"></div>
        </div>

        <!-- প্রোফাইল ছবি (Avatar) -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Profile Photo (Avatar). File type: jpg, jpeg, png</label>
            <input type="file" id="avatar" class="form-control bg-white border-secondary rounded-3 py-2">
            <div id="error-avatar" class="invalid-feedback"></div>
        </div>
    </div>

    <!-- সাবমিট বোতাম (onClick ইভেন্ট চালিত) -->
    <div class="mt-4">
        <button type="button" onclick="handleProfile()" class="btn btn-success rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm">
            Save Changes
        </button>
    </div>
    

    




@endpush

@push('script')
    <script>

        document.addEventListener('DOMContentLoaded', function(){    
            let user = JSON.parse(localStorage.getItem('user'));        
            document.getElementById('name').value = user.name;
            document.getElementById('phone').value = user.phone;
            document.getElementById('address').value = user.address;            
        });
        // getProfile();
        // async function getProfile() {
        //     try {                
        //         let response = await axios.get('/backend/profile');
        //         console.log(response);

        //         if(response.status === 200){
        //             let data = response.data.data;     
        //             document.getElementById('name').value = data.name;
        //             document.getElementById('phone').value = data.phone;
        //             document.getElementById('address').value = data.address;
                    
        //         } else {
        //             console.log(response.data);                    
        //             toastr.error(response.data.message || "Failed to load profile data.");
        //         }
        //     } catch (error) {
        //         console.error(error);
        //         if (error.response && error.response.data) {
        //             toastr.error(error.response.data.message);
        //         } else {
        //             toastr.error("Something went wrong while fetching profile.");
        //         }
        //     }
        // }

        async function handleProfile() {
            let name = document.getElementById('name').value.trim();
            let phone = document.getElementById('phone').value.trim();
            let address = document.getElementById('address').value.trim();
            let avatar = document.getElementById('avatar').files[0];
            let avatarFile = avatar; // প্রথম ফাইল অবজেক্টটি নেওয়া হলো

            
            if(name.length == 0){
                toastr.error("Name field is required!");
            }else{
                let formData = new FormData();
                formData.append('name', name);
                formData.append('phone', phone);
                formData.append('address', address);

                if(avatarFile) {
                    formData.append('avatar', avatarFile);
                }
                try {
                    let response = await axios.post('/backend/profile-update', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(response);
                    if(response.status === 200 && response.data.status === true){
                        localStorage.setItem('user', JSON.stringify(response.data.data));
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/profile';
                        }, 1000);
                    }else if(response.response.status === 422){
                        let errors = response.response.data.errors;
                        for (let field in errors) {
                            if(errors.hasOwnProperty(field)){
                                toastr.error(errors[field][0]);
                            }
                        }
                    }else{
                        console.log(response.data);
                        toastr.error("Some error.");
                    }
                } catch (err) {
                    if(err.response){
                        let errors = err.response.data.errors;
                        if(Array.isArray(errors)){  
                            errors.forEach(msg => toastr.error(msg));
                        }else{
                            for (let field in errors) {
                                if(errors.hasOwnProperty(field)){
                                    toastr.error(errors[field][0]);
                                }
                            }
                        }                        
                    }else{
                        toastr.error("Something went wrong. Please try again.");
                    }
                }
            }   
        }

    </script>
@endpush


