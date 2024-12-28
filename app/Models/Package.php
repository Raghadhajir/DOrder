<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;



class Package extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'image',
        'count_of_order',
        'package_price',
        'order_price'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    public function setOrderpriceAttribute()
    {
        return $this->attributes['order_price'] = $this->package_price / $this->count_of_order;
    }
    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
