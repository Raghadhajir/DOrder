<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class Area extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'city_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    public function City()
    {
        return $this->belongsTo(City::class);
    }
    public function Deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
    public function Monitors()
    {
        return $this->hasMany(Monitor::class);
    }

}
