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
        return $this->belongsTo('App\Models\Trip', 'trip_id');
    }

    public function seats()
    {
        return $this->hasMany('App\Models\Seat');
    }

}