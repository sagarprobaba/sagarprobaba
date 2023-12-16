<?php
use App\Models\Brand;

?>
@extends('gr.layout.app')
@section('body')
<div class="page-content">
    <div class="">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                
            </div>
        </div>
        <!-- end page title -->
        <div class="container-fluid">


            <div class="team-list row list-view-filter">
                <div class="col-lg-12">
                    <div class="card team-box">
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card">
                                    <table class="table align-middle " id="customerTable">
                                        <tbody class="list form-check-all">
                                            <tr>
                                            <td class="name" style="width:30%;">
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                        <?php


                                                                   $pic= isset($data->photo)?'storage/app/public/document/employee/'.$data->photo:'assets/images/no.png';
                                                                    ?>
                                                            
                                                                    <img src="{{asset($pic)}}" alt="" class="img-fluid d-block rounded-circle">
                                                        </div>
                                                        <div class="team-content">
                                                            <p class="text_blue mb-0">Freelancer</p>
                                                            <p class="text-muted mb-0">{{$data->EmployeeName}}</p>
                                                            <p class="text-muted mb-0">M: <span class="text_blue">{{$data->EmployeePhone}}</span></p>
                                                            <p class="badge bg-{{$data->attandence=='On Duty'?'success':'danger'}} mb-0">{{$data->attandence}}</span></p>
                                                            <p class="text-muted mb-0">Date : <span class="text_blue">{{$data->date}}</span></p>
                                                            <p class="text-muted mb-0">Time : <span class="text_blue">{{$data->time}}</span> </p>
                                                            <p class="text-muted mb-0">Location : <span class="text_blue">{{$data->address}}</span></p>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td style="width:30%;">
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0" style="width: 40px;height: 40px;">
                                                            <img src="{{asset('assets/images/brands/dribbble.png')}}" alt="" class="img-fluid d-block rounded-circle" style="width:100px">
                                                        </div>
                                                        <div class="team-content">
                                                            <p class="text_blue mb-0">Duty Start</p>                                                            
                                                            <p class="text-muted mb-0"> Total BGC : <span class="text_blue">{{$data->totalAssignDuty}}</span> </p>
                                                            <p class="text-muted mb-0"> Accept on : <span class="text_blue">{{$data->acceptDate}} </span></p>
                                                            <p class="text-muted mb-0"> To be Completed by : <span class="text_blue">{{$data->acceptDate}} </span></p>
                                                            <p class="text-muted mb-0"> Duty Area : <span class="text_blue">{{$data->address}}</span></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="name">
                                                    <p class="text_blue mb-0">Duty End</p>
                                                    <p class="text-muted mb-0"> Total BGC :<span class="text_blue"> {{$data->totalAssignDuty}}</span></p>
                                                    <p class="text-muted mb-0"> Complete BGC : <span class="text_blue">{{$data->totalcompleteDuty}}</span></p>
                                                    <p class="text-muted mb-0">Completed on :<span class="text_blue"> {{$data->completeDate}}</span></p>
                                                    <p class="text-muted mb-0"> Due BGC : <span class="text_blue"><b>{{$data->due}}</b></span></p>
                                                </td>

                                                <td>

                                                    
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control mb-2" placeholder="Commission : 800">
                                                        </div>
                                                    </div>
                                                    <select class="form-select mb-2" aria-label="Default select example">
                                                        <option> Estimated</option>
                                                        <option> Approved</option>
                                                        <option> Paid</option>
                                                        <option> Not Paid</option>
                                                        <option> Hold</option>
                                                    </select>
                                                    <div class="import_file">
                                                        <p class="btn btn-soft-success mb-0"> Import to CSV</p>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">BGC ID</th>
                                                <th scope="col">Start Date/Time</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Candidate</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Verify Type</th>
                                                <th scope="col">Commission</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($duties as $row)
                                            <tr>
                                                <td class="fw-medium">{{$row->checkID}}</td>
                                                <td>{{$row->assignDate}}</td>
                                                <td>{{$row->completeDate}}</td>
                                                <td><span class="badge bg-success ">Approved</span></td>
                                                @if(isset($row->brandId))
                                                <?php
                                                $brand = Brand::find($row->brandId);
                                                ?>
                                                <td>{{$brand->brandName}}</td>
                                                @else
                                                <td></td>
                                                @endif
                                                <td>{{$row->candidateName}}</td>
                                                <td>{{$row->mobileNo}}</td>
                                                @if($row->verificationType == "aV")
                                                <td>Address</td>
                                                @elseif($row->verificationType == "eV")
                                                <td>Employee</td>
                                                @elseif($row->verificationType == "cV")
                                                <td>Company</td>
                                                @elseif($row->verificationType == "sV")
                                                <td>Shop</td>
                                                @else
                                                <td></td>
                                                @endif

                                                <td>800</td>
                                                <td><a href="{{url('verifyDetail/'.$row->id.'/'.$row->verificationType)}}" target="_blank"  class="btn btn-light">Verify</a></td>
                                            </tr>
                                            @endforeach




                                            <tr class="table-light">
                                                <td class="fw-medium" colspan="8">Total {{$data->totalcompleteDuty}}</td>
                                                <td colspan="2">12000/-</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div><!-- end card-body -->
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title text-uppercase" id="exampleModalLabel">BCG CHECK ID : HCL00001
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" class="checkout-tab">
                <div class="modal-body p-0">
                    <div class="step-arrow-nav">
                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Basic Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">Emp Verification</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link p-3" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false">Custom Form (By AG)</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link p-3" id="pills-finish-tab" data-bs-toggle="pill" data-bs-target="#pills-finish" type="button" role="tab" aria-controls="pills-finish" aria-selected="false">Verification</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end modal-body-->
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                            <div class="row g-3">
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Check ID</label>
                                        <input type="email" class="form-control" id="phoneNumber" placeholder="HCL00001" readonly>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="firstName" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="HCL" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="lastName" class="form-label">Candidate</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="Gajendra" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Phone Number</label>
                                        <input type="email" class="form-control" id="phoneNumber" placeholder="9999999999" readonly>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="emailID" class="form-label"> Email ID </label>
                                        <input type="tel" class="form-control" id="emailID" placeholder="gajenn@webkype.com" readonly>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Address</label>
                                        <input type="tel" class="form-control" id="emailID" placeholder="Noida 201301, Sector 16, UP" readonly>
                                    </div>
                                </div>

                                <!--end col-->

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> Start Date</label>
                                        <input type="tel" class="form-control" id="emailID" placeholder="17 May 2022" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> End Date</label>
                                        <input type="tel" class="form-control" id="emailID" placeholder="19 May 2022" readonly>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Save</button>
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
                                        <label for="banknameInput" class="form-label">Researcher</label>
                                        <input type="text" class="form-control" id="banknameInput" placeholder="Avenue Growth" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="branchInput" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" id="branchInput" placeholder="HCL" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Employee Code</label>
                                        <input type="number" class="form-control" id="ifscInput" placeholder="HCL00001" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="accountnameInput" class="form-label">From</label>
                                        <input type="text" class="form-control" id="accountnameInput" placeholder="20/05/2022" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="accountnameInput" class="form-label">To</label>
                                        <input type="text" class="form-control" id="accountnameInput" placeholder="30/05/2022" readonly>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="accountnumberInput" class="form-label">Designation</label>
                                        <input type="number" class="form-control" id="accountnumberInput" placeholder="Manager" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Reason For Leaving</label>
                                        <input type="text" class="form-control" placeholder="Salary" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Reporting To</label>
                                        <input type="text" class="form-control" placeholder="Sumit" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Last Drawn Salary</label>
                                        <input type="text" class="form-control" placeholder="60,000" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack align-items-start gap-3 mt-4">

                                        <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Save</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                            <h5 class="mb-3">Custom Form</h5>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="banknameInput" class="form-label">Researcher</label>
                                        <input type="text" class="form-control" id="banknameInput" placeholder="Avenue Growth" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="branchInput" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" id="branchInput" placeholder="HCL" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Employee Code</label>
                                        <input type="number" class="form-control" id="ifscInput" placeholder="HCL00001" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="accountnameInput" class="form-label">From</label>
                                        <input type="text" class="form-control" id="accountnameInput" placeholder="20/05/2022" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="accountnameInput" class="form-label">To</label>
                                        <input type="text" class="form-control" id="accountnameInput" placeholder="30/05/2022" readonly>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="accountnumberInput" class="form-label">Designation</label>
                                        <input type="number" class="form-control" id="accountnumberInput" placeholder="Manager" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Reason For Leaving</label>
                                        <input type="text" class="form-control" placeholder="Salary" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Reporting To</label>
                                        <input type="text" class="form-control" placeholder="Sumit" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="ifscInput" class="form-label">Last Drawn Salary</label>
                                        <input type="text" class="form-control" placeholder="60,000" readonly>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack align-items-start gap-3 mt-4">

                                        <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Save</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="pills-finish" role="tabpanel" aria-labelledby="pills-finish-tab">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/images/brands/6x4_Wall_Snap_Horizontal.jpg')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/images/brands/download.jpg')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <p class="mb-0 text-center"><b>Remarks</b></p>
                                            <p class="text-muted mb-4 text-center">To stay verified, don't remove the
                                                meta tag form your site's home page. To avoid losing
                                                verification, you may want to add multiple methods form the
                                                <span class="fw-medium">Crypto > KYC Application.</span>
                                            </p>
                                        </div>

                                    </div>
                                </div>


                                <!--end col-->


                                <div class="hstack justify-content-center gap-2">
                                    <button type="button" class="btn btn-ghost-success" data-bs-dismiss="modal">Approved <i class="ri-thumb-up-fill align-bottom me-1"></i></button>
                                    <button type="button" class="btn btn-primary"><i class="ri-thumb-down-fill align-bottom me-1"></i> Dis-Approved</button>
                                </div>
                                <!--end col-->
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
<!--end modal-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header bg-light">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Job Fliters</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!--end offcanvas-header-->
    <form action="#" class="d-flex flex-column justify-content-end h-100">
        <div class="offcanvas-body">
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Category</label>
                        <select class="form-select " aria-label="Default select example">
                            <option value="1">Category 1 </option>
                            <option value="2"> Category 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Age Group</label>
                        <select class="form-select " aria-label="Default select example">
                            <option value="1">20-25 </option>
                            <option value="2"> 25-30</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Gender</label>
                        <select class="form-select " aria-label="Default select example">
                            <option value="1">Female </option>
                            <option value="2"> Male</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Skills</label>
                        <select class="form-select " aria-label="Default select example">
                            <option value="1">Skills 1 </option>
                            <option value="2"> Skills 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Location</label>
                        <select class="form-select " aria-label="Default select example">
                            <option value="1">Location 1 </option>
                            <option value="2"> Location 2</option>
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
@endsection