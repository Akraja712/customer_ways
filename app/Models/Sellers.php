<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sellers extends Model
{
    use HasFactory;

    protected $fillable = [
        'your_name',
        'store_name',
        'mobile',
        'email',
        'category',
        'store_address',
        'seller_status',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
