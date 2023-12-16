<?php

use App\Models\Company;
use App\Models\MasterValue;
use Illuminate\Support\Facades\DB;

$empid = $eid;
?>
@extends('gr.layout.app')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <div class="">


        <!-- end page title -->
        <div class="container-fluid">

            <div class="team-list row list-view-filter">

                <div class="col-lg-12">
                    <div class="card-header">
                        <div class="row g-2">
                            <div class="col-md-5">
                                <div class="flash-message">

                                    @if(Session::has('error'))

                                    <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                    @if(Session::has('success'))

                                    <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif

                                </div>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-sm-auto ms-auto">
                                <button class="btn btn-info add-btn" data-bs-toggle="modal" onclick="clearmodal();" data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Staff</button>
                                <!-- <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" href="#offcanvasExample"><i class="ri-filter-3-line align-bottom me-1"></i> Fliters</button> -->
                            </div>

                        </div>
                    </div>
                    <div class="card team-box">
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card">
                                    <table class="table align-middle" id="customerTable">

                                        <tbody class="list form-check-all">
                                            @foreach($data as $data)
                                            <tr>

                                                <td>
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                            <img src="{{asset('storage/app/public/document/staff/'.$data->profile)}}" alt="" class="img-fluid d-block rounded-circle">
                                                        </div>
                                                        <div class="team-content">
                                                            <a href="pages-profile.html" aria-controls="offcanvasExample">
                                                                <h5 class="fs-16 mb-1">{{$data->name}} {{$data->LastName}}</h5>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="name">

                                                    <p class="text-muted mb-0">{{$data->email}}</p>
                                                    <p class="text-muted mb-0">{{$data->MobileNo}} </p>
                                                </td>
                                                <?php
                                                $stateval = DB::table('states')->where('id', $data->State)->select('name')->first();
                                                $cityval = DB::table('cities')->where('id', $data->City)->select('name')->first();
                                                ?>
                                                <td class="name">
                                                    <p class="text-muted mb-0"> Address<br>{{$data->Address}}<br>{{$cityval?->name}},{{$stateval?->name}},{{$data->Country}}.</p>
                                                </td>
                                                <td class="name" align="center">
                                                    <p class="text-muted mb-0">Date of Joining</p>
                                                    <p class="text-muted mb-0">{{date('d-m-Y',strtotime($data->created_at))}}</p>

                                                </td>


                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$data->status==1?'Disable':'Enable'}}">
                                                            <a href="{{url('staff_desable/'.$data->id)}}" class="text-muted d-inline-block">
                                                                <i class="ri-{{$data->status==1?'close':'check'}}-fill fs-16" style="color:{{$data->status==1?'red':'green'}};font-weight: bold;"></i>
                                                            </a>
                                                        </li>


                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                            <a class="edit-item-btn" href="#showModal" onclick="editstaff({{$data->id}})" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        @if(auth()->user()->delete_access == 1)
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">


                                                            <a class="remove-item-btn" href="{{url('staff_delete/'.$data->id)}}">
                                                                <i class="ri-delete-bin-fill align-bottom "></i>
                                                            </a>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </td>


                                            </tr>
                                            @endforeach



                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <svg class="bookmark-hide">
            <symbol viewBox="0 0 24 24" stroke="currentColor" fill="var(--color-svg)" id="icon-star">
                <path stroke-width=".4" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </symbol>
        </svg>

    </div><!-- container-fluid -->
</div><!-- End Page-content -->

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 802px;">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <div class="modal-body p-0">
                <div class="step-arrow-nav">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Personal Info</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!--end modal-body-->
            <form action="{{route('Staff.store')}}" class="checkout-tab" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                            <div class="row g-3">
                                <!--end col-->
                                <!--<div class="col-lg-4">-->
                                <!--    <div>-->
                                <!--        <label for="phoneNumber" class="form-label">Emp ID</label>-->



                                <!--    </div>-->
                                <!--</div>-->

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter" required>
                                        <input type="hidden" class="form-control" id="staffid" name="staffid">
                                        <input type="hidden" class="form-control" id="nextid" name="nextid" value="{{$eid}}">
                                        <input type="hidden" name="Empid" class="form-control" id="Empid" placeholder="Enter" value="{{$eid}}" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" name="LastName" class="form-control" id="LastName" placeholder="Enter" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Email ID</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" onchange="enablepc();" placeholder="Enter New Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Confirm Password</label>
                                        <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Password Again" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="emailID" class="form-label"> Mobile No </label>
                                        <input type="text" name="MobileNo" class="form-control" id="MobileNo" placeholder="Enter" minlength="10" maxlength="10" required onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;" required>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Gender</label>
                                        <select class="form-select " id="Gender" name="Gender" aria-label="Default select example" required>
                                            <option value="">---select---</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Image</label>
                                        <input type="file" name="profile" accept="image/*" class="form-select ">

                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div>
                                        <label for="serviceTax" class="form-label"> Address</label>
                                        <input type="text" name="Address" class="form-control" id="Address" placeholder="Enter" required>

                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> Country</label>
                                        <select class="form-select" name="Country" id="Country" aria-label="Default select example" required>

                                            <option value="India">India</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> State</label>
                                        <select class="form-select " onchange="getcity(this.value,'')" id="State" aria-label="Default select example" name="State" required>
                                            <option value="">---select---</option>
                                            @foreach($state as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> City</label>
                                        <select class="form-select chosen-select" aria-label="Default select example" name="City" id="city">
                                            <option value="">---select---</option>
                                            @foreach($city as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-lg-12 mt-5 mb-4" style="border-top: 1px dashed #cccdcc;">

                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Assign Menu</label>
                                        <select class="form-select" name="menu[]" id="menu" aria-label="Default select example" multiple>
                                            <option value="0">All</option>
                                            @foreach($amenus as $amenu)
                                            <option value="{{$amenu->id}}">{{$amenu->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <input type="checkbox" class="form-checkbox" id="vehicle1" name="delete_access" value="1">
                                        <label for="vehicle1" class="form-label">Delete Access</label>

                                    </div>
                                </div>

                                <!--<div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> Assign Branch office</label>
                                        <select class="form-select" id="AssignBranchOffice" name="AssignBranchOffice" aria-label="Default select example" required>
                                            <option value="">---select---</option>
                                            @foreach($bname as $row)

                                            <option value="{{$row->id}}">{{$row->BranchName}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Assign Department</label>
                                        <select class="form-select" id="AssignDepartment" name="AssignDepartment" aria-label="Default select example" required>
                                            <option value="">---select---</option>
                                            @foreach($dname as $row)
                                            <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="vatNo" class="form-label">Assign Designation</label>
                                        <select class="form-select mb-3" id="AssignDesignation" name="AssignDesignation" aria-label="Default select example" required>
                                            <option value="">---select---</option>
                                            @foreach($desig as $row)
                                            <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->


                                <!--end col-->

                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="submit" class="btn btn-primary  ms-auto">
                                            Save</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </div>
                <!--end modal-body-->
            </form>
        </div>
    </div>
</div>
<!--end add modal-->
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body p-5 text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                <div class="mt-4 text-center">
                    <h4 class="fs-semibold">You are about to delete a Staff ?</h4>
                    <p class="text-muted fs-14 mb-4 pt-1">Deleting your Staff will
                        remove all of your information from our database.</p>
                    <div class="hstack gap-2 justify-content-center remove">
                        <button class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                            Close</button>
                        <button class="btn btn-danger" id="delete-record">Yes,
                            Delete It!!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header bg-light">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Employee Fliters</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!--end offcanvas-header-->
    <form action="#" class="d-flex flex-column justify-content-end h-100">
        <div class="offcanvas-body">
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Company</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="1">Avenue Growth Private Limited</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Branch office</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="1">Gurgaon</option>
                            <option value="2">Noida</option>
                            <option value="3">Delhi</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="confirmPassword" class="form-label"> Department</label>
                        <select class="form-select" aria-label="Default select example">

                            <option value="1">Merchant Onboarding</option>
                            <option value="2">Claim Settlements </option>
                            <option value="3">Management</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="vatNo" class="form-label"> Designation</label>
                        <select class="form-select mb-3" aria-label="Default select example">

                            <option value="1">Executive </option>
                            <option value="2">Manager</option>
                            <option value="3">Account Manager</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="confirmPassword" class="form-label">Gender</label>
                        <select class="form-select " aria-label="Default select example">

                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <!--end offcanvas-body-->
        <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
            <button class="btn btn-light w-100">Clear Filter</button>
            <button type="submit" class="btn btn-success w-100">Filters</button>
        </div>
        <!--end offcanvas-footer-->
    </form>
</div>
<!--end offcanvas-->

<script>
    function isNumber(e) {
        var keyCode = (e.which) ? e.which : e.keyCode;

        if (keyCode > 31 && (keyCode < 48 || keyCode > 57)) {
            //    alert("You can enter only numbers 0 to 9 ");
            return false;
        }
        return true;
    }

    function getcity(state,city_id) {
        // alert(state);
        jQuery.ajax({

            type: 'GET',

            url: "{{url('ajaxcity')}}?state=" + state,

            dataType: 'JSON',

            success: function(response) {

                const template = response.cities.map((city, index) => {
                    
                    if(city.id == city_id)
                    {
                        var sel = 'selected';
                    }
                    else
                    {
                        var sel = '';
                    }

                    return `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${city.id}" ${sel}>${city.name}</option>`;

                }).join(' ');



                $('#city').html(template);



            }

        });
    }

    function editstaff(id) {

        jQuery.ajax({
            type: 'GET',
            url: "{{url('editstaff')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                var x = JSON.parse(data);
                $('#staffid').val(x.id);
                $('#Empid').val(x.Empid);
                $('#name').val(x.name);
                $('#LastName').val(x.LastName);
                $('#email').val(x.email);
                $('#MobileNo').val(x.MobileNo);
                $('#Gender').val(x.Gender);
                $('#Address').val(x.Address);
                $('#Country').val(x.Country);
                $('#State').val(x.State);
                getcity(x.State,x.City);
                $('#AssignCompany').val(x.AssignCompany);
                $('#AssignBranchOffice').val(x.AssignBranchOffice);
                $('#AssignDepartment').val(x.AssignDepartment);
                $('#AssignDesignation').val(x.AssignDesignation);
                $('#AccountNumber').val(x.AccountNumber);
                $('#TanNumber').val(x.TanNumber);
                $('#GSTNumber').val(x.GSTNumber);
                $('#PanNumber').val(x.PanNumber);
                $('#menu').val(x.menu.split(','));
                if(x.delete_access == 1)
                {
                 document.getElementById("vehicle1").checked = true;
                    
                }
                else
                {
                    document.getElementById("vehicle1").checked = false;
                }
                 
                $('#password').prop('required', false);
                $('#password_confirmation').prop('required', false);

                // function reqListener() {
                //     console.log(this.responseText);
                // }
                // var oReq = new XMLHttpRequest();               
                // oReq.open("GET", "http://www.example.org/example.txt");
                // oReq.send();
            }
        }); //ajax close

    }

    function clearmodal() {
        var eid = $('#nextid').val();
        $('#staffid').val('');
        $('#Empid').val(eid);
        $('#name').val('');
        $('#LastName').val('');
        $('#email').val('');
        $('#MobileNo').val('');
        $('#Gender').val('');
        $('#Address').val('');
        $('#State').val('');
        $('#city').val('');
        $('#AssignCompany').val('');
        $('#AssignBranchOffice').val('');
        $('#AssignDepartment').val('');
        $('#AssignDesignation').val('');
        $('#AccountNumber').val('');
        $('#TanNumber').val('');
        $('#GSTNumber').val('');
        $('#PanNumber').val('');
        $('#menu').val('');
        document.getElementById("vehicle1").checked = false;
        $('#password').prop('required', true);
        $('#password_confirmation').prop('required', true);
    }
</script>
@endsection