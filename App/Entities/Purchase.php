<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model 
{
    protected $fillable = [
        'purchase_date',
        'tax',
        'total',
        'status',
        'picture'
    ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }

     public function provider()
     {
         return $this->belongsTo(Provider::class);
     }

     public function purchaceDetails()
     {
         return $this->hasMany(PurchaseDetails::class);
     }
}
