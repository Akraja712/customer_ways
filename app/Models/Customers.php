<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customers extends Model
{
    use Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'customer_user_id', 'user_id', 'datetime','status',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    
    public function customerUser()
    {
        return $this->belongsTo(Users::class, 'customer_user_id');
    }
}

