<?php

use App\Models\Cpr_ad_category;
use App\Models\MasterValue;

?>
@extends('gr.layout.app')
@section('body')

<div class="page-content">
    <div class="">
        <!-- end page title -->
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">
                        <a href="{{route('Category.index')}}">Category</a>
                        @if(isset($pppp))
                            @if($pppp != '')                        
                            -><a href ="{{url('ad-category/'.$pppp->id)}}">{{$pppp->category_name}}</a>
                            @endif
                        @endif
                        @if(isset($ppp))
                            @if($ppp !='')                        
                            -><a href ="{{url('ad-category/'.$ppp->id)}}">{{$ppp->category_name}}</a>
                            @endif
                        @endif
                        @if($parent !=0)                        
                        -><a href ="{{url('ad-category/'.$parent)}}">{{$parentParent->category_name}}</a>
                        @endif
                    </h4>
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
                    

                </div>
            </div>
        </div>
            <div class="team-list row list-view-filter">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                             <form class="needs-validation" action="{{url('search_category')}}" method="GET" enctype="multipart/form-data">
                                 @csrf
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="search-box">
                                    <select class="form-select"  aria-label="Default select example" onchange="getlower(this.value);">
                                    <option value="0">Primary Category</option>
                                        
                                                    @foreach($data as $row)
                                                        <option value="{{$row->id}}">{{$row->category_name}}</option>
                                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                     <input type="text" name="keyword" class="form-control bg-light " id="myInput" onkeyup="myFunction()" placeholder="Keywords" value="{{isset($keyword)?$keyword:''}}">
                                </div>
                                <div class="col-md-2">
                                     <button type="submit" class="btn btn-info add-btn">Search</button>
                                </div>
                              
                                <div class="col-sm-auto ms-auto">
                                    <div class="flex-grow-1">
                                        <a href="{{url('create-categary/'.$parent)}}"><button type="button" class="btn btn-info add-btn"><i class="ri-add-fill me-1 align-bottom"></i> Add Ad Category</button></a>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="card-body">

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle mb-0" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Banner</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">view</th>
                                                <th scope="col">Sort</th>                                    
                                                <th scope="col">Mapped Filter</th>                                    
                                                <th scope="col" style="text-align:center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $data)
                                            <tr>
                                                
                                                <td class="fw-medium"></td>
                                                <td>
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail  flex-shrink-0" style="width: 40px;height: 40px;">
                                                            <img src="{{asset('public/public/category/icon/'.$data->icon)}}" alt="" class="img-fluid d-block " style="width:100px">
                                                        </div>
                                                    </div>
                                                </td>
                                                    <?php
                                                    $sub = Cpr_ad_category::where('parent_id',$data->id)->count('id');
                                                    ?>
                                                <td>{{$data->category_name}} <br>
                                                    +{{$sub}} Sub Categories

                                                </td>                                                
                                                <td style="width:50px">
                                                    
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail  flex-shrink-0" style="width: 40px;height: 40px;">
                                                            <img src="{{asset('public/public/category/banner/'.$data->banner)}}" alt="" class="img-fluid d-block " style="width:100px">
                                                        </div>
                                                    </div>
                                                    </td>
                                                <td style="width:250px">{{$data->description}}</td>
                                                <td>
                                                    @if($data->parent_id == 0)
                                                    <input type="checkbox" name="event" data-id="{{$data->id}}" onchange="setHome(this.value)" id="Featured{{$data->id}}" value="{{$data->id}}" @if($data->home == 1)checked @endif>
                                                    <lable for="Featured{{$data->id}}">Home</lable> 
                                                    @endif
                                                </td>
                                                <td><input type="number" name="cat_short" id="" value="{{$data->sort}}" onchange="cat_short(this.value,{{$data->id}})" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
                                                <td style="width:50px">
                                                    <a href="javascript:;" onclick='viewSub({{$data->id}})' title='View filters' data-bs-toggle="modal" data-bs-target="#table-modal" data-type='filter' data-table-data=''>
                                                    <i class="ri-eye-fill fs-16" style="color:blue;font-weight: bold;"></i>
                                                    </a>
                                                </td>                                              
                                                <td align="right">
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="{{$data->status==1?'Desable':'Enable'}}">
                                                            @if($data->status==1)
                                                            <a href="{{url('Category_desable/'.$data->id.'/'.$parent)}}" class="text-muted d-inline-block">
                                                                <i class="ri-check-fill fs-16" style="color:red;font-weight: bold;"></i>
                                                            </a>
                                                            @endif
                                                            @if($data->status==0)
                                                            <a href="{{url('Category_enable/'.$data->id.'/'.$parent)}}" class="text-muted d-inline-block">
                                                                <i class="ri-check-fill fs-16" style="color:green;font-weight: bold;"></i>
                                                            </a>
                                                            @endif
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <a class="edit-item-btn" href="{{url('category_edit/'.$data->id.'/'.$parent)}}" href="javascript:void(0)"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        @if(auth()->user()->delete_access == 1)
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" href="{{url('category_delete/'.$data->id.'/'.$parent)}}" onclick="return confirm('Are You Sure')">
                                                                <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                            </a>
                                                        </li>
                                                        @endif
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
<!-- Modal -->
<div class="modal center-modal" id="table-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title list-heading">Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="list-group list-data">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

<script>
  function setTableData(e) {
    let type = e.dataset.type;
    let tableData = JSON.parse(e.dataset.tableData);
    let template = '';
    tableData.forEach(element => {
      if(type === 'filter') {
        template += `<a href="javascript:;" class="list-group-item list-group-item-action">${element.filter_name}</a>`;
      } 
      if(type === 'brand') {
        template += `<a href="javascript:;" class="list-group-item list-group-item-action">${element.brand_name}</a>`;
      }
      if(type === 'categories') {
        template += `<a href="${route('admin.category.index', element.id)}" class="list-group-item list-group-item-action">${element.category_name}</a>`;
      }
      if(type === 'blog') {
        template += `<a href="javascript:;" class="list-group-item list-group-item-action">${element.name}</a>`;
      }
      if(type === 'service-categories') {
        template += `<a href="${route('admin.service-category.index', element.id)}" class="list-group-item list-group-item-action">${element.category_name}</a>`;
      }
      
      if(type === 'filter-values') {
        template += `<a href="javascript:;" class="list-group-item list-group-item-action">${element.filter_value}</a>`;
      }
      if(type === 'product-type-values') {
        template += `<a href="javascript:;" class="list-group-item list-group-item-action">${element.type_value}</a>`;
      }
    });
    document.querySelector('.list-heading').textContent = type.toUpperCase();
    document.querySelector('.list-data').innerHTML = template;

  } 
</script>
<script>
    function isNumber(e) {
        var keyCode = (e.which) ? e.which : e.keyCode;

        if (keyCode > 31 && (keyCode < 48 || keyCode > 57)) {
            //    alert("You can enter only numbers 0 to 9 ");
            return false;
        }
        return true;
    }
    function getlower(id)
    {
        window.location.href = "{{url('ad-category')}}" + "/" + id;
    }
    function viewSub(id) {
        jQuery.ajax({
       type: 'GET',
       url: "{{url('viewSub')}}?id="+id,
       dataType: 'JSON',
       success: function(responce) {
        console.log(responce.data);
        let template = '';
        responce.data.forEach(element => {
            template += `<a href="javascript:;" class="list-group-item list-group-item-action">${element.filter_name}</a>`;
        });
       
            console.log(template);
            document.querySelector('.list-data').innerHTML = template;     
       }
       }); //ajax close
    }
    function setHome(id) {
        jQuery.ajax({
       type: 'GET',
       url: "{{url('setHome')}}?id="+id,
       dataType: 'JSON',
       success: function(responce) {
            
       }
       }); //ajax close
    }
    function cat_short(cat_val, cat_id) {
        
        if(cat_val != '')
        {
            jQuery.ajax({

            type: 'GET',

            url: "{{url('cat_short')}}?id=" + cat_id + "&val=" + cat_val,

            dataType: 'html',

            success: function(data) {

                

            }

            }); //ajax close
        }

        

    }
    function myFunction() {

        var input, filter, table, tr, td, i;

        input = document.getElementById("myInput");

        filter = input.value.toUpperCase();

        table = document.getElementById("customerTable");

        var rows = table.getElementsByTagName("tr");

        for (i = 0; i < rows.length; i++) {

            var cells = rows[i].getElementsByTagName("td");

            var j;

            var rowContainsFilter = false;

            for (j = 0; j < cells.length; j++) {

                if (cells[j]) {

                    if (cells[j].innerHTML.toUpperCase().indexOf(filter) > -1) {

                        rowContainsFilter = true;

                        continue;

                    }

                }

            }



            if (!rowContainsFilter) {

                rows[i].style.display = "none";

            } else {

                rows[i].style.display = "";

            }

        }

    }
    
    
</script>
@endsection