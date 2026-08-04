<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::all();
        return view('auth.sales.sales', compact('sales'));
    }

    public function create(){
        
    }
    public function store(){
        
    }
    public function show(){
        
    }
    public function edit(){
        
    }   
    public function update(){
        
    }

}
