<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class WorkTime extends Model
{

    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = str::uuid();
        });
    }
    protected $fillable = [
        'dateName',
        'fromTime',
        'toTime'
    ];
}
