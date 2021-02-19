<?php
namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $fillable = ['email', 'password'];
    public $timestamps = false;
}