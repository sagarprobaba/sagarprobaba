@extends('admin.layout.master')

@section('page_title','Pages')

@section('page_heading','pages')

@section('add_link',url('/admin/pages/create'))

@section('container')

<script type="text/javascript" src="{{asset('/public/admin/ckeditor/ckeditor.js')}}"></script>
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


<style>
	input[type="file"] {
		display: block;
	}
	.imageThumb {
		max-height: 75px;
		border: 2px solid;
		padding: 1px;
		cursor: pointer;
	}
	.pip {
		display: inline-block;
		margin: 10px 10px 0 0;
	}
	.remove {
		display: block;
		background: #444;
		border: 1px solid black;
		color: white;
		text-align: center;
		cursor: pointer;
	}
	.remove:hover {
		background: white;
		color: black;
	}
</style>







<form action="{{url('/admin/cmspages/')}}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">



	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Page</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#">Dashboard</a></li>

					<li><a href="#">Pages Manager</a></li>

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
	




	<div>

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
			<li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">Images</a></li>
			<li role="presentation"><a href="#metadata" aria-controls="metadata" role="tab" data-toggle="tab">Meta Data</a></li>
			
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="general">
				
				

				
				

				<div class="row">

					{{csrf_field()}}
					<div class="col-lg-9">

						<section class="panel">

							<header class="panel-heading">Page Details</header>

							<div class="panel-body">

								<div class="form-group">

									<input type="text" required="" name="title" id="categoriesTitle" class="form-control" placeholder="Page Title">

								</div>

								<div class="form-group">

									<textarea name="body" id="categoriesBody" class="form-control"></textarea>

								</div>

								
								<div class="row">


									<div class="col-md-6">

										<div class="form-group">

											<input type="text" name="heading" id="categoriesTitle" class="form-control" placeholder="Page Heading">

										</div>

									</div>

									<div class="col-md-6">

										<div class="form-group">

											<input type="text" required="" name="slug" id="categoriesTitle" class="form-control" placeholder="Page Slug">

										</div>

									</div>


								</div>
								


								

								<div class="form-group">

									<textarea rows="14" class="form-control ckeditor" name="body" id="categoriesDesc" placeholder="Products Description"></textarea>

								</div>
								
								<div class="form-group">

									<textarea rows="14" class="form-control ckeditor" name="excerpt" id="categoriesDesc" placeholder="Excerpt"></textarea>

								</div>
								
								
								
								
								


								


							</section>

						</div>

						<div class="col-lg-3 removePaddingLeft">

							<section class="panel">

								<header class="panel-heading">Additional Information</header>

								<div class="panel-body">

									
									<div class="form-group">

										<label for="isActive">Select Status:</label>

										<select name="status" id="isActive" class="form-control">

											<option value="1">Active</option>

											<option value="0">Deactive</option>

										</select>

									</div>
									

								</div>

								

							</section>
							
							
							
						</div>
						<input type ="hidden" name="submit" value="submit">
						

					</div>
					
					
					
					
				</div>
				
				
				
				
				
				<!-- Images Section -->
				
				
				
			
			<!-- Images Section Close-->
			
			<!-- Meta Data Section open-->
			<div role="tabpanel" class="tab-pane" id="metadata">
				
				
				<header class="panel-heading">Meta Details</header></br>
				
				<div class="form-group">

					<input type="text" name="meta_title" id="categoriesTitle" class="form-control" placeholder="Title">

				</div>
				
				<div class="form-group">

					<textarea class="form-control" name="meta_description" id="categoriesDesc" placeholder="Meta Description"></textarea>

				</div>
				
				<div class="form-group">

					<textarea class="form-control" name="meta_keywords" id="categoriesDesc" placeholder="Meta keywords"></textarea>

				</div>
				
				
				
			</div>
			
			<!-- Meta Data Section close-->
			
			











		</div>

	</div>






</form>






<script>
	
	$(document).ready(function() {
		if (window.File && window.FileList && window.FileReader) {
			$("#files").on("change", function(e) {
				var files = e.target.files,
				filesLength = files.length;
				for (var i = 0; i < filesLength; i++) {
					var f = files[i]
					var fileReader = new FileReader();
					fileReader.onload = (function(e) {
						var file = e.target;
						$("<span class=\"pip\">" +
							"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
							"<br/><span class=\"remove\">Remove image</span>" +
							"</span>").insertAfter("#files");
						$(".remove").click(function(){
							$(this).parent(".pip").remove();
						});
						
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
        }).insertAfter("#files").click(function(){$(this).remove();});*/
        
    });
					fileReader.readAsDataURL(f);
				}
			});
		} else {
			alert("Your browser doesn't support to File API")
		}
	});
</script>

<script>
	$(document).ready(function() {
		CKEDITOR.config.allowedContent = true;
		
		$('#parentid').select2();
		

	});
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>  

@endsection


