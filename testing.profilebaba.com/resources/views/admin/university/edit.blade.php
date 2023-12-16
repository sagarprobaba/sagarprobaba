@extends('admin.layout.master')
@section('page_title','University')
@section('page_heading','University')
@section('add_link',url('/admin/university/create'))

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
<form action="{{url('/admin/university/'.$item->unid)}}"  method="post" accept-charset="utf-8">
	{{ csrf_field() }}
	{{ method_field('PUT')}}  
 <section class="top-bredcumb">
		<div class="row">
			<div class="col-lg-3">
				<h4>Edit University</h4>
			</div>
			<div class="col-lg-6">				
				<ul class="breadcrumb">
				  <li><a href="#">Dashboard</a></li>
				  <li><a href="#">University Manager</a></li>
				  <li>Edit</li>
				</ul>
			</div>
			<div class="col-lg-3 text-right">
				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
				<button type="button" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
				<button type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>
			</div>
		</div>

	</section>
	
	<div class="row">
		<div class="col-lg-9">
			<section class="panel">
			<header class="panel-heading">Education Details</header>
			<div class="panel-body">
				<div class="form-group">
					<input type="text" name="title" class="form-control" value="{{$item->title}}">
				</div>
			</div>
			</section>
		</div>
		<input type ="hidden" name="submit" value="submit">
	</div>
</form>
 @endsection