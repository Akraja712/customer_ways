<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Products extends Authenticatable
{
    use Notifiable;

    protected $guard = 'products';

    protected $table = 'products';


    protected $fillable = [
        'product_type', 'location','from_date', 'to_date', 'product_title','product_description','user_id','product_datetime','product_status','product_image', // Add 'mobile' to the fillable fields
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function scopeFilterByStatus($query, $product_status)
    {
        if ($product_status !== null) {
            return $query->where('product_status', $product_status);
        }
        return $query;
    }
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($mobile)
    {
        return $this->where('mobile', $mobile)->first();
    }
    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }
}
