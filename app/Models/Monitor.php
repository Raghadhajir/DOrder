<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'area_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Area()
    {
        return $this->belongsTo(Area::class);
    }

    
}
