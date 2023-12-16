<?php

use App\Models\Cpr_Add_post;
use App\Models\Master;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_ad_category;
use App\Models\Cpr_enquiry_assign;
use App\Models\Cpr_auction_bid;
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
                            <form action="{{url('filtEnquiry')}}" method="get">
                                @csrf
                                <div class="row g-2">
                                    <!--<div class="col-md-2">-->
                                    <!--    <label for="confirmPassword" class="form-label">Category</label>-->
                                    <!--    <select class="form-select " name="category" onchange="getSub()" id="serchcategory" aria-label="Default select example" required>-->
                                    <!--        <option value="">Select</option>-->
                                    <!--        @foreach($cate as $cats)-->
                                    <!--        <option value="{{$cats->id}}">{{$cats->category_name}}</option>-->
                                    <!--        @endforeach-->
                                    <!--    </select>-->
                                    <!--    <script>-->
                                    <!--        document.getElementById('serchcategory').value = "{{isset($serchcategory)?$serchcategory:''}}";-->
                                    <!--    </script>-->
                                    <!--</div>-->
                                    
                                    <!--<div class="col-md-3">-->
                                    <!--    <button type="submit" class="btn btn-info mt-4">Search</button>-->
                                    <!--    <a href="{{url('auctionlist')}}"><button type="button" class="btn btn-info mt-4">Clear</button></a>-->

                                    <!--</div>-->
                                    <div class="col-md-2">
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

                                    <div class="col-sm-auto ms-auto">
                                        <button type="button" class="btn btn-info add-btn"><a href="{{url('adenquiry')}}" target="_blank">Back To Enquiry List</a></button>
                                        <!--<button type="button" id="auc_btn" class="btn btn-info add-btn d-none" data-bs-toggle="modal" data-bs-target="#auction"><i class="ri-add-fill me-1 align-bottom"></i>Create Auction</button>-->
                                        <!--<button type="button" class="btn btn-info add-btn" onclick="setAuction()"><i class="ri-add-fill me-1 align-bottom"></i>Create Auction</button>-->

                                        <!--<button type="button" class="btn btn-info add-btn" data-bs-toggle="modal" onclick="setExport()" data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i> Assign To Vendor</button>-->
                                        <!-- <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" href="#offcanvasExample"><i class="ri-filter-3-line align-bottom me-1"></i> Fliters</button> -->
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body">

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <!--<th scope="col" style="text-align:center">-->
                                                <!--    <label for="allcheck">#</label>-->
                                                <!--    <input id="allcheck" type="checkbox" name="check" />-->
                                                <!--</th>-->
                                                <th scope="col" style="text-align:center">Sr no.</th>
                                                <th scope="col" style="text-align:center">Auction Name</th>
                                                <th scope="col" style="text-align:center">Auction Category</th>
                                                <th scope="col" style="text-align:center">Minimum Bid</th>
                                                <th scope="col" style="text-align:center">Minimum Increment Amount</th>
                                                <th scope="col" style="text-align:center">Auction Start Date/Time</th>
                                                <th scope="col" style="text-align:center">Auction End Date/Time</th>
                                                <th scope="col" style="text-align:center">Enquiry Count</th>
                                                <th scope="col" style="text-align:center">Bid Placed</th>
                                                <th scope="col" style="text-align:center">Status</th>
                                                <th scope="col" style="text-align:center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($auctions as $key => $data)

                                            <tr>
                                                <!--<td class="fw-medium" style="text-align:center">-->
                                                <!--    <input id="check-{{$data->id}}" type="checkbox" name="emplist" value="{{$data->id}}" />-->
                                                <!--    <label for="check-{{$data->id}}"></label>-->
                                                <!--</td>-->
                                                <td class="fw-medium" style="text-align:center">{{$loop->index+1}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->auction_name}}</td>
                                                <?php
                                                
                                                    $adcat1 = Cpr_ad_category::find($data->cpr_ad_category_id);
                                                    
                                                ?>
                                                <td class="fw-medium" style="text-align:center">{{$adcat1?->category_name}}</td>
                                                

                                                <td class="fw-medium" style="text-align:center">{{$data->Minimum_bid}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->Min_increment_amt}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->auction_start_time}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->auction_time}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->enquiry_count}}</td>
                                                <?php
                                                
                                                    $cnt = Cpr_auction_bid::where('cpr_auction_id',$data->id)->count();
                                                    
                                                ?>
                                                <td class="fw-medium" style="text-align:center">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" onclick="getBidderList({{$data->id}})" data-bs-target="#showVendorList">{{$cnt}}</a>

                                                </td>
                                                @if($data->status == 1 )
                                                <td class="fw-medium" style="text-align:center">OPEN</td>
                                                @else
                                                <td class="fw-medium" style="text-align:center">CLOSE</td>
                                                @endif
                                                <td style="text-align:center;width:8%">

                                                    <ul class="list-inline hstack gap-2 mb-0 ml-2">
                                                        <!--@if($data->status == 0 )-->
                                                        <!--<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Enable">-->
                                                        <!--    <a href="{{url('auction_enable/'.$data->id)}}" class="text-muted d-inline-block">-->
                                                        <!--        <i class="ri-check-fill fs-16" style="color:green;font-weight: bold;"></i>-->
                                                        <!--    </a>-->
                                                        <!--</li>-->
                                                        <!--@else-->
                                                        <!--<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Disable">-->
                                                        <!--    <a href="{{url('auction_disable/'.$data->id)}}" class="text-muted d-inline-block">-->
                                                        <!--        <i class="ri-close-fill fs-16" style="color:red;font-weight: bold;"></i>-->
                                                        <!--    </a>-->
                                                        <!--</li>-->
                                                        <!--@endif-->
                                                        @if(auth()->user()->delete_access == 1)
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" href="{{url('auction_delete/'.$data->id)}}" onclick="return confirm('Are You Sure?')">
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

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 802px;">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <div class="modal-body p-0">
                <div class="step-arrow-nav">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Assign To</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!--end modal-body-->
            <form action="{{url('assignvendor')}}" class="checkout-tab" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                            <div class="row g-3">

                                <div class="col-lg-6">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Category</label>
                                        <select class="form-select " name="category" onchange="getVendor()" id="category" aria-label="Default select example" required>
                                            <option value="">Select</option>
                                            @foreach($cate as $cats)
                                            <option value="{{$cats->id}}">{{$cats->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Vendor</label>
                                        <select class="form-select " name="vendor[]" id="vendor" aria-label="Default select example" required multiple>
                                            <option value="">Select</option>
                                            @foreach($ven as $vens)
                                            <option value="{{$vens->id}}">{{$vens->firstName}}&nbsp;{{$vens->lastName}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="enqids" id="enqids" value="">
                                    </div>
                                </div>


                                <!--end col-->

                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="submit" class="btn btn-primary  ms-auto">
                                            Assign</button>
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
<div class="modal fade" id="showVendorList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 802px;">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <div class="modal-body p-0">
                <div class="step-arrow-nav">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Bidder List</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!--end modal-body-->
            <form action="" class="checkout-tab" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="step-arrow-nav">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle  mb-0" id="customerTable">
                                <thead class="table-light">
                                    <tr>

                                        <th align="center" scope="col">#</th>
                                        <th align="center" scope="col">Bidder Name</th>
                                        <th align="center" scope="col">Company Name</th>
                                        <th align="center" scope="col">Email</th>
                                        <th align="center" scope="col">Phone</th>
                                        <th align="center" scope="col">Bid Amount</th>
                                        <th align="center" scope="col">Status</th>
                                        <th align="center" scope="col">Action</th>
                                        

                                    </tr>
                                </thead>
                                <tbody id="sizelistView">



                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end tab content -->
                </div>
                <!--end modal-body-->
            </form>
        </div>
    </div>
</div>


<!--end modal-->
<div class="modal fade" id="auction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 802px;">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>

            <div class="modal-body p-0">
                <div class="step-arrow-nav">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">Create Auction</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!--end modal-body-->
            <form action="{{url('create_auction')}}" class="checkout-tab" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Selected Category :</label>          
                                        <label for="confirmPassword" class="form-label" id="cat_name"></label>          
                                                                     
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Enquiry Count :</label>          
                                        <label for="confirmPassword" class="form-label" id="enq_cnt"></label>              
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Name</label>          
                                        <input type="text" class="form-control" name="auction_name" value="" required>                              
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Minimum Bid</label>
                                        <input type="text" class="form-control" name="Minimum_bid" value="" required>
                                        <input type="hidden" name="enqids" id="auction_enqids" value="">
                                        <input type="hidden" name="enquiry_count" id="enquiry_count" value="">
                                        <input type="hidden" name="cat" id="auction_cat" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Start Date/Time</label>          
                                        <input type="datetime-local" class="form-control" name="auction_start_time" value="" required>                              
                                    </div>
                                </div>                   
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">End Date/Time</label>          
                                        <input type="datetime-local" class="form-control" name="auction_time" value="" required>                              
                                    </div>
                                </div>                   

                                <!--end col-->

                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="submit" class="btn btn-primary  ms-auto">
                                            Create</button>
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

    $('#allcheck').change(function() {
        if ($(this).prop('checked')) {
            $('tr td input[type="checkbox"]').each(function() {
                $(this).prop('checked', true);
            });
        } else {
            $('tr td input[type="checkbox"]').each(function() {
                $(this).prop('checked', false);
            });
        }
    });
    $(document).ready(function() {

        $('[name="emplist"]').click(function(e) {
            if ($('[name="emplist"]:checked').length == $('[name="emplist"]').length || !this.checked)
                $('#allcheck').prop('checked', this.checked);
        });

    });

    function setExport() {
        var checkboxes = document.getElementsByName('emplist');
       
        
        var checkboxesChecked = [];

        for (var i = 0; i < checkboxes.length; i++) {

            if (checkboxes[i].checked) {
                checkboxesChecked.push(checkboxes[i].value);
            }
        }
        if (checkboxesChecked.length > 0) {
            document.getElementById('enqids').value = checkboxesChecked;
            

        } else {
            alert('Please Select Enquiries');
        }

        console.log(checkboxesChecked.length);
    }
    function setAuction() {
        var checkboxes = document.getElementsByName('emplist');
        var cate = document.getElementById('serchcategory').value;
        if(cate == '')
        {
            alert('Please Select A Category');
            return false;
        }
        
        var checkboxesChecked = [];

        for (var i = 0; i < checkboxes.length; i++) {

            if (checkboxes[i].checked) {
                checkboxesChecked.push(checkboxes[i].value);
            }
        }
        if (checkboxesChecked.length > 0) {
            document.getElementById('auction_enqids').value = checkboxesChecked;
            document.getElementById('auction_cat').value = cate;
            var e = document.getElementById("serchcategory");
            var text = e.options[e.selectedIndex].text;
            document.getElementById('cat_name').innerHTML = text;
            document.getElementById('enq_cnt').innerHTML = checkboxesChecked.length;
            document.getElementById('enquiry_count').value = checkboxesChecked.length;
            document.getElementById('auc_btn').click();
        } else {
            alert('Please Select Enquiries');
            return false;
        }

        console.log(checkboxesChecked.length);
    }

    function getVendor() {

        var cat = $('#category').val();

        // alert(cat)
        jQuery.ajax({
            type: 'GET',
            url: "{{url('getVendor')}}?cat=" + cat,
            dataType: 'html',
            success: function(data) {
                console.log(data);
                $('#vendor').html(data);

            }
        }); //ajax close

    }

    function getSub() {

        var cat = $('#serchcategory').val();

        // alert(cat)
        jQuery.ajax({
            type: 'GET',
            url: "{{url('getSubAdmin')}}?cat=" + cat,
            dataType: 'html',
            success: function(data) {
                console.log(data);
                $('#serchSubcategory').html(data);

            }
        }); //ajax close

    }
    function getBidderList(ad) {

        

        // alert(cat)
        jQuery.ajax({
            type: 'GET',
            url: "{{url('getBidderList')}}?auction_id=" + ad,
            dataType: 'html',
            success: function(data) {
                console.log(data);
                $('#sizelistView').html(data);

            }
        }); //ajax close

    }
</script>
@endsection