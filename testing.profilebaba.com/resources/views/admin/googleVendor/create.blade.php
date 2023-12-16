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
    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Add Google Vendor</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Google Vendor</a></li>

					<li>Add</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="button" onClick="shareVendor()" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button type="reset" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>
    <div class="row">
		
		<div class="col-lg-12">

			<section class="panel">

				<header class="panel-heading">Vendor Details</header>

				<div class="panel-body">
                        <div class="col-md-5">
							<input type="text" class="form-control" id="category" placeholder="Search Category" onkeydown="getCategory(this)"/>
							<input type="hidden" id="cat" value=""/>
							<ul class="category-list d-none"></ul>
						</div>
						<div class="col-md-5">
							<input type="text" class="form-control" placeholder="Location" id="location" value=""/>
							<input type="hidden" id="lat" value=""/>
							<input type="hidden" id="lng" value=""/>
							<input type="hidden" id="state" value=""/>
						</div>
						<div class="col-md-2">
							<input type="button" class="btn btn-primary btn-md" value="Go" onClick="searchList()"/>
						</div>
				</div>
				<div class="d-none loader text-center">
					<img src="{{asset('public/admin/img/input-spinner.gif')}}" width="32px"/>
				</div>
				<div class="google-list pt-3">
				</div>
				<input type="hidden" id="google_search" value=""/>
            </section>
        </div>
    </div>

	<div class="modal fade" id="editvendor" tabindex="-1" role="dialog" aria-labelledby="editvendorLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editvendorLabel">Update Vendor</h5>
				</div>
				<div class="modal-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label>Business Name</label>
								<input type="text" class="form-control" id="business_name" placeholder="Business name"/>
							</div>
							<div class="col-md-6 form-group">
								<label>Mobile Number</label>
								<input type="text" class="form-control" placeholder="Mobile Number" id="contact_number"/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Address</label>
								<input type="text" class="form-control" placeholder="Address" id="address"/>
							</div>
						</div>
						<input type="hidden" id="vendor" value=""/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="saveVendor()">Save</button>
				</div>
			</div>
		</div>
	</div>
        
@endsection

<script>
		function getCategory(e) {
			$(".category-list").removeClass('d-none');
			$(".category-list").empty();
			$.ajax({
                url: "/admin/getCategory",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
					'category': e.value
                },
                success: function(output){
					var list = "";
					Object.values(output).forEach(value => {
						list += "<li><a href='#' onClick='putCategory(this, "+value.id+")'>"+value.title+"</a></li>";
					});
                    $(".category-list").append(list);
                }
            });
		}

		function putCategory(e,id){
			$(".category-list").addClass('d-none');
			$(".category-list").empty();
			$("#category").val(e.innerText);
			$("#cat").val(id);
		}

		function searchList() {
			$(".loader").removeClass("d-none");
				$(".google-list").empty();
				$.ajax({
					url: "/admin/vendor-google-list",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						'category': $("#category").val(),
						'location': $("#location").val(),
						'state':$("#state").val(),
						'limit' : 10
					},
					success: function(output){
						$("#google_search").val(output);
						output = JSON.parse(output);
						var list = "<table class='table table-striped table-hover table-bordered'><tr><th>Validate</th><th>Name</th><th>Contact Number</th><th>Address</th><th>Action</th></tr>";
						output.forEach(function(value,key) {
							list += '<tr><td><input type="checkbox" name="vendor_validate" value="'+key+'"/></td><td>'+value.name+'</td><td>'+value.phone+'</td><td>'+value.address+'</td><td><a href="#" onClick="editVendor('+key+')"><i class="fa fa-pencil"></i></a></td></tr>';
						});
						list += "</table>";
						$(".google-list").append(list);
						$(".loader").addClass("d-none");
					}
				});
		}

		function shareVendor() {

			var validate=[];
			var google_vendor = "";

			if($("#google_search").val() != ""){
				google_vendor = JSON.parse($("#google_search").val());
			}

			$('input[name="vendor_validate"]:checked').each(function() {
				validate.push(google_vendor[this.value]);
			});
			
				$.ajax({
					url: "/admin/google-vendor-save",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						'vendor_validate': validate,
						'cat': $("#cat").val(),
						'location': $("#location").val()
					},
					success: function(output){
						$(".google-list").empty();
						window.location.href = "/admin/get-online-vendor";
					}
				});
		}

		function editVendor(key){
			var google_vendor = "";

			if($("#google_search").val() != ""){
				google_vendor = JSON.parse($("#google_search").val());
			}
			var vendor = google_vendor[key];
			$("#business_name").val(vendor.name);
			$("#contact_number").val(vendor.phone);
			$("#address").val(vendor.address);
			$("#vendor").val(key);

			$("#editvendor").modal('show');
		}

		function saveVendor(){
			var google_vendor = "";

			if($("#google_search").val() != ""){
				google_vendor = JSON.parse($("#google_search").val());
			}
			var key = $("#vendor").val();
			google_vendor[key]['name'] = $("#business_name").val();
			google_vendor[key]['phone'] = $("#contact_number").val();
			google_vendor[key]['address'] = $("#address").val();

			$("#google_search").val(JSON.stringify(google_vendor));
			$(".google-list").empty();
			var output = google_vendor;
			var list = "<table class='table table-striped table-hover table-bordered'><tr><th>Validate</th><th>Name</th><th>Contact Number</th><th>Address</th><th>Action</th></tr>";
			output.forEach(function(value,key) {
				list += '<tr><td><input type="checkbox" name="vendor_validate" value="'+key+'"/></td><td>'+value.name+'</td><td>'+value.phone+'</td><td>'+value.address+'</td><td><a href="#" onClick="editVendor('+key+')"><i class="fa fa-pencil"></i></a></td></tr>';
			});
			list += "</table>";
			$(".google-list").append(list);
			$("#editvendor").modal('hide');
		}
</script>
@yield('javascript')