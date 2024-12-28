<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    public function Areas()
    {
        return $this->hasMany(Area::class);
    }
}
