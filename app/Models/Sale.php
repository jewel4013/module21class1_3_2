<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable([
    'user_id',
    'customer_id',
    'invoice_no',
    'sale_date',
    'sub_total',
    'discount',
    'grand_total',
    'paid_amount',
    'due_amount',
    'payment_type'
])]
class Sale extends Model
{
    //
}
