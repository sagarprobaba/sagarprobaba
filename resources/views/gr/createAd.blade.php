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
                    <h4 class="mb-sm-0">AD BASIC INFO</h4>

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
                    @if(isset($item))
                    <form class="needs-validation" action="{{route('Category.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @else
                        <form class="needs-validation" action="{{route('Category.store')}}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="card-body  border-bottom border-bottom-dashed p-4">

                                <!--end row-->
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6 col-sm-6">
                                            <label for="invoicenoInput">Ad Title*</label>
                                            <input type="text" name="category_name" class="form-control bg-light " id="invoicenoInput" value="{{isset($item)?$item->category_name:''}}">
                                            <input type="hidden" name="parent_id" class="form-control bg-light " id="invoicenoInput" value="{{$parent}}">
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="choices-payment-status">Filter</label>
                                                <select class="form-select bg-light " name="filter_ids[]" id="intType3" aria-label="multiple select example" multiple="multiple">
                                                    <option value="">Select</option>                                                                                                                                                   
                                                                                                   
                                                </select>
                                                <script>
                                                    document.getElementById('brandName').value = "{{isset($item)?$item->brandName:''}}";
                                                </script>
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <!--end col-->

                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-lg-6 col-sm-6">
                                            <label for="invoicenoInput">Icon [300X300, MAX: 512KB]</label>
                                            <input type="file" name="icon" class="form-control bg-light " id="invoicenoInput" placeholder="" value="" accept="image/*">
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Banner [1000X200, MAX: 2MB]</label>
                                                <input type="File" name="banner" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="" accept="image/*">
                                            </div>
                                        </div>
                                        < </div>
                                            <!--end row-->
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-lg-12 col-sm-12">
                                                <label for="choices-payment-status">Filter</label>
                                                <select class="form-select bg-light " name="filter_ids[]" id="intType3" aria-label="multiple select example" multiple="multiple">
                                                    <option value="">Select</option>
                                                    @foreach($filter as $row)
                                                        <?php
                                                        $selected = "";
                                                        ?>                                                       
                                                        @if(isset($selectFile))
                                                            @foreach($selectFile as $val)
                                                            @if($val->filter_id == $row->id)
                                                            <?php
                                                            $selected = "selected";
                                                            ?>
                                                            @endif
                                                            @endforeach                                                     
                                                        
                                                        @endif
                                                    <option value="{{$row->id}}" {{$selected}}>{{$row->filter_name}}</option>
                                                    @endforeach
                                                </select>
                                                <script>
                                                    document.getElementById('brandName').value = "{{isset($item)?$item->brandName:''}}";
                                                </script>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-lg-12 col-sm-12">
                                                <label for="choices-payment-status">Description</label>
                                                <div class="input-light">
                                                    <textarea class="form-control bg-light " name="description" id="description" rows="5" placeholder="Description.......">{{isset($item)?$item->description:''}}</textarea>

                                                </div>
                                            </div>
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