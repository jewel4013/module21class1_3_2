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
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function saleDetaills(){
        return $this->hasMany(SaleDetaills::class);
    }
    protected static function booted(){
        static::creating(function($sale){
            $latestSale = Sale::latest('id')->first();
            $nextId = $latestSale ? $latestSale->id + 1 : 1;
            $sequentialCode = str_pad($nextId, 6, '0', STR_PAD_LEFT);

            $sale->invoice_no = 'INV-'.$sequentialCode;
        });
    }
}
