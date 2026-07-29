<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'image', 'banner', 'is_popular', 'show_home', 'show_menu'])] 
class Catagory extends Model
{
    public function getImageUrlAttribute()
    {
        if($this->image) {
            return asset('storage/'.$this->image);
        }
        return asset('');
        // return $this->image ? Storage::url($this->image) : null;
    }
    public function getBannerUrlAttribute()
    {
        if($this->banner) {
            return asset('storage/'.$this->banner);
        }
        return asset('');
        // return $this->banner ? Storage::url($this->banner) : null;
    }
}
