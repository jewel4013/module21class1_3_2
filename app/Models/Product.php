<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable([
        'name', 'slug', 'product_code', 'brand_id', 'category_id', 'priority', 
        'image', 'product_cost', 'product_price', 'multiple_images', 
        'description', 'status', 'is_popular', 'show_home', 'show_menu'
    ])]    
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'multiple_images' => 'array',
        ];
    }

    public function catagory(){
        return $this->belongsTo(Catagory::class, 'category_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function getImageUrlAttribute()
    {
        if($this->image) {
            return asset('storage/'.$this->image);
        }
        return asset('');
        // return $this->image ? Storage::url($this->image) : null;
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
