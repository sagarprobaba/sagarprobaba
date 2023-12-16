<?php
use App\Models\Master;

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
                                <a href="{{url('userReport')}}"><button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal">
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
                                    <table class="table table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="text-align:center">Sr no.</th>
                                                <th scope="col" style="text-align:center">#</th>
                                                <th scope="col" style="text-align:center">User</th>
                                                <th scope="col" style="text-align:center">Email</th>
                                                <th scope="col" style="text-align:center">Phone</th>
                                                <th scope="col" style="text-align:center">Gender</th>
                                                <th scope="col" style="text-align:center">Address</th>

                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $data)
                                            
                                            <tr>
                                                <td class="fw-medium" style="text-align:center">{{$loop->index+1}}</td>
                                                <td class="fw-medium" style="text-align:center">
                                                @if($data->profile)                                                            <img src="{{asset('storage/app/public/document/staff/'.$data->profile)}}" alt="" class="img-fluid d-block" style="height:40px;width:40px">
                                                @endif
                                                </td>
                                              
                                                <td class="fw-medium" style="text-align:center">{{$data->name}} {{$data->LastName}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->email}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->MobileNo}}</td>
                                                <td class="fw-medium" style="text-align:center">{{$data->Gender}}</td>
                                                <td class="fw-medium" style="text-align:center">
                                                <?php
                                                $stateval = DB::table('states')->where('id', $data->State)->select('name')->first();
                                                $cityval = DB::table('cities')->where('id', $data->City)->select('name')->first();
                                                ?>
                                                    <p class="text-muted mb-0"> Address<br>{{$data->Address}}<br>
                                                    @if(isset($cityval))
                                                    {{$cityval->name}},
                                                    @endif
                                                    @if(isset($stateval))
                                                    {{$stateval->name}},
                                                    @endif

                                                    {{$data->Country}}.</p>       
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
        @csrf
        <div class="offcanvas-body">
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Type</label>
                        <select class="form-select " id="subType" name="subType" aria-label="Default select example">
                            <option value="">Select</option>
                           
                        </select>
                        <script>
                            document.getElementById('subType').value = "{{isset($subType)?$subType:''}}";
                        </script>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Gender</label>
                        <select class="form-select " aria-label="Default select example">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Area</label>
                        <input type="text" class="form-control" name="Area" id="" value="{{isset($Area)?$Area:''}}">
                    </div>
                </div>
            </div>

            
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">City</label>
                        <select class="form-select " id="subExpire"  name="subExpire" aria-label="Default select example">
                            <option value="">Select</option>
                            
                        </select>
                        <script>
                            document.getElementById('subExpire').value = "{{isset($subExpire)?$subExpire:''}}";
                        </script>
                    </div>
                </div>
            </div>

        </div>
        <!--end offcanvas-body-->
        <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
            <a href="{{url('userReport')}}"><button type="button" class="btn btn-light w-100">Clear Filter</button></a>
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
</script>
@endsection