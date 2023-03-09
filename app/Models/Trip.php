<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model 
{

    protected $table = 'trips';
    public $timestamps = true;
    protected $fillable = array('name');

    public function startStation()
    {
        return $this->belongsTo('App\Models\Station', 'start_station_id');
    }

    public function endStation()
    {
        return $this->belongsTo('App\Models\Station', 'end_station_id');
    }

    public function bus()
    {
        return $this->hasOne('App\Models\Bus', 'trip_id');
    }

}