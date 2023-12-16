<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExecutiveNumber extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'executive_number';

    protected $fillable = ['contact_number', 'status'];
}
