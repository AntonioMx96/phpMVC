<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name',
        'email',
        'rfc',
        'phone',
        'address'
    ];

    public function products()
    {
        return $this->hasMany(Prodcut::class);
    }

    public function exists($name, $model = null)
    {
        $query_name = $this::where('name', '=', $name)->get();
        $query_email =  $this::where('email', '=', $name)->get();
        $query_rfc =  $this::where('rfc', '=', $name)->get();
        if ($query_name[0]) {
     
            if ($model->name == $query_name[0]->name) {
                return false;
            }
            return true;
        } else if ($query_email[0]) {
            if ($model->email == $query_email[0]->email) {
                return false;
            }
            return true;
        } else if ($query_rfc[0]) {
            if ($model->rfc == $query_rfc[0]->rfc) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
