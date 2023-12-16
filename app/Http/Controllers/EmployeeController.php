<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\MasterValue;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state = DB::table('states')->where('country_id', 101)->select('name', 'id')->orderBy('name', 'ASC')->get();
        $city = DB::table('cities')->where('country_id', 101)->select('name', 'id')->orderBy('name', 'ASC')->get();
        $desig = MasterValue::where('MasterHead', 3)->where('status', 1)->get();
        $data = Employee::orderby('id', 'DESC')->get();
        $wcat = MasterValue::where('MasterHead', 5)->where('status', 1)->get();
        $skill = MasterValue::where('MasterHead', 6)->where('status', 1)->get();
        $expere = MasterValue::where('MasterHead', 7)->where('status', 1)->get();
        $transm = MasterValue::where('MasterHead', 8)->where('status', 1)->get();
        $edul = MasterValue::where('MasterHead', 10)->where('status', 1)->get();
        $oris = MasterValue::where('MasterHead', 12)->where('status', 1)->get();
        $reles = MasterValue::where('MasterHead', 13)->where('status', 1)->get();
        $workw = MasterValue::where('MasterHead', 14)->where('status', 1)->get();
        $brand = Brand::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('gr.employee', compact('data', 'city', 'state', 'desig', 'wcat', 'skill', 'expere', 'transm', 'edul', 'oris', 'reles', 'workw', 'brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'EmployeeName' => 'Required',
            'EmployeeEmail' => 'Required',
            'EmployeePhone' => 'Required',
        ]);
        if (isset($request->id)) {
            $data =  Employee::find($request->id);
            $msg = 'Employee Updated Successfully';
        } else {
            $data  = new Employee();
            $msg = 'Employee Created Successfully';
        }
        $data->EmployeeName = $request->EmployeeName;
        $data->EmployeeEmail  = $request->EmployeeEmail;
        $data->EmployeePhone = $request->EmployeePhone;
        $data->Gender = $request->Gender;
        $data->Dob = $request->Dob;
        $data->EmployeeAddress = $request->EmployeeAddress;
        $data->Country = $request->Country;
        $data->State = $request->State;
        $data->City = $request->City;
        $data->WorkCategory = $request->WorkCategory;
        if (isset($request->Skills)) {
            $data->Skills = implode(',', $request->Skills);;
        }
        $data->Experience = $request->Experience;
        $data->TransportationMode = $request->TransportationMode;
        $data->PoliceCase = $request->PoliceCase;
        $data->EducationLevel = $request->EducationLevel;
        $data->TimeAvailability = $request->TimeAvailability;
        $data->OrientationStatus = $request->OrientationStatus;
        $data->RelevantStatus = $request->RelevantStatus;
        if (isset($request->WorkedWith)) {
            $data->WorkedWith = implode(',', $request->WorkedWith);
        }
        $data->EmergencyContacts = $request->EmergencyContacts;
        $data->BankName = $request->BankName;
        $data->Branch = $request->Branch;
        $data->IFSC = $request->IFSC;
        $data->AccountHolderName  = $request->AccountHolderName;
        $data->AccountNumber = $request->AccountNumber;
        $data->DlNumber = $request->DlNumber;
        $data->PanNumber = $request->PanNumber;
        $data->type = $request->type;

        $data->created_by = auth()->user()->id;
        if ($request->hasFile('CancelCheque')) {
            $imgname = $request->file('CancelCheque');
            $filename = $request->EmployeePhone . rand(11, 99) . date('Ymdhis') . '.' . $imgname->extension();
            $imgname->storeAs('document/employee', $filename, 'public');
            $data['CancelCheque'] = $filename;
        }
        if ($request->hasFile('photo')) {
            $imgname1 = $request->file('photo');
            $filename1 = $request->EmployeePhone . rand(111, 999) . date('Ymdhis') . '.' . $imgname1->extension();
            $imgname1->storeAs('document/employee', $filename1, 'public');
            $data['photo'] = $filename1;
        }
        if ($request->hasFile('pancard')) {
            $imgname1 = $request->file('pancard');
            $filename1 = $request->EmployeePhone . rand(1111, 9999) . date('Ymdhis') . '.' . $imgname1->extension();
            $imgname1->storeAs('document/employee', $filename1, 'public');
            $data['pancard'] = $filename1;
        }
        if ($request->hasFile('tan')) {
            $imgname1 = $request->file('tan');
            $filename1 = $request->EmployeePhone . rand(1, 9) . date('Ymdhis') . '.' . $imgname1->extension();
            $imgname1->storeAs('document/employee', $filename1, 'public');
            $data['tan'] = $filename1;
        }
        if ($request->hasFile('gst')) {
            $imgname1 = $request->file('gst');
            $filename1 = $request->EmployeePhone . date('Ymdhis') . '.' . $imgname1->extension();
            $imgname1->storeAs('document/employee', $filename1, 'public');
            $data['gst'] = $filename1;
        }
        $data->save();
        return redirect(route('Freelancer.index'))->with('success', 'Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }
    public function employee_desable($id)
    {
        $data =  Employee::find($id);

        if ($data->status == 1) {
            $data->status = 0;
            $msg = 'Desabled';
        } else {
            $data->status = 1;
            $msg = 'Enabled';
        }
        $data->save();
        return redirect(route('Freelancer.index'))->with('success', 'Employee ' . $msg . ' Successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function employee_delete($id)
    {
        $data =  Employee::find($id);
        //  $status = $data->type;
        Employee::whereId($id)->delete();

        return redirect(route('Freelancer.index'))->with('success', 'Employee Deleted Successfully!');
    }

    public function editemployee(Request $request)
    {

        $data = Employee::find($request->id);

        return json_encode($data, true);
    }
}
