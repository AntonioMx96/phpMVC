<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class  Sale extends Model
{
    protected $fillable = [
        'tax',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
     {
         return $this->belongsTo(Client::class);
     }
}
