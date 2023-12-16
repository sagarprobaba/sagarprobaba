<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\Order;
use App\Product;


class SMSController extends Controller
{



	function sms_send($mobile,$msg){

		$api_key = '461010EFAF1B57';
		$contacts = $mobile;
		$from = 'SPTSMS';
		$sms_text = urlencode($msg);

		$api_url = "http://webmsg.smsbharti.com/app/smsapi/index.php?key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=1707166619134631839";

		//Submit to server

		$response = file_get_contents( $api_url);
		return $response;
	}


	//$url = "http://180.179.218.150/sendurlcomma.aspx?user=20081791&pwd=bx2dxk&senderid=STDDAK&mobileno=$mobile&msgtext=$msg";

	function sms_send_on_new_seller_registration($mobile,$id){
		$user=User::find($id);
		$name=$user->name;

		$msg="Hi, ".$name." You have successfully registered on ".config("app.name"). " as a seller .";

		$this->sms_send($mobile,$msg);

	}


	function sms_send_on_order_status_change($mobile,$oid,$order_status){

		$msg="Your Order #".$oid." is ".$order_status;

		$this->sms_send($mobile,$msg);


	}

	function sms_send_on_order_cancelled_to_seller($mobile,$oid,$order_status){

		$msg="Order #".$oid." is ".$order_status." by the customer";

		$this->sms_send($mobile,$msg);


	}

	function sms_send_on_order_cancelled_to_admin($mobile,$oid,$order_status){

		 $msg="Order #".$oid." is ".$order_status." by the customer";


		$this->sms_send($mobile,$msg);


	}


	function sms_send_on_new_order_place_to_customer($mobile,$oid){

		$order=Order::find($oid);

		 $products_arr=unserialize($order->product_name);
		  $product_id_arr=unserialize($order->product_id);


		$product_data_arr=array();

	 	foreach($products_arr as $key=>$product){

			$product_data_arr[]=$product;

		}

		$product_data=implode(" , ",$product_data_arr);

		$msg="Thanks for your order #".$oid. " has successfully placed ";
		$msg.=" of ".$product_data;
		$msg.=" on ". config("app.name");

		$this->sms_send($mobile,$msg);


	}



	function sms_send_on_new_order_place_to_seller($mobile,$oid,$customer_name){


		$msg="New order #".$oid. " placed by ".$customer_name." on ". config("app.name").
			 ". Pls login to your dashboard to accept or reject the order. ".config("app.url")."/seller/register_login" ;

		$this->sms_send($mobile,$msg);


	}



	function sms_send_on_new_order_place_to_admin($mobile,$seller_name,$seller_id,$oid,$customer_name){


		$msg="New order #".$oid. " placed by ".$customer_name." on ". config("app.name").
			". Seller name : ".$seller_name."( ID : ".$seller_id." )";

		$this->sms_send($mobile,$msg);


	}







}
