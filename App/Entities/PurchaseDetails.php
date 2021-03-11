<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model{
    protected $fillable = [
        'price',
        'quantity'
    ];

    public function prurchace()
    {
        return $this->belongsTo(Purchase::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}