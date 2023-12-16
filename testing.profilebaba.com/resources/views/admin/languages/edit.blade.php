@extends('admin.layout.master')

@section('page_title','Languages')

@section('page_heading','Languages')

@section('add_link',url('/admin/languages/create'))

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
<form action="{{url('/admin/languages/'.$item->langid)}}" name="frm_add_languages"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
	{{ csrf_field() }}
	{{ method_field('PUT')}}  
 <section class="top-bredcumb">
		<div class="row">
			<div class="col-lg-3">
				<h4>Create Court Type</h4>
			</div>
			<div class="col-lg-6">				
				<ul class="breadcrumb">
				  <li><a href="#">Dashboard</a></li>
				  <li><a href="#">Court Type Manager</a></li>
				  <li>Create</li>
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
			<header class="panel-heading">Court Type Details</header>
			<div class="panel-body">
				<div class="form-group">
					<input type="text" name="langName" class="form-control" value="{{$item->langName}}">
				</div>
				<div class="form-group">
					<input type="text" name="langCode" class="form-control" value="{{$item->langCode}}">
				</div>				
			</div>
			</section>
		</div>
		<input type ="hidden" name="submit" value="submit">
	</div>
</form>
 @endsection