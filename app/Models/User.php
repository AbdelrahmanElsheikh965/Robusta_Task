<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password');
    protected $hidden = ['password', 'password_confirmation'];

    public function bus()
    {
        return $this->belongsTo('App\Models\Bus');
    }

}
