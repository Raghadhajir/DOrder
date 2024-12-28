<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AllNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','content','channel_name','client_name'
    ];
    public function notification(): MorphTo
    {
        return $this->morphTo();

    }
}
