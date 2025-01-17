<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    public function latestImages(): HasOne
    {
       return $this->hasOne(Image::class)->latestOfMany();
    }
}
