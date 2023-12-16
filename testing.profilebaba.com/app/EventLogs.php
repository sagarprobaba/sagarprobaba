<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLogs extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'event_logs';

    protected $fillable = array('name', 'data');

}
