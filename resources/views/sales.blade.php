@extends('layout.app')

@push('styles')
<style>
    /* প্রোডাক্ট কার্ডের সুন্দর এনিমেশন ও শ্যাডো ইফেক্ট */
    .pos-product-card {
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .pos-product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
        border-color: #198754;
    }
    /* ডান পাশের অর্ডার প্যানেলটি স্ক্রিনের সাথে আটকে থাকার জন্য */
    .pos-sidebar {
        position: sticky;
        top: 24px;
        height: calc(100vh - 48px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .cart-items-zone {
        overflow-y: auto;
        flex-grow: 1;
    }
</style>
@endpush

@section('mainSection')
<div class="container-fluid px-4 py-4 bg-light min-vh-100">
    <div class="row g-4">
                <!-- 🛒 বাম পাশে: প্রোডাক্ট ক্যাটালগ ও সার্চ ফিল্টার -->
        <div class="col-12 col-lg-7 col-xl-8">
            
            <!-- ফিল্টার এবং সার্চ বার টপ প্যানেল -->
            <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
                <div class="row g-3 align-items-center">
                    <div class="col-12 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 text-muted">🔍</span>
                            <input type="text" class="form-control bg-light border-0" placeholder="Search product by Name, SKU or Scan Barcode...">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- ক্যাটাগরি ফিল্টার শর্টকাট বোতামসমূহ -->
                        <div class="d-flex gap-2 overflow-x-auto pb-1" style="white-space: nowrap;">
                            <button class="btn btn-success btn-sm rounded-pill px-3">All Items</button>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Grocery</button>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Beverages</button>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Cosmetics</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- প্রোডাক্ট গ্রিড ডিসপ্লে -->
            <div class="row g-3">
                <!-- ডামি প্রোডাক্ট ১ -->
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="card bg-white pos-product-card rounded-4 p-3 h-100 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1 small">Stock: 45</span>
                            <small class="text-muted fw-mono">SKU: PRN-01</small>
                        </div>
                        <h6 class="fw-bold text-dark text-truncate mb-1">Pran Mango Juice 250ml</h6>
                        <p class="text-muted small mb-3">Beverages</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-extrabold text-success fs-5">৳৩৫.০০</span>
                            <button type="button" class="btn btn-sm btn-light border rounded-3 px-2 text-success fw-bold">+</button>
                        </div>
                    </div>
                </div>

                <!-- ডামি প্রোডাক্ট ২ -->
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="card bg-white pos-product-card rounded-4 p-3 h-100 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1 small">Stock: 120</span>
                            <small class="text-muted fw-mono">SKU: RUP-5L</small>
                        </div>
                        <h6 class="fw-bold text-dark text-truncate mb-1">Rupchanda Soyabean Oil 5L</h6>
                        <p class="text-muted small mb-3">Grocery</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-extrabold text-success fs-5">৳৮২০.০০</span>
                            <button type="button" class="btn btn-sm btn-light border rounded-3 px-2 text-success fw-bold">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <!-- 🧾 ডান পাশে: কার্ট এবং কুইক ক্যাশিয়ার প্যানেল -->
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 pos-sidebar">
                
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Current Order</h5>
                        <span class="badge bg-success rounded-pill px-2.5">2 Items</span>
                    </div>

                    <!-- কাস্টমার ড্রপডাউন -->
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">👤</span>
                            <select class="form-select bg-light border-0 rounded-end-3 small">
                                <option value="">Walk-in / Cash Customer</option>
                                <option value="1">Jewel Rana (01712xxxxxx)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- কার্টের আইটেম এরিয়া -->
                <div class="cart-items-zone my-3 pe-1">
                    <table class="table align-middle table-borderless">
                        <tbody>
                            <tr class="border-bottom border-light">
                                <td class="ps-0 py-3" style="width: 60%;">
                                    <h6 class="mb-0 fw-bold small text-dark text-truncate">Pran Mango Juice</h6>
                                    <small class="text-muted">৳৩৫.০০ × ২</small>
                                </td>
                                <td class="text-end fw-bold text-dark small pe-0">৳৭০.০০</td>
                                <td class="text-end pe-0"><a href="#" class="text-decoration-none small">❌</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- টোটাল হিসাব ও বাটন সমূহ -->
                <div>
                    <div class="bg-light bg-opacity-70 p-3 rounded-4 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Sub Total:</span>
                            <span class="fw-bold text-dark">৳৮৯০.০০</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Discount:</span>
                            <span class="fw-bold text-danger">-৳২০.০০</span>
                        </div>
                        <hr class="my-2 border-secondary border-opacity-10">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">Net Payable:</span>
                            <span class="fw-extrabold text-success fs-4">৳৮৭০.০০</span>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success w-100 rounded-3 py-2.5 fw-bold text-uppercase shadow-sm">
                        💸 Complete & Print Invoice
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection


