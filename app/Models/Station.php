<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model 
{

    protected $table = 'stations';
    public $timestamps = true;
    protected $fillable = array('name');

    public function startTrips()
    {
        return $this->hasMany('App\Models\Trip', 'start_station_id');
    }

    public function endTrips()
    {
        return $this->hasMany('App\Models\Trip', 'end_station_id');
    }

}