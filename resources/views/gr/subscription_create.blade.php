@extends('gr.layout.app')
@section('body')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Ad Subscription</h4>

                    <div class="page-title-right">
                        <div class="flex-grow-1">
                            <a href="{{url('subscription_list')}}" rel="noopener noreferrer"> <button class="btn btn-info add-btn">Subscription List</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card">
                    @if(isset($item))
                    <form class="needs-validation" action="{{url('subscription_update/'.$item->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @else
                        <form class="needs-validation" action="{{url('subscription_store')}}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="card-body  border-bottom border-bottom-dashed p-4">

                                <!--end row-->
                                
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-6 col-sm-6">
                                            <label for="invoicenoInput">Name</label>
                                            <input type="text" name="name" class="form-control bg-light " id="invoicenoInput" placeholder="" value="{{isset($item)?$item->name:''}}">
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Price</label>
                                                <input type="number" name="price" min="0" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->price:''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Number Of Enquiries </label>
                                                <input type="number" name="number_of_enquiries" min="0" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->number_of_enquiries:''}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="choices-payment-status">Validity Days</label>
                                            <div class="input-light">
                                                <input type="number" name="validity_days" min="0" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->validity_days:''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                    </div>
                                    <!--end row-->
                                </div>

                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    <button type="submit" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>Save</button>
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
@endsection