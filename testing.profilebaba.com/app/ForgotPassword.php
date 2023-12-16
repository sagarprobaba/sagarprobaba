<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'forgot_password';
    protected $fillable = array("user_id", "otp","verify_type");

    function user(){
      return $this->hasOne('App\User', 'id', 'user_id');
    }
}
