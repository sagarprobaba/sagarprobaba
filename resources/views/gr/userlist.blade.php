<?php
use App\Models\Master;
use App\Models\Cpr_ad_category;

?>
@extends('gr.layout.app')
@section('body')

<div class="page-content">
    <div class="">
        <!-- end page title -->
        <div class="container-fluid">

            <div class="team-list row list-view-filter">
                <div class="col-lg-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">User ({{$tdata}})</h4>
          
                    

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    
                                    <div class="search-box">
                                        <div class="search-box">
                                                <input type="text" class="form-control search" id="myInput" onkeyup="myFunction()" placeholder="Search ...">

                                                <i class="ri-search-line search-icon"></i>
                                    </div>
                                    
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="flash-message">
    
                                    @if(Session::has('error'))
                                
                                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                                    @endif
                                    @if(Session::has('success'))
                                
                                    <p class="alert alert-success">{{ Session::get('success') }} </p>
                                    @endif
                                
                                </div>	
                                </div>
                                <div class="col-sm-auto ms-auto">
                                    <!-- <div class="flex-grow-1">
                                        <button class="btn btn-info add-btn" onclick="clearmodal();" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Master Values</button>
                                    </div> -->
                                    <div class="col-sm-auto ms-auto">
                                        
                                    <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" href="#offcanvasExample">
                                        <i class="ri-filter-3-line align-bottom me-1"></i>
                                        Fliters
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle mb-0" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="text-align:center">Sr no.</th>
                                                <th scope="col" style="text-align:center">Image</th>
                                                <th scope="col" style="text-align:center">User</th>
                                                <th scope="col" style="text-align:center">Email</th>
                                                <th scope="col" style="text-align:center">Phone</th>
                                                <th scope="col" style="text-align:center">Category</th>
                                                <th scope="col" style="text-align:center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datas as $data)
                                            
                                            <tr>
                                                
                                                <td class="fw-medium" style="text-align:center">{{$loop->index+1}}</td>
                                                
                                                <td>
                                                    <a class="edit-item-btn" href="#showModal" onclick="editUser({{$data->id}})" data-bs-toggle="modal">
                                                        <div class="team-profile-img">
                                                            <div class="avatar-lg img-thumbnail flex-shrink-0">
                                                                <img src="{{asset('public/user/'.$data->image)}}" alt="" class="img-fluid d-block" style="height:70px;">
                                                            </div>
                                                        </div>
                                                    </a> 
                                                </td>
                                                <td class="fw-medium" style="text-align:center"><a class="edit-item-btn" href="#showModal" onclick="editUser({{$data->id}})" data-bs-toggle="modal">{{$data->firstName}} {{$data->lastName}}</a></td>
                                                <td class="fw-medium" style="text-align:center"><a class="edit-item-btn" href="#showModal" onclick="editUser({{$data->id}})" data-bs-toggle="modal">{{$data->email}}</a></td>
                                                <td class="fw-medium" style="text-align:center"><a class="edit-item-btn" href="#showModal" onclick="editUser({{$data->id}})" data-bs-toggle="modal">{{$data->phone}}</a></td>
                                                <?php
                                                    $adcat = Cpr_ad_category::find($data->company_category);
                                                ?>
                                                <td class="fw-medium" style="text-align:center"><a class="edit-item-btn" href="#showModal" onclick="editUser({{$data->id}})" data-bs-toggle="modal">{{$adcat?->category_name}}</a></td>
                                                                                         

                                               
                                                <td style="text-align:center;width:8%">
                                                
                                                    <ul class="list-inline hstack gap-2 mb-0 ml-2">
                                                                @if($data->status == 0 )
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Approve">
                                                                    <a href="{{url('user_approve/'.$data->id)}}" class="text-muted d-inline-block">
                                                                        <i class="ri-check-fill fs-16" style="color:green;font-weight: bold;"></i>
                                                                    </a>
                                                                </li>
                                                                @else
                                                                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Reject">
                                                                    <a href="{{url('user_reject/'.$data->id)}}" class="text-muted d-inline-block">
                                                                        <i class="ri-close-fill fs-16" style="color:red;font-weight: bold;"></i>
                                                                    </a>
                                                                </li>
                                                                @endif
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                            <a class="edit-item-btn" href="#showModal" onclick="editUser({{$data->id}})" data-bs-toggle="modal"><i class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        @if(auth()->user()->delete_access == 1)
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" href="{{url('user_delete/'.$data->id)}}">
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
                                {{$datas->links('pagination::bootstrap-4')}}
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
                            <button class="nav-link p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">User Info</button>
                        </li>

                    </ul>
                </div>
            </div>
            <!--end modal-body-->
            <form action="{{url('userUpdate')}}" class="checkout-tab" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                            <div class="row g-3">
                                <!--end col-->
                                <!--<div class="col-lg-4">-->
                                <!--    <div>-->
                                <!--        <label for="phoneNumber" class="form-label">Emp ID</label>-->



                                <!--    </div>-->
                                <!--</div>-->

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Enter" required>
                                        <input type="hidden" class="form-control" id="userid" name="userid">
                                        
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter" minlength="10" maxlength="10" required onkeypress="return isNumber(event);" ondrop="return false;" onpaste="return false;">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Email ID</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="phoneNumber" class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" id="image" placeholder="Enter" accept="image/*">
                                    </div>
                                </div>
                                <!--end col-->

                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmPassword" class="form-label">Gender</label>
                                        <select class="form-select " id="gender" name="gender" aria-label="Default select example">
                                            <option value="">---select---</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                
                                <!--end col-->
                                <!--end col-->
                                <!--end col-->
                                @if($userType == 'v')
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label"> Company Category</label>
                                        <select class="form-select" id="company_category" aria-label="Default select example" name="company_category" required>
                                            <option value="">---select---</option>
                                            @foreach($cat as $row)
                                            <option value="{{$row->id}}">{{$row->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Company Name</label>
                                        <input type="text" name="companyName" class="form-control" id="companyName" placeholder="Enter" companyWebsite>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">company Email</label>
                                        <input type="email" name="companyEmail" class="form-control" id="companyEmail" placeholder="Enter">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Company Phone</label>
                                        <input type="text" name="companyPhone" class="form-control" id="companyPhone" placeholder="Enter">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Company Website</label>
                                        <input type="text" name="companyWebsite" class="form-control" id="companyWebsite" placeholder="Enter" >

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Company Address</label>
                                        <input type="text" name="companyAddress" class="form-control" id="companyAddress" placeholder="Enter" >

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Company GST Number</label>
                                        <input type="text" name="cac_certificate_number" class="form-control" id="cac_certificate_number" placeholder="Enter" >

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">Company Logo</label>
                                        <input type="file" name="companyLogo" class="form-control" id="companyLogo" placeholder="Enter" accept="image/*">

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="serviceTax" class="form-label">GST Certificate</label>
                                        <input type="file" name="cac_certificate" class="form-control" id="cac_certificate" placeholder="Enter" accept="image/*">

                                    </div>
                                </div>
                                <!--end col-->
                                @endif
                                <div class="col-lg-12 mt-5 mb-4" style="border-top: 1px dashed #cccdcc;">

                                </div>
                                


                                <!--end col-->

                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-start gap-3 mt-3">
                                        <button type="submit" class="btn btn-primary  ms-auto">Save</button>
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
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header bg-light">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Fliters</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!--end offcanvas-header-->
    <form action="" class="d-flex flex-column justify-content-end h-100">
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
            <!--<a href="{{url('adReport')}}"><button type="button" class="btn btn-light w-100">Clear Filter</button></a>-->
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
    function editmastervalue(id) {
       
       jQuery.ajax({
       type: 'GET',
       url: "{{url('editmastervalue')}}?id="+id,
       dataType: 'html',
       success: function(data) {
           var x = JSON.parse(data);            
                 $('#MasterValueid').val(x.id);
                 $('#MasterHead').val(x.MasterHead);
                 $('#MasterValue').val(x.MasterValue);

                          
       }
       }); //ajax close

}
    function clearmodal()
    {
                 $('#MasterValueid').val('');
                 $('#MasterHead').val('');
                 $('#MasterValue').val('');
                  
    }
    
    function editUser(id) {

        jQuery.ajax({
            type: 'GET',
            url: "{{url('editUser')}}?id=" + id,
            dataType: 'html',
            success: function(data) {
                var x = JSON.parse(data);
                $('#userid').val(x.id);
                $('#firstName').val(x.firstName);
                $('#lastName').val(x.lastName);
                $('#email').val(x.email);
                $('#phone').val(x.phone);
                $('#gender').val(x.gender);
                $('#company_category').val(x.company_category);
                $('#companyName').val(x.companyName);
                $('#companyEmail').val(x.companyEmail);
                $('#companyPhone').val(x.companyPhone);
                $('#companyWebsite').val(x.companyWebsite);
                $('#companyAddress').val(x.companyAddress);
                $('#cac_certificate_number').val(x.cac_certificate_number);
                $('#companyLogo').val(x.companyLogo);
                $('#cac_certificate').val(x.cac_certificate);
                $('#image').val(x.image);
                $('#location').val(x.location);
                $('#about_company').val(x.about_company);
                $('#yoe').val(x.yoe);
            }
        }); //ajax close

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