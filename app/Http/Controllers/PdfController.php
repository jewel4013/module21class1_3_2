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
        // ঠিক ২৪ ঘণ্টা আগের সময় থেকে শুরু করে বর্তমান সময় পর্যন্ত ডাটা আসে।
        //$sales = Sale::where('sale_date', '>=', now()->subDays(1))->get();

        // এটা নির্দিষ্ট তারিখের ডেটা আসে।
        $sales = Sale::where('sale_date', '>=', today())->get();
        // উপরেরটা আর নিচের এটা একই ।
        // $sales = Sale::whereBetween('sale_date', [
        //     now()->startOfDay(),
        //     now()->endOfDay()
        // ])->get();
        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.todaySales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('today-sales-report.pdf');
    }

    public function lastMonthSales(){
        // আজকে থেকে গত এক মাসের সেল। আজ যদি ৮ আগস্ট হয় থাওলে 
        // গত মাসের (৯ জুলাই) থেকে এখানে আসবে।
        // $sales = Sale::where('sale_date', '>=', now()->subMonths(1))->get();

        //এভাবে লিখলে গত মাসের ১ তারিখ থেকে গত মাসের শেষ তারিখের ডেটা নিয়ে আসে।
        $sales = Sale::whereBetween('sale_date', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        ])->get();
        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.lastMonthSales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('last-month-sales-report.pdf');
    }

    public function lastYearSales(){
        // আজকে থেকে গত এক বছরের সেল। আজ যদি ৮ আগস্ট ২০২৬ হয়
        // তাহলে গত বছরের ৯ আগস্ট ২০২৫ থেকে এখানে আসবে।
        // $sales = Sale::where('sale_date', '>=', now()->subYears(1))->get(); 
         
        //এভাবে লিখলে গত বছরের ১ তারিখ থেকে গত বছরের শেষ তারিখের ডেটা নিয়ে আসে।
        $sales = Sale::whereBetween('sale_date', [
            now()->subYear()->startOfYear(),
            now()->subYear()->endOfYear()
        ])->get();


        $totalSalesAmount = $sales->sum('paid_amount');

        // কনফিগ ফাইল থেকে ডাটা অটো লোড হবে
        $pdf = PDF::loadView('pdf.lastYearSales', compact('sales', 'totalSalesAmount'));
        
        return $pdf->stream('last-year-sales-report.pdf');
    }   
}
