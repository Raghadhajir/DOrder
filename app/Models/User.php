<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'package_id',
        'profile_image',
        'subscription_fees',
        'date_subscribe',
        'address',
        'notes',
        'type',
        'active',
        'expire',
        'area_id'
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    public function Package()
    {
        return $this->belongsTo(Package::class);

    }
    public function Area()
    {
        return $this->belongsTo(Area::class);
    }
    public function CustomerTokens()
    {
        return $this->hasMany(CustomerToken::class);

    }
    public function UserGeneralNotifications()
    {
        return $this->hasMany(UserGeneralNotification::class);

    }
    public function Monitors()
    {
        return $this->hasMany(Monitor::class);

    }
    public function AdminNotifications()
    {
        return $this->hasMany(AdminNotification::class);

    }
    public function Orders()
    {
        return $this->hasMany(Order::class);

    }
    public function RateServices()
    {
        return $this->hasMany(RateService::class);

    }
    public function ContactUs()
    {
        return $this->hasMany(ContactUs::class);

    }
    public function Deliveries()
    {
        return $this->hasMany(Delivery::class);

    }
    public function Addresses()
    {
        return $this->hasMany(Address::class);

    }
    public function notifications(): MorphMany
    {
        return $this->morphMany(AllNotification::class, 'notification');
    }
}
