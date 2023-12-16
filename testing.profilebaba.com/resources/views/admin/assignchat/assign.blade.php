@extends('admin.layout.master')

@section('page_title','Assign Query')

@section('page_heading','Assign Query')

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
<form action="{{url('/admin/query-assign/')}}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">

	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Assign Query</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Chat Manager</a></li>

					<li>Assign</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>
	
	

	<div class="row">

		{{csrf_field()}}
		<div class="col-lg-8">

			<section class="panel">

				<header class="panel-heading">User Details</header>

				<div class="panel-body">
                    @if($chat->sender_type == 'guest')
                    <h5>Guest User</h5>
                    @else
                    <h5>{{$chat->user->name}} 
						@if($chat->user->is_vendor == 1)
						(Vendor)
						@else
						(User)
						@endif
					</h5>
                    @endif
					<p><b>Message: </b>{{$chat->message}}</p>				
					<p><b>Date: </b>{{$chat->created_at}}</p>
				</div>

			</section>

		</div>

		<div class="col-lg-4 removePaddingLeft">

			<section class="panel">

				<header class="panel-heading">Assign to Executive</header>

				<div class="panel-body">
                    <input type="hidden" name="chat_id" value="{{$chat->id}}"/>
					<div class="form-group">

						<label for="assignTo">Executive List:</label>

						<select name="assigned_to" id="assignTo" class="form-control">

							<option value="0">Select Executive</option>
							<?php 
							$category=\App\Admin::where('role_id',3)->get();
							?> 
							@foreach($category as $val)
							<option value="{{$val->id}}" {{$chat->assigned_to == $val->id ? "selected" : ""}}>{{$val->name}}</option>
							@endforeach
							
						</select>

					</div>
				</div>

			</section>

		</div>
		

	</div>
</form>

@endsection


