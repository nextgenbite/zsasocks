<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeCreatedOrUpdated($query, $date)
    {
        return $query->where('created_at', '>=', $date)
                     ->orWhere('updated_at', '>=', $date);
    }
}
