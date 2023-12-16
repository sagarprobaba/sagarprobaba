<?php

use App\Models\Cpr_ad_event;
use App\Models\Cpr_Add_filter_value;
use App\Models\Master;
use App\Models\webUser;
use App\Models\Cpr_Add_images;

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
                                    <h4>Total Ad {{$tdata}}</h4>
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
                                <a href="{{url('adReport')}}"><button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal">
                                        <i class="ri-add-fill me-1 align-bottom"></i>
                                        Clear
                                    </button></a>
                                    <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" href="#offcanvasExample">
                                        <i class="ri-filter-3-line align-bottom me-1"></i>
                                        Fliters
                                    </button>
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
                                                 <th scope="col" style="text-align:center">User image</th>
                                                <th scope="col" style="text-align:center">User</th>
                                                <th scope="col" style="text-align:center">Title</th>
                                                <th scope="col" style="text-align:center">Description</th>
                                                <th scope="col" style="text-align:center">Location</th>
                                                <th scope="col" style="text-align:center">Price</th>
                                                <th scope="col" style="text-align:center">Images</th>
                                                <th scope="col" style="text-align:center">Values</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datas as $data)

                                            <tr>
                                                <td class="fw-medium" style="text-align:center">{{$loop->index+1}}</td>
                                                    <?php
                                                    $user = webUser::find($data->user_id);
                                                    ?>
                                                <td class="fw-medium" style="text-align:center">
                                                @if(isset($user->companyLogo))
                                                <img src="{{asset('public/user/'.$user->companyLogo)}}" class="img-fluid d-block rounded-circle" alt="profile" width="65" style="height:45px" />

                                                @elseif(isset($user->image))
                                                <img src="{{asset('public/user/'.$user->image)}}" class="img-fluid d-block rounded-circle" alt="profile" width="65"  style="height:45px"/>

                                                @else
                                                <img src="webassets/images/profile.png" alt="profile" class="img-fluid d-block rounded-circle" width="65"  style="height:45px"/>

                                                @endif
                                                </td>
                                                <td class="fw-medium" style="text-align:center">
                                                    @if(isset($user))
                                                    
                                                    {{$user->firstName}} {{$user->lastName}}
                                                    @endif
                                                </td>
                                                <td class="fw-medium" style="text-align:center"><a href="{{url('product_detail/'.$data->id)}}" target="_blank">{{$data->title}}</a></td>
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
                                                            <?php
                                                            $pic = Cpr_Add_images::where('ad_id', $data->id)->first();
                                                            ?>
                                                            @if(isset($pic))
                                                            <img   src="{{asset('public/ad/'.$pic->image)}}" alt="image" title="" style=" max-width:100px;max-height:100px;width:auto" />
                                                            @endif


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
    <form action="{{url('adfilter')}}" class="d-flex flex-column justify-content-end h-100">
        @csrf
        <div class="offcanvas-body">
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Category</label>
                        <select class="form-select " id="adcat" name="adcat" aria-label="Default select example">
                            <option value="">Select</option>
                            @foreach($cat as $cat)
                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                        <script>
                            document.getElementById('adcat').value = "{{isset($adcat)?$adcat:''}}";
                        </script>
                    </div>
                </div>
            </div>
            

        </div>
        <!--end offcanvas-body-->
        <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
            <a href="{{url('adReport')}}"><button type="button" class="btn btn-light w-100">Clear Filter</button></a>
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

    function setEvent(e) {
        console.log(e.checked);
        console.log(e.dataset.id);
        var id = e.dataset.id;
        var value = e.value;
        var bool = e.checked;
        jQuery.ajax({
            type: 'GET',
            url: "{{url('setEvent')}}?id=" + id + "&value=" + value + "&bool=" + bool,
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