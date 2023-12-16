@extends('admin.layout.master')

@section('page_title','Category')

@section('page_heading','category')

@section('add_link',url('/admin/category/create'))

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
<form action="{{url('/admin/category/'.$item->id)}}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">

	
	{{ csrf_field() }}
	{{ method_field('PUT')}}  
	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Categories</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Categories Manager</a></li>

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

				<header class="panel-heading">Categories Details</header>

				<div class="panel-body">

					<div class="form-group">

						<input type="text" name="title" id="categoriesTitle" required="" class="form-control" value="{{$item->title}}">

					</div>

					<div class="form-group">

						<input type="text" name="slug" id="categoriesTitle" class="form-control" value="{{$item->slug}}">

					</div>
					
            		<div class="form-group">

						<input type="text" name="meta_title"  class="form-control" value="{{$item->meta_title}}" placeholder="Meta Title">

					</div>
					
					<div class="form-group">

						<input type="text" name="meta_keyword"  class="form-control" value="{{$item->meta_keyword}}" placeholder="Meta Keyword">

					</div>
					
					<div class="form-group">

						<textarea rows="5" class="form-control" name="meta_description"  placeholder="Meta Description">{{$item->meta_description}}</textarea>

					</div>					

				</div>

			</section>

		</div>

		<div class="col-lg-3 removePaddingLeft">

			<section class="panel">

				<header class="panel-heading">Additional Information</header>

				<div class="panel-body">

					<div class="form-group">

						<label for="parentId">Parent Category:</label>
						
						<select name="parent_id" id="parentId" class="form-control">
							<option value="0">Select Parent Category</option>
							<?php 
							$category=\App\Category::where('id','!=',$item->id)->orderBy('title','ASC')->get();
							?> 
							@foreach($category as $val)
							<option value="{{$val->id}}" {{$item->parent_id == $val->id  ? 'selected' : ''}}>{{$val->title}}</option>
							@endforeach
						</select>

					</div>

					<div class="form-group">

						<label for="isActive">Select Status:</label>

						<select name="status" id="isActive" class="form-control">

							<option @if($item->status==1) {{"selected"}} @endif value="1">Active</option>

							<option  @if($item->status==0) {{"selected"}} @endif value="0">Block</option>

						</select>

					</div>

					<div class="form-group">

						<label for="priority">Priority:</label>

						<input type="number" class="form-control" name="priority" value="{{ $item->priority ?? 100000}}"/>

					</div>

					<div class="form-group">

						<label for="showmobile">Show in Mobile: </label>

						<input type="checkbox" value='1' name="show_in_mobile" id="showmobile" {{$item->show_in_mobile == '1' ? 'checked' : ''}}/>

					</div>

					<div class="form-group">

						<label for="categoriesIcon">Mobile Icon:</label>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						@if($item->mobile_icon != "")
							<div class="fileupload-new thumbnail">

								<img width="200" src="{{asset('uploads/category/'.$item->mobile_icon)}}" alt="" />

							</div>
						@endif
							<div class="fileupload-preview fileupload-exists thumbnail img-responsive"></div>

							<div>

								<span class="btn btn-white btn-file">

									<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>

									<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>

									<input type="file" name="mobile_icon" id="categoriesIcon" class="default" />

								</span>

								<a href="javascript:void(0)" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>

							</div>

						</div>
						

					</div>


					<div class="form-group last">

						<label for="categoriesImage">Image: (Size: 265*215)</label>
						<div class="fileupload fileupload-new" data-provides="fileupload">
						@if($item->category_image != "")
							<div class="fileupload-new thumbnail">

								<img width="200" src="{{asset('uploads/category/'.$item->category_image)}}" alt="" />

							</div>
						@endif
							<div class="fileupload-preview fileupload-exists thumbnail img-responsive"></div>

							<div>

								<span class="btn btn-white btn-file">

									<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>

									<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>

									<input type="file" name="category_image" id="categoriesImage" class="default" />

								</span>

								<a href="javascript:void(0)" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>

							</div>

						</div>
						

					</div>

				</div>

			</section>

		</div>
		<input type ="hidden" name="submit" value="submit">
		

	</div>
</form>
<script src="{{asset('public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}" ></script>
<script src="{{asset('public/admin/js/jquery.fileuploader.min.js')}}" ></script>
<link href="{{asset('public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}" rel="stylesheet" />

@endsection


