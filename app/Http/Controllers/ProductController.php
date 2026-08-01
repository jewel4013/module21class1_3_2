<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdictCreatRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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
    public function show($slug)
    {
        $product = Product::with(['catagory', 'brand'])->where('slug', $slug)->firstOrFail();
        return view('auth.products.productShow', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        // ১. স্লাগ ধরে ডাটাবেজ থেকে প্রোডাক্টটি খুঁজে বের করা
        $product = Product::where('slug', $slug)->firstOrFail();
        
        // ২. ড্রপডাউনে দেখানোর জন্য সমস্ত সচল ক্যাটাগরি ও ব্র্যান্ডের ডাটা নেওয়া
        $catagories = Catagory::all();
        $brands = Brand::where('status', 1)->get();

        // ৩. ৩টি ডাটাই একসাথে এডিট ব্লেড ফাইলে পাঠানো হলো
        return view('auth.products.edit', compact('product', 'catagories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
  
    public function update(ProductUpdateRequest $request, $slug)
    {
        // ১. ডাটাবেজ থেকে এডিটেবল প্রোডাক্টটি খুঁজে বের করা
        $product = Product::where('slug', $slug)->firstOrFail();

        // ২. আপডেট ভ্যালিডেশন রুলস (ইন-লাইন দেওয়া হলো আপনার সুবিধার জন্য)
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            // ৩. নতুন নাম দিলে স্লাগ ও নাম আপডেট করা
            $validated['slug'] = Str::slug($validated['name']);

            // 🖼️ ৪. মেইন সিঙ্গেল ইমেজ আপডেট এবং ওল্ড ফাইল ক্লিনিং
            if ($request->hasFile('image')) {
                // পুরানো মেইন ছবি যদি থেকে থাকে তবে সেটি হার্ডডিস্ক থেকে ডিলিট করা হবে
                if ($product->image && File::exists(public_path($product->image))) {
                    File::delete(public_path($product->image));
                }

                $path = $request->file('image')->store('images/products', 'public');
                $validated['image'] = $path;
            } else {
                // যদি ইউজার নতুন ছবি না দেয়, তবে ডাটাবেজে যা আছে সেটাই বহাল থাকবে
                $validated['image'] = $product->image;
            }

            // 🚀 ৫. মাল্টিপল গ্যালারি ইমেজ আপডেট এবং ওল্ড গ্যালারি ক্লিনিং
            if ($request->hasFile('multiple_images')) {
                // পুরানো যতগুলো গ্যালারি ছবি ছিল সব ফাইল ডিলিট করা হলো
                if ($product->multiple_images && is_array($product->multiple_images)) {
                    foreach ($product->multiple_images as $old_gallery_path) {
                        if (File::exists(public_path($old_gallery_path))) {
                            File::delete(public_path($old_gallery_path));
                        }
                    }
                }

                // নতুন ছবিগুলো আপলোড করা
                $imageArray = [];
                foreach($request->file('multiple_images') as $image){
                    $path = $image->store('images/products', 'public');
                    $imageArray[] = $path;
                }
                $validated['multiple_images'] = $imageArray;    
            } else {
                // নতুন গ্যালারি ইমেজ না দিলে পুরোনো গ্যালারি অক্ষত থাকবে
                $validated['multiple_images'] = $product->multiple_images;
            }

            // 🎯 ৭. ডাটাবেজ আপডেট অ্যাকশন 실행
            $product->update($validated);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully with images!',
                'slug'    => $validated['slug'],
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong during update: ' . $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
