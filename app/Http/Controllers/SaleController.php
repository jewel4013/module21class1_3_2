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
        $search = $request->input('query');
        if (empty($search)) {
            return response()->json([]);
        }
        try {
            $products = DB::table('products')
                ->select('id', 'name', 'product_code', 'product_price', 'image')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('product_code', 'LIKE', '%' . $search . '%')
                ->orWhere('slug', 'LIKE', '%' . $search . '%')
                ->orderBy('name', 'ASC')
                ->limit(10) // একবারে সর্বোচ্চ ১০টি সাজেশন দেখাবে (সার্ভার লোড ফ্রি ট্রিকস)
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
