@extends('layouts.app')
@section('title', 'Sales')
@section('PageHeader')
    Selling Board
@endsection
@section('HeaderDown')
    From this page you can see all your sales history and can add new sales.
@endsection

@push('style')

<style>
    .text-purple { color: #6f42c1 !important; }
    .btn-purple { background-color: #6f42c1 !important; border-color: #6f42c1 !important; transition: 0.2s; }
    .btn-purple:hover { background-color: #59339e !important; transform: translateY(-1px); }
    .card-hover-purple:hover { transform: translateY(-3px); border: 1px solid #6f42c1 !important; }
</style>

@endpush

@push('mainSection')
 <div class="container-fluid pb-4 bg-light min-vh-100 text-dark">
    <div class="">        
        <a href="/sales/create" class="btn btn-success mb-2">🛒 Sale some product</a>        
    </div>
    <ul class="nav nav-tabs row g-3" id="myTab" role="tablist">
        <li class="nav-item col-12 col-sm-6 col-md-3" role="presentation" >            
            <div class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="false">                
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-success">
                   <span class="text-muted d-block small fw-bold text-uppercase">All</span>
                    <span class="fs-3 fw-bold text-success mt-1">Sales</span>
                    <small class="text-secondary" style="font-size: 11px;">※ Real-time calculations</small>
                </div>
            </div>
        </li>
        <li class="nav-item col-12 col-sm-6 col-md-3" role="presentation">
            <div class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">                
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-info">
                    <span class="text-muted d-block small fw-bold text-uppercase">Today's Sale</span>
                    <span class="fs-3 fw-bold text-info mt-1">৳{{ number_format($todaySales->sum('paid_amount'), 2) }}</span>
                    <small class="text-secondary" style="font-size: 11px;">※ Real-time calculations</small>
                </div>
            </div>          
        </li>
        <li class="nav-item col-12 col-sm-6 col-md-3" role="presentation">
            <div class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="false">                
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-primary">
                    <span class="text-muted d-block small fw-bold text-uppercase">Last Month Sale</span>
                    <span class="fs-3 fw-bold text-primary mt-1">৳{{ number_format($lastMonthSales->sum('paid_amount'), 2) }}</span>
                    <small class="text-secondary" style="font-size: 11px;">※ Real-time calculations</small>
                </div>
            </div>          
        </li>
        <li class="nav-item col-12 col-sm-6 col-md-3" role="presentation">
            <div class="nav-link" id="contact2-tab" data-bs-toggle="tab" data-bs-target="#contact2" role="tab" aria-controls="contact2" aria-selected="false">                
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-warning">
                    <span class="text-muted d-block small fw-bold text-uppercase">Last Year's Sale</span>
                    <span class="fs-3 fw-bold text-warning mt-1">৳{{ number_format($lastYearSales->sum('paid_amount'), 2) }}</span>
                    <small class="text-secondary" style="font-size: 11px;">※ Real-time calculations</small>
                </div>
            </div>          
        </li>
        
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" >
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius:0 0 10px 10px;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold text-dark m-0">📜 Recent Sales History</h5>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-2 px-2 py-1 smallfw-semibold">Total Sales: {{ count($sales) }}</span>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-danger" title="Copy">📋</button>
                        <button class="btn btn-secondary" title="CSV">📄</button>
                        <button class="btn btn-warning text-white" title="Excel">📊</button>
                        <button class="btn btn-info text-white" title="PDF">📕</button>
                        <a href="/allsales/pdf" class="btn btn-primary" title="Print">🖨️</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-light-subtle" style="font-size: 13px;">
                        <thead class="table-light text-secondary fw-semibold border-bottom">
                            <tr>
                                <th class="py-3">Invoice No</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Customer Info</th>
                                <th class="py-3">Grand Total</th>
                                <th class="py-3">Paid Amount</th>
                                <th class="py-3">Due Status</th>
                                <th class="py-3">Payment</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @forelse($sales as $sale)
                                <tr class="border-bottom border-light-subtle">
                                    <!-- ইনভয়েস নাম্বার -->
                                    <td class="fw-bold text-dark">{{ $sale->invoice_no }}</td>
                                    
                                    <!-- বিক্রির তারিখ -->
                                    <td class="text-secondary">{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d h:i:s A l') }}</td>
                                    
                                    <!-- কাস্টমারের তথ্য (Null-safe Operator প্রটেকশন সহ) -->
                                    <td>
                                        <span class="d-block fw-semibold text-dark">{{ $sale->customer?->name ?? 'Walk-in Customer' }}</span>
                                        <small class="text-muted" style="font-size: 11px;">📱 {{ $sale->customer?->phone ?? 'N/A' }}</small>
                                    </td>
                                    
                                    <!-- গ্র্যান্ড টোটাল -->
                                    <td class="fw-bold text-dark">৳{{ number_format($sale->grand_total, 2) }}</td>
                                    
                                    <!-- পেইড অ্যামাউন্ট -->
                                    <td class="text-success fw-medium">৳{{ number_format($sale->paid_amount, 2) }}</td>
                                    
                                    <!-- ডিউ স্ট্যাটাস ব্যাজ লজিক -->
                                    <td>
                                        @if($sale->due_amount > 0)
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ⚠️ Due: ৳{{ number_format($sale->due_amount, 2) }}
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ✓ Fully Paid
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- পেমেন্ট মেথড টাইপ -->
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-2 px-2 py-1" style="font-size: 11px;">
                                            💳 {{ $sale->payment_type }}
                                        </span>
                                    </td>
                                    
                                    <!-- 🚀 অ্যাকশন বাটন জোন: স্লাগ-ভিত্তিক প্রিমিয়াম ইনভয়েস বাটন -->
                                    <td class="text-end pe-4">
                                        <!-- আপনার স্লাগ আর্কিটেকচার মেনে ইনভয়েস দেখার সরাসরি প্রিমিয়াম বাটন -->
                                        <a href="{{ route('invoiceShow', $sale->invoice_no) }}" class="btn btn-purple btn-sm px-3 rounded-2 fw-semibold shadow-sm text-white">
                                            📄 Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-secondary">
                                        <span class="fs-1 d-block mb-2">📥</span>
                                        <p class="m-0 fw-medium">No sales recorded yet. Click on '+ Make Sale' to begin.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius:0 0 10px 10px;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold text-dark m-0">📜 Today Sales History</h5>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-2 px-2 py-1 smallfw-semibold">Total Sales: {{ count($todaySales) }}</span>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-danger" title="Copy">📋</button>
                        <button class="btn btn-secondary" title="CSV">📄</button>
                        <button class="btn btn-warning text-white" title="Excel">📊</button>
                        <button class="btn btn-info text-white" title="PDF">📕</button>
                        <a href="/todaysales/pdf" class="btn btn-primary" title="Print">🖨️</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-light-subtle" style="font-size: 13px;">
                        <thead class="table-light text-secondary fw-semibold border-bottom">
                            <tr>
                                <th class="py-3">Invoice No</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Customer Info</th>
                                <th class="py-3">Grand Total</th>
                                <th class="py-3">Paid Amount</th>
                                <th class="py-3">Due Status</th>
                                <th class="py-3">Payment</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @forelse($todaySales as $sale)
                                <tr class="border-bottom border-light-subtle">
                                    <!-- ইনভয়েস নাম্বার -->
                                    <td class="fw-bold text-dark">{{ $sale->invoice_no }}</td>
                                    
                                    <!-- বিক্রির তারিখ -->
                                    <td class="text-secondary">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M, Y') }}</td>
                                    
                                    <!-- কাস্টমারের তথ্য (Null-safe Operator প্রটেকশন সহ) -->
                                    <td>
                                        <span class="d-block fw-semibold text-dark">{{ $sale->customer?->name ?? 'Walk-in Customer' }}</span>
                                        <small class="text-muted" style="font-size: 11px;">📱 {{ $sale->customer?->phone ?? 'N/A' }}</small>
                                    </td>
                                    
                                    <!-- গ্র্যান্ড টোটাল -->
                                    <td class="fw-bold text-dark">৳{{ number_format($sale->grand_total, 2) }}</td>
                                    
                                    <!-- পেইড অ্যামাউন্ট -->
                                    <td class="text-success fw-medium">৳{{ number_format($sale->paid_amount, 2) }}</td>
                                    
                                    <!-- ডিউ স্ট্যাটাস ব্যাজ লজিক -->
                                    <td>
                                        @if($sale->due_amount > 0)
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ⚠️ Due: ৳{{ number_format($sale->due_amount, 2) }}
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ✓ Fully Paid
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- পেমেন্ট মেথড টাইপ -->
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-2 px-2 py-1" style="font-size: 11px;">
                                            💳 {{ $sale->payment_type }}
                                        </span>
                                    </td>
                                    
                                    <!-- 🚀 অ্যাকশন বাটন জোন: স্লাগ-ভিত্তিক প্রিমিয়াম ইনভয়েস বাটন -->
                                    <td class="text-end pe-4">
                                        <!-- আপনার স্লাগ আর্কিটেকচার মেনে ইনভয়েস দেখার সরাসরি প্রিমিয়াম বাটন -->
                                        <a href="{{ route('invoiceShow', $sale->invoice_no) }}" class="btn btn-purple btn-sm px-3 rounded-2 fw-semibold shadow-sm text-white">
                                            📄 Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-secondary">
                                        <span class="fs-1 d-block mb-2">📥</span>
                                        <p class="m-0 fw-medium">No sales recorded yet. Click on '+ Make Sale' to begin.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius:0 0 10px 10px;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold text-dark m-0">Last Month Sale</h5>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-2 px-2 py-1 smallfw-semibold">Total Sales: {{ count($lastMonthSales) }}</span>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-danger" title="Copy">📋</button>
                        <button class="btn btn-secondary" title="CSV">📄</button>
                        <button class="btn btn-warning text-white" title="Excel">📊</button>
                        <button class="btn btn-info text-white" title="PDF">📕</button>
                        <a href="/lastmonthsales/pdf" class="btn btn-primary" title="Print">🖨️</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-light-subtle" style="font-size: 13px;">
                        <thead class="table-light text-secondary fw-semibold border-bottom">
                            <tr>
                                <th class="py-3">Invoice No</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Customer Info</th>
                                <th class="py-3">Grand Total</th>
                                <th class="py-3">Paid Amount</th>
                                <th class="py-3">Due Status</th>
                                <th class="py-3">Payment</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @forelse($lastMonthSales as $sale)
                                <tr class="border-bottom border-light-subtle">
                                    <!-- ইনভয়েস নাম্বার -->
                                    <td class="fw-bold text-dark">{{ $sale->invoice_no }}</td>
                                    
                                    <!-- বিক্রির তারিখ -->
                                    <td class="text-secondary">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M, Y') }}</td>
                                    
                                    <!-- কাস্টমারের তথ্য (Null-safe Operator প্রটেকশন সহ) -->
                                    <td>
                                        <span class="d-block fw-semibold text-dark">{{ $sale->customer?->name ?? 'Walk-in Customer' }}</span>
                                        <small class="text-muted" style="font-size: 11px;">📱 {{ $sale->customer?->phone ?? 'N/A' }}</small>
                                    </td>
                                    
                                    <!-- গ্র্যান্ড টোটাল -->
                                    <td class="fw-bold text-dark">৳{{ number_format($sale->grand_total, 2) }}</td>
                                    
                                    <!-- পেইড অ্যামাউন্ট -->
                                    <td class="text-success fw-medium">৳{{ number_format($sale->paid_amount, 2) }}</td>
                                    
                                    <!-- ডিউ স্ট্যাটাস ব্যাজ লজিক -->
                                    <td>
                                        @if($sale->due_amount > 0)
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ⚠️ Due: ৳{{ number_format($sale->due_amount, 2) }}
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ✓ Fully Paid
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- পেমেন্ট মেথড টাইপ -->
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-2 px-2 py-1" style="font-size: 11px;">
                                            💳 {{ $sale->payment_type }}
                                        </span>
                                    </td>
                                    
                                    <!-- 🚀 অ্যাকশন বাটন জোন: স্লাগ-ভিত্তিক প্রিমিয়াম ইনভয়েস বাটন -->
                                    <td class="text-end pe-4">
                                        <!-- আপনার স্লাগ আর্কিটেকচার মেনে ইনভয়েস দেখার সরাসরি প্রিমিয়াম বাটন -->
                                        <a href="{{ route('invoiceShow', $sale->invoice_no) }}" class="btn btn-purple btn-sm px-3 rounded-2 fw-semibold shadow-sm text-white">
                                            📄 Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-secondary">
                                        <span class="fs-1 d-block mb-2">📥</span>
                                        <p class="m-0 fw-medium">No sales recorded yet. Click on '+ Make Sale' to begin.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius:0 0 10px 10px;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold text-dark m-0">Last Year Sale</h5>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-2 px-2 py-1 smallfw-semibold">Total Sales: {{ count($lastYearSales) }}</span>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-danger" title="Copy">📋</button>
                        <button class="btn btn-secondary" title="CSV">📄</button>
                        <button class="btn btn-warning text-white" title="Excel">📊</button>
                        <button class="btn btn-info text-white" title="PDF">📕</button>
                        <a href="/lastyearsales/pdf" class="btn btn-primary" title="Print">🖨️</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-light-subtle" style="font-size: 13px;">
                        <thead class="table-light text-secondary fw-semibold border-bottom">
                            <tr>
                                <th class="py-3">Invoice No</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Customer Info</th>
                                <th class="py-3">Grand Total</th>
                                <th class="py-3">Paid Amount</th>
                                <th class="py-3">Due Status</th>
                                <th class="py-3">Payment</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @forelse($lastYearSales as $sale)
                                <tr class="border-bottom border-light-subtle">
                                    <!-- ইনভয়েস নাম্বার -->
                                    <td class="fw-bold text-dark">{{ $sale->invoice_no }}</td>
                                    
                                    <!-- বিক্রির তারিখ -->
                                    <td class="text-secondary">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M, Y') }}</td>
                                    
                                    <!-- কাস্টমারের তথ্য (Null-safe Operator প্রটেকশন সহ) -->
                                    <td>
                                        <span class="d-block fw-semibold text-dark">{{ $sale->customer?->name ?? 'Walk-in Customer' }}</span>
                                        <small class="text-muted" style="font-size: 11px;">📱 {{ $sale->customer?->phone ?? 'N/A' }}</small>
                                    </td>
                                    
                                    <!-- গ্র্যান্ড টোটাল -->
                                    <td class="fw-bold text-dark">৳{{ number_format($sale->grand_total, 2) }}</td>
                                    
                                    <!-- পেইড অ্যামাউন্ট -->
                                    <td class="text-success fw-medium">৳{{ number_format($sale->paid_amount, 2) }}</td>
                                    
                                    <!-- ডিউ স্ট্যাটাস ব্যাজ লজিক -->
                                    <td>
                                        @if($sale->due_amount > 0)
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ⚠️ Due: ৳{{ number_format($sale->due_amount, 2) }}
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-2 px-2 py-1" style="font-size: 11px;">
                                                ✓ Fully Paid
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- পেমেন্ট মেথড টাইপ -->
                                    <td>
                                        <span class="badge bg-light text-dark border rounded-2 px-2 py-1" style="font-size: 11px;">
                                            💳 {{ $sale->payment_type }}
                                        </span>
                                    </td>
                                    
                                    <!-- 🚀 অ্যাকশন বাটন জোন: স্লাগ-ভিত্তিক প্রিমিয়াম ইনভয়েস বাটন -->
                                    <td class="text-end pe-4">
                                        <!-- আপনার স্লাগ আর্কিটেকচার মেনে ইনভয়েস দেখার সরাসরি প্রিমিয়াম বাটন -->
                                        <a href="{{ route('invoiceShow', $sale->invoice_no) }}" class="btn btn-purple btn-sm px-3 rounded-2 fw-semibold shadow-sm text-white">
                                            📄 Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-secondary">
                                        <span class="fs-1 d-block mb-2">📥</span>
                                        <p class="m-0 fw-medium">No sales recorded yet. Click on '+ Make Sale' to begin.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






    <style>
        .nav-tabs .nav-link:not(.active):hover
        {
            border-color: transparent !important; /* ৩ পাশের বর্ডার গায়েব করবে */
        }
        .nav-link .card{
            cursor: pointer;
        }

    </style>
@endpush


@push('script')
    <script>
        
        
    </script>
@endpush