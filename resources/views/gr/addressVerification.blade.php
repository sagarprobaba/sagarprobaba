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
                    <h4 class="mb-sm-0">Address Verifiction</h4>

                    <div class="page-title-right">
                        <div class="flex-grow-1">
                            <a href="{{route('address.index')}}" rel="noopener noreferrer"> <button class="btn btn-info add-btn">Form List</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card">
                    <form class="needs-validation" action="{{route('addressVerify.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <script>
                                            document.getElementById('brandName').value = "{{isset($item)?$item->brandName:''}}";
                                        </script>
                                    </div>

                                </div>
                            </div>
                            <!--end row-->
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="invoicenoInput">Candidate Name</label>
                                        <input type="text" name="candidateName" class="form-control bg-light border-0" id="invoicenoInput" value="{{isset($item)?$item->candidateName:''}}">
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <label for="date-field">Check id</label>
                                            <input type="text" name="checkId" class="form-control bg-light border-0" id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->checkId:''}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="choices-payment-status">Complete Address</label>
                                        <div class="input-light">
                                            <textarea class="form-control bg-light border-0" name="completeAddress" id="billingAddress" rows="1" placeholder="Address">{{isset($item)?$item->completeAddress:''}}</textarea>
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
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="invoicenoInput">Period of Stay</label>
                                        <input type="text" name="periodOfStay" class="form-control bg-light border-0" id="invoicenoInput" placeholder="" value="{{isset($item)?$item->periodOfStay:''}}">
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <label for="date-field">Document Proof Attached</label>
                                            <input type="text" name="documentProofAttached" class="form-control bg-light border-0" id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->documentProofAttached:''}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="invoicenoInput">Respondent’s Name</label>
                                        <input type="text" name="respondentName" class="form-control bg-light border-0" id="invoicenoInput" placeholder="" value="{{isset($item)?$item->respondentName:''}}">
                                    </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <label for="date-field">Respondent’s contact Details</label>
                                            <input type="text" name="respondentContactDetails" class="form-control bg-light border-0" id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->respondentContactDetails:''}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="choices-payment-status">Respondent’s Signature</label>
                                        <div class="input-light">
                                            <input type="text" name="respondentSignature" class="form-control bg-light border-0" id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->respondentSignature:''}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-sm-6">
                                        <label for="invoicenoInput">Additional Comment if any</label>
                                        <input type="text" name="additionalComment" class="form-control bg-light border-0" id="invoicenoInput" value="{{isset($item)?$item->additionalComment:''}}">
                                    </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </div>
                            <div class="card-body p-4 mb-3">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-sm-6">
                                        <div>
                                            <label for="date-field">Date of visit</label>
                                            <input type="date" name="dateOfVisit" class="form-control bg-light border-0" id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->dateOfVisit:''}}">
                                        </div>
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
                url: "{{url('addfieldname')}}?fieldname=" + fieldname + "&userId=" + userId,
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
            url: "{{url('fatchinput')}}?userId=" + userId,
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
            url: "{{url('removeDiv')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                $("#new" + data).remove();
            }
        }); //ajax close
    }
</script>
@endsection