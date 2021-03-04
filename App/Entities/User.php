<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class User extends Model{
    public $timestamps = false;
    protected $fillable = ['email', 'password'];
   
    protected $hidden = [
        'password',
        'create_time',
        'update_time'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}