<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class dashboardController extends Controller
{
    public function index(){
        $todaySales = Sale::wheredate('sale_date', Carbon::now())->get();
        $lastMonthSales = Sale::whereBetween('sale_date',[
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
         ])->get();
        return view('welcome', compact(['todaySales', 'lastMonthSales']));
    }
}
