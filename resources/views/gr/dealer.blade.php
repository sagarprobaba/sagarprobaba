<?php
use App\Models\MasterValue;

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
                                                <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i>Add Dealer</button>
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
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <div class="team-profile-img">
                                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                                    <img src="assets/images/logo-dark.png" alt="" class="img-fluid d-block rounded-circle">
                                                                </div>
                                                                <div class="team-content">
                                                                    <a href="pages-profile.html" aria-controls="offcanvasExample">
                                                                        <h5 class="fs-16 mb-1">{{$data->CompanyName}} </h5>
                                                                    </a>

                                                                    <p class="text-muted mb-0">{{$data->CompanyEmail}}</p>
                                                                    <p class="text-muted mb-0">{{$data->CompanyPhone}}</p>
                                                                    <p class="text-muted mb-0">{{$data->CompanyWebsite}}</p>
                                                                    <p class="text-muted mb-0">Date Added: {{date('d-m-Y',strtotime($data->created_at))}}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="name">
                                                            <p class="text-muted mb-0">TAN: {{$data->TanNumber}} </p>
                                                            <p class="text-muted mb-0">GST: {{$data->GSTNumber}}</p>
                                                            <p class="text-muted mb-0">PAN: {{$data->PanNumber}}</p>
                                                        </td>
                                                        <?php


                                                            $des = MasterValue::find($data->Designation);
                                                            ?>
                                                        <td class="name">

                                                            <p class="text-muted mb-0"> {{$data->FirstName}} {{$data->LastName}}</p>
                                                            <p class="text-muted mb-0">{{$des->MasterValue}}</p>
                                                            <p class="text-muted mb-0">Email: {{$data->EmailID}}</p>
                                                            <p class="text-muted mb-0">Mobile: {{$data->MobileNo}}</p>

                                                        </td>
                                                        <td class="name" align="center">
                                                            <h5 class="mb-1">0</h5>
                                                            <p class="text-muted mb-0">Total Orders</p>
                                                        </td>
                                                        <td align="center">
                                                            <h5 class="mb-1">0</h5>
                                                            <p class="text-muted mb-0">Cancel Orders</p>
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$data->status==1?'Enable':'Desable'}}">
                                                                    <a href="{{url('client_desable/'.$data->id)}}" class="text-muted d-inline-block">
                                                                        <i class="ri-check-fill fs-16" style="color:{{$data->status==1?'green':'red'}};font-weight: bold;"></i>
                                                                    </a>
                                                                </li>

                                                                <li class="list-inline-item">
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-eye-fill align-bottom text-muted"></i></a>
                                                                </li>
                                                                <li class="list-inline-item">

                                                                    <a class="edit-item-btn" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" href="{{url('client_delete/'.$data->id)}}">
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

                                <div class="modal-body p-0">
                                    <div class="step-arrow-nav">
                                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
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
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end modal-body-->
                                <form action="{{route('Client.store')}}" method="POST" class="checkout-tab" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                                                <div class="row g-3">
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label for="firstName" class="form-label">Company Name</label>
                                                            <input type="text" class="form-control" id="firstName" placeholder="Enter Company Name" name="CompanyName" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label for="lastName" class="form-label">Company Email</label>
                                                            <input type="email" class="form-control" id="lastName" placeholder="Enter Company Email" name="CompanyEmail" required>
                                                        </div>
                                                    </div>


                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label for="emailID" class="form-label"> Company Phone</label>
                                                            <input minlength="10" maxlength="10" class="form-control" id="emailID" placeholder="Enter Company Phone" name="CompanyPhone" required onkeypress="return isNumber(event);" type="text" ondrop="return false;" onpaste="return false;">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <label for="emailID" class="form-label"> Company Website </label>
                                                            <input type="text" class="form-control" id="emailID" placeholder="Enter Company Website" name="CompanyWebsite" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 mt-3 mb-3" style="border-top: 1px dashed #cccdcc;">

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label for="serviceTax" class="form-label">Company Address</label>
                                                            <input type="text" class="form-control" id="serviceTax" placeholder="Enter your Address" name="CompanyAddress" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> Country</label>
                                                            <select class="form-select " aria-label="Default select example" name="Country" required>

                                                                <option value="1">India </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="serviceTax" class="form-label"> State</label>
                                                            <select class="form-select " onchange="getcity(this.value)" aria-label="Default select example" name="State" required>
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
                                                            <select class="form-select chosen-select" aria-label="Default select example" name="City" id="city" required>
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

                                                            <button class="nexttab btn btn-success right ms-auto">Next</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane fade" id="pills-bill-address" role="tabpanel" aria-labelledby="pills-bill-address-tab">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="banknameInput" class="form-label">Bank
                                                                Name</label>
                                                            <input type="text" class="form-control" id="banknameInput" placeholder="Enter your bank name" name="BankName" required>
                                                            <input type="hidden" name="type" value="D">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="branchInput" class="form-label">Branch</label>
                                                            <input type="text" class="form-control" id="branchInput" placeholder="Branch" name="Branch" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="ifscInput" class="form-label">IFSC</label>
                                                            <input type="text" class="form-control" id="ifscInput" placeholder="IFSC" name="IFSC" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnameInput" class="form-label">Account
                                                                Holder Name</label>
                                                            <input type="text" class="form-control" id="accountnameInput" placeholder="Enter account holder name" name="AccountHolderName" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">Account Number</label>
                                                            <input type="number" class="form-control" id="accountnumberInput" placeholder="Enter account number" name="AccountNumber" required onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="ifscInput" class="form-label">Cancel Cheque</label>
                                                            <input type="file" class="form-control" name="CancelCheque">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="row">
                                                        <div class="col-lg-3">
                                                            <div>
                                                                <div class="form-check mt-3">
                                                                    <input class="form-check-input" type="checkbox" name="chk_child" value="option1"> Validate Data
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 " style="margin-top: 11px;"><span style="color:green;"><i class="ri-check-fill fs-16" style="color:green;font-weight: bold;"></i> Information is Valid</span></div>
                                                    </div> -->

                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack align-items-start gap-3 mt-4">


                                                            <button class="prevtab btn btn-success">Prev</button>

                                                            <button class="nexttab btn btn-success right ms-auto">Next</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                                                <div class="row mb-3">
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">Tan Number</label>
                                                            <input type="text" class="form-control" id="accountnumberInput" placeholder="Enter " name="TanNumber" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">GST Number</label>
                                                            <input type="text" class="form-control" id="accountnumberInput" placeholder="Enter " name="GSTNumber" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="accountnumberInput" class="form-label">Pan Number</label>
                                                            <input type="text" class="form-control" id="accountnumberInput" placeholder="Enter " name="PanNumber" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5 class="mb-3">Choose Document Type</h5>

                                                <div class="d-flex gap-2">
                                                    <div>
                                                        <input type="radio" class="btn-check" id="passport" checked="" name="choose-document">
                                                        <label class="btn btn-outline-info" for="passport">MOU</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" class="btn-check" id="aadhar-card" name="choose-document">
                                                        <label class="btn btn-outline-info" for="aadhar-card">GST</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" class="btn-check" id="pan-card" name="choose-document">
                                                        <label class="btn btn-outline-info" for="pan-card">Pan Card</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" class="btn-check" id="profile-photo" name="choose-document">
                                                        <label class="btn btn-outline-info" for="profile-photo">Logo</label>
                                                    </div>

                                                </div>

                                                <div class="dropzone d-flex align-items-center">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick text-center">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                        </div>

                                                        <h4>Drop files here or click to upload.</h4>
                                                    </div>
                                                </div>

                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    <li class="mt-2" id="dropzone-preview-list">
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded">
                                                                        <img src="#" alt="" data-dz-thumbnail="" class="img-fluid rounded d-block">
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1" data-dz-name="">&nbsp;</h5>
                                                                        <p class="fs-13 text-muted mb-0" data-dz-size="">
                                                                        </p>
                                                                        <strong class="error text-danger" data-dz-errormessage=""></strong>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    <button data-dz-remove="" class="btn btn-sm btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- end dropzon-preview -->
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button class="prevtab btn btn-success">Prev</button>
                                                    <button class="nexttab btn btn-success right ms-auto">Next</button>


                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                                                <div class="row g-3">

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="firstName" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="firstName" placeholder="Enter" name="FirstName" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="lastName" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="lastName" placeholder="Enter" name="LastName" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="phoneNumber" class="form-label">Email ID</label>
                                                            <input type="email" class="form-control" id="phoneNumber" placeholder="Enter" name="EmailID" required>
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="emailID" class="form-label"> Mobile No </label>
                                                            <input type="text" minlength="10" maxlength="10" class="form-control" id="emailID" placeholder="Enter" name="MobileNo" required onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;" required>
                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmPassword" class="form-label">Gender</label>
                                                            <select class="form-select " name="Gender" aria-label="Default select example" required>

                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="emailID" class="form-label"> Designation </label>
                                                            <select class="form-select mb-3" name="Designation" aria-label="Default select example" required>
                                                                @foreach($desig as $row)
                                                                <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <!--end col-->
                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button class="prevtab btn btn-success">Prev</button>
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
                                        <h4 class="fs-semibold">You are about to delete a Dealer ?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your Dealer will
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
            pane = $('.tab-pane');
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
</script>
@endsection