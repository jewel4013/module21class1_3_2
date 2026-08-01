@extends('layouts.app')
@section('title', 'Products View')
@section('PageHeader')
    Product Details
@endsection

@push('style')
    <!-- 🎨 কাস্টম কার্সার এবং স্টাইল সাপোর্ট -->
<style>
    .cursor-pointer { cursor: pointer; }
    .bg-purple { background-color: #6f42c1; }
    .thumbnail-box { transition: all 0.2s ease-in-out; }
    .thumbnail-box:hover { transform: scale(1.05); border-color: #198754 !important; }
</style>
@endpush

@push('mainSection')
    <div class="">
        <a href="/products" class="btn btn-outline-secondary btn-sm px-3 rounded-2 fw-semibold">
            ← Back to List
        </a>
    </div>
    <div class="container-fluid pt-4 bg-light h-auto">
        
        <div class="row g-4">

            <!-- 🖼️ বাম পাশের প্যানেল: ইমেজ গ্যালারি আর্কিটেকচার (ইমেজ সোয়াপার ম্যাজিক) -->
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">                    
                    <!-- ১. মূল বড় ইমেজের স্থান (Main Display) -->
                    <div class="text-center rounded-3 overflow-hidden bg-light border p-2 mb-3" style="height: 380px;">
                        <img id="mainProductImage" src="{{ asset($product->imageUrl) }}" 
                            class="w-100 h-100" 
                            style="object-fit: contain; transition: all 0.3s ease;" 
                            alt="{{ $product->name }}">
                    </div>

                    <!-- ২. নিচের ছোট ছোট থাম্বনেইল গ্যালারি ইমেজসমূহ (Carousel / Thumbnails) -->
                    <div class="d-flex align-items-center gap-2 overflow-x-auto pb-2" style="scrollbar-width: thin;">
                        
                        <!-- প্রথম থাম্বনেইল হিসেবে মেইন ইমেজটি নিজে থাকবে (একটিভ বর্ডারসহ) -->
                        <div class="thumbnail-box border border-2 border-success rounded-2 p-1 bg-white cursor-pointer" 
                            style="width: 70px; height: 70px; flex-shrink: 0;"
                            onclick="changePreviewImage('{{ asset($product->imageUrl) }}', this)">
                            <img src="{{ asset($product->imageUrl) }}" class="w-100 h-100 rounded" style="object-fit: cover;">
                        </div>

                        <!-- 🚀 লারাভেল জাদুকরী লুপ: যদি ডাটাবেজের JSON কলামে মাল্টিপল ইমেজ থাকে, তা এখানে এক সিরিয়ালে চলে আসবে -->
                        @if($product->multiple_images && is_array($product->multiple_images))
                            @foreach($product->multiple_images as $gallery_img)
                                <div class="thumbnail-box border border-light-subtle rounded-2 p-1 bg-white cursor-pointer" 
                                    style="width: 70px; height: 70px; flex-shrink: 0;"
                                    onclick="changePreviewImage('{{ asset('storage/'. $gallery_img) }}', this)">
                                    <img src="{{ asset('storage/'. $gallery_img) }}" class="w-100 h-100 rounded" style="object-fit: cover;">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <!-- 📄 ডান পাশের প্যানেল: প্রোডাক্টের সুন্দর ইনফরমেশন গ্রিড (POS ভিউ) -->
            <div class="col-12 col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    
                    <!-- প্রোডাক্টের ক্যাটাগরি ব্যাজ ও নাম -->
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1 fw-bold" style="font-size: 12px;">
                            📂 {{ $product->catagory?->name ?? 'General' }}
                        </span>
                        <span class="text-muted small fw-semibold">📅 Added: {{ $product->created_at?->format('d M, Y') }}</span>
                    </div>
                    <h2 class="fw-bold text-dark mb-1">{{ $product->name }}</h2>
                    <p class="text-secondary small mb-3">Brand: <span class="fw-bold text-dark">{{ $product->brand?->name ?? 'No Brand' }}</span></p>

                    <hr class="text-muted my-3">

                    <!-- 💰 প্রাইজ এবং কস্ট প্যানেল (ইনভেন্টরি স্ট্যান্ডার্ড কার্ড) -->
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3 border-start border-3 border-primary">
                                <span class="text-muted d-block small fw-medium">Selling Price</span>
                                <span class="fs-4 fw-bold text-primary">৳{{ number_format($product->product_price, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3 border-start border-3 border-secondary">
                                <span class="text-muted d-block small fw-medium">Purchase Stocks</span>
                                <span class="fs-4 fw-bold text-secondary">000</span>
                            </div>
                        </div>
                    </div>

                    <!-- ⚙️ প্রোডাক্ট টেকনিক্যাল মেটা ডাটা গ্রিড -->
                    <div class="row g-3 style-info mb-4" style="font-size: 13px;">
                        <div class="col-6">
                            <span class="text-muted d-block">Product Code:</span>
                            <span class="fw-bold text-dark fs-6">{{ $product->product_code }}</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block">Priority Rank:</span>
                            <span class="fw-bold text-dark fs-6">#{{ $product->priority ?? 0 }}</span>
                        </div>
                        
                        <!-- ৩টি কন্ডিশনাল চেকবক্সের লাইভ স্ট্যাটাস ব্যাজ -->
                        <div class="col-12 mt-3 d-flex flex-wrap gap-2">
                            <span class="badge {{ $product->has_variant ? 'bg-purple text-white' : 'bg-light text-muted border' }} rounded-2 px-2 py-1">
                                {{ $product->has_variant ? '✓ Has Variant' : '✕ No Variant' }}
                            </span>
                            <span class="badge {{ $product->add_promo_price ? 'bg-warning text-dark' : 'bg-light text-muted border' }} rounded-2 px-2 py-1">
                                {{ $product->add_promo_price ? '✓ Promo Active' : '✕ No Promo' }}
                            </span>
                            <span class="badge {{ $product->for_seo ? 'bg-info text-white' : 'bg-light text-muted border' }} rounded-2 px-2 py-1">
                                {{ $product->for_seo ? '✓ SEO Configured' : '✕ No SEO' }}
                            </span>
                        </div>
                    </div>

                    <!-- 📝 প্রোডাক্ট ডিটেইলস / ডেসক্রিপশন এরিয়া -->
                    <div class="mt-2">
                        <h6 class="fw-bold text-dark mb-2">📜 Product Details</h6>
                        <div class="p-3 bg-light rounded-3 text-secondary" style="font-size: 13px; line-height: 1.6; max-height: 200px; overflow-y: auto;">
                            {!! $product->description ? nl2br(e($product->description)) : '<em>No description available for this product.</em>' !!}
                        </div>
                    </div>

                    <!-- ব্যাক বাটন -->
                    <div class="mt-auto pt-4">
                        <a href="/products/{{ $product->slug }}/edit" class="btn btn-outline-secondary btn-sm px-3 rounded-2 fw-semibold">
                           ✏️ Edit Product
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

 
    
@endpush

@push('script')
   <script>
    function changePreviewImage(imageUrl, element) {
        // ১. মূল বড় ইমেজটির src পরিবর্তন করা হলো
        const mainImg = document.getElementById('mainProductImage');
        mainImg.style.opacity = '0.3'; // সুন্দর অ্যানিমেশন ইফেক্ট
        
        setTimeout(() => {
            mainImg.src = imageUrl;
            mainImg.style.opacity = '1';
        }, 150);

        // ২. সমস্ত থাম্বনেইল বক্সের চারপাশের সবুজ একটিভ বর্ডার রিমুভ করা
        document.querySelectorAll('.thumbnail-box').forEach(box => {
            box.classList.remove('border-success', 'border-2');
            box.classList.add('border-light-subtle');
        });

        // ৩. বর্তমানে যে ছোট ইমেজে ক্লিক করা হয়েছে, তার চারপাশে সবুজ কাস্টম বর্ডার লক করা
        element.classList.remove('border-light-subtle');
        element.classList.add('border-success', 'border-2');
    }
</script>
@endpush