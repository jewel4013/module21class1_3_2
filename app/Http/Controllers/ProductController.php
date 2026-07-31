<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdictCreatRequest;
use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('auth.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catagories = Catagory::all();
        $brands = Brand::all();
        return view('auth.products.productsCreate', compact('catagories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdictCreatRequest $request)
    {
        $validated = $request->validated();
        try{
            $validated['slug'] = Str::slug($validated['name']);
            $validated['status'] = true;
            if($request->hasFile('image')){
                $path = $request->file('image')->store('images/products', 'public');
                $validated['image'] = $path;
            }
            if($request->hasFile('multiple_images')){
                $imageArray = [];
                foreach($request->file('multiple_images') as $image){
                    $path = $image->store('images/products', 'public');
                    $imageArray[] = $path;
                }
                $validated['multiple_images'] = $imageArray;    
            }            

            // return $validated;
            Product::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'Product created successfully',
            ], 201);    
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
