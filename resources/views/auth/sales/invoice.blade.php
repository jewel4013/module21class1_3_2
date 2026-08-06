<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Label - {{ $sale->invoice_no }}</title>
    <!-- বুটস্ট্র্যাপ ৫.৩ সিডিএন -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    
    <style>
        body { background-color: #d1d5db; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .cursor-pointer { cursor: pointer; }
        
        /* 📄 থার্মাল লেবেল কন্টেইনার (ইমেজের মতো সাইজ ২x৩ ইঞ্চি অনুপাত) */
        .invoice-card {
            width: 420px;
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
        }

        /* 🖨️ প্রিন্ট মিডিয়া কোড: প্রিন্ট দেওয়ার সময় ওপরে বাটনগুলো গায়েব হয়ে যাবে এবং শুধু লেবেলটি আসবে */
        @media print {
            body { background-color: #ffffff !important; margin: 0; padding: 0; }
            .no-print { display: none !important; } /* বাটনগুলো হাইড করার লক */
            .invoice-card {
                box-shadow: none !important;
                margin: 0 auto !important;
                width: 100% !important;
                padding: 10px !important;
            }
            @page { size: auto; margin: 0mm; }
        }

        .border-dashed-bottom { border-bottom: 2px dashed #000000; }
        .barcode-box { letter-spacing: 6px; font-family: 'Courier New', Courier, monospace; font-size: 15px; }
    </style>
</head>
<body>

<!-- 🎛️ ওপরের কন্ট্রোল বাটন প্যানেল (প্রিন্ট দেওয়ার সময় হাইড থাকবে) -->
<div class="container text-center pt-4 no-print">
    <div class="d-flex justify-content-center gap-2 mb-2">
        <a href="/sales" class="btn btn-light border shadow-sm btn-sm px-3 fw-semibold">← Back</a>
        <button onclick="window.print()" class="btn btn-primary shadow-sm btn-sm px-4 fw-bold">🖨️ Print Label / Save PDF</button>
    </div>
</div>

<!-- 📦 মূল থার্মাল ইনভয়েস মেমো (ইমেজের মতো হুবহু আর্কিটেকচার) -->
<div class="invoice-card text-dark">
    
    <!-- হেডার: শপের নাম ও মার্চেন্ট আইডি -->
    <div class="d-flex align-items-center justify-content-between pb-3 border-dashed-bottom">
        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 45px; height: 42px; font-size: 20px;">
            🛒
        </div>
        <div class="text-end">
            <h6 class="fw-bold m-0 text-uppercase tracking-wide" style="font-size: 16px;">SHWAPNO POS</h6>
            <small class="text-muted small" style="font-size: 11px;">Merchant ID: SWP-{{ auth()->id() ?? '2026' }}</small>
        </div>
    </div>

    <!-- বারকোড প্রিভিউ জোন -->
    <div class="text-center py-3 border-dashed-bottom">
        <div class="bg-dark text-white py-1 px-3 d-inline-block fw-bold barcode-box mb-1 rounded">
||||| | |||| ||| || ||||
        </div>
        <div class="fw-bold small text-secondary">ORDER-{{ $sale->id }}</div>
    </div>

    <!-- মেটা ডাটা গ্রিড (ইনভয়েস কোড ও ডেলিভারি মোড) -->
    <div class="row g-0 py-3 border-dashed-bottom" style="font-size: 12px;">
        <div class="col-6 border-end pe-2">
            <table class="w-100">
                <tr><td class="text-secondary fw-semibold">INVOICE:</td><td class="fw-bold text-end">{{ $sale->invoice_no }}</td></tr>
                <tr><td class="text-secondary fw-semibold">PMETHOD:</td><td class="fw-bold text-end">{{ $sale->payment_type }}</td></tr>
            </table>
        </div>
        <div class="col-6 ps-2">
            <table class="w-100">
                <tr><td class="text-secondary fw-semibold">DEL_TYPE:</td><td class="fw-bold text-end text-success">Counter</td></tr>
                <tr><td class="text-secondary fw-semibold">ITEMS:</td><td class="fw-bold text-end">{{ count($sale->saleDetaills) }} Pcs</td></tr>
            </table>
        </div>
    </div>

    <!-- কাস্টমার ইনফরমেশন প্যানেল -->
    <div class="py-3 border-dashed-bottom" style="font-size: 13px;">
        <table class="w-100 g-2">
            <tr><td class="text-secondary fw-semibold" style="width: 80px;">NAME:</td><td class="fw-bold text-dark">{{ $sale->customer?->name ?? 'Walk-in Customer' }}</td></tr>
            <tr><td class="text-secondary fw-semibold">PHONE:</td><td class="fw-bold text-dark">{{ $sale->customer?->phone ?? 'N/A' }}</td></tr>
            <tr><td class="text-secondary fw-semibold">ADDRESS:</td><td class="text-secondary fw-medium">{{ $sale->customer?->address ?? 'Shop Counter Delivery' }}</td></tr>
            <tr><td class="text-secondary fw-semibold">AREA:</td><td class="text-secondary small fw-bold">{{ $sale->customer?->thana ?? 'Dhaka' }}, {{ $sale->customer?->district ?? 'Dhaka' }}</td></tr>
        </table>
    </div>

    <!-- আইটেম ব্রেকডাউন সামারি টেবিল (অতিরিক্ত প্রিমিয়াম ইউএক্স সংযোজন) -->
    <div class="py-3 border-dashed-bottom" style="font-size: 12px;">
        <table class="w-100 text-secondary">
            <thead>
                <tr class="fw-bold text-dark border-bottom"><td class="pb-1">Item Description</td><td class="text-center pb-1">Qty</td><td class="text-end pb-1">Total</td></tr>
            </thead>
            <tbody>
                @foreach($sale->saleDetaills as $detail)
                    <tr>
                        <td class="pt-1 fw-medium text-dark">{{ $detail->product?->name }}</td>
                        <td class="text-center pt-1">{{ $detail->quantity }}</td>
                        <td class="text-end pt-1 fw-bold text-dark">৳{{ number_format($detail->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- পেমেন্ট এবং ফাইনাল ক্যাশ বক্স জোন (ইমেজের মতো হুবহু ক্যাশ অন ডেলিভারি বক্স) -->
    <div class="mt-3 p-3 border border-2 border-dark rounded bg-light">
        <div class="d-flex align-items-center justify-content-between">
            <span class="fw-bold text-uppercase fs-6" style="letter-spacing: 1px;">TOTAL PAID</span>
            <span class="fw-bold fs-4">৳{{ number_format($sale->paid_amount, 0) }}</span>
        </div>
        @if($sale->due_amount > 0)
            <div class="d-flex align-items-center justify-content-between text-danger small fw-bold mt-1">
                <span>⚠️ DUE AMOUNT:</span>
                <span>৳{{ number_format($sale->due_amount, 2) }}</span>
            </div>
        @endif
    </div>

    <!-- ফুটার মেটা তথ্য -->
    <div class="d-flex align-items-center justify-content-between mt-4 text-muted" style="font-size: 10px;">
        <div>Printed: {{ $sale->created_at?->format('d/m/y') }}<br>{{ $sale->created_at?->format('h:i a') }}</div>
        <div class="text-end fw-bold text-uppercase" style="color: #6f42c1;">⚡ Shwapno POS Engine</div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@1.18.1/dist/axios.min.js"></script>

</body>
</html>
