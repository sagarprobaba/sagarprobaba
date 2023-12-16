<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use App\Vendor;
use App\VendorContactInformation;
use App\VendorOtherInformation;
use App\VendorImages;
use App\VendorCategory;
use App\VendorServiceLocation;

use Auth;
use Response;
use Mail;
use Validator;
use Redirect;
use DB;
use Image;
use Hash;
use File;
use App\Classes\GeniusMailer;
use Laravel\Socialite\Facades\Socialite;
use Grimzy\LaravelMysqlSpatial\Types\Point;

use Softon\Indipay\Facades\Indipay;

class BusinessController extends Controller
{

    public function general_information(Request $request){
        $data = new Vendor;
        if($request->id) {
            $data = Vendor::where('id', $request->id)->first();
        }
        return view('user.business.general_information', compact('data'));
    }

    public function general_information_save(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        $user['is_vendor'] = '1';
        $user->save();
        $records['user_id'] = Auth::user()->id;
        $records['business_name'] = $request->business_name;
        $records['about_me'] = $request->about_me;
        $records['slug'] = str_replace(' ','-',strtolower($request->business_name));
        if ($request->hasFile('file')) {
			if ($request->file('file')->isValid()) {

                $this->validate($request, [
                    'file' => 'mimes:jpeg,jpg,png,gif'
                ]);

				$fileName = $request->file('file')->extension();
				$fileName =time()."_b.".$fileName;
				//upload
				$request->file('file')->move('uploads/users/', $fileName);
				//column name
				$records['logo']=$fileName;
			}
		}
        if($request->id == ''){
            $vendor = new Vendor;
        }
        else{
            $vendor = Vendor::where('id',$request->id)->first();
        }
        
        $vendor->fill($records);
        if($vendor->save()){

            // ----------LocationInformationCategory------------- //
            $categories = array();
            $category = $request->category;

            VendorCategory::where('vendor_id', $vendor->id)->delete();
            if ($category){
                foreach ($category as $category_one) {
                    $categories[] = array('vendor_id' => $vendor->id, 'category_id' => $category_one);
                }
                VendorCategory::insert($categories);
            }
            // ----------Inserting LocationInformationCategory------------- //

        }

        $plan['vendor_id'] = $records['user_id'];
        $plan['plan_id'] = 1;
        $plan['leads'] = 10;
        $plan['payment_mode'] = 'cash';
        $plan['payment_key'] = "";
        $plan['signature'] = "";
        $plan['transaction_id'] = "";
        $plan['order_id'] = "";
        $plan['status'] = '1';
        VendorPlan::create($plan);
        
        return Redirect::route('user.business_contact',['vendor'=>$vendor->id])->with('message', 'Successfully Updated!');

    }

    public function business_profile(Request $request){

        $data = Vendor::where(['user_id'=>Auth::user()->id])->get();
        return view('user.business.profile',compact(
            'data',
        ));
    }

    public function business_contact(Request $request){
        $data = new VendorContactInformation;
        $vendor = '';
        if($request->vendor) {
            $data = VendorContactInformation::where('vendor_id', $request->vendor)->first();
            $vendor = $request->vendor;
        }
        return view('user.business.contact_Information',compact(
            'data','vendor'
        ));
    }

    public function business_contact_save(Request $request){
        $this->validate($request, [
			'mobile_number' => "required",
			'email' => "required",
            'country' => "required",
            'state' => "required",
            'city' => "required",
            'pincode' => "required",
		]);

        $records = $request->all();
        if($request->google_location != ''){
            $arr = explode(',',explode('@',$request->google_location)[1]);
            $records['lat_lng'] = new Point($arr[0],$arr[1]);
        }
        if($request->id == '') {
            $contact_information = new VendorContactInformation;
        }
        else{
            $contact_information = VendorContactInformation::where('id',$request->id)->first();
        }

        $contact_information->fill($records);
		$contact_information->save();

        return Redirect::route('user.service_location',['vendor'=>$request->vendor_id])->with('message', 'Successfully Updated!');

    }

    public function service_location(Request $request){
        $data = new VendorServiceLocation;
        $vendor = '';
        if($request->vendor) {
            $data = VendorServiceLocation::where('vendor_id', $request->vendor)->get();
            $vendor = $request->vendor;
        }
        return view('user.business.service_location',compact(
            'data','vendor'
        ));
    }

    public function service_location_save(Request $request){

        $records['vendor_id'] = $request->vendor_id;
        $records['status'] = '1';
        if($request->service_location){
            VendorServiceLocation::where('vendor_id', $request->vendor_id)->delete();
            $location = json_decode($request->service_location);
            foreach($location as $loc){
                $service_loc = new VendorServiceLocation;
                $records['service_location'] = $loc[0];
                $records['lat_lng'] = new Point($loc[1]->lat,$loc[1]->lng);
                $service_loc->fill($records);
                $service_loc->save();
            }
        }

        return Redirect::route('user.business_other',['vendor'=>$request->vendor_id])->with('message', 'Successfully Updated!');

    }

    public function business_other(Request $request){
        $data = new VendorOtherInformation;
        $vendor = '';
        if($request->vendor) {
            $data = VendorOtherInformation::where('vendor_id', $request->vendor)->first();
            $vendor = $request->vendor;
        }
        return view('user.business.other_Information',compact(
            'data','vendor'
        ));
    }
    public function business_other_save(Request $request){
        $records = $request->all();
        VendorOtherInformation::where('vendor_id', $request->vendor_id)->delete();
        $other_inormation = new VendorOtherInformation;
        $records['payment_mode'] = implode(", ", $request->payment_mode ?? []);

        $records['Monday_closed'] = isset($request->Monday_closed) ? 'closed' : '';
        $records['Tuesday_closed'] = isset($request->Tuesday_closed) ? 'closed' : '';
        $records['Wednesday_closed'] = isset($request->Wednesday_closed) ? 'closed' : '';
        $records['Thursday_closed'] = isset($request->Thursday_closed) ? 'closed' : '';
        $records['Friday_closed'] = isset($request->Friday_closed) ? 'closed' : '';
        $records['Saturday_closed'] = isset($request->Saturday_closed) ? 'closed' : '';
        $records['Sunday_closed'] = isset($request->Sunday_closed) ? 'closed' : '';

        $other_inormation->fill($records);
		$other_inormation->save();

        return Redirect::route('user.business_upload_video',['vendor'=>$request->vendor_id])->with('message', 'Successfully Updated!');
    }

    public function business_Business(Request $request){
        $item = Auth::user();

        return view('user.business.business_keywords',compact(
            'item',
        ));
    }

    public function business_upload_video(Request $request){
        $data = new VendorImages;
        $vendor = '';
        if($request->vendor) {
            $data = VendorImages::where('vendor_id', $request->vendor)->first();
            $vendor = $request->vendor;
        }
        return view('user.business.upload_video_logo_pictures',compact(
            'data','vendor'
        ));
    }

    public function business_upload_video_save(Request $request){
        $records = $request->all();
        $item = Vendor::find($request->vendor_id);
        $upload_video_logopicture_size = $item->vendor_images()->where('type','file')->sum('size');

        $records['type'] = 'file';
        
        $image = $request->file('file');

		$size = $image->getSize();

        $upload_video_logopicture_size_n = $size+$upload_video_logopicture_size;
        $upload_video_logopicture_size_n = number_format($upload_video_logopicture_size_n / 1048576,2);

        $space = 5 - number_format($upload_video_logopicture_size / 1048576,2);
        if ($upload_video_logopicture_size_n > 5) {
            return response()->json('Maximum file size allowed for upload: '.$space.' MB', 400);
        }

    	$fileInfo = $image->getClientOriginalName();
    	$filename = pathinfo($fileInfo, PATHINFO_FILENAME);
    	$extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
    	$file_name= $filename.'-'.time().'.'.$extension;
    	$image->move('uploads/users/',$file_name);
    		
		
		//column name 
		$records['file']=$file_name;
		$records['size']=$size;

        $upload_video_logopicture = new VendorImages;
        $upload_video_logopicture->fill($records);
		$upload_video_logopicture->save();

        return Redirect::back()->with('message', 'Successfully Updated!');
    }

    public function business_upload_video_delete($id){
        $upload_video_logopictur = VendorImages::find($id);

        if ($upload_video_logopictur){
            $oldimg = base_path('uploads/users/'. $upload_video_logopictur->file);
            if (File::exists($oldimg)){
                File::delete($oldimg);
            }
            $upload_video_logopictur->delete();

            return Redirect::back()->with('message', 'Successfully Deleted!');

        }

        return Redirect::back();
    }
}
