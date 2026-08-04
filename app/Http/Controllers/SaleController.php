<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::all();
        return view('auth.sales.sales', compact('sales'));
    }

    public function create(){
        $products = Product::all();
        $customers = Customer::all();
        return view('auth.sales.salesCreate', compact('products', 'customers'));
    }
    public function store(){
        
    }
    public function show(){
        
    }
    public function edit(){
        
    }   
    public function update(){
        
    }

    public function searchProducts(Request $request)
    {
        // 🚀 ফিক্স ১: জাভাস্ক্রিপ্ট অ্যাক্সিওস প্যারামিটারের সাথে মিল রেখে 'query' রিড করা হলো
        
       
       // যদি সার্চ বক্সে কোনো ডাটা না থাকে তবে ফাঁকা রেসপন্স যাবে
        try {
            $search = $request->input('query');
            // 🎯 আপনার মাইগ্রেশন অনুযায়ী 'name' এবং 'product_code' কলাম নিখুঁতভাবে লক করা হলো
             $products = Product::with('brand') // 🚀 ব্র্যান্ড রিলেশন লোড করা হলো
            ->select('id', 'name', 'product_code', 'product_price', 'image', 'brand_id')
            ->where(function($query) use ($search) {
                $query->where('slug', 'LIKE', '%' . $search . '%')
                    ->orWhere('product_code', 'LIKE', '%' . $search . '%');
            })
            ->limit(10)
            ->get();
            return response()->json([
                'status' => true,
                'data'   => $products
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Search failed: ' . $e->getMessage()
            ], 500);
        }
    }

}
