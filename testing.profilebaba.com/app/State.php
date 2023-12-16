<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'state';

    protected $fillable = array(
        "country_id", 
        "name", 
        "status", 
    );

    function country(){
        return $this->hasOne('App\Country', 'id', 'country_id');
    }
}