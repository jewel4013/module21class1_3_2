<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function allSales(){
        $data = []; // আপনার ডাটা এখানে থাকবে

        // ১. ভিউ লোড করা
        $pdf = Pdf::loadView('pdf.allSales', $data);

        // ২. ফন্ট ডিরেক্টরি এবং ক্যাশ অপশন সেট করা (এটিই মূল সমাধান)
        $pdf->setOption([
            'fontDir' => public_path('fonts/'), // আপনার TTF ফন্ট যেখানে আছে
            'fontCache' => storage_path('fonts/'), // ক্যাশ ফাইল যেখানে তৈরি হবে
            'isRemoteEnabled' => true
        ]);

        // ৩. পেজ সাইজ নির্ধারণ
        $pdf->setPaper('a4', 'portrait'); 

        // ৪. ব্রাউজারে স্ট্রিম করা
        return $pdf->stream('allSales.pdf');
    }
}
