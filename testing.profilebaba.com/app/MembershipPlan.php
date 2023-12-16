<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'membership_plan';

    protected $fillable = array('title', 'plan_type', 'area', 'price_per_lead', 'total_price', 'lead','min_lead','description');

}
