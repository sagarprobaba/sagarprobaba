<?php

use App\Models\MasterValue;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
?>
@extends('gr.layout.app')
@section('body')
<div class="page-content">
    <div class="">
        <div class="container-fluid">
            <div class="row">
                <!--end col-->
                <div class="col-xxl-12">
                    <div class="team-list row list-view-filter">
                        <div class="col-lg-12">
                            <div class="card team-box">
                                <div class="card-header">
                                    <div class="row g-2">
                                        <div class="col-md-5">
                                            <div class="search-box">
                                            </div>
                                        </div>
                                        <div class="col-md-5"></div>
                                        <div class="col-sm-auto ms-auto">
                                            <div class="flex-grow-1">
                                                <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Freelancer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive ">
                                            <table class="table align-middle table-nowrap mb-0" id="customerTable">

                                                <tbody class="list form-check-all">
                                                    @foreach($data as $data)
                                                    <tr>
                                                        
                                                        <td>
                                                            <div class="team-profile-img">
                                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                    <?php
                                                                   $pic= isset($data->photo)?'storage/app/public/document/employee/'.$data->photo:'assets/images/no.png';
                                                                    ?>
                                                            
                                                                    <img src="{{asset($pic)}}" alt="" class="img-fluid d-block rounded-circle">
                                                                </div>
                                                                <div class="team-content">
                                                                    <a href="pages-profile.html" aria-controls="offcanvasExample">
                                                                        <h5 class="fs-16 mb-1">{{$data->EmployeeName}} </h5>
                                                                    </a>

                                                                    <p class="text-muted mb-0">{{$data->EmployeeEmail}}</p>
                                                                    <p class="text-muted mb-0">{{$data->EmployeePhone}}</p>
                                                                    <p class="text-muted mb-0">{{$data->EmployeeAddress}}</p>
                                                                    <p class="text-muted mb-0">Date Added: {{date('d-m-Y',strtotime($data->created_at))}}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="name">
                                                            <p class="text-muted mb-0">Dl: {{$data->DlNumber}} </p>
                                                            <p class="text-muted mb-0">PAN: {{$data->PanNumber}}</p>
                                                        </td>
                                                        <?php


                                                        $wca = MasterValue::find($data->WorkCategory);
                                                        $trn = MasterValue::find($data->TransportationMode);
                                                        ?>

                                                        <td class="name">

                                                            <p class="text-muted mb-0"> WorkCategory :{{$wca->MasterValue}} </p>

                                                            <p class="text-muted mb-0">TransportationMode: {{$trn->MasterValue}}</p>
                                                            <p class="text-muted mb-0">PoliceCase: {{$data->PoliceCase}}</p>

                                                        </td>
                                                        <td class="name" align="center">
                                                            <h5 class="mb-1">0</h5>
                                                            <p class="text-muted mb-0">Active BGV</p>
                                                        </td>
                                                        <td align="center">
                                                            <h5 class="mb-1">0</h5>
                                                            <p class="text-muted mb-0">Complete BGV</p>
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$data->status==1?'Enable':'Desable'}}">
                                                                    <a href="{{url('employee_desable/'.$data->id)}}" class="text-muted d-inline-block">
                                                                        <i class="ri-check-fill fs-16" style="color:{{$data->status==1?'green':'red'}};font-weight: bold;"></i>
                                                                    </a>
                                                                </li>

                                                                <!-- <li class="list-inline-item">
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-eye-fill align-bottom text-muted"></i></a>
                                                                </li> -->
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                                    <a class="edit-item-btn" href="#showModal" onclick="editemployee({{$data->id}})" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                                    <a class="remove-item-btn" href="{{url('employee_delete/'.$data->id)}}">
                                                                        <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                                    </a>
                                                                </li>

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




                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 802px;">
                            <div class="modal-content border-0">
                                <div class="modal-header bg-soft-info p-3">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <!--end modal-body-->
                                <!--end modal-body-->
                                <form action="{{route('Freelancer.store')}}" method="POST" class="checkout-tab" enctype="multipart/form-data">
                                    @csrf <div class="modal-body p-0">
                                        <div class="step-arrow-nav">
                                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link tabs p-3 active" id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="true">Basic Info</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link tabs p-3 " id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="false">Work</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link tabs p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">Bank Details</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link tabs p-3" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Document Verification</button>
                                                </li>
                                                <!--  <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Info</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">Bank Details</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Document Verification</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3" id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="false">Contact</button>
                                            </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <!--end modal-body-->
                                    <div class="modal-body">
                                        <div class="tab-content">
                                            <div class="tab-pane tabpane fade show active" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                                                <div class="row g-3">

                                                    <div class="col-lg-6">
                                                        <label for="firstName" class="form-label mb-3">Photo uploade</label>
                                                        <div class="dropzone d-flex align-items-center documents_upload_tb">
                                                            <div class="">
                                                                <input type="file" class="form-control" name="photo" id="photo" accept=".jpg, .png, .jpeg">
                                                            </div>
                                                            <div class="dz-message needsclick text-center">
                                                                <div class="mb-3">
                                                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                                </div>

                                                                <h4>Photo upload</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row">
                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="firstName" class="form-label">First Name</label>
                                                                    <input type="text" class="form-control mb-3" id="EmployeeName" placeholder="Enter your firstname" name="EmployeeName">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="phoneNumber" class="form-label">Email ID</label>
                                                                    <input type="email" class="form-control mb-3" id="EmployeeEmail" placeholder="Enter your Personal Email ID" name="EmployeeEmail">

                                                                </div>
                                                            </div>

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="emailID" class="form-label"> Mobile No </label>
                                                                    <input type="text" class="form-control mb-3" id="EmployeePhone" placeholder="Enter your Personal Mobile No" name="EmployeePhone">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            

                                                        </div>

                                                    </div>


                                                    <div class="col-lg-12 mt-3 mb-3" style="border-top: 1px dashed #cccdcc;"></div>
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Address</label>
                                                            <input type="text" class="form-control" id="EmployeeAddress" placeholder="Enter your Address" name="EmployeeAddress">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Country</label>
                                                            <select class="form-select " aria-label="Default select example" name="Country">

                                                                <option value="India">India</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> State</label>
                                                            <select class="form-select " onchange="getcity(this.value)" aria-label="Default select example" name="State" id="State">
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
                                                                <option value="{{$row->id}}">{{$row->name}}</option> @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="d-flex align-items-start gap-3 mt-3">
                                                            <!-- <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                                Save</button>
                                                                <a class="nexttab" href="#pills-bill-address">Next Tab</a> -->

                                                            <button type="button" class="nexttab btn btn-success right ms-auto">Next</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane tabpane fade " id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                                                <div class="row g-3">

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Work Category</label>
                                                            <select class="form-select" aria-label="Default select example" id="WorkCategory" name="WorkCategory">
                                                                @foreach($wcat as $row)
                                                                <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Skills</label>
                                                            <select class="form-select" aria-label="Default select example" name="Skills[]" id="Skills" multiple>
                                                                @foreach($skill as $row)
                                                                <option value="{{$row->id}}" >{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Experience</label>
                                                            <select class="form-select" aria-label="Default select example" name="Experience" id="Experience">
                                                                @foreach($expere as $row)
                                                                <option value="{{$row->id}}" >{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Transportation Mode</label>
                                                            <select class="form-select" aria-label="Default select example" name="TransportationMode" id="TransportationMode">
                                                                @foreach($transm as $row)
                                                                <option value="{{$row->id}}" >{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="phoneNumber" class="form-label">Police Case or Legal Consent</label>
                                                            <input type="text" class="form-control" placeholder="Enter" name="PoliceCase" id="PoliceCase">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Education Level</label>
                                                            <select class="form-select" aria-label="Default select example" name="EducationLevel" id="EducationLevel">
                                                                @foreach($edul as $row)
                                                                <option value="{{$row->id}}" >{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    

 

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="phoneNumber" class="form-label">Time Availability</label>
                                                            <select class="form-select" aria-label="Default select example" name="TimeAvailability" id="TimeAvailability">                                                               
                                                                <option value="Morning">Morning</option>
                                                                <option value="Day">Day</option>
                                                                <option value="Evening">Evening</option>
                                                                <option value="Night">Night</option>                                                              
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Orientation Status</label>
                                                            <select class="form-select" aria-label="Default select example" name="OrientationStatus" id="OrientationStatus">
                                                                @foreach($oris as $row)
                                                                <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Relevant Status</label>
                                                            <select class="form-select" aria-label="Default select example" name="RelevantStatus" id="RelevantStatus">
                                                                @foreach($reles as $row)
                                                                <option value="{{$row->id}}" >{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="choices-multiple-default" class="form-label text-muted">Worked With</label>
                                                            <select class="form-control" id="WorkedWith" data-choices name="WorkedWith[]" multiple>
                                                                @foreach($brand as $row)
                                                                <option value="{{$row->id}}">{{$row->brandName}}</option>
                                                                @endforeach

                                                            </select>

                                                        </div>
                                                    </div>


                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Emergency Contacts</label>
                                                            <input type="text" class="form-control" id="EmergencyContacts" placeholder="Enter " name="EmergencyContacts">
                                                        </div>
                                                    </div>


                                                    <!--end col-->
                                                    <div class="d-flex align-items-start gap-3 mt-4">
                                                        <button type="button" class="prevtab btn btn-success">Prev</button>
                                                        <button type="button" class="nexttab btn btn-success right ms-auto">Next</button>


                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane tabpane fade" id="pills-bill-address" role="tabpanel" aria-labelledby="pills-bill-address-tab">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="banknameInput" class="form-label">Bank
                                                                Name</label>
                                                            <input type="text" class="form-control" id="BankName" placeholder="Enter your bank name" name="BankName">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="branchInput" class="form-label">Branch</label>
                                                            <input type="text" class="form-control" id="Branch" placeholder="Branch" name="Branch">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="ifscInput" class="form-label">IFSC</label>
                                                            <input type="text" class="form-control" id="IFSC" placeholder="IFSC" name="IFSC">
                                                            <input type="hidden" id="id" name="id">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnameInput" class="form-label">Account
                                                                Holder Name</label>
                                                            <input type="text" class="form-control" id="AccountHolderName" placeholder="Enter account holder name" name="AccountHolderName">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">Account
                                                                Number</label>
                                                            <input type="number" class="form-control" id="AccountNumber" placeholder="Enter account number" name="AccountNumber">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="ifscInput" class="form-label">Cancel Cheque</label>
                                                            <input type="file" class="form-control" name="CancelCheque" id="CancelCheque">
                                                        </div>
                                                    </div>
                                                    

                                                    <!--end col-->
                                                    <div class="d-flex align-items-start gap-3 mt-4">
                                                        <button type="button" class="prevtab btn btn-success">Prev</button>
                                                        <button type="button" class="nexttab btn btn-success right ms-auto">Next</button>


                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane tabpane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">

                                                <div class="row mb-3">
                                                    <!--end col-->

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">DL Number</label>
                                                            <input type="text" class="form-control" id="DlNumber" placeholder="Enter " name="DlNumber">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">Pan Number</label>
                                                            <input type="text" class="form-control" id="PanNumber" placeholder="Enter " name="PanNumber">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="mb-3">Choose Document Type</h5>

                                                <div class="d-flex gap-2">
                                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">PAN</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">TAN</button>
                                                        </li>

                                                        
                                                    </ul>
                                                </div>
                                                <div class="tab-content" id="pills-tabContent">

                                                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                            <div class="dropzone d-flex align-items-center documents_upload_tb">
                                                                <div class="">
                                                                    <input type="file" name="pancard" accept=".jpg, .png, .jpeg, .docx, .doc, .pdf">
                                                                </div>
                                                                <div class="dz-message needsclick text-center">
                                                                    <div class="mb-3">
                                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                                    </div>
                                                                    <h4>Drop tan file here or click to upload.</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                            <div class="dropzone d-flex align-items-center documents_upload_tb">
                                                                <div class="">
                                                                    <input type="file" name="tan" accept=".jpg, .png, .jpeg, .docx, .doc, .pdf">
                                                                </div>
                                                                <div class="dz-message needsclick text-center">
                                                                    <div class="mb-3">
                                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                                    </div>
                                                                    <h4>Drop gst file here or click to upload.</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    <li class="mt-2" id="dropzone-preview-list">
                                                        <div class="border rounded">

                                                            <div id="newdiv" class="d-flex p-2">


                                                                <!-- <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1" data-dz-name="">&nbsp;</h5>
                                                                        <p class="fs-13 text-muted mb-0" data-dz-size="">
                                                                        </p>
                                                                        <strong class="error text-danger" data-dz-errormessage=""></strong>
                                                                    </div>
                                                                </div> -->

                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                
                                                <!-- end dropzon-preview -->
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="prevtab btn btn-success">Prev</button>
                                                    <button type="submit" class="btn btn-primary btn-label right ms-auto nexttab"><i class="ri-save-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->


                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                    <!--end modal-body-->
                                </form>
                            </div>
                            <!--end offcanvas-->

                        </div>
                        <!-- container-fluid -->
                    </div>
                          <!--end card-->
                </div>
                <!--end col-->

            </div>
        </div>
        </div>
    <!-- container-fluid -->
</div>
                    <!-- End Page-content -->
                    <script type="text/javascript">
                        function isNumber(e) {
                            var keyCode = (e.which) ? e.which : e.keyCode;

                            if (keyCode > 31 && (keyCode < 48 || keyCode > 57)) {
                                //    alert("You can enter only numbers 0 to 9 ");
                                return false;
                            }
                            return true;
                        }


                        function bootstrapTabControl() {
                            var i, items = $('.tabs'),
                                pane = $('.tabpane');
                            //   alert(pane.length);
                            // next
                            $('.nexttab').on('click', function() {
                                for (i = 0; i < items.length; i++) {
                                    if ($(items[i]).hasClass('active') == true) {
                                        break;
                                    }
                                }
                                if (i < items.length - 1) {
                                    // for tab
                                    $(items[i]).removeClass('active');
                                    $(items[i + 1]).addClass('active');
                                    // for pane
                                    $(pane[i]).removeClass('show active');
                                    $(pane[i + 1]).addClass('show active');
                                }

                            });
                            // Prev
                            $('.prevtab').on('click', function() {
                                for (i = 0; i < items.length; i++) {
                                    if ($(items[i]).hasClass('active') == true) {
                                        break;
                                    }
                                }
                                if (i != 0) {
                                    // for tab
                                    $(items[i]).removeClass('active');
                                    $(items[i - 1]).addClass('active');
                                    // for pane
                                    $(pane[i]).removeClass('show active');
                                    $(pane[i - 1]).addClass('show active');
                                }
                            });
                        }
                        bootstrapTabControl();

                        function getcity(state) {
                            // alert(state);
                            jQuery.ajax({
                                type: 'GET',
                                url: "{{url('ajaxcity')}}?state=" + state,
                                dataType: 'html',
                                success: function(city_name) {
                                    document.getElementById("city").innerHTML = city_name;
                                    $('#city').selectpicker('refresh');
                                    // $('#city_chosen').hide();;

                                    // alert(city_name);
                                    //   $('#city').html(city);

                                }
                            }); //ajax close
                        }

                        function editemployee(id) {

                            jQuery.ajax({
                                type: 'GET',
                                url: "{{url('editemployee')}}?id=" + id,
                                dataType: 'html',
                                success: function(data) {
                                    // alert("hello");
                                    var x = JSON.parse(data);
                                    $('#id').val(x.id);
                                    // alert(x.id);

                                    $('#EmployeeName').val(x.EmployeeName);
                                    $('#EmployeeEmail').val(x.EmployeeEmail);
                                    $('#EmployeePhone').val(x.EmployeePhone);
                                   
                                    // $('#photo').val(x.photo);
                                    $('#EmployeeAddress').val(x.EmployeeAddress);
                                    $('#Country').val(x.Country);
                                    $('#State').val(x.State);
                                    getcity(x.State);
                                    $('#city').val(x.City);
                                    $('#WorkCategory').val(x.WorkCategory);
                                    $('#Skills').val(x.Skills.split(','));
                                    $('#Experience').val(x.Experience);
                                    $('#TransportationMode').val(x.TransportationMode);
                                    $('#PoliceCase').val(x.PoliceCase);
                                    $('#EducationLevel').val(x.EducationLevel);
                                    $('#TimeAvailability').val(x.TimeAvailability);
                                    $('#OrientationStatus').val(x.OrientationStatus);
                                    $('#RelevantStatus').val(x.RelevantStatus);
                                    $('#WorkedWith').val(x.WorkedWith.split(','));
                                    $('#EmergencyContacts').val(x.EmergencyContacts);
                                    $('#BankName').val(x.BankName);
                                    $('#Branch').val(x.Branch);               
                                    $('#IFSC').val(x.IFSC);
                                    $('#AccountHolderName').val(x.AccountHolderName);
                                    $('#AccountNumber').val(x.AccountNumber);
                                    $('#DlNumber').val(x.DlNumber);
                                    $('#PanNumber').val(x.PanNumber);
                                    $('#ChoosedocumType').val(x.ChoosedocumType);
                                    const myNode = document.getElementById("newdiv");
                                    while (myNode.lastElementChild) {
                                        myNode.removeChild(myNode.lastElementChild);
                                    }
                                    
                                    if (x.pancard != null) {
                                        var pancard = x.pancard;
                                        $("#newdiv").append('<a href="storage/app/public/document/employee/' + pancard + '" target="_blank" alt="" id="pancardimage" data-dz-thumbnail="" class="img-fluid rounded d-block"> <div class="flex-shrink-0 me-3"><div class="avatar-sm bg-light rounded"><i class="ri-file-fill" style="font-size:39px !important;"></i></div></div></a>');
                                    }
                                    if (x.tan != null) {
                                        var tan = x.tan;
                                        $("#newdiv").append('<a href="storage/app/public/document/employee/' + tan + '" target="_blank" alt="" id="gstimage" data-dz-thumbnail="" class="img-fluid rounded d-block"> <div class="flex-shrink-0 me-3"><div class="avatar-sm bg-light rounded"><i class="ri-file-fill" style="font-size:39px !important;"></i></div></div></a>');
                                    }
                                    


                                }
                            }); //ajax close

                        }

                        function clearmodal() {
                            $('#id').val('');
                            $('#EmployeeName').val('');
                            $('#EmployeeEmail').val('');
                            $('#EmployeePhone').val('');
                            $('#Gender').val('');
                            $('#Dob').val('');
                            $('#photo').val('');
                            $('#EmployeeAddress').val('');
                            $('#State').val('');
                            $('#city').val('');
                            $('#WorkCategory').val('');
                            $('#Skills').val('');
                            $('#Experience').val('');
                            $('#TransportationMode').val('');
                            $('#PoliceCase').val('');
                            $('#EducationLevel').val('');
                            $('#TimeAvailability').val('');
                            $('#OrientationStatus').val('');
                            $('#RelevantStatus').val('');
                            $('#WorkedWith').val('');
                            $('#EmergencyContacts').val('');
                            $('#BankName').val('');
                            $('#Branch').val('');
                            $('#IFSC').val('');
                            $('#AccountHolderName').val('');
                            $('#AccountNumber').val('');
                            $('#DlNumber').val('');
                            $('#PanNumber').val('');
                            $('#ChoosedocumType').val('');
                            const myNode = document.getElementById("newdiv");
                            while (myNode.lastElementChild) {
                                myNode.removeChild(myNode.lastElementChild);
                            }
                        }
                    </script>

                    @endsection