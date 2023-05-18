<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $primaryKey = 'car_id';
    protected $fillable = [
        'car_name',
        'slug',
        'description',
        'image',
        'car_type',
        'price',
        'expiry_date',
        'category_id',
        'brand_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('role', 'User');
    }

    public function category()
    {
        return  $this->belongsTo(CarCategory::class, "category_id", "category_id");
    }

    public function brand()
    {
        return  $this->belongsTo(CarBrands::class, "brand_id", "brand_id");
    }

    public function gallery()
    {
        return $this->hasMany(CarGallery::class, 'car_id', 'car_id');
    }
    public function bids()
    {
        return $this->hasMany(CarBids::class, 'car_id', 'car_id');
    }

    public function comments()
    {
        return $this->hasMany(CarComment::class ,'car_id', 'car_id');
    }
}
