<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model 
{

    protected $table = 'seats';
    public $timestamps = true;
    protected $fillable = array('name');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function bus()
    {
        return $this->belongsTo('App\Models\Bus');
    }

}