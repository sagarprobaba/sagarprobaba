<?php

namespace App\Http\Controllers;

use App\Models\addressLowerTable;
use App\Models\companyLowerTable;
use App\Models\employeeLowerTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cpr_ad_category;
use App\Models\webUser;

class AjexController extends Controller
{
    //
    public function ajaxcity(Request $request)
    {
        $state = $request->state;
        $data = DB::table('cities')->where('state_id', $state)->get();

        // $unit = $data->unitId;

        // $unitName = DB::table('units')->where('id', $unit)->get();
        $html = '';

        foreach ($data as $un) {
            $html .= '<option value ='.$un->id.'>' . $un->name . '</option>';
        }

        return $html;
    }
    
    function addfieldname(Request $request)
    {
        $cnt = addressLowerTable::where('Uperid',0)->count('id');
        $idvalue= "a".$cnt+1;
        $array1 = array('a1','a2','a3','a4','a5','a6','a7','a8','a9','a10');
        $array2 = array('a1','a2','a3','a4','a5','a6','a7','a8','a9','a10');
        $array3 = addressLowerTable::where('Uperid',0)->get();
        if (sizeof($array3)>0) {
            foreach ($array3 as $row) {
                for ($i=0;$i<10;$i++) {
                    if ($row->columnId == $array2[$i]) {
                        unset($array1[$i]);
                    }
                }
            }
            array_values($array1);
            $idvalue = reset($array1);
        } 
        $data  = new addressLowerTable();
        $data->field = $request->fieldname;
        $data->columnId = $idvalue;
        $data->userId = $request->userId;
        $data->save();
        return json_encode($data,true);
    }
    public function fatchinput(Request $request)
    {
        return  $data = addressLowerTable::where('Uperid',0)->where('userId',$request->userId)->get();
         
    }
    public function removeDiv(Request $request)
    {
        addressLowerTable::whereid($request->id)->delete();
        return $request->id;
    }
    
    function companyaddfieldname(Request $request)
    {
        $cnt = companyLowerTable::where('Uperid',0)->count('id');
        $idvalue= "a".$cnt+1;
        $array1 = array('a1','a2','a3','a4','a5','a6','a7','a8','a9','a10');
        $array2 = array('a1','a2','a3','a4','a5','a6','a7','a8','a9','a10');
        $array3 = companyLowerTable::where('Uperid',0)->get();
        if (sizeof($array3)>0) {
            foreach ($array3 as $row) {
                for ($i=0;$i<10;$i++) {
                    if ($row->columnId == $array2[$i]) {
                        unset($array1[$i]);
                    }
                }
            }
            array_values($array1);
            $idvalue = reset($array1);
        } 
        $data  = new companyLowerTable();
        $data->field = $request->fieldname;
        $data->columnId = $idvalue;
        $data->userId = $request->userId;
        $data->save();
        return json_encode($data,true);
    }
    public function fatchinputcompany(Request $request)
    {
        return  $data = companyLowerTable::where('Uperid',0)->where('userId',$request->userId)->get();
         
    }
    public function removeDivcompany(Request $request)
    {
        companyLowerTable::whereid($request->id)->delete();
        return $request->id;
    }
    
    function addfieldnameEmployee(Request $request)
    {
        $cnt = employeeLowerTable::where('Uperid',0)->count('id');
        $idvalue= "a".$cnt+1;
        $array1 = array('a1','a2','a3','a4','a5','a6','a7','a8','a9','a10');
        $array2 = array('a1','a2','a3','a4','a5','a6','a7','a8','a9','a10');
        $array3 = employeeLowerTable::where('Uperid',0)->get();
        if (sizeof($array3)>0) {
            foreach ($array3 as $row) {
                for ($i=0;$i<10;$i++) {
                    if ($row->columnId == $array2[$i]) {
                        unset($array1[$i]);
                    }
                }
            }
            array_values($array1);
            $idvalue = reset($array1);
        } 
        $data  = new employeeLowerTable();
        $data->field = $request->fieldname;
        $data->columnId = $idvalue;
        $data->userId = $request->userId;
        $data->save();
        return json_encode($data,true);
    }
    public function fatchinputEmployee(Request $request)
    {
        return  $data = employeeLowerTable::where('Uperid',0)->where('userId',$request->userId)->get();
         
    }
    public function removeDivEmployee(Request $request)
    {
        employeeLowerTable::whereid($request->id)->delete();
        return $request->id;
    }

    public function getVendor(Request $request)
    {
       
        $ven = webUser::where('company_category',$request->cat)->where('status',1)->where('account_type','v')->orderBy('firstName','Asc')->get(['id','firstName','lastName']);

        $html = '<option value="">Select</option>';

        foreach ($ven as $un) {
            $html .= '<option value ='.$un->id.'>' . $un->firstName .' '.$un->lastName. '</option>';
        }
        return $html;
    }
    public function getSub(Request $request)
    {
    //    return "hello";
        $ven = Cpr_ad_category::where('parent_id',$request->cat)->where('status',1)->orderBy('category_name','Asc')->get(['id','category_name']);

        $html = '<option value="">Select</option>';

        foreach ($ven as $un) {
            $html .= '<option value ='.$un->id.'>' . $un->category_name .' </option>';
        }
        return $html;
    }
    
}
