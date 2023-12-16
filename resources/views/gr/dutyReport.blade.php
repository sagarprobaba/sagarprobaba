<?php
 $fdate = date('Y-m-d');
 if(isset($todate))
 {
    $fdate = $todate;
 }
?>
@extends('gr.layout.app')
@section('body')
<div class="page-content">
    <div class="">

        <!-- start page title -->
        <!-- <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="padding: 10px 1.5rem;
                            background-color: var(--vz-card-bg) !important;
                            -webkit-box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
                            box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
                            border-bottom: 1px solid none;
                            border-top: 1px solid none;
                            margin: 0px 0rem 1.5rem 0rem;">
                    <h4 class="mb-sm-0" style="margin-left: 106px;">All Jobs</h4>

                    <div class="page-title-right" style="margin-right: 106px;">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">All Jobs</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div> -->
        <!-- end page title -->
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <div class="row g-2">

                        
                        <!--end col-->
                        <div class="col-sm-auto ms-auto">
                            <div class="list-grid-nav hstack gap-1">
                                <div class="import_file">
                                    <!-- <p class="btn btn-soft-success mb-0"> Import to CSV</p>
                                    <input class="form-control" type="file" id="formFile"> -->
                                </div>
                                <button type="button" class="btn btn-info" data-bs-toggle="offcanvas" href="#offcanvasExample"><i class="ri-filter-3-line align-bottom me-1"></i> Fliters</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>


            <div class="team-list row list-view-filter">
                <div class="col-lg-12">
                    <div class="card team-box">
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card">
                                    <table class="table align-middle " id="customerTable">
                                        <tbody class="list form-check-all">
                                            @foreach($data as $data)
                                            <tr>
                                                
                                                <td class="name" style="width:30%;">
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                        <?php
                                                                   $pic= isset($data->photo)?'storage/app/public/document/employee/'.$data->photo:'assets/images/no.png';
                                                                    ?>
                                                            
                                                                    <img src="{{asset($pic)}}" alt="" class="img-fluid d-block rounded-circle">
                                                        </div>
                                                        <div class="team-content">
                                                            <p class="text_blue mb-0">Freelancer</p>
                                                            <p class="text-muted mb-0">{{$data->EmployeeName}}</p>
                                                            <p class="text-muted mb-0">M: <span class="text_blue">{{$data->EmployeePhone}}</span></p>
                                                            <p class="badge bg-{{$data->attandence=='On Duty'?'success':'danger'}} mb-0">{{$data->attandence}}</span></p>
                                                            <p class="text-muted mb-0">Date : <span class="text_blue">{{$data->date}}</span></p>
                                                            <p class="text-muted mb-0">Time : <span class="text_blue">{{$data->time}}</span> </p>
                                                            <p class="text-muted mb-0">Location : <span class="text_blue">{{$data->address}}</span></p>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td style="width:30%;">
                                                    <div class="team-profile-img">
                                                        <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0" style="width: 40px;height: 40px;">
                                                            <img src="assets/images/brands/dribbble.png" alt="" class="img-fluid d-block rounded-circle" style="width:100px">
                                                        </div>
                                                        <div class="team-content">
                                                            <p class="text_blue mb-0">Duty Start</p>                                                            
                                                            <p class="text-muted mb-0"> Total BGC : <span class="text_blue">{{$data->totalAssignDuty}}</span> </p>
                                                            <p class="text-muted mb-0"> Accept on : <span class="text_blue">{{$data->acceptDate}} </span></p>
                                                            <p class="text-muted mb-0"> To be Completed by : <span class="text_blue">{{$data->acceptDate}} </span></p>
                                                            <p class="text-muted mb-0"> Duty Area : <span class="text_blue">{{$data->address}}</span></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="name">
                                                    <p class="text_blue mb-0">Duty End</p>
                                                    <p class="text-muted mb-0"> Total BGC :<span class="text_blue"> {{$data->totalAssignDuty}}</span></p>
                                                    <p class="text-muted mb-0"> Complete BGC : <span class="text_blue">{{$data->totalcompleteDuty}}</span></p>
                                                    <p class="text-muted mb-0">Completed on :<span class="text_blue"> {{$data->completeDate}}</span></p>
                                                    <p class="text-muted mb-0"> Due BGC : <span class="text_blue"><b>{{$data->due}}</b></span></p>
                                                </td>

                                                <td>                                                   
                                                @if($data->totalAssignDuty != 0)
                                                    <a href="{{url('DutyDetailshow/'.$data->formId.'/'.$fdate)}}" class="btn width100 btn-light"> Order View</a>
                                                   @else 
                                                   <a href="{{url('DutyDetailshow/'.$data->formId.'/'.$fdate)}}" class="btn width100 btn-light"> Order View</a>
                                                   @endif
                                                </td>
                                            </tr>
                                            
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="col-lg-12">
                    <div class="text-center mb-3">
                        <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load More </a>
                    </div>
                </div> -->
            </div>
        </div>

        <svg class="bookmark-hide">
            <symbol viewBox="0 0 24 24" stroke="currentColor" fill="var(--color-svg)" id="icon-star">
                <path stroke-width=".4" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </symbol>
        </svg>

    </div><!-- container-fluid -->
</div><!-- End Page-content -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header bg-light">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Job Fliters</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!--end offcanvas-header-->
    <form action="{{url('filterReport')}}" class="d-flex flex-column justify-content-end h-100" method="GET">
        @csrf
        <div class="offcanvas-body">
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Freelancer</label>
                        <select class="form-select " name="freelancer" id="freelancer" aria-label="Default select example">
                        <option value="">Freelancer</option>
                            @foreach($employee as $row)
                            <option value="{{$row->id}}">{{$row->EmployeeName}}</option>
                            @endforeach
                        </select>
                        <script>
                            document.getElementById('freelancer').value = "{{isset($freelancer)?$freelancer:''}}";
                        </script>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Date</label>
                        <input type="date" name="date" id="" class="form-control" value="{{isset($todate)?$todate:''}}">
                    </div>
                </div>
            </div>
            <!-- <div class="mb-3">
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
            </div> -->
            <!-- <div class="mb-3">
                <div class="col-lg-12">
                    <div>
                        <label for="serviceTax" class="form-label">Location</label>
                        <input type="text" name="loction" id="" class="form-control">
                    </div>
                </div>
            </div> -->

        </div>
        <!--end offcanvas-body-->
        <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
            <a href="{{route('DutyReport.index')}}"><button class="btn btn-light w-100">Clear Filter</button></a>
            <button type="submit" class="btn btn-success w-100">Filters</button>
        </div>
        <!--end offcanvas-footer-->
    </form>
</div>
@endsection