@extends('admin.layout.master')

@section('page_title','Membership Plan')

@section('page_heading','Membership Plan')

@section('add_link',url('/admin/membership-plan/create'))

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
<form action="{{url('/admin/membership-plan/')}}" name="frm_add_plan" id="frm_add_plan" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}

    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Plan</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Membership Plan</a></li>

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

				<header class="panel-heading">Plan Details</header>

				<div class="panel-body">
                        <div class="form-group">
                            <label for="text">Title</label>
                             <input type="text" required="" class="form-control item-menu" name="title" id="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="text">Plan Type</label>
                             <input type="text" required="" class="form-control item-menu" name="plan_type" id="plan_type" placeholder="Plan type">
                        </div>
                        <div class="form-group">
                            <label for="text">Area</label>
                             <input type="text" required="" class="form-control item-menu" name="area" id="area" placeholder="Area Zip">
                        </div>
                        <div class="form-group">
                            <label for="text">Price Per Lead</label>
                             <input type="number" class="form-control item-menu" name="price_per_lead" id="price_per_lead" placeholder="Price Per Lead">
                        </div>
                        <div class="form-group">
                            <label for="text">Total Price</label>
                             <input type="number" class="form-control item-menu" name="total_price" id="total_price" placeholder="Total Price">
                        </div>
                        <div class="form-group">
                            <label for="text">Lead</label>
                             <input type="number" required="" class="form-control item-menu" name="lead" id="lead" placeholder="Lead">
                        </div>
                        <div class="form-group">
                            <label for="text">Minimum Lead</label>
                             <input type="text" required="" class="form-control item-menu" name="min_lead" id="min_lead" placeholder="Minimum Lead">
                        </div>
                        <div class="form-group">
                            <label for="text">Description</label>
                            <textarea class="form-control item-menu" name="description" id="description" row="5"></textarea>
                        </div>
                </div>
            </section>
        </div>
       

    </div>
</form>
@endsection
