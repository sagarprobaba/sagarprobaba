@extends('admin.layout.master')

@section('page_title','Membership Vendor')

@section('page_heading','Membership Vendor')

@section('add_link',url('/admin/membership-vendor/create'))

@section('container')



@if(Session::has('message'))
<div class="alert alert-success">
	{{ Session::get('message') }}
</div>
@endif




@if (Session::has('errors'))
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	{{ $error }}<br/>
	@endforeach
</div>
@endif
<form action="{{url('/admin/membership-vendor/add_vendor_plan')}}" name="frm_add_vendor" id="frm_add_vendor" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}

    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Vendor Plan</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Membership Vendor</a></li>

					<li>Create</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button type="reset" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>

	<div class="row">
		
		<div class="col-lg-9">

			<section class="panel">

				<header class="panel-heading">Vendor Plan Details</header>

				<div class="panel-body">
                        <div class="form-group">
                            <label for="text">User</label>
                                @php
                                    $user = App\User::where('id',$vendor->vendor_id)->first()->name;
                                @endphp
                            <input type="text" value="{{$user}}" readonly class="form-control">
                            <input type="hidden" name="vendor_plan_id" value="{{$vendor->id}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="text">Plan</label>
                            <select class="form-control" name="plan" id="plan">
                                <option>Select Plan</option>
                                @php
                                    $user = App\MembershipPlan::where('id','>','1')->get();
                                @endphp
                                @foreach($user as $u)
                                <option lead="{{$u->min_lead}}" value="{{$u->id}}" {{($u->id == $vendor->plan_id) ? "selected" : ""}}>{{$u->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">Leads</label>
                            <input type="text" name="lead" id="lead" value="" class="form-control">
                        </div>
                        
                </div>
            </section>
        </div>
       

    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        var lead = $("option[value="+$("#plan").val()+"]").attr("lead");
        $("#lead").val(lead)
    })
	$("#plan").change(function(){
		var lead = $("option[value="+$("#plan").val()+"]").attr("lead");
        $("#lead").val(lead)
	}); 
</script>
@endsection
