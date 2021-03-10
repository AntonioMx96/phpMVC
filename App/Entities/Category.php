<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $fillable = [
        'name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Prodcut::class);
    }

    public function exists($name, $model=null){
        $query=$this::where('name', '=',$name)->get();
        if($query[0]){
            if($model->name==$query[0]->name){
                return false;
            }
            return true;
        }else{
            return false;
        }
    }
}