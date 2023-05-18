<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'name',
        'email',
        'user_id',
        'car_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class ,'car_id', 'car_id');
    }
}
