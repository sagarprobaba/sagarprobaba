<?php

use Illuminate\Support\Facades\Auth;

$userid = Auth()->user()->id;
?>
@extends('gr.layout.app')
@section('body')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Company Verifiction</h4>

                    <div class="page-title-right">
                                            <div class="flex-grow-1">
                                               <a href="{{route('companyForm.index')}}"  rel="noopener noreferrer"> <button class="btn btn-info add-btn">Form List</button></a>
                                            </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card">
                    <form class="needs-validation" action="{{route('companyVerify.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body  border-bottom border-bottom-dashed p-4">
                        <div class="card-body p-4">


                                    <div class="row g-3">

                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <label for="serviceTax" class="form-label">Brand</label>
                                            <select class="form-control bg-light border-0" name="brandName" id="brandName" aria-label="Default select example">

                                                @foreach($brand as $row)
                                                <option value="{{$row->id}}">{{$row->brandName}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    </div>
                            <!--end row-->
                            <div class="card-body">
                                <div class="row g-3">
                                    <label for="invoicenoInput" class="col-lg-2 col-sm-6 text-center">Company Name</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <input type="text" name="companyName" class="form-control bg-light border-0" id="companyName" value="{{old('companyName')}}">
                                    </div>
                                    <!--end col-->
                                    <label for="date-field" class="col-lg-2 col-sm-6 text-center">District</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <input type="text" name="district" class="form-control bg-light border-0" id="district" data-provider="flatpickr" data-time="true" value="{{old('district')}}">
                                        </div>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <label for="date-field" class="col-lg-2 col-sm-6 text-center">Check ID </label>
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <input type="text" name="checkID" class="form-control bg-light border-0" id="checkID" data-provider="flatpickr" data-time="true" value="{{old('checkID')}}">
                                        </div>
                                    </div>

                                    <label for="invoicenoInput" class="col-lg-2 col-sm-6 text-center">State</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <input type="text" name="State" class="form-control bg-light border-0" id="State" value="{{old('State')}}">
                                    </div>
                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <label for="date-field" class="col-lg-2 col-sm-6 text-center">Address of company</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <textarea class="form-control bg-light border-0" name="addressOfCompany" id="addressOfCompany" rows="1" placeholder="Address" >{{old('addressOfCompany')}}</textarea>

                                        </div>
                                    </div>

                                    <label for="invoicenoInput" class="col-lg-2 col-sm-6 text-center">Pin-Code</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <input type="text" name="pinCode" class="form-control bg-light border-0" id="pinCode" value="{{old('pinCode')}}">
                                    </div>
                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <label for="date-field" class="col-lg-2 col-sm-6 text-center">Landmark</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <input type="text" name="landmark" class="form-control bg-light border-0" id="landmark" data-provider="flatpickr" data-time="true" value="{{old('landmark')}}">
                                        </div>
                                    </div>

                                    <label for="invoicenoInput" class="col-lg-2 col-sm-6 text-center">Type of Area</label>
                                    <div class="col-lg-4 col-sm-6">
                                        <input type="text" name="typeOfArea" class="form-control bg-light border-0" id="typeOfArea" value="{{old('typeOfArea')}}">
                                    </div>
                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <div class="col-lg-2 col-sm-6">
                                        <label class="form-check-label" style="font-size: 11px;" for="companyExists">
                                            Company Exists
                                        </label>
                                        <input type="checkbox" class="form-check-input"  id="companyExists" name="companyExists" value="1">
                                    </div>
                                    <div class="col-lg-2 col-sm-6">
                                        <label class="form-check-label" style="font-size: 11px;" for="companyShutDown">
                                            Company ShutDown
                                        </label>
                                        <input type="checkbox" class="form-check-input" id="companyShutDown" name="companyShutDown" value="1">
                                    </div>
                                    <div class="col-lg-2 col-sm-6">
                                        <label class="form-check-label" style="font-size: 11px;" for="companyShifted">
                                            Company Shifted
                                        </label>
                                        <input type="checkbox" class="form-check-input" id="companyShifted" name="companyShifted" value="1">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label class="form-check-label" style="font-size: 11px;" for="noInformationFound">
                                            No Information Found
                                        </label>
                                        <input type="checkbox" class="form-check-input" id="noInformationFound" name="noInformationFound" value="1">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label class="form-check-label" style="font-size: 11px;" for="companyNeverExisted">
                                        Company Never Existed
                                        </label>
                                        <input type="checkbox" class="form-check-input" id="companyNeverExisted" name="companyNeverExisted" value="1">
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <center> <label for="date-field" class="text-center">Company Details if Exists & Never Exists</label></center>
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Company Board Available</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="companyBoardAvailable" class="form-control bg-light " id="companyBoardAvailable" value="{{old('companyBoardAvailable')}}">
                                            </div>

                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Company name at the board </label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="companyNameAtTheBoard" class="form-control bg-light " id="companyNameAtTheBoard" value="{{old('companyNameAtTheBoard')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Number of Employees</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="numberofEmployees" class="form-control bg-light " id="numberofEmployees" value="{{old('numberofEmployees')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Nature of Business</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="natureOfBusiness" class="form-control bg-light " id="natureOfBusiness" value="{{old('natureOfBusiness')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Existing since</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="existingSince" class="form-control bg-light " id="existingSince" value="{{old('existingSince')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Interior of the company</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="interiorOfTheCompany" class="form-control bg-light " id="interiorOfTheCompany" value="{{old('interiorOfTheCompany')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Exterior of the company</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="exteriorOfTheCompany" class="form-control bg-light " id="exteriorOfTheCompany" value="{{old('exteriorOfTheCompany')}}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <center><label for="date-field" class="text-center">Concerned person Details</label></center>
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Name of the concerned person</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="nameOfTheConcernedPerson" class="form-control bg-light " id="nameOfTheConcernedPerson" value="{{old('nameOfTheConcernedPerson')}}">
                                            </div>

                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Designation</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="designationOfTheConcernedPerson" class="form-control bg-light " id="designationOfTheConcernedPerson" value="{{old('designationOfTheConcernedPerson')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Contact No./Email</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="contactEmailOfTheConcernedPerson" class="form-control bg-light " id="contactEmailOfTheConcernedPerson" value="{{old('contactEmailOfTheConcernedPerson')}}">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-12 col-sm-12">
                                                <center><label for="date-field" class="text-center">Name of the person met who verifies the existence of the compan</label></center>
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Name of the person met</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="nameOfThePersonMet" class="form-control bg-light " id="nameOfThePersonMet" value="{{old('nameOfThePersonMet')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Designation</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="designationOfThePersonMet" class="form-control bg-light " id="designationOfThePersonMet" value="{{old('designationOfThePersonMet')}}">
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Contact No./Email</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="contactEmailOfThePersonMet" class="form-control bg-light " id="contactEmailOfThePersonMet" value="{{old('contactEmailOfThePersonMet')}}">
                                            </div>

                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <div class="col-lg-12 col-sm-12">
                                        <center><label for="date-field" class="text-center">Company Details if Shut-down & shifte</label></center>
                                    </div>

                                    <label for="date-field" class="col-lg-6 col-sm-6 ">New Address of the company availabl</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="radio" class="form-check-input" id="yes" name="newAddressOfTheCompanyAvailable" value="1">
                                                <label for="yes" class="">Yes</label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="radio" class="form-check-input" id="no" name="newAddressOfTheCompanyAvailable" value="0">
                                                <label for="no" class="">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">If “No” mention reason</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="reason" class="form-control bg-light " id="reason" value="{{old('reason')}}">
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">New Address of the company</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="newAddressOfTheCompany" class="form-control bg-light " id="newAddressOfTheCompany" value="{{old('newAddressOfTheCompany')}}">
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Month & Year of shifting/ shutdown</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="monthYearOfShiftingShutdown" class="form-control bg-light " id="monthYearOfShiftingShutdown" value="{{old('monthYearOfShiftingShutdown')}}">
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">In case of shifted or shut down, name of the current company at the given address</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="inCaseOfShifted" class="form-control bg-light " id="inCaseOfShifted" value="{{old('inCaseOfShifted')}}">
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Duration of Current Company’s Existenc</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="durationOfCurrentCompanyExistenc" class="form-control bg-light " id="durationOfCurrentCompanyExistenc" value="{{old('durationOfCurrentCompanyExistenc')}}">
                                    </div>

                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body">

                                <div class="row g-3">


                                    <label for="date-field" class="col-lg-6 col-sm-6 ">Collected Photograph of the company containing the address</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="radio" class="form-check-input" id="co_yes" name="collectedPhotograph" value="1">
                                                <label for="co_yes" class="">Yes</label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="radio" class="form-check-input" id="co_no" name="collectedPhotograph" value="0">
                                                <label for="co_no" class="">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Photos unavailability reason</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="photosUnavailabilityReason" class="form-control bg-light " id="photosUnavailabilityReason" value="{{old('photosUnavailabilityReason')}}">
                                    </div>


                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="table-responsive">
                                <table class="invoice-table table table-borderless table-nowrap mb-0">
                                    <thead class="align-middle">
                                        <tr class="table-active">
                                            <th scope="col" class="text-start" style="width:30%;">Neighbour Check </th>
                                            <th scope="col" class="text-start">Neighbour 1</th>
                                            <th scope="col" class="text-start">Neighbour 2</th>
                                            <th scope="col" class="text-start">Neighbour 3</th>
                                            <th scope="col" class="text-start">Neighbour 4</th>
                                            <th scope="col" class="text-start">Neighbour 5</th>

                                        </tr>
                                    </thead>
                                    <tbody id="newlink">
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">Name of Neighbour</th>
                                            <td class="text-start">
                                                <input type="text" name="nameOfNeighbour1" class="form-control bg-light border-0" id="nameOfNeighbour1">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="nameOfNeighbour2" class="form-control bg-light border-0" id="nameOfNeighbour2">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="nameOfNeighbour3" class="form-control bg-light border-0" id="nameOfNeighbour3">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="nameOfNeighbour4" class="form-control bg-light border-0" id="nameOfNeighbour4">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="nameOfNeighbour5" class="form-control bg-light border-0" id="nameOfNeighbour5">
                                            </td>                               
                                        </tr>
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">Company name <br> (forcommercial/Industrial areas) / Full Address <br> (for residential areas)</th>
                                            <td class="text-start">
                                                <input type="text" name="companyNameOfNeighbour1" class="form-control bg-light border-0" id="companyNameOfNeighbour1">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="companyNameOfNeighbour2" class="form-control bg-light border-0" id="companyNameOfNeighbour2">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="companyNameOfNeighbour3" class="form-control bg-light border-0" id="companyNameOfNeighbour3">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="companyNameOfNeighbour4" class="form-control bg-light border-0" id="companyNameOfNeighbour4">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="companyNameOfNeighbour5" class="form-control bg-light border-0" id="companyNameOfNeighbour5">
                                            </td>                               
                                        </tr>
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">Period of existence</th>
                                            <td class="text-start">
                                                <input type="text" name="periodOfExistenceOfNeighbour1" class="form-control bg-light border-0" id="periodOfExistenceOfNeighbour1">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="periodOfExistenceOfNeighbour2" class="form-control bg-light border-0" id="periodOfExistenceOfNeighbour2">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="periodOfExistenceOfNeighbour3" class="form-control bg-light border-0" id="periodOfExistenceOfNeighbour3">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="periodOfExistenceOfNeighbour4" class="form-control bg-light border-0" id="periodOfExistenceOfNeighbour4">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="periodOfExistenceOfNeighbour5" class="form-control bg-light border-0" id="periodOfExistenceOfNeighbour5">
                                            </td>                               
                                        </tr>
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">Statement by the Neighbour</th>
                                            <td class="text-start">
                                                <input type="text" name="statementByTheNeighbour1" class="form-control bg-light border-0" id="statementByTheNeighbour1">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="statementByTheNeighbour2" class="form-control bg-light border-0" id="statementByTheNeighbour2">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="statementByTheNeighbour3" class="form-control bg-light border-0" id="statementByTheNeighbour3">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="statementByTheNeighbour4" class="form-control bg-light border-0" id="statementByTheNeighbour4">
                                            </td>
                                            <td class="text-start">
                                                <input type="text" name="statementByTheNeighbour5" class="form-control bg-light border-0" id="statementByTheNeighbour5">
                                            </td>                               
                                        </tr>
                                    </tbody>



                                    </tbody>
                                </table>
                                <!--end table-->

                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <center> <label for="date-field" class="text-center">Post Office Check </label></center>
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Name of Post office </label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="nameOfPostOffice" class="form-control bg-light " id="nameOfPostOffice" value="{{old('nameOfPostOffice')}}">
                                            </div>

                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Whether the post office receives any request from the given compan</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="postOfficeReceivesRequest" class="form-control bg-light " id="postOfficeReceivesRequest" value="{{old('postOfficeReceivesRequest')}}">
                                            </div>
                                           
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <center><label for="date-field" class="text-center">Courier Service Check</label></center>
                                            </div>
                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Name of Courier Service</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="nameOfCourierService" class="form-control bg-light " id="nameOfCourierService" value="{{old('nameOfCourierService')}}">
                                            </div>

                                            <label for="invoicenoInput" class="col-lg-6 col-sm-6 ">Whether the Courier Service receives any request from the given compan</label>
                                            <div class="col-lg-6 col-sm-6">
                                                <input type="text" name="courierServiceReceivesRequest" class="form-control bg-light " id="courierServiceReceivesRequest" value="{{old('courierServiceReceivesRequest')}}">
                                            </div>
                                            
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="row">
                                            
                                            <label for="invoicenoInput" class="col-lg-4 col-sm-6 ">Additional remarks by Field Executive</label>
                                            <div class="col-lg-8 col-sm-6">
                                                <input type="text" name="additionalRemarks" class="form-control bg-light " id="additionalRemarks" value="{{old('additionalRemarks')}}">
                                            </div>

                                            
                                           
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row g-3">
                                    

                                    <label for="date-field" class="col-lg-6 col-sm-6 ">Signature of Vendor </label>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="text" name="signatureOfVendor" class="form-control bg-light " id="signatureOfVendor" placeholder="DigitalSignature" value="{{old('signatureOfVendor')}}">
                                    </div>
                                    
                                    <label for="invoicenoInput" class="col-lg-1 col-sm-6 ">Date</label>
                                    <div class="col-lg-3 col-sm-6">
                                        <input type="date" name="Date" class="form-control bg-light " id="Date" value="{{old('Date')}}">
                                    </div>
                                    <label for="invoicenoInput" class="col-lg-2 col-sm-6 text-center">Time</label>
                                    <div class="col-lg-3 col-sm-6">
                                        <input type="time" name="time" class="form-control bg-light " id="time" value="{{old('time')}}">
                                    </div>
                                   

                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="table-responsive">
                                <table class="invoice-table table table-borderless table-nowrap mb-0">
                                    <thead class="align-middle">
                                        <tr class="table-active">
                                            <th scope="col" class="text-start" style="width:10%">#</th>
                                            <th scope="col" class="text-start" style="width:50%">
                                                Field Name
                                            </th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="newlink">
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">1</th>
                                            <td class="text-start">
                                                <input type="text" class="form-control bg-light border-0" id="fieldname">
                                            </td>

                                            <td>
                                                <a href="javascript:new_link()" onclick="additem();" id="add-item" class="btn btn-soft-secondary fw-medium"><i class="ri-add-fill me-1 align-bottom"></i>Add</a>
                                            </td>

                                        </tr>
                                    </tbody>



                                    </tbody>
                                </table>
                                <!--end table-->

                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3" id="newFields">

                                </div>
                                <!--end row-->
                            </div>

                            <div class="mt-4">
                                <label for="exampleFormControlTextarea1" class="form-label text-muted text-uppercase fw-semibold">NOTES</label>
                                <textarea class="form-control alert alert-info" id="exampleFormControlTextarea1" placeholder="Notes" rows="2">All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</textarea>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <button type="submit" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Save</button>
                                <!-- <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download Invoice</a>
                                <a href="javascript:void(0);" class="btn btn-danger"><i class="ri-send-plane-fill align-bottom me-1"></i> Send Invoice</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div>
<script>
    function additem() {
        var len = $("#newFields div").length;
        var xid = len;
        if (xid < 10) {
            var fieldname = $("#fieldname").val();
            var userId = "{{$userid}}";

            // alert(userId);
            jQuery.ajax({
                type: 'GET',
                url: "{{url('companyaddfieldname')}}?fieldname=" + fieldname + "&userId=" + userId,
                dataType: 'html',
                success: function(city_name) {

                    // document.getElementById("city").innerHTML = city_name; 
                    // $('#city').selectpicker('refresh'); 
                    // $('#city_chosen').hide();;
                    var x = JSON.parse(city_name);



                    $("#newFields").append('<div id="new' + x.id + '" class="col-lg-4 col-sm-6"><label for="invoicenoInput">' + x.field + '</label><input type="text" name="' + x.columnId + '" class="form-control bg-light border-0" value="{{old(' + x.columnId + ')}}" id="invoicenoInput"><a href="javascript:void(0);"  onclick="removeDiv(' + x.id + ');" id="add-item" class="btn btn-danger btn-sm fw-medium"><i class="ri-add-fill me-1 align-bottom"></i>Remove</a></div>');



                    // alert(city_name);
                    //   $('#city').html(city);

                }
            }); //ajax close
        }
    }

    function fatchinput() {
        var userId = "{{$userid}}";
        jQuery.ajax({
            type: 'GET',
            url: "{{url('fatchinputcompany')}}?userId=" + userId,
            dataType: 'html',
            success: function(data) {


                var x = JSON.parse(data);


                for (let i = 0; i < x.length; i++) {

                    $("#newFields").append('<div id="new' + x[i].id + '" class="col-lg-4 col-sm-6"><label for="invoicenoInput">' + x[i].field + '</label><input type="text" name="' + x[i].columnId + '" class="form-control bg-light border-0" id="invoicenoInput" value="{{old(' + x[i].columnId + ')}}"><a href="javascript:void(0);" onclick="removeDiv(' + x[i].id + ');" id="add-item" class="btn btn-danger btn-sm fw-medium"><i class="ri-add-fill me-1 align-bottom"></i>Remove</a></div>');

                }



            }
        }); //ajax close
    }
    window.onload = fatchinput;

    function removeDiv(id) {

        jQuery.ajax({
            type: 'GET',
            url: "{{url('removeDivcompany')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                $("#new" + data).remove();
            }
        }); //ajax close
    }
</script>
@endsection