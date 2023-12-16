<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorOtherInformation extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_other_info';
    protected $fillable = array(
        "vendor_id",
        "display_time",
        "Monday_form",
        "Monday_to",
        "Tuesday_form",
        "Tuesday_to",
        "Wednesday_form",
        "Wednesday_to",
        "Thursday_form",
        "Thursday_to",
        "Friday_form",
        "Friday_to",
        "Saturday_form",
        "Saturday_to",
        "Sunday_form",
        "Sunday_to",
        "Monday_closed",
        "Tuesday_closed",
        "Wednesday_closed",
        "Thursday_closed",
        "Friday_closed",
        "Saturday_closed",
        "Sunday_closed",
        "payment_mode",
    );
}
