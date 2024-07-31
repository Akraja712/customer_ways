<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    protected $table = 'otps'; // Replace 'your_table_name' with the actual table name if it's different
    protected $fillable = [
        'mobile',
        'otp',
        'datetime',
    ];
}
