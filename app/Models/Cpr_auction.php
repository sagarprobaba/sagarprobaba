<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpr_auction extends Model
{
    use HasFactory;

    protected $casts = [
        'applydate' => 'datetime',
      ];
}
