<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'description', 'image', 'banner', 'is_popular')]
class Catagory extends Model
{
    //
}
