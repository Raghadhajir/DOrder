<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerToken extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id','mobile','token'
    ];
    protected $hidden=[
        'uuid'
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
}
