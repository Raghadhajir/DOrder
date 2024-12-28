<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'order','status','uuid','delivary_id','scheduledTime','estimatedTime','address_id','startDelivaryTime','receivedTime','canceled'
        ,'order_number','cancelNote','user_id','rate'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    public function Delivary(){
        return $this->belongsTo(Delivery::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Address(){
        return $this->belongsTo(Address::class);
    }
    public function AdminNotifications(){
        return $this->hasMany(AdminNotification::class);
    }
    public function Invoices(){
        return $this->hasMany(Invoice::class);
    }
    public function UserGeneralNotification(){
        return $this->hasMany(UserGeneralNotification::class);
    }
    public function notifications(): MorphMany
    {
        return $this->morphMany(AllNotification::class, 'notification');
    }
}
