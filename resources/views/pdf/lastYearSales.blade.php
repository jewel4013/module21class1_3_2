<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <style>
        /* ১. গ্লোবাল রিসেট ও ফন্ট লক */
        *, div, th, td, span{ 
            font-family: 'solaimanlipi', sans-serif !important; 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        body { 
            font-family: 'solaimanlipi', sans-serif !important; 
            padding: 30px; 
            font-size: 13px; 
            color: #334155; 
            background-color: #ffffff;
            line-height: 1.6;
        }
        
        /* ২. হেডার ব্যানার ডিজাইন */
        .report-header { 
            width: 100%; 
            margin-bottom: 25px; 
            border-bottom: 2px solid #0f766e; /* ডার্ক টিল কালার */
            padding-bottom: 12px; 
        }
        .company-name { 
            font-size: 24px; 
            font-weight: bold; 
            color: #0f766e; 
        }
        .report-title { 
            font-size: 16px; 
            color: #64748b; 
            margin-top: 4px; 
            font-weight: bold;
        }
        .caption-container {
            width: 100%;
            margin: 20px 0 0 0;
        }
        .box-left {
            float: left;
            width: 44%; /* ২% মার্জিনের জন্য ফাকা রাখা ভালো */
            padding: 10px;
            text-align: left;  
            font-size: 12px;
        }
        .box-right {
            float: right;
            width: 44%;
            padding: 10px;
            text-align: right;  
            font-size: 12px;
        }
        .clear-fix {
            clear: both;
        }

         /* ৩. আধুনিক টেবিল ডিজাইন */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 5px; 
        }
        th { 
            background-color: #0f766e; /* টেবিল হেডার ব্যাকগ্রাউন্ড */
            color: #ffffff; 
            text-align: left; 
            padding: 10px 12px; 
            font-weight: bold; 
            font-size: 13px; 
            border: 1px solid #0f766e; 
        }
        td { 
            padding: 10px 12px; 
            border-bottom: 1px solid #e2e8f0; 
            color: #334155; 
        }
        
        /* স্ট্রাইপড ইফেক্ট (একটি রো পর পর হালকা কালার) */
        tr:nth-child(even) { 
            background-color: #f8fafc; 
        }
        
        /* ৪. ইউটিলিটি ও পেমেন্ট ব্যাজ */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .badge { 
            padding: 3px 8px; 
            border-radius: 12px; 
            font-size: 10px; 
            font-weight: bold; 
            display: inline-block; 
        }
        .badge-cash { background-color: #dcfce7; color: #15803d; }
        .badge-bkash { background-color: #fce7f3; color: #9d174d; }
        .badge-card { background-color: #e0f2fe; color: #0369a1; }
        
        /* ৫. সর্বমোট (Total) রো ডিজাইন */
        .total-row td { 
            background-color: #f1f5f9; 
            font-weight: bold; 
            color: #0f766e; 
            font-size: 14px; 
            border-top: 2px solid #cbd5e1; 
            border-bottom: 2px double #cbd5e1;
        }
    </style>
</head>
<body>

    <!-- হেডার সেকশন -->
    <div class="report-header">
        <div style="float: left;">
            <div class="company-name">Shwapno POS</div>
            <div class="report-title">Branch: {{ Auth::user()->outlet }}</div>
            <div class="report-title">Address: {{ Auth::user()->profile->address }}</div>
        </div>
        <div class="caption-container">
            <div class="box-left">Last Year Sales Report</div>
            <div class="box-right">{{ now()->format('d-m-Y h:i A') }}</div>
            <div class="clear-fix"></div> <!-- ফ্লোট ব্রেক করার জন্য জরুরি -->
        </div>

        <div class="clear-fix"></div>
    </div>

    <!-- সেলস ডেটা টেবিল -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Invoice No</th>
                <th>Sub_total</th>
                <th>Discount</th>
                <th>Grand Total</th>
                <th>Paid Amount</th>
                <th>Due Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>#{{ $sale->id }}</td>
                <td>{{ $sale->sale_date }}</td>
                <td>{{ $sale->invoice_no }}</td>
                <td>{{ $sale->sub_total }}</td>
                <td>{{ $sale->discount }}</td>
                <td>{{ $sale->grand_total }}</td>
                <td>{{ $sale->paid_amount }}</td>
                <td>{{ $sale->due_amount }}</td>
            </tr>
            @endforeach
            
            <!-- ফাইনাল টোটাল রো -->
            <tr class="total-row">
                <td colspan="3" class="text-right">Total: = </td>
                <td >{{$sales->sum('sub_total')}}</td>
                <td >{{$sales->sum('discount')}}</td>
                <td >{{$sales->sum('grand_total')}}</td>
                <td >{{$sales->sum('paid_amount')}}</td>
                <td >{{$sales->sum('due_amount')}}</td>
            </tr>
        </tbody>
    </table>
    

    <div>
        <p style="text-align: right; margin-top: 80px ">Author signature</p>

    </div>
</body>
</html>
