<?php
use App\Models\MasterValue;

?>
@extends('gr.layout.app')
@section('body')

<div class="page-content">
    <div class="">
        <!-- end page title -->
        <div class="container-fluid">

            <div class="team-list row list-view-filter">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <div class="search-box">
                                       
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-sm-auto ms-auto">
                                    <div class="flex-grow-1">
                                        <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">PID/SKU</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col" style="text-align:center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $data)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td class="fw-medium">{{$data->PID}}</td>
                                                <td>
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0" style="width: 40px;height: 40px;">
                                                            <img src="{{asset('storage/app/public/document/'.$data->ProductImage)}}" alt="" class="img-fluid d-block rounded-circle" style="width:100px">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$data->ProductName}}</td>
                                                <?php
                                                $cname = MasterValue::find($data->ProductCategory);
                                                ?>
                                                <td>{{$cname->MasterValue}}</td>
                                                <td>{{$data->ProductSize}}</td>
                                                <td>{{$data->ProductRate}}</td>
                                                <td>{{$data->stock}}</td>
                                                <td align="right">
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$data->status==1?'Enable':'Desable'}}">
                                                            <a href="{{url('product_desable/'.$data->id)}}" class="text-muted d-inline-block">
                                                                <i class="ri-check-fill fs-16" style="color:{{$data->status==1?'green':'red'}};font-weight: bold;"></i>
                                                            </a>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <a class="edit-item-btn" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" href="{{url('product_delete/'.$data->id)}}">
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
                <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">
                <div class="step-arrow-nav">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Product Info</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!--end modal-body-->
            <form action="{{route('Product.store')}}" method="POST" class="checkout-tab" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                            <div class="row g-3">
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="firstName" class="form-label">PID</label>
                                        <input type="text" name="PID" class="form-control" id="firstName" value="{{$pid}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> Product Category </label>
                                        <select class="form-select " name="ProductCategory" aria-label="Default select example">
                                        @foreach($cat as $row)
                                            <option value="{{$row->id}}">{{$row->MasterValue}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="lastName" class="form-label">Product Name</label>
                                        <input type="text" name="ProductName" class="form-control" id="lastName" placeholder="Enter ">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="emailID" class="form-label"> Product Size</label>
                                        <input type="text" name="ProductSize" class="form-control" id="emailID" placeholder="Enter">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="emailID" class="form-label"> Product Rate </label>
                                        <input type="text" name="ProductRate" class="form-control" id="emailID" placeholder="Enter ">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="emailID" class="form-label"> Stock </label>
                                        <input type="text" name="stock" class="form-control" id="emailID" placeholder="Enter"  required onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="emailID" class="form-label"> Product Image </label>
                                        <input type="file" class="form-control" name="ProductImage" id="emailID" placeholder="Enter " accept="image/*">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="submit" class="btn btn-primary btn-label right ms-auto " data-nexttab="pills-bill-address-tab"> Save</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
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
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4 class="fs-semibold">You are about to delete a Product ?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your Product will
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
<script>
    function isNumber(e) {
        var keyCode = (e.which) ? e.which : e.keyCode;

        if (keyCode > 31 && (keyCode < 48 || keyCode > 57)) {
            //    alert("You can enter only numbers 0 to 9 ");
            return false;
        }
        return true;
    }
</script>
@endsection