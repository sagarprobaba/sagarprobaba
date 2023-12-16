<?php

namespace App\Helpers;

class StaticArray{

	public static function status(){
		return [
			1 => 'Active',
			2 => 'Inactive',
		];
	}

	public static function experience(){
		return [
			'0' => 'Select Experience',
			'< 5 Years' => '< 5 Years',
			'5-10 Years' => '5-10 Years',
			'10-15 Years' => '10-15 Years',
			'15-20 Years' => '15-20 Years',
			'20-25 Years' => '20-25 Years',
			'25-30 Years' => '25-30 Years',
			'30-35 Years' => '30-35 Years',
			'35-40 Years' => '35-40 Years',
			'40-45 Years' => '40-45 Years',			
		];
	}
	public static function verifiedstatus(){
		return [
			'0' => 'Select Status',
			'Yes' => 'Verified',
			'No' => 'Not Verified',
		];
	}

	public static function status2(){
		return [
			1 => 'Active',
			0 => 'Inactive',
		];
	}

	public static function gender(){
		return [
			"Male" => "Male",
			"Female" => "Female",
		];
	}

	public static function contact_person_label(){
		return [
			"Mr" => "Mr",
			"Mrs" => "Mrs",
			"Miss" => "Miss",
		];
	}

	public static function payment_modes(){
		return [
			"Cash" => "Cash",
			"Master Card" => "Master Card",
			"Visa Card" => "Visa Card",
			"Debit Cards" => "Debit Cards",
			"Money Orders" => "Money Orders",
			"Cheques" => "Cheques",
			"Credit Card" => "Credit Card",
			"Travelers Cheque" => "Travelers Cheque",
			"Financing Available" => "Financing Available",
			"American Express Card" => "American Express Card",
			"Diners Club Card" => "Diners Club Card",
			"Paytm" => "Paytm",
			"G Pay" => "G Pay",
			"UPI" => "UPI",
			"BHIM" => "BHIM",
			"JD Pay" => "JD Pay",
			"Airtel Money" => "Airtel Money",
			"Oxigen" => "Oxigen",
			"Sodexo Meal Card" => "Sodexo Meal Card",
			"Cash on Delivery" => "Cash on Delivery",
			"Card on Delivery" => "Card on Delivery",
			"Payumoney" => "Payumoney",
			"PhonePe" => "PhonePe",
			"NEFT" => "NEFT",
			"RTGS" => "RTGS",
			"IMPS" => "IMPS",
			"Demand Draft" => "Demand Draft",
			"Amazon Pay" => "Amazon Pay",
			"Pockets by ICICI" => "Pockets by ICICI",
			"RuPay Card" => "RuPay Card",
			"Ola Money" => "Ola Money",
		];
	}

	public static function hour(){
		return [
		    "Open 24 Hrs" => "Open 24 Hrs",
            "01:00 AM" => "01:00 AM",
            "01:30 AM" => "01:30 AM",
            "02:00 AM" => "02:00 AM",
            "02:30 AM" => "02:30 AM",
            "03:00 AM" => "03:00 AM",
            "03:30 AM" => "03:30 AM",
            "04:00 AM" => "04:00 AM",
            "04:30 AM" => "04:30 AM",
            "05:00 AM" => "05:00 AM",
            "05:30 AM" => "05:30 AM",
            "06:00 AM" => "06:00 AM",
            "06:30 AM" => "06:30 AM",
            "07:00 AM" => "07:00 AM",
            "07:30 AM" => "07:30 AM",
            "08:00 AM" => "08:00 AM",
            "08:30 AM" => "08:30 AM",
            "09:00 AM" => "09:00 AM",
            "09:30 AM" => "09:30 AM",
            "10:00 AM" => "10:00 AM",
            "10:30 AM" => "10:30 AM",
            "11:00 AM" => "11:00 AM",
            "11:30 AM" => "11:30 AM",
            "12:00 AM" => "12:00 AM",
            "01:00 PM" => "01:00 PM",
            "01:30 PM" => "01:30 PM",
            "02:00 PM" => "02:00 PM",
            "02:30 PM" => "02:30 PM",
            "03:00 PM" => "03:00 PM",
            "03:30 PM" => "03:30 PM",
            "04:00 PM" => "04:00 PM",
            "04:30 PM" => "04:30 PM",
            "05:00 PM" => "05:00 PM",
            "05:30 PM" => "05:30 PM",
            "06:00 PM" => "06:00 PM",
            "06:30 PM" => "06:30 PM",
            "07:00 PM" => "07:00 PM",
            "07:30 PM" => "07:30 PM",
            "08:00 PM" => "08:00 PM",
            "08:30 PM" => "08:30 PM",
            "09:00 PM" => "09:00 PM",
            "09:30 PM" => "09:30 PM",
            "10:00 PM" => "10:00 PM",
            "10:30 PM" => "10:30 PM",
            "11:00 PM" => "11:00 PM",
            "11:30 PM" => "11:30 PM",
            "12:00 PM" => "12:00 PM",
            "Closed" => "Closed"
		];
	}
	
	// public static function admin_role(){
	// 	return [
	// 		'admin' => 'Admin',
	// 		'member' => 'Member',
	// 	];
	// }

}