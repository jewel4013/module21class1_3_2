@extends('layouts.app')
@section('title', 'Product Modify')
@section('PageHeader', 'Product Modify')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
    <div class="">
        <a href="{{route('productShow', $product->slug)}}" class="btn btn-outline-secondary btn-sm px-3 rounded-2 fw-semibold">
            ← Back to Product
        </a>
    </div>
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-dark mt-4">
        <h4 class="fw-bold text-dark mb-4">✏️ Edit Product: {{ $product->name }}</h4>
        
        <div class="row g-3" style="font-size: 13px;">
            
            <!-- ১. Product Name (value তে লারাভেলের ডাটা বসবে) -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Product Name *</label>
                <input type="text" id="name" class="form-control form-control-sm" value="{{ $product->name }}">
            </div>

            <!-- ২. Category Dropdown (ডাইনামিকালি কারেন্ট ক্যাটাগরি সিলেক্টেড থাকবে) -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Category *</label>
                <select id="category_id" class="form-select form-select-sm">
                    @foreach($catagories as $catagory)
                        <!-- 🎯 ট্রিকস: প্রোডাক্টের category_id এর সাথে লুপের আইডি মিললে সেটি selected হয়ে থাকবে -->
                        <option value="{{ $catagory->id }}" {{ $product->category_id == $catagory->id ? 'selected' : '' }}>
                            {{ $catagory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- ৩. Brand Dropdown (ডাইনামিকালি কারেন্ট ক্যাটাগরি সিলেক্টেড থাকবে) -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Brands *</label>
                <select id="brand_id" class="form-select form-select-sm">
                    @foreach($brands as $brand)
                        <!-- 🎯 ট্রিকস: প্রোডাক্টের brand_id এর সাথে লুপের আইডি মিললে সেটি selected হয়ে থাকবে -->
                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

             <!-- ৪. Product Cost -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Product Cost *</label>
                <input type="number" id="product_cost" class="form-control form-control-sm" value="{{ $product->product_cost }}">
            </div>
            <!-- ৫. Product Price -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Product Price *</label>
                <input type="number" id="product_price" class="form-control form-control-sm" value="{{ $product->product_price }}">
            </div>

            <!-- ৭. Priority -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Priority</label>
                <input type="number" id="priority" class="form-control form-control-sm" value="{{ $product->priority }}">
            </div>
            
            <!-- 📝 ৬. ডিফল্ট নাল যাবে প্রোডাক্ট ডিটেইলস / ডেসক্রিপশন এরিয়া --> 
            <div class="col-12 col-md-12">
                <label class="form-label fw-semibold text-secondary">Product Details</label>
                <!-- 🎯 এডিটরের জন্য ক্লাসিক টেক্সট-এরিয়া, আইডি ধরে আমরা জাভাস্ক্রিপ্ট দিয়ে রিড করব -->
                <textarea id="description" class="form-control border-light-subtle rounded-2" rows="6" placeholder="Enter product descriptions..." value="">{{ $product->description }}</textarea>
                <div id="error-description" class="invalid-feedback"></div>
            </div>

            <!-- ৮. Main Single Image (পাশে ছোট করে বর্তমানে আপলোড থাকা ইমেজটির প্রিভিউ দেখানো) -->
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-secondary">Update Product Image</label>
                <input type="file" id="image" class="form-control form-control-sm mb-2">
                
                <!-- 🎯 উইন্ডোজ ব্যাকস্ল্যাশ বাগ ক্লিন করে ছবি প্রদর্শন -->
                {{-- @php $clean_main = str_replace('\\', '/', $product->image); @endphp --}}
                <div class="small text-muted mb-1">Current Image:</div>
                <img src="{{ asset($product->imageUrl) }}" class="rounded border p-1 bg-light" style="width: 100px; height: 100px; object-fit: cover;" alt="img">
            </div>

            <!-- ৯. Multiple Images Preview Zone (জেসন থেকে পুরানো ছবিগুলো লুপে দেখানো) -->
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-secondary">Update Gallery Images</label>
                <input type="file" id="multiple_images" class="form-control form-control-sm mb-2" multiple>
                
                <div class="small text-muted mb-1">Current Gallery:</div>
                <div class="d-flex align-items-center gap-2 overflow-x-auto pb-1">
                    @if($product->multiple_images && is_array($product->multiple_images))
                        @foreach($product->multiple_images as $gallery_img)
                            @php $clean_gallery = str_replace('\\', '/', $gallery_img); @endphp
                            <img src="{{ asset('storage/' . $clean_gallery) }}" class="rounded border p-1" style="width: 85px; height: 85px; object-fit: cover;">
                        @endforeach
                    @else
                        <span class="text-muted extra-small">No gallery uploaded</span>
                    @endif
                </div>
            </div>

            <!-- ⚙️ ১০. জাভাস্ক্রিপ্ট ফ্রেন্ডলি ৩টি চেকবক্স (লারাভেলের কন্ডিশনে টিক মার্ক বসবে) -->
            <div class="col-12 mt-4 d-flex justify-content-start gap-2 fw-semibold text-dark">
                
                <!-- চেকবক্স ১: is_popular -->
                <div class="form-check">
                    <!-- 🎯 ট্রিকস: ডাটাবেজে ১ থাকলে ব্লেড থেকে অটোমেটিক 'checked' হয়ে যাবে -->
                    <input class="form-check-input" type="checkbox" id="is_popular" {{ $product->is_popular == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_popular">Popular Category</label>
                </div>

                <!-- চেকবক্স ২: show_home -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="show_home" {{ $product->show_home == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_home">Show Home</label>
                </div>

                <!-- চেকবক্স ৩: show_menu -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="show_menu" {{ $product->show_menu == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_menu">Show Menu</label>
                </div>
            </div>

            <!-- ১১. আপডেট বাটন (আপনার স্যারের ফর্ম-লেস ওনক্লিক মেথড) -->
            <div class="col-12 mt-4">
                <!-- 🚀 এখানে আমরা কারেন্ট প্রোডাক্টের আইডি বা স্লাগ প্যারামিটার হিসেবে পাস করে দেব -->
                <button class="btn text-white px-4 fw-semibold rounded-2 shadow-sm" 
                        style="background-color: #6f42c1;" 
                        onclick="handleProductUpdate('{{ $product->slug }}')">
                    Update Product
                </button>
            </div>

        </div>
    </div>


    

    




@endpush

@push('script')
    <script>
        async function handleProductUpdate(slug) {
            let name = document.getElementById('name').value.trim();            
            let brand_id = document.getElementById('brand_id').value;
            let category_id = document.getElementById('category_id').value;
            let priority = document.getElementById('priority').value;
            let product_cost = document.getElementById('product_cost').value;
            let product_price = document.getElementById('product_price').value;
            let description = document.getElementById('description').value;

            let image = document.getElementById('image').files[0];
            let multiple_images = document.getElementById('multiple_images').files;
            let is_popular = document.getElementById('is_popular').checked ? 1 : 0;
            let show_home = document.getElementById('show_home').checked ? 1 : 0;
            let show_menu = document.getElementById('show_menu').checked ? 1 : 0;


            
            if(name.length === 0){
                toastr.error("Name field is required!");
            }else if(category_id.length === 0){
                toastr.error("Category field is required!");
            }else if(product_price.length === 0){
                toastr.error("Product Price field is required!");
            } 
            else{
                let formData = new FormData();
                formData.append('name', name);
                formData.append('brand_id', brand_id);
                formData.append('category_id', category_id);
                formData.append('priority', priority);
                formData.append('product_cost', product_cost);
                formData.append('product_price', product_price);
                formData.append('description', description);
                formData.append('is_popular', is_popular);
                formData.append('show_home', show_home);
                formData.append('show_menu', show_menu);

                if(image) {
                    formData.append('image', image);
                }
                if (multiple_images.length > 0) {
                    for (let i = 0; i < multiple_images.length; i++) {
                        formData.append('multiple_images[]', multiple_images[i]);
                    }
                }
                try {
                    let response = await axios.post('/products/'+slug+'/update', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(response);
                    // localStorage.setItem('user', JSON.stringify(response.data.data));
                    if(response.status === 201 && response.data.status === true){
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/products/' + response.data.slug;
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


