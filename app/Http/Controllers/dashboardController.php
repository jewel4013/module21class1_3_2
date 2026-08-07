<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class dashboardController extends Controller
{
    public function index(){
        $todaySales = Sale::wheredate('sale_date', Carbon::now())->get();
        $thiMonthSales = Sale::whereMonth('sale_date', Carbon::now()->month)->get();
        $thisYearSales = Sale::whereYear('sale_date', Carbon::now()->year)->get();
        return view('welcome', compact(['todaySales', 'thiMonthSales', 'thisYearSales']));
    }
}
