<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScrapperHost extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'scrapper_host';

    protected $fillable = array('url');

}
