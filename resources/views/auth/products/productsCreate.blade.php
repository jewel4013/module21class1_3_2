@extends('layouts.app')
@section('title', 'Product Create')
@section('PageHeader', 'Product Create')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-dark mt-4">
        {{-- <h4 class="fw-bold text-dark mb-4">➕ Add New Product</h4> --}}
        
        <!-- 🚀 মূল গ্রিড কন্টেইনার (কোনো HTML <form> ট্যাগ ব্যবহার করা হয়নি) -->
        <div class="row g-3" style="font-size: 13px;">
            
            <!-- ১. Product Name -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary" for="name">Product Name *</label>
                <input type="text" id="name" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter product name">
                <div id="error-name" class="invalid-feedback"></div>
            </div>

            <!-- ২. Product Code (With Refresh/Generate Button) -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Product Code</label>                 
                <div class="input-group input-group-sm">
                    <!-- 🚀 readonly এবং placeholder ট্রিকস: এটি ইউজারকে একটি স্পষ্ট ও প্রিমিয়াম POS ফিল দেবে -->
                    <input type="text" class="form-control bg-light text-muted border-light-subtle rounded-2 fw-bold" 
                        placeholder="SW-XXXXXX (Auto Generated)" 
                        title="System will auto generate a unique sequential code upon submission."                        
                        readonly>
                </div>
                
            </div>

            <!-- ৩. Brand Dropdown -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Brand :-</label> 
                <a href="/brands">Add Brand</a>
                <select id="brand_id" class="form-select form-select-sm border-light-subtle rounded-2 text-muted">
                    <option value="" selected disabled>Select Brand...</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>                        
                    @endforeach
                    <!-- ডাইনামিক ব্র্যান্ড লুপ এখানে আসবে -->
                </select>
            </div>

            <!-- ৪. Category Dropdown -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Category *</label> <a href="/catagories">Add Category</a>
                <select id="category_id" class="form-select form-select-sm border-light-subtle rounded-2 text-muted">
                    <option value="" selected disabled>Select Category... OR add category from above link</option>
                    <!-- ক্যাটাগরি ডাটা লুপ এখানে আসবে -->
                    @foreach($catagories as $catagory)
                        <option value="{{ $catagory->id }}">{{ $catagory->name }}</option>
                    @endforeach
                </select>
                <div id="error-category_id" class="invalid-feedback"></div>
            </div>

            <!-- ৫. Priority -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Priority</label>
                <input type="number" id="priority" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="e.g. 1, 2, 3">
                <div id="error-priority class="invalid-feedback"></div>
            </div>

            <!-- ৬. Main Product Image -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Main Product Image *</label>
                <input type="file" id="image" class="form-control form-control-sm border-light-subtle rounded-2">
                <div id="error-image" class="invalid-feedback"></div>
            </div>

            <!-- ৭. Product Cost -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Product Cost *</label>
                <input type="number" id="product_cost" class="form-control form-control-sm border-light-subtle rounded-2" value="0">
                <div id="error-product_cost" class="invalid-feedback"></div>
            </div>

            <!-- ৮. Product Price -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Product Price *</label>
                <input type="number" id="product_price" class="form-control form-control-sm border-light-subtle rounded-2" placeholder="Enter selling price">
                <div id="error-product_price" class="invalid-feedback"></div>
            </div>

            <!-- ৯. Main Product Multiple Image -->
            <div class="col-12 col-md-4">
                <label class="form-label fw-semibold text-secondary">Main Product Multiple Image</label>
                <input type="file" id="multiple_images" class="form-control form-control-sm border-light-subtle rounded-2" multiple>
                <div id="error-multiple_images" class="invalid-feedback"></div>
            </div>
                    <!-- ১০. Product Details (Rich Text Editor Zone) -->
            <div class="col-12 mt-3">
                <label class="form-label fw-semibold text-secondary">Product Details</label>
                <!-- 🎯 এডিটরের জন্য ক্লাসিক টেক্সট-এরিয়া, আইডি ধরে আমরা জাভাস্ক্রিপ্ট দিয়ে রিড করব -->
                <textarea id="description" class="form-control border-light-subtle rounded-2" rows="6" placeholder="Enter product descriptions..."></textarea>
                <div id="error-description" class="invalid-feedback"></div>
            </div>

            <!-- ১১. ৩টি নিচের কন্ডিশনাল চেকবক্স প্যানেল -->
            <div class="d-flex row mt-2 align-items-center justify-content-between">
                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-between">                
                    <!-- চেকবক্স ১: Variant -->
                    <div class="form-check">
                        <input class="form-check-input border-secondary-subtle" type="checkbox" id="is_popular">
                        <label class="form-check-label" for="is_popular">
                            Is popular
                        </label>
                    </div>

                    <!-- চেকবক্স ২: Promotional Price -->
                    <div class="form-check">
                        <input class="form-check-input border-secondary-subtle" type="checkbox" id="show_home">
                        <label class="form-check-label" for="show_home">
                            Show Home
                        </label>
                    </div>

                    <!-- চেকবক্স ৩: SEO Option -->
                    <div class="form-check">
                        <input class="form-check-input border-secondary-subtle" type="checkbox" id="show_menu">
                        <label class="form-check-label" for="show_menu">
                            Show Menu
                        </label>
                    </div>                
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <label class="form-label fw-semibold text-secondary" for="stock_quantity">Stock Quantity</label>
                    <input type="number" id="stock_quantity" class="form-control form-control-sm border-light-subtle rounded-2" required placeholder="Enter stock quantity">
                </div>
            </div>

            <!-- ১২. সাবমিট বোতাম প্যানেল -->
            <div class="col-12 mt-4">
                <!-- 🚀 ওনক্লিক মেথড অ্যাসাইন করা হলো, যা আপনার প্রজেক্টের এক্সিওস ফ্লো হ্যান্ডেল করবে -->
                <button class="btn text-white px-4 fw-semibold rounded-2 shadow-sm" 
                        style="background-color: #6f42c1; font-size: 14px;" 
                        onclick="handleProductCreate()">
                    Submit
                </button>
            </div>

        </div>
    </div>

    

    




@endpush

@push('script')
    <script>
        async function handleProductCreate() {
            let name = document.getElementById('name').value.trim();            
            let brand_id = document.getElementById('brand_id').value;
            let category_id = document.getElementById('category_id').value;
            let priority = document.getElementById('priority').value;
            let image = document.getElementById('image').files[0];
            let product_cost = document.getElementById('product_cost').value;
            let product_price = document.getElementById('product_price').value;
            let multiple_images = document.getElementById('multiple_images').files;
            let description = document.getElementById('description').value;
            let is_popular = document.getElementById('is_popular').checked ? 1 : 0;
            let show_home = document.getElementById('show_home').checked ? 1 : 0;
            let show_menu = document.getElementById('show_menu').checked ? 1 : 0;
            let stock_quantity = document.getElementById('stock_quantity').value;
            if(name.length === 0){
                toastr.error("Name field is required!");
            }else if(category_id.length === 0){
                toastr.error("Category field is required!");
            }else if(product_price.length === 0){
                toastr.error("Product Price field is required!");
            }else if(stock_quantity.length === 0){
                toastr.error("Stock Quantity field is required!");  
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
                formData.append('stock_quantity', stock_quantity);
                if(image) {
                    formData.append('image', image);
                }
                if (multiple_images.length > 0) {
                    for (let i = 0; i < multiple_images.length; i++) {
                        formData.append('multiple_images[]', multiple_images[i]);
                    }
                }
                try {
                    let response = await axios.post('/products/store', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(response);
                    // localStorage.setItem('user', JSON.stringify(response.data.data));
                    if(response.status === 201 && response.data.status === true){
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/products';
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


