@extends('layouts.app')
@section('title', 'Sales Board')
@section('PageHeader')
    🛒 POS Sales Register
@endsection
@section('HeaderDown')
    📅 Today: <span class="text-dark">'d M, Y'</span>
@endsection

@push('style')
    

@endpush

@push('mainSection')

    <div class="container-fluid py-4 bg-light min-vh-100 text-dark" style="font-size: 13px;">
        
        {{-- <!-- 🏢 পিওএস হেডার প্যানেল -->
        <div class="d-flex align-items-center justify-content-between mb-4 bg-white p-3 rounded-4 shadow-sm">
            <h4 class="fw-bold text-dark m-0">🛒 POS Sales Register</h4>
            <div class="text-secondary fw-semibold">
                📅 Date: <span class="text-dark">'d M, Y'</span>
            </div>
        </div> --}}

        <div class="row g-4">
            
            <!-- 📂 বাম পাশের প্যানেল: কাস্টমার এবং প্রোডাক্ট সিলেকশন এরিয়া -->
            <div class="col-12 col-lg-7">
                
                <!-- ১. কাস্টমার সিলেকশন কার্ড -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="form-label fw-bold text-secondary m-0">👥 Select Customer *</label>
                        <a href="/customers/create" class="text-decoration-none small fw-bold text-purple">+ Add New</a>
                    </div>
                    <!-- কাস্টমার ড্রপডাউন (সার্চেবল POS কনভেনশন) -->
                    <select id="customer_id" class="form-select border-light-subtle rounded-3 text-muted">
                        <option value="" selected disabled>Search or Select Customer...</option>
                        <option value="walk-in">🚶 Walk-in Customer (General)</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} (📱 {{ $customer->phone }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- ২. প্রোডাক্ট সার্চ এবং বারকোড স্ক্যান এরিয়া -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <label class="form-label fw-bold text-secondary mb-3">🛍️ Search Products or Scan Barcode</label>
                    <div class="input-group mb-4 shadow-sm rounded-3 overflow-hidden">
                        <span class="input-group-text bg-light border-light-subtle text-muted">🔍</span>
                        <input type="text" id="product_search" class="form-control border-light-subtle" 
                            placeholder="Type product name or code / Scan Barcode here..." autocomplete="off">
                    </div>
                    <!-- 📋 কার্ট আইটেম গ্রিড টেবিল (লাইভ জাভাস্ক্রিপ্ট অ্যাপেন্ড জোন) -->
                    <h6 class="fw-bold text-dark mb-3">📦 Cart Items</h6>
                    <div class="table-responsive border rounded-3 bg-light" style="max-height: 280px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small fw-bold border-bottom">
                                <tr>
                                    <th class="ps-3 py-3">Product Info</th>
                                    <th class="py-3" style="width: 120px;">Qty</th>
                                    <th class="py-3">Price</th>
                                    <th class="py-3">Total</th>
                                    <th class="py-3 text-end pe-3">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableBody" class="border-0">
                                <!-- 💡 ডেমো কন্টেন্ট (জাভাস্ক্রিপ্ট দিয়ে কার্টে আইটেম যোগ করলে এখানে ইনসার্ট হবে) -->
                                {{-- <tr>
                                    <td class="ps-3">
                                        <span class="d-block fw-bold text-dark">Samsung Galaxy S26 Ultra</span>
                                        <small class="text-muted">Code: SW-000105</small>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm border rounded-2 bg-white" style="max-width: 100px;">
                                            <button class="btn btn-light border-0 px-2 py-0 fw-bold" type="button">−</button>
                                            <input type="text" class="form-control border-0 text-center fw-bold p-0" value="1" readonly>
                                            <button class="btn btn-light border-0 px-2 py-0 fw-bold" type="button">+</button>
                                        </div>
                                    </td>
                                    <td class="text-secondary fw-semibold">৳১,৫০,০০০.০০</td>
                                    <td class="fw-bold text-dark">৳১,৫০,০০০.০০</td>
                                    <td class="text-end pe-3">
                                        <button class="btn btn-link text-danger p-0 text-decoration-none" title="Remove">🗑️</button>
                                    </td>
                                </tr> --}}
                                
                                <!-- যদি কার্ট খালি থাকে তাহলে নিচের অংশটি দেখাবে -->
                                {{-- <tr id="emptyCartRow">
                                    <td colspan="5" class="text-center py-5 text-secondary">
                                        <span class="fs-2 d-block mb-1">🛒</span>
                                        Cart is empty. Search products to add.
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- 💰 ডান পাশের প্যানেল: পেমেন্ট এবং অর্ডার সামারি এরিয়া -->
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100 d-flex flex-column">
                    <h5 class="fw-bold text-dark mb-4 border-bottom pb-2">💳 Payment & Summary</h5>
                    
                    <!-- বিলিং ক্যালকুলেশন মেট তথ্য -->
                    <div class="d-flex flex-column gap-3 mb-4 bg-light p-3 rounded-4 border">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-secondary fw-medium">Sub Total</span>
                            <span id="summary_sub_total" class="fw-bold text-dark">৳১,৫০,০০০.০০</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-secondary fw-medium">Discount (৳)</span>
                            <input type="number" id="discount_input" class="form-control form-control-sm text-end border-light-subtle rounded-2 fw-bold text-danger" 
                                value="0" style="max-width: 120px;">
                        </div>
                        <hr class="text-muted my-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-dark fw-bold fs-6">Grand Total</span>
                            <span id="summary_grand_total" class="fw-bold text-purple fs-5">৳১,৫০,০০০.০০</span>
                        </div>
                    </div>

                    <!-- পেমেন্ট ইনপুট এবং মেথড জোন -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary">Paid Amount (৳) *</label>
                            <input type="number" id="paid_amount" class="form-control form-control-lg bg-light-subtle border-light-subtle rounded-3 fw-bold text-success fs-4 text-end" 
                                placeholder="0.00">
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-3 fw-bold text-center d-none" id="due_alert_box">
                                ⚠️ Due Amount: <span id="summary_due_amount">৳0.00</span>
                            </div>
                        </div>
                        
                        <!-- পেমেন্ট মেথড টাইপ ড্রপডাউন -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary">Payment Method</label>
                            <select id="payment_type" class="form-select border-light-subtle rounded-3 fw-semibold text-dark">
                                <option value="Cash" selected>💵 Cash</option>
                                <option value="bKash">📱 bKash</option>
                                <option value="Nagad">📱 Nagad</option>
                                <option value="Card">💳 Card Payment</option>
                            </select>
                        </div>
                    </div>

                    <!-- 🚀 স্যারের ফর্ম-লেস আর্কিটেকচার অনুযায়ী কাস্টম কমপ্লিট সেল বাটন -->
                    <div class="mt-auto pt-4 border-top">
                        <button class="btn btn-purple btn-lg w-100 py-3 fw-bold text-white rounded-3 shadow" 
                                onclick="handleCompleteSale()">
                            ⚡ Complete Sale & Print Invoice
                        </button>
                        <a href="/sales" class="btn btn-outline-secondary btn-sm w-100 mt-2 border-0 rounded-2 fw-medium">
                            ← Cancel and Back to List
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
{{-- ===================================================================================================================================================== --> --}}
    <!-- 🎨 কাস্টম বেগুনি কালার স্কিম এবং কন্টট্রোল সিএসএস -->
    <style>
        .text-purple { color: #6f42c1 !important; }
        .btn-purple { background-color: #6f42c1 !important; border-color: #6f42c1 !important; transition: 0.2s; }
        .btn-purple:hover { background-color: #59339e !important; }
        .bg-light-subtle { background-color: #fcfbfe; }
        .cursor-pointer { cursor: pointer; }
        #live-search-results .list-group-item:hover { background-color: #f8f5fe !important; border-left: 3px solid #6f42c1; }

        /* কাস্টম স্ক্রোলবার ফিক্স */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
@endpush

@push('script')
    <script>
        window.laravelAssetUrl = "{{ asset('storage/') }}/";
        document.getElementById('product_search').addEventListener('input', async function(event) {
            let query = event.target.value.trim();

             // পুরানো সাজেশন লিস্ট স্ক্রিন থেকে মুছে ফেলা (Reset)
            removeSearchDropdown();
            if (query.length < 2) return; // কমপক্ষে ২টি অক্ষর টাইপ করলে তবেই সার্চ শুরু হবে
            try {
                // 🚀 এক্সিওস লাইভ গেট রিকোয়েস্ট
                let response = await axios.get('/productssearching', {
                    params: { query: query }
                });

                if (response.status === 200 && response.data.status === true) {   
                    console.log("Live search response:");                 
                    let products = response.data.data;
                    if (products.length > 0) {
                        renderSearchDropdown(products);
                    }
                }
            } catch (err) {
                console.error("Live search failed:", err);
            }

            function renderSearchDropdown(products) {
                let searchInput = document.getElementById('product_search');
                let dropdown = document.createElement('ul');
                dropdown.id = "live-search-results";
                dropdown.className = "list-group position-relative w-100 shadow-lg rounded-3 mt-1";
                dropdown.style.zIndex = "1090";
                dropdown.style.maxHeight = "250px";
                dropdown.style.overflowY = "auto";

                products.forEach(product => {
                    let li = document.createElement('li');
                    li.className = "list-group-item list-group-item-action d-flex align-items-center justify-content-between cursor-pointer p-2";
                    li.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <img src="${window.laravelAssetUrl}${product.image}" class="rounded border" style="width: 32px; height: 32px; object-fit: cover;">
                       <div>
                            <strong class="text-dark d-block">${product.name}</strong>
                            <small class="text-muted">Code: ${product.product_code}</small>
                        </div>
                    </div>
                    <div class="align-items-center gap-2">
                        <span class="text-muted">${product.brand ? product.brand.name : 'No brand mensioned'}</span>
                        <span class="badge bg-purple text-dark fw-bold" style="font-size: 15px;">৳${parseFloat(product.product_price).toFixed(2)}</span>
                    </div>
                    `;
        
                    li.onclick = function() {
                        addToCart(product);
                        searchInput.value = '';
                        removeSearchDropdown();
                    };
                    dropdown.appendChild(li);
                });

                searchInput.parentNode.appendChild(dropdown);
            }
            
            // 🎯 ১. গ্লোবাল কার্ট মেমোরি অ্যারে (প্রতিবার আইটেম যোগ করলে এখানে ডাটা জমা হবে)
            let cart = [];
            function addToCart(product) {
                let price = parseFloat(product.product_price || 0);
                
                // কার্ট অ্যারের ভেতর অলরেডি এই প্রোডাক্ট আইডিটি যোগ করা আছে কিনা তা খোঁজা
                let existingItem = cart.find(item => item.id === product.id);

                if (existingItem) {
                    // শর্ত: প্রোডাক্ট অলরেডি কার্টে থাকলে শুধু কোয়ান্টিটি ১ পিস বাড়বে
                    existingItem.quantity += 1;
                } else {
                    // শর্ত: সম্পূর্ণ নতুন প্রোডাক্ট হলে কার্ট অ্যারেতে অবজেক্ট পুশ হবে
                    cart.push({
                        id: product.id,
                        name: product.name || product.product_name,
                        code: product.product_code,
                        price: price,
                        quantity: 1
                    });
                }

                // 🔄 কার্ট টেবিলের এইচটিএমএল ভিজ্যুয়াল এবং ডান পাশের হিসাব আপডেট করা
                updateCartDOM();
            }

            /**
             * 🖼️ ৩. কার্ট অ্যারের ওপর ভিত্তি করে ব্লেড টেবিল রো (DOM) তৈরি করার লাইভ মেথড
             */
            function updateCartDOM() {
                let tableBody = document.getElementById('cartTableBody');
                if (!tableBody) return;

                // টেবিল বডি সম্পূর্ণ খালি করে নতুন করে লুপ চালানো (ডুপ্লিকেশন এড়াতে)
                tableBody.innerHTML = '';

                if (cart.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center py-5 text-secondary">
                                <span class="fs-2 d-block mb-1">🛒</span>
                                Cart is empty. Search products to add.
                            </td>
                        </tr>`;
                    calculateBillingSummary();
                    return;
                }

                // কার্ট অ্যারের ওপর লুপ চালিয়ে প্রতিটা প্রোডাক্টের জন্য ডাইনামিক বুটস্ট্র্যাপ রো তৈরি
                cart.forEach((item, index) => {
                    let itemTotal = item.price * item.quantity;
                    let tr = document.createElement('tr');
                    tr.className = "border-bottom border-light-subtle";

                    tr.innerHTML = `
                        <td class="ps-3 py-3">
                            <span class="d-block fw-bold text-dark">${item.name}</span>
                            <small class="text-muted">Code: ${item.code}</small>
                        </td>
                        <td>
                            <!-- ⚡ প্লাস-মাইনাস কন্ট্রোল প্যানেল উইথ ইনডেক্স লক -->
                            <div class="input-group input-group-sm border rounded-2 bg-white" style="max-width: 100px;">
                                <button class="btn btn-light border-0 px-2 py-0 fw-bold" type="button" onclick="changeQty(${index}, -1)">−</button>
                                <input type="text" class="form-control border-0 text-center fw-bold p-0" value="${item.quantity}" readonly>
                                <button class="btn btn-light border-0 px-2 py-0 fw-bold" type="button" onclick="changeQty(${index}, 1)">+</button>
                            </div>
                        </td>
                        <td class="text-secondary fw-semibold">৳${item.price.toFixed(2)}</td>
                        <td class="fw-bold text-dark">৳${itemTotal.toFixed(2)}</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-link text-danger p-0 text-decoration-none fw-bold" onclick="removeItem(${index})" title="Remove">🗑️</button>
                        </td>
                    `;
                    tableBody.appendChild(tr);
                });

                // ডান পাশের বিলিং সামারি ক্যালকুলেট করা
                calculateBillingSummary();
            }

            /**
             * ➕ ➖ ৪. প্লাস-মাইনাস বাটনে ক্লিক করলে কোয়ান্টিটি পরিবর্তন করার মেথড
             */
            function changeQty(index, amount) {
                if (cart[index]) {
                    cart[index].quantity += amount;
                    
                    // সেফটি গার্ড: কোয়ান্টিটি ১ এর নিচে নামলে আইটেমটি কার্ট থেকে ডিলিট হয়ে যাবে
                    if (cart[index].quantity <= 0) {
                        cart.splice(index, 1);
                    }
                    
                    updateCartDOM();
                }
            }

            /**
             * 🗑️ ৫. ট্র্যাশ ক্যানে ক্লিক করলে সরাসরি কার্ট থেকে প্রোডাক্ট রিমুভ করার মেথড
             */
            function removeItem(index) {
                cart.splice(index, 1);
                toastr.warning("Item removed from cart");
                updateCartDOM();
            }

            /**
             * 💰 ৬. ডান পাশের পেমেন্ট ও ডিসকাউন্ট সামারি লাইভ রিল-টাইম হিসাবের কোর মেথড
             */
            function calculateBillingSummary() {
                let subTotal = 0;
                cart.forEach(item => {
                    subTotal += item.price * item.quantity;
                });

                // ডিসকাউন্ট ইনপুট রিড করা
                let discountInput = document.getElementById('discount_input');
                let discount = discountInput ? parseFloat(discountInput.value) || 0 : 0;

                let grandTotal = subTotal - discount;
                if (grandTotal < 0) grandTotal = 0;

                // ব্লেডের ডান পাশের স্প্যানগুলোতে মান পুশ করা
                document.getElementById('summary_sub_total').innerText = '৳' + subTotal.toFixed(2);
                document.getElementById('summary_grand_total').innerText = '৳' + grandTotal.toFixed(2);
                
                // অটোমেটিক পেইড অ্যামাউন্ট ফিল্ডে গ্র্যান্ড টোটালের মান অ্যাসাইন করা (POS স্পিড ইউএক্স ট্রিকস)
                let paidInput = document.getElementById('paid_amount');
                if (paidInput && (paidInput.value === "" || parseFloat(paidInput.value) === 0)) {
                    paidInput.value = grandTotal.toFixed(2);
                }
                
                calculateDue();
            }

            // 💵 ৭. ডিসকাউন্ট ইনপুট বক্সে হাত দিলে রিয়েল-টাইমে গ্র্যান্ড টোটাল আপডেট হওয়ার লিসেনার
            document.getElementById('discount_input').addEventListener('input', calculateBillingSummary);
            document.getElementById('paid_amount').addEventListener('input', calculateDue);

            /**
             * ⚠️ ৮. ডিউ (Due) বা বাকি টাকা লাইভ ক্যালকুলেশন অ্যালার্ট বক্স মেথড
             */
            function calculateDue() {
                let grandTotalText = document.getElementById('summary_grand_total').innerText.replace('৳', '').replace(/,/g, '');
                let grandTotal = parseFloat(grandTotalText) || 0;
                
                let paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
                let dueAmount = grandTotal - paidAmount;

                let dueAlertBox = document.getElementById('due_alert_box');
                let dueSpan = document.getElementById('summary_due_amount');

                if (dueAmount > 0) {
                    if (dueAlertBox) dueAlertBox.classList.remove('d-none');
                    if (dueSpan) dueSpan.innerText = '৳' + dueAmount.toFixed(2);
                } else {
                    if (dueAlertBox) dueAlertBox.classList.add('d-none');
                }
            }







            function removeSearchDropdown() {
                let oldDropdown = document.getElementById('live-search-results');
                if (oldDropdown) {
                    oldDropdown.remove();
                }
            }

            document.addEventListener('click', function(event) {
                if(event.target.id !== 'product_search') {
                    removeSearchDropdown();
                }
            });



        });
    </script>
@endpush
