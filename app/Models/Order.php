<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderitem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeCreatedOrUpdated($query, $date)
    {
        return $query->where('created_at', '>=', $date)
                     ->orWhere('updated_at', '>=', $date);
    }

    public function scopeCreatedOrUpdatedToday($query)
    {
        $today = Carbon::today();
        return $query->whereDate('created_at', $today)
                     ->orWhereDate('updated_at', $today);
    }
}
