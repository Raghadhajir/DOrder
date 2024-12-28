<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body','order_id', 'user_id', 'read'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Order(){
        return $this->belongsTo(Order::class);
    }

}
