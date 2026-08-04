@extends('layouts.app')
@section('title', 'Sales')
@section('PageHeader')
    Selling Board
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
 <div class="container-fluid py-4 bg-light min-vh-100 text-dark">
    
    <!-- 📊 ওপরের চার্ট ও কাউন্টার প্যানেল জোন -->
    <div class="row g-3 mb-4">
        
        <!-- ১. নতুন সেলস কাউন্টার / বাটন (Make Sale Action) -->
        <div class="col-12 col-sm-6 col-md-3">
            <a href="/sales/create" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center h-100 card-hover-purple" style="transition: 0.2s;">
                    <span class="fs-2 d-block mb-1">🛒</span>
                    <span class="text-muted d-block small fw-bold text-uppercase">New Order</span>
                    <span class="fs-5 fw-bold text-purple">+ Make Sale</span>
                </div>
            </a>
        </div>

        <!-- ২. আজকের মোট বিক্রি (Today's Sale) -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-success">
                <span class="text-muted d-block small fw-bold text-uppercase">Today's Sale</span>
                <span class="fs-3 fw-bold text-success mt-1">৳{{ number_format($todaySales ?? 0, 2) }}</span>
                <small class="text-secondary" style="font-size: 11px;">※ Real-time calculations</small>
            </div>
        </div>

        <!-- ৩. চলতি মাসের মোট বিক্রি (This Month's Sale) -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-primary">
                <span class="text-muted d-block small fw-bold text-uppercase">This Month</span>
                <span class="fs-3 fw-bold text-primary mt-1">৳{{ number_format($monthSales ?? 0, 2) }}</span>
                <small class="text-secondary" style="font-size: 11px;">※ Updated current month</small>
            </div>
        </div>

        <!-- ৪. চলতি বছরের মোট বিক্রি (This Year's Sale) -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-warning">
                <span class="text-muted d-block small fw-bold text-uppercase">This Year</span>
                <span class="fs-3 fw-bold text-warning mt-1">৳{{ number_format($yearSales ?? 0, 2) }}</span>
                <small class="text-secondary" style="font-size: 11px;">※ Cumulative annual data</small>
            </div>
        </div>

    </div>

    <!-- 📃 নিচের মূল সেলস ডাটা টেবিল প্যানেল -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="fw-bold text-dark m-0">📜 Recent Sales History</h5>
            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-2 px-2 py-1 smallfw-semibold">Total Orders: {{ count($sales) }}</span>
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


@endpush

@push('script')
    <script>
        
        
    </script>
@endpush