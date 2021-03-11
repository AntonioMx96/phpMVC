<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model{
    protected $fillable = [
        'quantity',
        'price',
        'discount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}