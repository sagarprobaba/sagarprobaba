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
                    <h4 class="mb-sm-0">Employee Verifiction</h4>

                    <div class="page-title-right">
                        <div class="flex-grow-1">
                            <a href="{{route('employeeForm.index')}}" rel="noopener noreferrer"> <button class="btn btn-info add-btn">Form List</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card">
                    <form class="needs-validation" action="{{route('employeeVerify.store')}}" method="POST" enctype="multipart/form-data">
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
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="invoicenoInput">Name of Employee</label>
                                        <input type="text" name="nameOfEmployee" class="form-control bg-light border-0" id="nameOfEmployee" value="{{old('nameOfEmployee')}}">
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Period of Employment</label>
                                            <div class="row g-3">
                                                <label for="date-field" class="col-lg-2 col-sm-6 text-center">From</label>
                                                <div class="col-lg-4 col-sm-6">
                                                    <input type="date" style="font-size: 11px;" name="periodOfEmploymentFrom" class="form-control bg-light border-0" id="periodOfEmploymentFrom" value="{{old('periodOfEmploymentFrom')}}">
                                                </div>
                                                <label for="date-field" class="col-lg-2 col-sm-6 text-center">To</label>
                                                <div class="col-lg-4 col-sm-6">
                                                    <input type="date" style="font-size: 11px;" name="periodOfEmploymentTo" class="form-control bg-light border-0 " id="periodOfEmploymentTo" value="{{old('periodOfEmploymentTo')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="choices-payment-status">Designation</label>
                                        <div class="input-light">
                                            <!-- <textarea class="form-control bg-light border-0" name="completeAddress" id="billingAddress" rows="1" placeholder="Address" >{{old('periodOfStay')}}</textarea> -->
                                            <input type="text" name="designation" class="form-control bg-light border-0" id="designation" value="{{old('designation')}}">

                                            <div class="invalid-feedback" value="">
                                                Please enter a address
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="choices-payment-status">Last drawn salary by the Applicant (Annual Gross)</label>
                                        <div class="input-light">
                                            <!-- <textarea class="form-control bg-light border-0" name="completeAddress" id="billingAddress" rows="1" placeholder="Address" >{{old('periodOfStay')}}</textarea> -->
                                            <input type="text" name="lastDrawnsalary" class="form-control bg-light border-0" id="lastDrawnsalary" value="{{old('lastDrawnsalary')}}">

                                            <div class="invalid-feedback" value="">
                                                Please enter a address
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->



                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="invoicenoInput">Employee Code</label>
                                        <input type="text" name="employeeCode" class="form-control bg-light border-0" id="employeeCode" placeholder="" value="{{old('employeeCode')}}">
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Reporting Managers Details</label>
                                            <input type="text" name="reportingManagersDetails" class="form-control bg-light border-0" id="reportingManagersDetails" value="{{old('reportingManagersDetails')}}">
                                        </div>
                                    </div>
                                    <!--end col-->




                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="invoicenoInput">Reason for leaving</label>
                                        <input type="text" name="reasonForLeaving" class="form-control bg-light border-0" id="reasonForLeaving" placeholder="" value="{{old('reasonForLeaving')}}">
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Eligibility for rehire</label>
                                            <input type="text" name="eligibilityForRehire" class="form-control bg-light border-0" id="eligibilityForRehire" value="{{old('eligibilityForRehire')}}">
                                        </div>
                                    </div>
                                    <!--end col-->


                                </div>
                            </div>

                            <div class="card-body p-4 mb-3">
                                <div class="row g-3">
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="choices-payment-status" style="font-size: 12.5px;">Feedback on account of Disciplinary/Ethical/Integrity conduct on the job.</label>
                                        <div class="input-light">
                                            <input type="text" name="feedbackOnAccount" class="form-control bg-light border-0" id="feedbackOnAccount" value="{{old('feedbackOnAccount')}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="invoicenoInput">Referee's Details</label>
                                        <input type="text" name="refereeDetails" class="form-control bg-light border-0" id="refereeDetails" value="{{old('refereeDetails')}}">
                                    </div>
                                    <!--end col-->


                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4 mb-3">
                                <div class="row g-3">

                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Additional Comments</label>
                                            <input type="text" name="additionalComments" class="form-control bg-light border-0" id="additionalComments" value="{{old('additionalComments')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Exit Formalities</label>
                                            <input type="text" name="exitFormalities" class="form-control bg-light border-0" id="exitFormalities" value="{{old('exitFormalities')}}">
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4 mb-3">
                                <div class="row g-3">

                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Details Confirmed by</label>
                                            <input type="text" name="detailsConfirmedBy" class="form-control bg-light border-0" id="detailsConfirmedBy" value="{{old('detailsConfirmedBy')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div>
                                            <label for="date-field">Digital Signature Of Verifire</label>
                                            <input type="text" name="signature" class="form-control bg-light border-0" id="signature" value="{{old('signature')}}">
                                        </div>
                                    </div>
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
                url: "{{url('addfieldnameEmployee')}}?fieldname=" + fieldname + "&userId=" + userId,
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
            url: "{{url('fatchinputEmployee')}}?userId=" + userId,
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
            url: "{{url('removeDivEmployee')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                $("#new" + data).remove();
            }
        }); //ajax close
    }
</script>
@endsection