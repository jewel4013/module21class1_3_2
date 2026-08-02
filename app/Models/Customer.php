<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable([
        'name', 'user_id', 'phone', 'email', 'address', 'thana', 'district'        
    ])]
class Customer extends Model
{
    //
}
