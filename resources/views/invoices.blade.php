@extends('layout.app')
@section('title', 'Invoices')

@push('styles')
<style>
    /* ইনভয়েস কার্ডের সুন্দর সফট শ্যাডো ইফেক্ট */
    .invoice-stat-card {
        border-radius: 16px;
        transition: transform 0.2s;
    }
    .invoice-stat-card:hover {
        transform: translateY(-3px);
    }
</style>
@endpush

@section('mainSection')
<div class="container-fluid px-4 py-4 bg-light min-vh-100">
    
    <!-- ১. টপ হেডিং এবং কুইক অ্যাকশন -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Invoice Management</h2>
            <p class="text-muted small mb-0">View, search, print, and download PDF history for all outlet billing invoices.</p>
        </div>
        <div>
            <button class="btn btn-outline-success rounded-3 px-3 fw-semibold shadow-sm">
                📥 Export All Invoices (Excel)
            </button>
        </div>
    </div>

    <!-- ২. ইনভয়েস সংক্রান্ত সংক্ষিপ্ত কার্ডসমূহ -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm invoice-stat-card p-3 bg-white border-start border-primary border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Total Invoices</span>
                        <h4 class="fw-extrabold text-dark mb-0">১,৪২০টি</h4>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 fs-4">🧾</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm invoice-stat-card p-3 bg-white border-start border-success border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Paid Invoices</span>
                        <h4 class="fw-extrabold text-dark mb-0">১,৩৯৫টি</h4>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 fs-4">✅</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm invoice-stat-card p-3 bg-white border-start border-warning border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Due / Pending</span>
                        <h4 class="fw-extrabold text-warning mb-0">২৫টি</h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 fs-4">⏳</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm invoice-stat-card p-3 bg-white border-start border-danger border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Total Discount Given</span>
                        <h4 class="fw-extrabold text-danger mb-0">৳১২,৪৫০</h4>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 fs-4">📉</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ৩. ফিল্টারিং এবং অ্যাডভান্সড ডেট সার্চ ফিল্ড -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-muted">🔍</span>
                    <input type="text" class="form-control bg-light border-0" placeholder="Search by Invoice No, Customer Name or Phone...">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 text-muted">📅</span>
                    <input type="date" class="form-control bg-light border-0" title="Start Date">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <select class="form-select bg-light border-0">
                    <option value="">All Status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Due / Pending</option>
                </select>
            </div>
            <div class="col-12 col-md-2 text-md-end">
                <button class="btn btn-success btn-sm w-100 rounded-3 py-2 fw-semibold">Filter</button>
            </div>
        </div>
    </div>

    <!-- ৪. মূল ইনভয়েস টেবিল -->
    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="small text-muted text-uppercase">
                        <th>Invoice No</th>
                        <th>Customer Name</th>
                        <th>Sub Total</th>
                        <th>Discount</th>
                        <th>Net Payable</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                                        <!-- ডামি ইনভয়েস ১ (পেইড) -->
                    <tr>
                        <td class="fw-bold text-primary">INV-20260709-4821</td>
                        <td>
                            <div class="fw-bold text-dark">Jewel Rana</div>
                            <small class="text-muted">01712xxxxxx</small>
                        </td>
                        <td class="text-muted">৳৮৯০.০০</td>
                        <td class="text-danger">-৳২০.০০</td>
                        <td class="fw-bold text-dark">৳৮৭০.০০</td>
                        <td class="small text-muted">09 July, 2026 | 04:30 PM</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1">Paid</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light border rounded-3 px-2 me-1" title="View Details">👁️ View</button>
                            <button class="btn btn-sm btn-light border text-success rounded-3 px-2 me-1" title="Print Invoice">🖨️ Print</button>
                            <button class="btn btn-sm btn-light border text-danger rounded-3 px-2" title="Download PDF">📥 PDF</button>
                        </td>
                    </tr>

                    <!-- ডামি ইনভয়েস ২ (ডিউ / পেন্ডিং) -->
                    <tr>
                        <td class="fw-bold text-primary">INV-20260709-1250</td>
                        <td>
                            <div class="fw-bold text-dark">Sajib Ahmed</div>
                            <small class="text-muted">01911xxxxxx</small>
                        </td>
                        <td class="text-muted">৳৪,৫০০.০০</td>
                        <td class="text-muted">৳০.০০</td>
                        <td class="fw-bold text-dark">৳৪,৫০০.০০</td>
                        <td class="small text-muted">09 July, 2026 | 02:15 PM</td>
                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2.5 py-1">Due / Pending</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light border rounded-3 px-2 me-1">👁️ View</button>
                            <button class="btn btn-sm btn-light border text-success rounded-3 px-2 me-1">🖨️ Print</button>
                            <button class="btn btn-sm btn-light border text-danger rounded-3 px-2">📥 PDF</button>
                        </td>
                    </tr>

                    <!-- ডামি ইনভয়েস ৩ (ওয়াক-ইন / ক্যাশ কাস্টমার) -->
                    <tr>
                        <td class="fw-bold text-primary">INV-20260708-9962</td>
                        <td>
                            <div class="fw-bold text-secondary">Walk-in Customer</div>
                            <small class="text-muted">N/A</small>
                        </td>
                        <td class="text-muted">৳১২৫.০০</td>
                        <td class="text-muted">৳০.০০</td>
                        <td class="fw-bold text-dark">৳১২৫.০০</td>
                        <td class="small text-muted">08 July, 2026 | 08:45 PM</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1">Paid</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light border rounded-3 px-2 me-1">👁️ View</button>
                            <button class="btn btn-sm btn-light border text-success rounded-3 px-2 me-1">🖨️ Print</button>
                            <button class="btn btn-sm btn-light border text-danger rounded-3 px-2">📥 PDF</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

