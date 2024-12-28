<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateService extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rate',
        'review',
        'service_id'
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
}
