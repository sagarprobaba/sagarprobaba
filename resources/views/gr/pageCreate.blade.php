@extends('gr.layout.app')
@section('body')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Page</h4>
                    <div class="flash-message">

                        @if(Session::has('error'))

                        <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @if(Session::has('success'))

                        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif

                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="page-title-right">
                        <div class="flex-grow-1">
                            <a href="{{route('Pages.index')}}" rel="noopener noreferrer"> <button class="btn btn-info add-btn">Page List</button></a>
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
                    <form class="needs-validation" action="{{route('Pages.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @else
                        <form class="needs-validation" action="{{route('Pages.store')}}" method="POST" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="card-body  border-bottom border-bottom-dashed p-4">

                                <!--end row-->

                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-6 col-sm-6">
                                            <label for="invoicenoInput">Page Name *</label>
                                            <input type="text" name="name" class="form-control bg-light " id="invoicenoInput" placeholder="" value="{{isset($item)?$item->name:''}}">
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Page Seo Title</label>
                                                <input type="text" name="seo_title" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->seo_title:''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-6 col-sm-6">
                                            <div>
                                                <label for="date-field">Page Seo Description</label>
                                                <input type="text" name="seo_description" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->seo_description:''}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="choices-payment-status">Page Seo Keyword</label>
                                            <div class="input-light">
                                                <input type="number" name="seo_keywords" class="form-control bg-light " id="date-field" data-provider="flatpickr" data-time="true" value="{{isset($item)?$item->seo_keywords:''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">

                                        <div class="col-lg-12 col-sm-12">
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
                                        <div class="col-lg-12 col-sm-12">
                                            <label for="invoicenoInput">Page Content</label>
                                            <textarea class="form-control bg-light" name="content" id="projectDescription" placeholder="About Description..." required>
													{!! isset($item)?$item->content:'' !!}</textarea>
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
<script>
    CKEDITOR.replace('projectDescription');
</script>
@endsection