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







<form action="{{ route('question.store') }}" name="frm_add_categories" id="frm_add_categories" enctype="multipart/form-data" method="post" accept-charset="utf-8">



	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Question and answers</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#">Dashboard</a></li>

					<li><a href="#">Question and answers</a></li>

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
	

	@include('admin.question._form')


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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>  

@endsection


