<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
     'content','quantity','price','total','delivary_id','order_id'
    ];
    public function Order(){
        return $this->belongsTo(Order::class);
    }
    public function Delivary(){
        return $this->belongsTo(Delivery::class);
    }
}
