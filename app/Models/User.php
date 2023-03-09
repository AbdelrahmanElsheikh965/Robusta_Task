<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password');

    public function seats()
    {
        return $this->hasMany('App\Models\Seat');
    }

}