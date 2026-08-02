@extends('layouts.app')
@section('title', 'Customer Create')
@section('PageHeader', 'Customer Create')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-dark mt-4">
        {{-- <h4 class="fw-bold text-dark mb-4">➕ Add New Product</h4> --}}
        
        <!-- 🚀 মূল গ্রিড কন্টেইনার (কোনো HTML <form> ট্যাগ ব্যবহার করা হয়নি) -->
        <div class="row g-3" style="font-size: 13px;">
            
            <!-- ১. Customer Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="name">Customer Name</label>
                <input type="text" id="name" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter customer name">
                <div id="error-name" class="invalid-feedback"></div>
            </div>

            <!-- ১. Customer Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="phone">Phone *</label>
                <input type="text" id="phone" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter phone number">
                <div id="error-phone" class="invalid-feedback"></div>
            </div>

            <!-- ১. Customer Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="email">Email</label>
                <input type="email" id="email" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter email address">
                <div id="error-email" class="invalid-feedback"></div>
            </div>

            <!-- ১. Customer Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="address">Address</label>
                <input type="text" id="address" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter address">
                <div id="error-address" class="invalid-feedback"></div>
            </div>

            <!-- ১. Customer Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="thana">Thana</label>
                <input type="text" id="thana" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter thana">
                <div id="error-thana" class="invalid-feedback"></div>
            </div>

            <!-- ১. Customer Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="district">District</label>
                <input type="text" id="district" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter district">
                <div id="error-district" class="invalid-feedback"></div>
            </div>

            <!-- ১২. সাবমিট বোতাম প্যানেল -->
            <div class="col-12 mt-4">
                <!-- 🚀 ওনক্লিক মেথড অ্যাসাইন করা হলো, যা আপনার প্রজেক্টের এক্সিওস ফ্লো হ্যান্ডেল করবে -->
                <button class="btn text-white px-4 fw-semibold rounded-2 shadow-sm" 
                        style="background-color: #6f42c1; font-size: 14px;" 
                        onclick="handleCustomersCreate()">
                    Submit
                </button>
            </div>

        </div>
    </div>
 


@endpush

@push('script')
    <script>
        async function handleCustomersCreate() {
            let name = document.getElementById('name').value.trim();            
            let phone = document.getElementById('phone').value.trim();            
            let email = document.getElementById('email').value.trim();            
            let address = document.getElementById('address').value.trim();            
            let thana = document.getElementById('thana').value.trim();            
            let district = document.getElementById('district').value.trim();
            


            
            if(phone.length === 0){
                toastr.error("Phone field is required!");
            }else{
                let formData = new FormData();
                formData.append('name', name);
                formData.append('phone', phone);
                formData.append('email', email);
                formData.append('address', address);
                formData.append('thana', thana);
                formData.append('district', district);
                try {
                    let response = await axios.post('/customers/create', formData, {});
                    console.log(response);
                    // localStorage.setItem('user', JSON.stringify(response.data.data));
                    if(response.status === 201 && response.data.status === true){
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/customers';
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


