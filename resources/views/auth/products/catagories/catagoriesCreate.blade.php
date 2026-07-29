@extends('layouts.app')
@section('title', 'Catagory Create')
@section('PageHeader', 'Catagory Create')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
     <div class="row g-3">
                <!-- নাম -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold" for="name">Name *</label>
            <input type="text" id="name" class="form-control bg-white border-secondary rounded-3 py-2" placeholder="John Doe">
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        
        <!-- Catagory Image ছবি -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold" for="image">Image. <span class="opacity-25">File type: jpg, jpeg, png</span></label>
            <input type="file" id="image" class="form-control bg-white border-secondary rounded-3 py-2">
            <div id="error-avatar" class="invalid-feedback"></div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold" for="description">Descripton</label>
            <textarea type="text" id="description" rows="4" class="form-control bg-white border-secondary rounded-3 py-2" placeholder="Dhaka, Bangladesh"></textarea>
            <div id="error-name" class="invalid-feedback"></div>
        </div>

        <!-- Catagory Banner ছবি -->
        <div class="col-12 col-md-6">
            <label class="form-label text-dark-50 small fw-bold">Banner. <span class="opacity-25">File type: jpg, jpeg, png</span></label>
            <input type="file" id="banner" class="form-control bg-white border-secondary rounded-3 py-2">
            <div id="error-avatar" class="invalid-feedback"></div>
        </div>

        <!-- Catagory Banner ছবি -->
        <div class="col-12 col-md-6">
            <div class="form-check">
                <input class="form-check-input border-black" type="checkbox" value="1" id="is_popular">
                <label class="form-check-label" for="is_popular">Popular Catagory</label>
            </div>
            <div id="is_popular" class="invalid-feedback"></div>
        </div>

    </div>

    <!-- সাবমিট বোতাম (onClick ইভেন্ট চালিত) -->
    <div class="mt-4">
        <button type="button" onclick="handleCatagory()" class="btn btn-success rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm">
            Save Changes
        </button>
    </div>
    

    




@endpush

@push('script')
    <script>
        async function handleCatagory() {
            let name = document.getElementById('name').value.trim();
            let description = document.getElementById('description').value.trim();
            let image = document.getElementById('image').files[0];
            let banner = document.getElementById('banner').files[0];
            let is_popular = document.getElementById('is_popular').checked;

            
            if(name.length == 0){
                toastr.error("Name field is required!");
            }else{
                let formData = new FormData();
                formData.append('name', name);
                formData.append('description', description);

                if(image) {
                    formData.append('image', image);
                }
                if(banner) {
                    formData.append('banner', banner);
                }
                if(is_popular) {
                    formData.append('is_popular', is_popular);
                }
                try {
                    let response = await axios.post('/backend/catagories', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(response);
                    if(response.status === 200 && response.data.status === true){
                        // localStorage.setItem('user', JSON.stringify(response.data.data));
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/catagories';
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


