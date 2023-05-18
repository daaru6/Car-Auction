<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistrationAmount extends Model
{
    use HasFactory;

    protected  $table  = 'user_registration_amounts';
    protected $fillable = [
        'amount', 
    ];
}
