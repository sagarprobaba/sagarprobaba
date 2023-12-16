@extends('admin.layout.master')

@section('page_title','Google Vendor')

@section('page_heading','Google Vendor')

@section('add_link',url('/admin/add-google-vendor'))

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

<form action="{{url('/admin/google-vendor/'.$vendor->id)}}" name="frm_add_menu" id="frm_add_menu" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
	{{ method_field('PUT')}} 
    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Edit Vendor</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Google Vendor</a></li>

					<li>Edit</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>

	<div class="row">
		
		<div class="col-lg-9">

			<section class="panel">

				<header class="panel-heading">Google vendor Details</header>

				<div class="panel-body">
                        <div class="form-group">
                            <label for="text">Name</label>
                             <input type="text" required="" value="{{$vendor->name}}" class="form-control item-menu" name="name" id="name" >
                        </div>
                        <div class="form-group">
                            <label for="text">Category</label>
                             <input type="text" required="" value="{{$vendor->category}}" class="form-control item-menu" name="category" id="category">
                        </div>
						<div class="form-group">
                            <label for="text">Location</label>
                             <input type="text" required="" value="{{$vendor->location}}" class="form-control item-menu" name="location" id="location">
                        </div>
                        <div class="form-group">
                            <label for="text">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{$vendor->status == '1' ? 'selected' : ''}}>Validate</option>
                                <option value="0" {{$vendor->status == '0' ? 'selected' : ''}}>Block</option>
                            </select>
                        </div>
                </div>
            </section>
        </div>

    </div>
</form>
@endsection
