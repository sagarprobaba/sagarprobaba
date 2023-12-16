<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPlan extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_plan';

    protected $fillable=[
        'vendor_id',
        'vendor_type',
        'plan_id',
        'leads',
        'payment_mode',
        'payment_key',
        'signature',
        'transaction_id',
        'order_id',
        'status'
    ];

    public function vendor() {
        return $this->hasOne('App\Vendor', 'id', 'vendor_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'vendor_id');
    }

    public function plan() {
        return $this->hasOne('App\MembershipPlan', 'id', 'plan_id');
    }

}