<?php

use App\Models\MasterValue;
use Illuminate\Support\Facades\DB;

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
                                                <button type="button" class="btn btn-primary" onclick="clearmodal();" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>Add Brand</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive ">
                                            <table class="table align-middle" id="customerTable">
                                                <tbody class="list form-check-all">
                                                    @foreach($data as $data)
                                                    <tr>
                                                        

                                                        <td>
                                                            <div class="team-profile-img">
                                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                    <?php


                                                                    $pic = isset($data->photo) ? 'storage/app/public/document/brand/' . $data->photo : 'assets/images/no.png';
                                                                    $brind = MasterValue::find($data->brandIndustry);
                                                                    $brseg = MasterValue::find($data->brandSegments);

                                                                    ?>

                                                                    <img src="{{asset($pic)}}" alt="" class="img-fluid d-block rounded-circle">
                                                                </div>
                                                                <div class="team-content">
                                                                    <a href="pages-profile.html" aria-controls="offcanvasExample">
                                                                        <h5 class="fs-16 mb-1">
                                                                            {{$data->brandName}}
                                                                        </h5>
                                                                    </a>
                                                                    <p class="text-muted mb-0">
                                                                        Industry : {{$brind->MasterValue}}
                                                                    </p>
                                                                    <p class="text-muted mb-0">
                                                                        Segment : {{$brseg->MasterValue}}
                                                                    </p>
                                                                    <p class="text-muted mb-0">
                                                                        Alias - {{$data->alias}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <?php
                                                        $stateval = DB::table('states')->where('id', $data->state)->select('name')->first();
                                                        $cityval = DB::table('cities')->where('id', $data->city)->select('name')->first();
                                                        ?>
                                                        <td class="name">
                                                            <p class="text-muted mb-0">Main Office:</p>
                                                            <p class="text-muted mb-0">
                                                                Address: {{$data->brandAddress}}<br />
                                                                {{$cityval->name}} {{$stateval->name}} India 

                                                            </p>
                                                        </td>

                                                        <td class="name">
                                                            <p class="text-muted mb-0">Bank Details</p>
                                                            <p class="text-muted mb-0">
                                                                Acc Name: {{$data->accountHolderName}}
                                                            </p>
                                                            <p class="text-muted mb-0">
                                                                Acc No: {{$data->accountNumber}}
                                                            </p>
                                                            <p class="text-muted mb-0">Type: Saving</p>
                                                            <p class="text-muted mb-0">
                                                                Bank: {{$data->bankName}}
                                                            </p>
                                                            <p class="text-muted mb-0">GST: {{$data->gstNumber}}</p>
                                                            <p class="text-muted mb-0">PAN: {{$data->panNumber}}</p>
                                                        </td>
                                                        <td class="name">
                                                            <p class="text-muted mb-0">Contact</p>
                                                            <p class="text-muted mb-0"> {{$data->firstName}}
                                                            </p>
                                                            <p class="text-muted mb-0">
                                                                {{$data->email}}
                                                            </p>
                                                            <p class="text-muted mb-0">
                                                                {{$data->mobile}}
                                                            </p>


                                                        </td>
                                                        

                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$data->status==1?'Enable':'Desable'}}">
                                                                    <a href="{{url('brand_desable/'.$data->id)}}" class="text-muted d-inline-block">
                                                                        <i class="ri-check-fill fs-16" style="color:{{$data->status==1?'green':'red'}};font-weight: bold;"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                                    <a class="edit-item-btn" onclick="editbrand({{$data->id}})" href="#exampleModal" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                                    <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                                    <!-- <a class="remove-item-btn" href="{{url('brand_delete/'.$data->id)}}">
                                                                    </a> -->
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




                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header p-3">

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body p-0">
                                    <div class="step-arrow-nav">
                                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Basic Info</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">Bank Details</button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3 " id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="false">Brand Contact</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tabs p-3" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Addresses</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end modal-body-->
                                <form action="{{route('Brand.store')}}" method="POST" enctype="multipart/form-data" class="checkout-tab">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="tab-content">
                                            <div class="tab-pane tabpane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                                                <div class="row g-3">
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="phoneNumber" class="form-label">Brand Name </label>
                                                            <input type="text" name="brandName" class="form-control" id="brandName" placeholder="Enter">
                                                            <input type="hidden" name="brandid" id="brandid">

                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Brand Email Id</label>
                                                            <input type="email" name="brandEmail" class="form-control" id="brandEmail" placeholder="Enter">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Brand Phone</label>
                                                            <input type="text" name="brandPhone" class="form-control" id="brandPhone" placeholder="Enter" maxlength="10" minlength="10" onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Brand Website</label>
                                                            <input type="text" name="brandWebsite" class="form-control" id="brandWebsite" placeholder="Enter">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label">Brand Industry</label>
                                                            <select class="form-select" name="brandIndustry" id="brandIndustry" aria-label="Default select example">
                                                                @foreach($indus as $row)
                                                                <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Brand Segments</label>
                                                            <select class="form-select" name="brandSegments" id="brandSegments" aria-label="Default select example">
                                                                @foreach($seg as $row)
                                                                <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-8">
                                                        <div>
                                                            <label for="serviceTax" class="form-label">Brand Main Address</label>
                                                            <input type="text" name="brandAddress" class="form-control" id="brandAddress" placeholder="Enter your Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Country</label>
                                                            <select class="form-select " name="country" id="country" aria-label="Default select example">
                                                                <option value="1">India </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> State</label>
                                                            <select class="form-select " name="state" id="state" onchange="getcity(this.value,'st')" aria-label="Default select example">
                                                                @foreach($state as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> City</label>
                                                            <select class="form-select" name="city" id="city" aria-label="Default select example">
                                                                @foreach($city as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Pincode</label>
                                                            <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Enter" onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Alias</label>
                                                            <input type="text" name="alias" class="form-control" id="alias" placeholder="Enter">
                                                        </div>
                                                    </div>
                                                    <!--end col-->




                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="d-flex align-items-start gap-3 mt-3">
                                                            <button type="button" class="nexttab btn btn-success right ms-auto">Next</button>

                                                        </div>
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
                                                            <label for="accountnumberInput" class="form-label">GST Number</label>
                                                            <input type="text" name="gstNumber" class="form-control" id="gstNumber" placeholder="Enter ">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">PAN Number</label>
                                                            <input type="text" name="panNumber" class="form-control" id="panNumber" placeholder="Enter ">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="banknameInput" class="form-label">Bank
                                                                Name</label>
                                                            <input type="text" class="form-control" id="bankName" placeholder="Enter your bank name" name="bankName">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="branchInput" class="form-label">Branch</label>
                                                            <input type="text" class="form-control" id="branch" placeholder="Branch" name="branch">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="ifscInput" class="form-label">IFSC</label>
                                                            <input type="text" class="form-control" id="ifsc" placeholder="IFSC" name="ifsc">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnameInput" class="form-label">Account
                                                                Holder Name</label>
                                                            <input type="text" class="form-control" id="accountHolderName" placeholder="Enter account holder name" name="accountHolderName">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">Account Number</label>
                                                            <input type="number" class="form-control" id="accountNumber" placeholder="Enter account number" name="accountNumber" onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="ifscInput" class="form-label">Cancel Cheque</label>
                                                            <input type="file" class="form-control" name="cancelCheque" accept=".jpg, .png, .jpeg, .docx, .doc, .pdf">
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack align-items-start gap-3 mt-4">

                                                            <button type="button" class="prevtab btn btn-success">Prev</button>
                                                            <button type="button" class="nexttab btn btn-success right ms-auto">Next</button>

                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane tabpane fade " id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                                                <div class="row g-3">

                                                    <div class="col-lg-6">
                                                        <label for="firstName" class="form-label mb-3">Photo uploade</label>
                                                        <div class="dropzone d-flex align-items-center documents_upload_tb">
                                                            <div class="">
                                                                <input name="photo" type="file" id="photo" multiple="multiple" accept=".jpg, .png, .jpeg, .docx, .doc, .pdf">
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
                                                                    <input type="text" class="form-control mb-3" id="firstName" name="firstName" placeholder="Enter your firstname">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="phoneNumber" class="form-label">Email ID</label>
                                                                    <input type="email" name="email" class="form-control mb-3" id="email" placeholder="Enter your Personal Email ID">
                                                                </div>
                                                            </div>

                                                            <!--end col-->
                                                            <div class="col-lg-12">
                                                                <div>
                                                                    <label for="emailID" class="form-label"> Mobile No </label>
                                                                    <input type="text" name="mobile" class="form-control mb-3" id="mobile" placeholder="Enter your Personal Mobile No" maxlength="10" minlength="10" onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-6">
                                                                <div>
                                                                    <label for="confirmPassword" class="form-label">Gender</label>
                                                                    <select name="gender" id="gender" class="form-select mb-3" aria-label="Default select example">

                                                                        <option value="1">Female</option>
                                                                        <option value="2">Male</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-lg-6">
                                                                <div>
                                                                    <label for="emailID" class="form-label"> DOB </label>
                                                                    <input type="date" name="dob" id="dob" class="form-control mb-3" placeholder="Enter your Personal Mobile No">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>




                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="d-flex align-items-start gap-3 mt-3">
                                                            <button type="button" class="prevtab btn btn-success">Prev</button>
                                                            <button type="button" class="nexttab btn btn-success right ms-auto">Next</button>

                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>

                                            <div class="tab-pane tabpane fade " id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                                                <div class="row g-3">


                                                    <div class="col-lg-8">
                                                        <div>
                                                            <label for="serviceTax" class="form-label">warehouse Address 1</label>
                                                            <input type="text" name="warehouseAddress1" id="warehouseAddress1" class="form-control" placeholder="Enter your Address">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Country</label>
                                                            <select class="form-select " name="warehouseCountry1" id="warehouseCountry1" aria-label="Default select example">

                                                                <option value="1">India </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> State</label>
                                                            <select class="form-select " name="warehouseState1" onchange="getcity(this.value,'wh1')" id="warehouseState1" aria-label="Default select example">

                                                                @foreach($state as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> City</label>
                                                            <select class="form-select" name="warehouseCity1" id="warehouseCity1" aria-label="Default select example">

                                                                @foreach($city as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Pincode</label>
                                                            <input type="text" name="warehousePincode1" id="warehousePincode1" class="form-control" id="phoneNumber" placeholder="Enter" onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-4 mb-3" style="border-top: 1px dashed #cccdcc;"></div>
                                                    <div class="col-lg-8">
                                                        <div>
                                                            <label for="serviceTax" class="form-label">warehouse Address 2</label>
                                                            <input type="text" name="warehouseAddress2" id="warehouseAddress2" class="form-control" id="serviceTax" placeholder="Enter your Address">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Country</label>
                                                            <select class="form-select " name="warehouseCountry2" id="warehouseCountry2" aria-label="Default select example">

                                                                <option value="1">India </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> State</label>
                                                            <select class="form-select " name="warehouseState2" onchange="getcity(this.value,'wh2')" id="warehouseState2" aria-label="Default select example">

                                                                @foreach($state as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> City</label>
                                                            <select class="form-select" name="warehouseCity2" id="warehouseCity2" aria-label="Default select example">

                                                                @foreach($city as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Pincode</label>
                                                            <input type="text" name="warehousePincode2" class="form-control" id="warehousePincode2" placeholder="Enter" onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="d-flex align-items-start gap-3 mt-3">
                                                            <button type="button" class="prevtab btn btn-success">Prev</button>
                                                            <button type="submit" class="btn btn-primary btn-label right ms-auto nexttab"><i class="ri-save-line label-icon align-middle fs-16 ms-2"></i>Submit</button>

                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>

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

                                        <h4 class="fs-semibold">You are about to delete a Company ?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your Company will
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
                    <!--end delete modal -->


                    <!--end card-->
                </div>
                <!--end col-->

            </div>
        </div>
        <!--end modal-->

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header bg-light">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Leads Fliters</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!--end offcanvas-header-->
            <form action="#" class="d-flex flex-column justify-content-end h-100">
                <div class="offcanvas-body">
                    <div class="mb-4">
                        <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date</label>
                        <input type="date" class="form-control" id="datepicker-range" data-provider="flatpickr" data-range="true" placeholder="Select date">
                    </div>
                    <div class="mb-4">
                        <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Country</label>
                        <select class="form-control" data-choices data-choices-multiple-remove="true" name="country-select" id="country-select" multiple>
                            <option value="">Select country</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Brazil" selected>Brazil</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Denmark">Denmark</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Russia">Russia</option>
                            <option value="Spain">Spain</option>
                            <option value="Syria">Syria</option>
                            <option value="United Kingdom" selected>United Kingdom</option>
                            <option value="United States of America">United States of
                                America</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="status-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
                        <div class="row g-2">
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">New Leads</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Old Leads</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                    <label class="form-check-label" for="inlineCheckbox3">Loss Leads</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                                    <label class="form-check-label" for="inlineCheckbox4">Follow Up</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="leadscore" class="form-label text-muted text-uppercase fw-semibold mb-3">Lead
                            Score</label>
                        <div class="row g-2 align-items-center">
                            <div class="col-lg">
                                <input type="number" class="form-control" id="leadscore" placeholder="0">
                            </div>
                            <div class="col-lg-auto">
                                To
                            </div>
                            <div class="col-lg">
                                <input type="number" class="form-control" id="leadscore" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="leads-tags" class="form-label text-muted text-uppercase fw-semibold mb-3">Tags</label>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="marketing" value="marketing">
                                    <label class="form-check-label" for="marketing">Marketing</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="management" value="management">
                                    <label class="form-check-label" for="management">Management</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="business" value="business">
                                    <label class="form-check-label" for="business">Business</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="investing" value="investing">
                                    <label class="form-check-label" for="investing">Investing</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="partner" value="partner">
                                    <label class="form-check-label" for="partner">Partner</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="lead" value="lead">
                                    <label class="form-check-label" for="lead">Leads</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sale" value="sale">
                                    <label class="form-check-label" for="sale">Sale</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="owner" value="owner">
                                    <label class="form-check-label" for="owner">Owner</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="banking" value="banking">
                                    <label class="form-check-label" for="banking">Banking</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="banking" value="banking">
                                    <label class="form-check-label" for="banking">Exiting</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="banking" value="banking">
                                    <label class="form-check-label" for="banking">Finance</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="banking" value="banking">
                                    <label class="form-check-label" for="banking">Fashion</label>
                                </div>
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

    </div>
    <!-- container-fluid -->
</div>
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

    function getcity(state, id) {
        // alert(state);

        jQuery.ajax({
            type: 'GET',
            url: "{{url('ajaxcity')}}?state=" + state,
            dataType: 'html',
            success: function(city_name) {
                if (id == "st") {
                    document.getElementById("city").innerHTML = city_name;
                    $('#city').selectpicker('refresh');

                } else if (id == "wh1") {
                    document.getElementById("warehouseCity1").innerHTML = city_name;
                    $('#warehouseCity1').selectpicker('refresh');

                } else if (id == "wh2") {
                    document.getElementById("warehouseCity2").innerHTML = city_name;
                    $('#warehouseCity2').selectpicker('refresh');

                } else {

                }
                // $('#city_chosen').hide();;

                // alert(city_name);
                //   $('#city').html(city);

            }
        }); //ajax close
    }

    function editbrand(id) {

        jQuery.ajax({
            type: 'GET',
            url: "{{url('editbrand')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                var x = JSON.parse(data);
                $('#brandid').val(x.id);
                $('#brandName').val(x.brandName);
                $('#brandEmail').val(x.brandEmail);
                $('#brandPhone').val(x.brandPhone);
                $('#brandWebsite').val(x.brandWebsite);
                $('#brandIndustry').val(x.brandIndustry);
                $('#brandSegments').val(x.brandSegments);
                $('#brandAddress').val(x.brandAddress);
                $('#country').val(x.country);
                $('#state').val(x.state);
                getcity(x.state, "st");
                $('#city').val(x.city);
                $('#pincode').val(x.pincode);
                $('#alias').val(x.alias);
                $('#firstName').val(x.firstName);
                $('#email').val(x.email);
                $('#mobile').val(x.mobile);
                $('#gender').val(x.gender);
                $('#dob').val(x.dob);
                $('#warehouseAddress1').val(x.warehouseAddress1);
                $('#warehouseCountry1').val(x.warehouseCountry1);
                $('#warehouseState1').val(x.warehouseState1);
                getcity(x.warehouseState1, "wh1");
                $('#warehouseCity1').val(x.warehouseCity1);
                $('#warehousePincode1').val(x.warehousePincode1);
                $('#warehouseAddress2').val(x.warehouseAddress2);
                $('#warehouseCountry2').val(x.warehouseCountry2);
                $('#warehouseState2').val(x.warehouseState2);
                getcity(x.warehouseState2, "wh2");
                $('#warehouseCity2').val(x.warehouseState1);
                $('#warehousePincode2').val(x.warehousePincode2);
                $('#bankName').val(x.bankName);
                $('#branch').val(x.branch);
                $('#ifsc').val(x.ifsc);
                $('#accountHolderName').val(x.accountHolderName);
                $('#accountNumber').val(x.accountNumber);
                $('#TanNumber').val(x.TanNumber);
                $('#gstNumber').val(x.gstNumber);
                $('#panNumber').val(x.panNumber);
            }
        }); //ajax close

    }

    function clearmodal() {
        $('#brandid').val('');
        $('#brandName').val('');
        $('#brandEmail').val('');
        $('#brandPhone').val('');
        $('#brandWebsite').val('');

        $('#brandAddress').val('');

        $('#pincode').val('');
        ('#alias').val('');
        $('#firstName').val('');
        $('#email').val('');
        $('#mobile').val('');
        $('#gender').val('');
        $('#dob').val('');
        $('#warehouseAddress1').val('');



        $('#warehousePincode1').val('');
        $('#warehouseAddress2').val('');



        $('#warehousePincode2').val('');
        $('#bankName').val('');
        $('#branch').val('');
        $('#ifsc').val('');
        $('#accountHolderName').val('');
        $('#accountNumber').val('');
        $('#TanNumber').val('');
        $('#gstNumber').val('');
        $('#panNumber').val('');
    }
</script>
@endsection