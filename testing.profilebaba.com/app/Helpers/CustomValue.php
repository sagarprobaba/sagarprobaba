<?php
namespace App\Helpers;
use File;
use DateTime;

class CustomValue {

    public function getInputValue($path)
    {
        return old('title');
    }

    public function filecheck($filename,$filepat)
    {	
        $notfound = asset('uploads/users/1604701337_default.jpg'); 

        if (!empty($filename)) {

            $filepatready = base_path($filepat."".$filename);

        	$backimage = asset($filepat."".$filename);

            if (File::exists($filepatready)){

                return $backimage;

            }else{

                return $notfound;

            }

        }else{

            return $notfound;
            
        }
    }

    public function check_url($url){

        if (empty($url) || $url=='#' || $url=='#;'){
            
            return '#;';
           
        }
        return url($url);
    }

    
    public function displayStatus($index) {
        $status = ['New', 'Assigned', 'Open', 'Closed'];
        return $status[$index];
    }

    public function getTime($date) {
        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime('now');
        $interval = $datetime1->diff($datetime2);
        $secs = $interval->s;
        $mins = $interval->i;
        $hrs = $interval->h;
        $days = $interval->d;
        $mnths = $interval->m;
        $yrs = $interval->y;
        $time = $yrs > 0 ? $yrs." years " : ($mnths > 0 ? $mnths." months " : ($days > 0 ? $days." days " : ($hrs > 0 ? $hrs." hours " : ($mins > 0 ? $mins." minutes " : $secs." seconds"))));

        return $time." ago";
    }

    public function showTime($date) {
        return date_format($date, 'G:ia');
    }

    public function getDistance($given_location, $loc){
        $location = [];
        $location['lat'] = gettype($given_location) == 'array' ? $given_location['lat'] : $given_location->getlat();
        $location['lng'] = gettype($given_location) == 'array' ? $given_location['lng'] : $given_location->getlng();
        if($location['lat'] == ""){
            return 0;
        }
        $theta = $location['lng'] - $loc->lat_lng->getlng();
        $distance = sin(deg2rad($location['lat'])) * sin(deg2rad($loc->lat_lng->getlat())) + cos(deg2rad($location['lat'])) * cos(deg2rad($loc->lat_lng->getlat())) * cos(deg2rad($theta));
            
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515;
            
        $distance = $distance * 1.609344;
        return $distance;
    }

    /*public function getGoogleDistance($location, $loc){
        if($location['lat'] == ""){
            return 0;
        }
        $theta = $location['lng'] - $loc[1];
        $distance = sin(deg2rad($location['lat'])) * sin(deg2rad($loc[0])) + cos(deg2rad($location['lat'])) * cos(deg2rad($loc[0])) * cos(deg2rad($theta));
            
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515;
            
        $distance = $distance * 1.609344;
        return $distance;
    }*/


    /*public function getGoogleDistance($lat, $lng){
        //die('C2');
        if($lat == ""){
            return 0;
        }
        $theta = $lng - $lat;
        $distance = sin(deg2rad($lat)) * sin(deg2rad($lng)) + cos(deg2rad($lat)) * cos(deg2rad($lat)) * cos(deg2rad($theta));
            
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515;
        //echo $distance; die;
            
        $distance = $distance * 1.609344;
        return $distance;
    }*/
	
	public function getGoogleDistance($lat1,$lng1,$lat2,$lng2){
		//echo $lat1.'--'.$lng1.'--'.$lat2.'--'.$lng2;
		
		if (($lat1 == $lat2) && ($lng1 == $lng2) || ($lat1=="") ) {
			return 0;
		}
		else {
			$theta = $lng1 - $lng2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$distance = ($miles * 1.609344);
			return round($distance,1); 
		}
	}

}
