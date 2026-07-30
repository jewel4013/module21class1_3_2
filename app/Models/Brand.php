<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['name', 'image', 'slug', 'description', 'status', 'is_popular', 'show_home', 'show_menu'])]
class Brand extends Model
{
    

    public function getImageUrlAttribute()
    {
        if($this->image) {
            return asset('storage/'.$this->image);
        }
        return asset('');
        // return $this->image ? Storage::url($this->image) : null;
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
