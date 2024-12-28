<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','area_id','monitor_id'
    ];
    public function User(){
        return $this->belongsTo(User::class );
    }
    public function Area(){
        return $this->belongsTo(Area::class);
    }
    public function Monitor(){
        return $this->belongsTo(Monitor::class);
    }
    public function Orders(){
        return $this->hasMany(Order::class);
    }
    public function Invoices(){
        return $this->hasMany(Invoice::class);
    }

}
