@extends('admin.layout.master')

@section('page_title','Menu')

@section('page_heading','Menu')

@section('add_link',url('/admin/menu/create'))

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
<form action="{{url('/admin/menu/')}}" name="frm_add_menu" id="frm_add_menu" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}

    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Menu</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Site Menu</a></li>

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

				<header class="panel-heading">Menu Details</header>

				<div class="panel-body">
                        <div class="form-group">
                            <label for="text">Name</label>
                             <input type="text" required="" class="form-control item-menu" name="name" id="name" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <label for="text">Position</label>
                            <select class="form-control" name="position">
                                <option value="">Select Position</option>
                                <option value="header">Header</option>
                                <option value="footer">Footer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">Need Login</label>
                            <select class="form-control" name="need_login">
                                <option value="">Select whether it needs login or not</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">URL</label>
                            <div class="input-group">
                                <span class="input-group-addon">{{ url('/') }}/</span>
                                <input id="msg" type="text" class="form-control item-menu ffffffff" id="href" name="href" placeholder="Enter URL">
                            </div>
                        </div>
                </div>
            </section>
        </div>
       

    </div>
</form>
@endsection
