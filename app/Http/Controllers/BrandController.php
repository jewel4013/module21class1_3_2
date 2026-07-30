<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandCreatRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('auth.products.brands.brands', compact('brands'));
    }
    public function create(){
        return view('auth.products.brands.brandsCreate');
    }
    public function store(BrandCreatRequest $request){
        $validated = $request->validated();
        try {            
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validated['image'] = $path;
            } else {
                $validated['image'] = null; // কোনো ছবি না দিলে ডিফল্ট নাল যাবে
            }
            $validated['slug'] = Str::slug($validated['name']);
            $validated['status'] = true;
            
            Brand::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'Brand created successfully',
            ], 201);
        }   
        catch (\Exception $e) {
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }
    }
}
