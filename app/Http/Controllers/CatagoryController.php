<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatagoryStoreRequest;
use App\Models\Catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catagories = Catagory::orderBy('name', 'asc')->get();
        return view('auth.products.catagories.catagories', compact('catagories'));
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
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $imageName = time() . '_main.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(storage_path('app/public/images/catagories'), $imageName);
                $validated['image'] = 'images/catagories/' . $imageName;
            } else {
                $validated['image'] = null; // কোনো ছবি না দিলে ডিফল্ট নাল যাবে
            }
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $bannerName = time() . '_main.' . $bannerFile->getClientOriginalExtension();
                $bannerFile->move(storage_path('app/public/images/catagories/banners'), $bannerName);
                $validated['banner'] = 'images/catagories/banners/' . $bannerName;
            } else {
                $validated['banner'] = null; // কোনো ছবি না দিলে ডিফল্ট নাল যাবে
            } 
            Catagory::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'Catagory created successfully',
            ], 201);
        } catch (\Exception $e) {
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
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
