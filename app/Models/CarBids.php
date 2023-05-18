<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBids extends Model
{
    use HasFactory;

    protected $primaryKey = 'bid_id';
    protected $fillable = [
        'bid_amount',
        'is_winner',
        'is_rejected',
        'is_paid',
        'paid_at',
        'car_id',
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('role', 'User');
    }
}
