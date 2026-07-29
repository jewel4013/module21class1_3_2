<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatagoryStoreRequest;
use App\Models\Catagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.products.catagories.catagories');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.products.catagories.catagoriesCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatagoryStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Catagory::create($validated);
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validated['image'] = $path;
            } else {
                $validated['image'] = null; // কোনো ছবি না দিলে ডিফল্ট নাল যাবে
            }
            if ($request->hasFile('banner')) {
                $path = $request->file('banner')->store('images', 'public');
                $validated['banner'] = $path;
            } else {
                $validated['banner'] = null; // কোনো ছবি না দিলে ডিফল্ট নাল যাবে
            }   
            return response()->json([
                'status' => true,
                'message' => 'Catagory created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Catagory $catagory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catagory $catagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catagory $catagory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catagory $catagory)
    {
        //
    }
}
