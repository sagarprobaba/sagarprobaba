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
<form action="{{url('/admin/category/')}}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">

	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Categories</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Categories Manager</a></li>

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

		{{csrf_field()}}
		<div class="col-lg-9">

			<section class="panel">

				<header class="panel-heading">Categories Details</header>

				<div class="panel-body">

					<div class="form-group">

						<input type="text" name="title" id="categoriesTitle" class="form-control" required="" placeholder="Categories Name">

					</div>

					<div class="form-group">

						<input type="text" name="slug" id="categoriesTitle" class="auto_slug form-control" placeholder="Categories Slug">

					</div>
					
                	<div class="form-group">

						<input type="text" name="meta_title"  class="form-control"  placeholder="Meta Title">

					</div>
					
					<div class="form-group">

						<input type="text" name="meta_keyword"  class="form-control"  placeholder="Meta Keyword">

					</div>
					
					<div class="form-group">

						<textarea rows="5" class="form-control" name="meta_desc"  placeholder="Meta Description"></textarea>

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

						<select name="parent_id" id="parentId" class="form-control javascript_select">

							<option value="0">Select Parent Category</option>
							<?php 
							$category=\App\Category::orderBy('title','ASC')->get();
							?> 
							@foreach($category as $val)
							<option value="{{$val->id}}">{{$val->title}}</option>
							@endforeach
							
						</select>

					</div>

					<div class="form-group">

						<label for="isActive">Select Status:</label>

						<select name="status" id="isActive" class="form-control">

							<option value="1">Active</option>

							<option value="0">Block</option>

						</select>

					</div>

					<div class="form-group">

						<label for="priority">Priority:</label>

						<input type="number" class="form-control" name="priority" value="100000"/>

					</div>

					<div class="form-group">

						<label for="showmobile">Show in Mobile: </label>

						<input type="checkbox" value='1' name="show_in_mobile" id="showmobile"/>

					</div>

					<div class="form-group">

						<label for="categoriesIcon">Mobile Icon:</label>
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail">

								<img src="{{asset('public/admin/img/pro-ac-1.png')}}" alt="" />

							</div>
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

							<div class="fileupload-new thumbnail">

								<img src="{{asset('public/admin/img/pro-ac-1.png')}}" alt="" />

							</div>

							<div class="fileupload-preview fileupload-exists thumbnail img-responsive"></div>

							<div>

								<span class="btn btn-white btn-file">

									<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>

									<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>

									<input type="file" name="image" id="categoriesImage" class="default" />

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


