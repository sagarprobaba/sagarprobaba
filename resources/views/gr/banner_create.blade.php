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
                    <h4 class="mb-sm-0">Ad Banner</h4>

                    <div class="page-title-right">
                        <div class="flex-grow-1">
                            <a href="{{route('Banner.index')}}" rel="noopener noreferrer"> <button class="btn btn-info add-btn">Banner List</button></a>
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
                    <form class="needs-validation" action="{{route('Banner.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @else
                        <form class="needs-validation" action="{{route('Banner.store')}}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="card-body  border-bottom border-bottom-dashed p-4">

                                <!--end row-->
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="choices-payment-status">Position</label>
                                            <select class="form-control bg-light " name="position" id="position" aria-label="Default select example">
                                                <option value="">Select</option>
                                                <option value="home-top-left">Home-Top-Left</option>
                                                <option value="home-top-right-up">Home-Top-Right-Up</option>
                                                <option value="home-top-right-down">Home-Top-Right-Down</option>
                                                <option value="home-second-top">Home-Second-Top</option>
                                                <option value="home-middle">Home-Middle</option>
                                                <option value="home-second-last-botom">Home-Second-Last-Bottom</option>
                                                <option value="home-bottom">Home-Bottom</option>
                                            </select>
                                            <script>
                                                document.getElementById('position').value = "{{isset($item)?$item->position:''}}";
                                            </script>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label for="invoicenoInput">Banner*</label>
                                            <input type="file" name="banner" class="form-control bg-light " id="invoicenoInput" accept="image/*">
                                        </div>
                                        <!--end col-->

                                        <!--end col-->

                                        <!--end col-->

                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-6 col-sm-6">
                                            <label for="invoicenoInput">Heading</label>
                                            <input type="text" name="heading" class="form-control bg-light " id="invoicenoInput" placeholder="" value="{{isset($item)?$item->heading:''}}">
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Description</label>
                                                <input type="text" name="description" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->description:''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Share link</label>
                                                <input type="text" name="link" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->link:''}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="choices-payment-status">slider short</label>
                                            <div class="input-light">
                                                <input type="number" name="slider_short" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->slider_short:''}}">
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