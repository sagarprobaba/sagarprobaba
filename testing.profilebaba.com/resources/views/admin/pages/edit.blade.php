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



<?php //dd($item->pimages); ?>



<form action="{{url('/admin/cmspages/'.$item->id)}}"   method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="PUT" />

	{{csrf_field()}}


	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Products</h4>

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
			<!-- <li role="presentation"><a href="#image" aria-controls="image" role="tab" data-toggle="tab">Images</a></li> -->
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

									<input type="text" required="" name="title" id="categoriesTitle" class="form-control" value="{{$item->title}}">

								</div>

								<div class="form-group">

									<textarea name="body" id="categoriesBody" class="form-control ckeditor">{{$item->body}}</textarea>

								</div>

								
								<div class="row">


									<div class="col-md-6">

										<div class="form-group">

											<input type="text" name="heading" id="categoriesTitle" class="form-control" value="{{$item->heading}}">

										</div>

									</div>

									<div class="col-md-6">

										<div class="form-group">

											<input type="text" required="" name="slug" id="categoriesTitle" class="form-control" value="{{$item->slug}}">

										</div>

									</div>


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

											<option value="1" @if($item->status==1) {{"selected"}} @endif>Active</option>

											<option value="0" @if($item->status==0) {{"selected"}} @endif >Deactive</option>

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

						<input type="text" name="meta_title" id="categoriesTitle" class="form-control" value="{{$item->meta_title}}">

					</div>
					
					<div class="form-group">

						<textarea class="form-control" name="meta_description" id="categoriesDesc" >{{$item->meta_description}}</textarea>

					</div>
					
					<div class="form-group">

						<textarea class="form-control" name="meta_keywords" id="categoriesDesc">{{$item->meta_keywords}}</textarea>

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

								alert('Jitesh');

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
	
	
	
	
	
	
	
	<script type="text/javascript">
		
		$(document).ready(function(){

			$('.remove').on('click',function(){

				var pageimageid=$(this).data('pageimageid');
				
				var data="pageimageid="+pageimageid;

				$.ajax({

					url:"{{url('/admin/ajax/remove_page_image')}}",
					type:"get",
					data:data,
					success:function(output){
						
						if(output==1){
							$('.pageimg_'+pageimageid).fadeOut('slow');
					//alert('deleted !');
				}else{
					alert('Some error deleting the image !');
				}

			}

		});

			});
			
			
			


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


