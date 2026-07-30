<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdictCreatRequest;
use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.products.products');
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
