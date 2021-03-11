<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function privider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function purchaceDetails()
    {
        return $this->hasMany(PurchaseDetails::class);
    }
}