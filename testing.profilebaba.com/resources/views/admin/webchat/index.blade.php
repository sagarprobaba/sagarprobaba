@extends('admin.layout.master')
@section('page_title','Web Chat')
@section('page_heading','Web Chat')
@section('top')
@include('admin.layout.top')
@endsection
@section('container')
		<div class="card">
			<div class="row g-0">
				
				<div class="col-12 col-lg-9 col-xl-9 chats">
					{!! $view !!}

				</div>

                <div class="col-12 col-lg-3 col-xl-3 border-left">

					<div class="px-4 d-none d-md-block">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1">
								<input type="text" class="form-control my-3" placeholder="Search...">
							</div>
						</div>
					</div>
					@foreach($chat as $user)
					<a href="#" class="list-group-item list-group-item-action border-0" onClick="openChat({{$user->id}})">
						@if($user->status == 0)<div class="badge bg-success float-right">New</div>@endif
						<div class="d-flex align-items-start">
							@if($user->sender_type == 'user' && $user->user->profile_pic != "")
							<img src="{{asset('uploads/users/'.$user->user->profile_pic)}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
							@else 
							<img src="{{asset('public/image/avatar.jpg')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
							@endif
							<div class="flex-grow-1 ml-3">
								{{$user->sender_type == 'guest' ? "Guest User" : $user->user->name}}
								<div class="small"><span class="fas fa-circle chat-online"></span> </div>
							</div>
						</div>
					</a>
					@endforeach
					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
			</div>
		</div>
        
@endsection

<script>
	function sendMessage() {
		var t = new Date();
		var time = t.getHours()+':'+t.getMinutes();
            var msg = '<div class="chat-message-right pb-4"><div><img src="{{asset("public/image/logo.png")}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40"><div class="text-muted small text-nowrap mt-2">'+time+'</div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">You</div>'+$("#chatSend").val()+'</div></div>';
            $(".chat-messages").append(msg);
            $.ajax({
                url: "/admin/chat",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'message': $("#chatSend").val(),
					'chat_id': $("#chat_id").val()
                },
                success: function(output){
                    
                    $("#chatSend").val('');
                }
            });
        }

		function openChat(chat_id) {
			$(".chats").empty();
			$.ajax({
                url: "/admin/openChat",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
					'chat_id': chat_id
                },
                success: function(output){
                    $(".chats").append(output);
                }
            });
		}

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
			if($("#cat").val() != ""){
				$(".modal-list").empty();
				$.ajax({
					url: "/admin/vendor-list",
					type: "POST",
					headers: {"Accept":"application/json"},
					data: {
						"_token": "{{ csrf_token() }}",
						'category_id': $("#cat").val(),
						'lat': $("#lat").val(),
						'lng': $("#lng").val()
					},
					success: function(output){
						if(output.length > 0 || Object.keys(output).length > 0){
							$("#vendor").val(JSON.stringify(output.data));
							var list = "<table class='table table-striped table-hover table-bordered'><tr><th>Share</th><th>Name</th><th>Contact Number</th></tr>";
							Object.values(output.data).forEach((value,key) => {
								list += '<tr><td><input type="checkbox" name="vendor" value="'+key+'"/></td><td><label class="pl-3">'+value.business_name+'</label></td><td><label class="pl-3">'+value.mobile_number+'</label></td></tr>';
							});
							list += "</table>";
							$(".modal-list").append(list);
							
							// if((output.data).length < 5){
							// 	googleVendors();
							// }
						}
						// else{
						// 	googleVendors();
						// }
					}
				});
			}
			// else{
			// 	googleVendors();
			// }
		}

		function googleVendors() {
				$(".modal-google-list").empty();
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
						var list = "<table class='table table-striped table-hover table-bordered'><tr><th>Share</th><th>Name</th><th>Contact Number</th><th>Address</th><th>Validate or Edit</th></tr>";
						output.forEach(function(value,key) {
							list += '<tr><td><input type="checkbox" name="vendor_google" value="'+key+'"/></td><td><label class="pl-3">'+value.name+'</label></td><td><label class="pl-3">'+value.phone+'</label></td><td><label class="pl-3">'+value.address+'</label></td><td><input type="checkbox" name="vendor_validate" value="'+key+'"/>&nbsp;<a href="#" onClick="editVendor('+key+')"><i class="fa fa-pencil"></i></a></td></tr>';
						});
						list += "</table>";
						$(".modal-google-list").append(list);
					}
				});
		}

		function shareVendor() {
			var t = new Date();
			var time = t.getHours()+':'+t.getMinutes();

			var validate=[],vendor = [], list="";
			var google_vendor = "", vendorL = "";

			if($("#google_search").val() != ""){
				google_vendor = JSON.parse($("#google_search").val());
			}
			if($("#vendor").val() != ""){
				vendorL = JSON.parse($("#vendor").val());
			}

			$('input[name="vendor_validate"]:checked').each(function() {
				validate.push(google_vendor[this.value]);
			});
			$('input[name="vendor"]:checked').each(function() {
				vendor.push(vendorL[this.value]);
				if(vendorL[this.value]['type'] == 'google'){
					list = list+"<li>"+vendorL[this.value]['name']+"<span>"+vendorL[this.value]['phone']+"</span></li>";
				}
				else{
					list = list+"<li>"+vendorL[this.value]['business_name']+"<span>"+vendorL[this.value]['mobile_number']+"</span></li>";
				}
			});
			$('input[name="vendor_google"]:checked').each(function() {
				list = list+"<li>"+google_vendor[this.value]['name']+"<span>"+google_vendor[this.value]['phone']+"</span></li>";
			});
			
				$.ajax({
					url: "/admin/vendor-share",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						'vendor_validate': validate,
						'vendor': vendor,
						'chat_id': $("#chat_id").val(),
						'cat': $("#cat").val(),
						'location': $("#location").val()
					},
					success: function(output){
						var msg = '<div class="chat-message-right pb-4"><div><img src="{{asset("public/image/logo.png")}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40"><div class="text-muted small text-nowrap mt-2">'+time+'</div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">You</div><ul class="vendor-list">'+list+'</ul></div></div>';
            			$(".chat-messages").append(msg);
						
						$(".modal-list").empty();
						$(".modal-google-list").empty();
						$("#vendorList").modal('hide');
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
			$("#vendor_key").val(key);

			$("#editvendor").modal('show');
		}

		function saveVendor(){
			var google_vendor = "";

			if($("#google_search").val() != ""){
				google_vendor = JSON.parse($("#google_search").val());
			}
			var key = $("#vendor_key").val();
			google_vendor[key]['name'] = $("#business_name").val();
			google_vendor[key]['phone'] = $("#contact_number").val();
			google_vendor[key]['address'] = $("#address").val();

			$("#google_search").val(JSON.stringify(google_vendor));
			$(".modal-google-list").empty();
			var output = google_vendor;
			var list = "<table class='table table-striped table-hover table-bordered'><tr><th>Share</th><th>Name</th><th>Contact Number</th><th>Address</th><th>Validate or Edit</th></tr>";
			output.forEach(function(value,key) {
				list += '<tr><td><input type="checkbox" name="vendor_google" value="'+key+'"/></td><td><label class="pl-3">'+value.name+'</label></td><td><label class="pl-3">'+value.phone+'</label></td><td><label class="pl-3">'+value.address+'</label></td><td><input type="checkbox" name="vendor_validate" value="'+key+'"/>&nbsp;<a href="#" onClick="editVendor('+key+')"><i class="fa fa-pencil"></i></a></td></tr>';
			});
			list += "</table>";
			$(".modal-google-list").append(list);
			$("#editvendor").modal('hide');
		}
</script>
@yield('javascript')