<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
 // ফাসাদ ইমপোর্ট করুন

class PdfController extends Controller
{
    public function allSales(){
        $sales = Sale::all();
        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.allSales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('all-sales-report.pdf');
    }

    public function todaySales(){
        $sales = Sale::where('sale_date', '>=', now()->subDays(1))->get();
        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.todaySales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('today-sales-report.pdf');
    }

    public function lastMonthSales(){
        $sales = Sale::where('sale_date', '>=', now()->subMonths(1))->get();
        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.lastMonthSales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('last-month-sales-report.pdf');
    }

    public function lastYearSales(){
        $sales = Sale::where('sale_date', '>=', now()->subYears(1))->get();
        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.lastYearSales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('last-year-sales-report.pdf');
    }   
}
