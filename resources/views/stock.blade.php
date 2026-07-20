@extends('layout.app')
@section('title', 'Stock')

@push('styles')
<style>
    /* স্টক কার্ডের সুন্দর শ্যাডো এবং বর্ডার ইফেক্ট */
    .stock-counter-card {
        border-radius: 16px;
        transition: transform 0.2s;
    }
    .stock-counter-card:hover {
        transform: translateY(-3px);
    }
    .product-img-placeholder {
        width: 40px;
        height: 40px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 1.2rem;
    }
</style>
@endpush

@section('mainSection')
<div class="container-fluid px-4 py-4 bg-light min-vh-100">
    
    <!-- ১. টপ হেডিং সেকশন -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Stock Management</h2>
            <p class="text-muted small mb-0">Monitor current product stock, inventory levels, and low stock alerts for this outlet.</p>
        </div>
        <div>
            <button class="btn btn-outline-success rounded-3 px-3 fw-semibold shadow-sm me-2">
                📥 Download PDF Report
            </button>
            <button class="btn btn-success rounded-3 px-4 fw-semibold shadow-sm">
                ➕ Add New Product
            </button>
        </div>
    </div>

    <!-- ২. স্টক স্ট্যাটাস সংক্ষিপ্ত কার্ডসমূহ -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm stock-counter-card p-3 bg-white border-start border-primary border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Total Items</span>
                        <h4 class="fw-extrabold text-dark mb-0">২৪৮টি পণ্য</h4>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 fs-4">📦</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm stock-counter-card p-3 bg-white border-start border-success border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">In Stock Value</span>
                        <h4 class="fw-extrabold text-dark mb-0">৳৪,৮৫,২০০</h4>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 fs-4">💰</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm stock-counter-card p-3 bg-white border-start border-danger border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Low Stock Alerts</span>
                        <h4 class="fw-extrabold text-danger mb-0">১২টি আইটেম</h4>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 fs-4">⚠️</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm stock-counter-card p-3 bg-white border-start border-warning border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Out of Stock</span>
                        <h4 class="fw-extrabold text-warning mb-0">৩টি আইটেম</h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 fs-4">🚫</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ৩. ফিল্টারিং এবং সার্চ এরিয়া -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-muted">🔍</span>
                    <input type="text" class="form-control bg-light border-0" placeholder="Search stock by product name, SKU or barcode...">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <select class="form-select bg-light border-0">
                    <option value="">All Categories</option>
                    <option value="1">Grocery</option>
                    <option value="2">Beverages</option>
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 text-sm-end">
                <div class="btn-group border border-light-subtle rounded-3 p-1 bg-light">
                    <button class="btn btn-sm btn-white shadow-sm rounded-2 px-3 fw-bold">All Stock</button>
                    <button class="btn btn-sm text-danger rounded-2 px-3">Low Stock</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ৪. মূল স্টক ডাটা টেবিল -->
    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small text-muted text-uppercase">
                        <th>Product Info</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Current Qty</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                                        <!-- ডামি প্রোডাক্ট ১ (ইন স্টক) -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-img-placeholder">🍎</div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Fresh Apple Fuji 1kg</h6>
                                    <small class="text-muted">ID: #PROD-102</small>
                                </div>
                            </div>
                        </td>
                        <td class="fw-mono text-muted small">APL-FUJ-1K</td>
                        <td><span class="badge bg-light text-secondary rounded-2">Fruits & Veggies</span></td>
                        <td class="fw-semibold">৳১৮০.০০</td>
                        <td class="fw-bold text-success">৳২৪০.০০</td>
                        <td class="fw-bold fs-6">১২0 কেজি</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1">In Stock</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light border rounded-3 px-2 me-1" title="Update Stock">📝 Edit</button>
                            <button class="btn btn-sm btn-light border text-primary rounded-3 px-2" title="Stock Log">📊 History</button>
                        </td>
                    </tr>

                    <!-- ডামি প্রোডাক্ট ২ (লো স্টক অ্যালার্ট) -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-img-placeholder">🧴</div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Savlon Handwash Refill 200ml</h6>
                                    <small class="text-muted">ID: #PROD-405</small>
                                </div>
                            </div>
                        </td>
                        <td class="fw-mono text-muted small">SVL-HW-200</td>
                        <td><span class="badge bg-light text-secondary rounded-2">Cosmetics & Care</span></td>
                        <td class="fw-semibold">৳৬৫.০০</td>
                        <td class="fw-bold text-success">৳৮৫.০০</td>
                        <td class="fw-bold text-danger fs-6">৫ পিস</td>
                        <td><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2.5 py-1">Low Stock</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light border rounded-3 px-2 me-1">📝 Edit</button>
                            <button class="btn btn-sm btn-light border text-primary rounded-3 px-2">📊 History</button>
                        </td>
                    </tr>

                    <!-- ডামি প্রোডাক্ট ৩ (আউট অফ স্টক) -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-img-placeholder">🥛</div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Aarong Dairy Pure Ghee 400g</h6>
                                    <small class="text-muted">ID: #PROD-890</small>
                                </div>
                            </div>
                        </td>
                        <td class="fw-mono text-muted small">ARG-GHE-400</td>
                        <td><span class="badge bg-light text-secondary rounded-2">Dairy Products</span></td>
                        <td class="fw-semibold">৳৫৮০.০০</td>
                        <td class="fw-bold text-success">৳৬৫০.০০</td>
                        <td class="fw-bold text-muted fs-6">০ পিস</td>
                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2.5 py-1">Out of Stock</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light border rounded-3 px-2 me-1">📝 Edit</button>
                            <button class="btn btn-sm btn-light border text-primary rounded-3 px-2">📊 History</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

