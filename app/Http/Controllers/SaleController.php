<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleStoreRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetaills;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::all();
        $todaySales = Sale::wheredate('sale_date', Carbon::now())->get();
        $lastMonthSales = Sale::whereBetween('sale_date',[
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
         ])->get();
         $lastYearSales = Sale::whereBetween('sale_date',[
            Carbon::now()->subYear()->startOfYear(),
            Carbon::now()->subYear()->endOfYear()
         ])->get();
        
        return view('auth.sales.sales', compact(['sales', 'todaySales', 'lastMonthSales', 'lastYearSales']));
    }

    public function create(){
        $products = Product::all();
        $customers = Customer::all();
        return view('auth.sales.salesCreate', compact('products', 'customers'));
    }

    public function store(SaleStoreRequest $request){
        
        // ২. সার্চ এবং বারকোড স্ক্যান এরিয়া
        $validated = $request->validated();
        $cartItems = $request->input('cart');
        DB::beginTransaction();
        try {
            // 🎯 নাম থেকে স্লাগ তৈরি করা এবং স্ট্যাটাস লক করা
            $validated['user_id'] = Auth::id();
            $validated['sale_date'] = date('Y-m-d H:i:s');
            
            $sale = Sale::create($validated); 
            $saleDetail = [];
            foreach($cartItems as $item){
                $totalPrice = $item['price'] * $item['quantity'];
                $saleDetail = [
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $totalPrice,
                ];
                SaleDetaills::create($saleDetail);
                Product::where('id', $item['id'])->decrement('stock_quantity', $item['quantity']);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Sale created successfully',
            ], 201);    
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }    
    }
    public function showInvoice($invoice_no){
       // 🎯 Eager Loading রিলেশনশিপ চেইন: এক ক্লিকে কাস্টমার এবং প্রোডাক্টের ডাটা তুলুন
        $sale = Sale::with(['saleDetaills.product', 'customer'])->where('invoice_no', $invoice_no)->firstOrFail();    
        return view('auth.sales.invoice', compact('sale'));
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
            ->select('id', 'name', 'product_code', 'product_price', 'image', 'brand_id', 'stock_quantity')
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
