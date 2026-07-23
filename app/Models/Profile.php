<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'phone', 'address', 'avatar'])]
class Profile extends Model
{
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function getAvatarUrlAttribute()
    {
        if($this->avatar) {
            return asset('storage/'.$this->avatar);
        }
        return asset('images/defaultAvatar.png');
        // return $this->avatar ? Storage::url($this->avatar) : null;
    }
}
