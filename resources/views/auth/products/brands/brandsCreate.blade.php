@extends('layouts.app')
@section('title', 'Brand Create')
@section('PageHeader', 'Brand Create')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
     <div class="row g-3">
                <!-- নাম -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold" for="name">Name *</label>
            <input type="text" id="name" class="form-control bg-white border-secondary rounded-3 py-2" placeholder="">
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        
        <!-- Catagory Image ছবি -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold" for="image">Image. <span class="opacity-25">File type: jpg, jpeg, png</span></label>
            <input type="file" id="image" class="form-control bg-white border-secondary rounded-3 py-2">
            <div id="error-image" class="invalid-feedback"></div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold" for="description">Descripton</label>
            <textarea type="text" id="description" rows="3" class="form-control bg-white border-secondary rounded-3 py-2" placeholder=""></textarea>
            <div id="error-description" class="invalid-feedback"></div>
        </div>

        <!-- Catagory Banner ছবি -->
        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-between flex-wrap gap-4 mt-3 p-2 ">
                <div class="form-check">
                    <input class="form-check-input border-secondary" type="checkbox" id="is_popular">
                    <label class="form-check-label" for="is_popular">Popular Catagory</label>
                </div>
                <div id="error-is_popular" class="invalid-feedback"></div>


                <div class="form-check">
                    <input class="form-check-input border-secondary" type="checkbox" id="show_home">
                    <label class="form-check-label" for="show_home">Show Home</label>
                </div>
                <div id="error-show_home" class="invalid-feedback"></div>


                <div class="form-check">
                    <input class="form-check-input border-secondary" type="checkbox" id="show_menu">
                    <label class="form-check-label" for="show_menu">Show Menu</label>
                </div>
                <div id="error-show_menu" class="invalid-feedback"></div>


            </div>
        </div>       
    </div>

    <!-- সাবমিট বোতাম (onClick ইভেন্ট চালিত) -->
    <div class="mt-4">
        <button type="button" onclick="handleBrand()" class="btn btn-success rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm">
            Creat Brand
        </button>
    </div>
    

    




@endpush

@push('script')
    <script>
        async function handleBrand() {
            let name = document.getElementById('name').value.trim();
            let description = document.getElementById('description').value.trim();
            let image = document.getElementById('image').files[0];
            let is_popular = document.getElementById('is_popular').checked ? 1 : 0;
            let show_home = document.getElementById('show_home').checked ? 1 : 0;
            let show_menu = document.getElementById('show_menu').checked ? 1 : 0;

            
            if(name.length === 0){
                toastr.error("Name field is required!");
            }else{
                let formData = new FormData();
                formData.append('name', name);
                if(image) {
                    formData.append('image', image);
                }
                formData.append('description', description);
                formData.append('is_popular', is_popular);
                formData.append('show_home', show_home);
                formData.append('show_menu', show_menu);
                try {
                    let response = await axios.post('/backend/brands/create', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(response);
                    // localStorage.setItem('user', JSON.stringify(response.data.data));
                    if(response.status === 201 && response.data.status === true){
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/brands';
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


