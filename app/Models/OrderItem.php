<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];

     public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }
     public function order(){
    	return $this->belongsTo(Order::class,'order_id','id');
    }

    public function scopeCreatedOrUpdated($query, $date)
    {
        return $query->where('created_at', '>=', $date)
                     ->orWhere('updated_at', '>=', $date);
    }
}
