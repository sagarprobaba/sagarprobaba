<?php

use App\Models\Cpr_ad_event;
use App\Models\Cpr_Add_filter_value;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_ad_category;
use App\Models\Master;
use App\Models\webUser;
use Illuminate\Support\Facades\DB;

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
                                        <div class="flash-message">

                                            @if(Session::has('error'))

                                            <p class="alert alert-danger">{{ Session::get('error') }}</p>
                                            @endif
                                            @if(Session::has('success'))

                                            <p class="alert alert-success">{{ Session::get('success') }} </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-sm-auto ms-auto">
                                    <!-- <div class="flex-grow-1">
                                        <button class="btn btn-info add-btn" onclick="clearmodal();" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Master Values</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle  mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="text-align:center">Sr no.</th>
                                                <th scope="col" style="text-align:center">User</th>
                                                <th scope="col" style="text-align:center">Title</th>
                                                <th scope="col" style="text-align:center">Category</th>
                                                <th scope="col" style="text-align:center">Description</th>
                                                <th scope="col" style="text-align:center">Location</th>
                                                <th scope="col" style="text-align:center">Price</th>
                                                <th scope="col" style="text-align:center">Images</th>
                                                <th scope="col" style="text-align:center">Values</th>
                                                <th scope="col" style="text-align:center">View</th>
                                                <th scope="col" style="text-align:center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datas as $data)

                                            <tr>
                                                <td class="fw-medium" style="text-align:center">{{$loop->index+1}}</td>
                                                <td class="fw-medium" style="text-align:center">

                                                    <?php
                                                    $user = webUser::find($data->user_id);
                                                    ?>
                                                    {{$user->firstName}} {{$user->lastName}}
                                                </td>
                                                <td class="fw-medium" style="text-align:center">{{$data->title}}</td>
                                                <?php
                                                    $ct = Cpr_ad_mapped_category::where('ad_id',$data->id)->first();
                                                    if(isset($ct))
                                                    {
                                                        $ctt = Cpr_ad_category::where('id',$ct->category_id)->first();
                                                        $cat_name = $ctt->category_name;
                                                    }
                                                    else
                                                    {
                                                        $cat_name = "";
                                                    }
                                                    
                                                ?>
                                                <td class="fw-medium" style="text-align:center">{{$cat_name}}</td>
                                                <td class="fw-medium" style="text-align:center;">{{$data->description}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->country}},
                                                @if(isset($data->state))
                                                <?php                                                
                                                $state = DB::table('states')->whereId($data->state)->first();
                                                ?>
                                                {{$state->name}},
                                                @endif
                                                @if(isset($data->city))
                                                <?php                                                
                                                $city = DB::table('cities')->whereId($data->city)->first();
                                                ?>
                                                {{$city->name}}
                                                @endif
                                                
                                                </td>
                                                <td class="fw-medium" style="text-align:center">₹{{$data->price}}</td>
                                                <td class="fw-medium" style="text-align:center">
                                                    <a href="javascript:;" onclick='viewSub({{$data->id}})' title='View filters' data-bs-toggle="modal" data-bs-target="#table-modal" data-type='filter' data-table-data=''>
                                                        <i class="ri-eye-fill fs-16" style="color:blue;font-weight: bold;"></i>
                                                    </a>
                                                </td>
                                                <?php
                                                $fill = Cpr_Add_filter_value::join('cpr_ad_filter_values', 'cpr_ad_filter_values.id', 'cpr__add_filter_values.filter_value_id')->where('ad_id', $data->id)->get();

                                                ?>
                                                <td class="fw-medium" style="text-align:left;width:12%;">
                                                    <ul>
                                                        @foreach($fill as $fill)
                                                        <li>{{$fill->filter_value}}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="fw-medium" style="text-align:left;width:12%;">
                                                    <ul style="list-style:none;">
                                                        <?php
                                                        $fet = Cpr_ad_event::where('ad_id',$data->id)->where('event','f')->first();
                                                        isset($fet)?$fcheck="checked":$fcheck="";
                                                        $Cfet = Cpr_ad_event::where('ad_id',$data->id)->where('event','c')->first();
                                                        isset($Cfet)?$Ccheck="checked":$Ccheck="";
                                                        $efet = Cpr_ad_event::where('ad_id',$data->id)->where('event','e')->first();
                                                        isset($efet)?$echeck="checked":$echeck="";
                                                        ?>
                                                        
                                                    
                                                        <li><input type="checkbox" name="event" data-id="{{$data->id}}" onchange="setEvent(this)" id="Featured{{$data->id}}" value="f" {{$fcheck}}>Featured</li>
                                                        <li><input type="checkbox" name="event" data-id="{{$data->id}}" onchange="setEvent(this)" id="Collection{{$data->id}}" value="c" {{$Ccheck}}>Collection</li>
                                                        <li><input type="checkbox" name="event" data-id="{{$data->id}}" onchange="setEvent(this)" id="Electric{{$data->id}}" value="e" {{$echeck}}>Electric</li>
                                                    </ul>
                                                </td>
                                                <td style="text-align:center;width:8%">

                                                    <ul class="list-inline hstack gap-2 mb-0 ml-2">
                                                        @if($data->status == 0 )
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Enable">
                                                            <a href="{{url('Add_enable/'.$data->id)}}" class="text-muted d-inline-block" onclick="return confirm('Are You Sure?');">
                                                                <i class="ri-check-fill fs-16" style="color:green;font-weight: bold;"></i>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Disable">
                                                            <a href="{{url('Add_disable/'.$data->id)}}" class="text-muted d-inline-block" onclick="return confirm('Are You Sure?');">
                                                                <i class="ri-close-fill fs-16" style="color:red;font-weight: bold;"></i>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if(auth()->user()->delete_access == 1)
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" href="{{url('Add_delete/'.$data->id)}}" onclick="return confirm('Are You Sure?');">
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
                            {{$datas->links('pagination::bootstrap-4')}}
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
                <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Master Value
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">
                <div class="step-arrow-nav">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Master Info</button>
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
                    <h4 class="fs-semibold">You are about to delete a Master Value ?</h4>
                    <p class="text-muted fs-14 mb-4 pt-1">Deleting your Master Value will
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
<div class="modal center-modal" id="table-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title list-heading">Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group list-data">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function isNumber(e) {
        var keyCode = (e.which) ? e.which : e.keyCode;

        if (keyCode > 31 && (keyCode < 48 || keyCode > 57)) {
            //    alert("You can enter only numbers 0 to 9 ");
            return false;
        }
        return true;
    }

    function editmastervalue(id) {

        jQuery.ajax({
            type: 'GET',
            url: "{{url('editmastervalue')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                var x = JSON.parse(data);
                $('#MasterValueid').val(x.id);
                $('#MasterHead').val(x.MasterHead);
                $('#MasterValue').val(x.MasterValue);


            }
        }); //ajax close

    }

    function clearmodal() {
        $('#MasterValueid').val('');
        $('#MasterHead').val('');
        $('#MasterValue').val('');

    }

    function viewSub(id) {
        jQuery.ajax({
            type: 'GET',
            url: "{{url('viewImages')}}?id=" + id,
            dataType: 'JSON',
            success: function(responce) {
                console.log(responce);
                let template = '';
                responce.forEach(element => {
                    template += `<img src="public/ad/${element.image}">`;
                });

                console.log(template);
                document.querySelector('.list-data').innerHTML = template;
            }
        }); //ajax close
    }
    function setEvent(e)
    {
        console.log(e.checked);
        console.log(e.dataset.id);
        var id = e.dataset.id;
        var value = e.value;
        var bool = e.checked;
        jQuery.ajax({
            type: 'GET',
            url: "{{url('setEvent')}}?id=" + id+"&value="+value+"&bool="+bool,
            dataType: 'JSON',
            success: function(responce) {
                console.log(responce);
                let template = '';
                responce.forEach(element => {
                    template += `<img src="public/ad/${element.image}">`;
                });

                console.log(template);
                document.querySelector('.list-data').innerHTML = template;
            }
        }); //ajax close
    }
</script>
@endsection