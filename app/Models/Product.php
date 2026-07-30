<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    

    public function catagory(){
        return $this->belongsTo(Catagory::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }


    protected static function booted(){
        static::creating(function($product){
            $latestProduct = Product::latest('id')->first();
            $nextId = $latestProduct ? $latestProduct->id + 1 : 1;
            $sequentialCode = str_pad($nextId, 6, '0', STR_PAD_LEFT);

            $product->product_code = 'SW-'.$sequentialCode;
        });
    }
}
