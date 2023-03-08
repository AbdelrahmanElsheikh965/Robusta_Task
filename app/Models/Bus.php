<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model 
{

    protected $table = 'buses';
    public $timestamps = true;
    protected $fillable = array('seats');

    public function trip()
    {
        return $this->belongsTo('App\Models\Trip');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}