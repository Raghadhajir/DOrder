<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Address extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','address','area_id'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Area()
    {
        return $this->belongsTo(Area::class);
    }
    public function Orders()
    {
        return $this->hasMany(Order::class);

    }
}
