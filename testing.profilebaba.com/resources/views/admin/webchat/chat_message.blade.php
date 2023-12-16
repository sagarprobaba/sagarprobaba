                @if($first)
					<div class="py-2 px-4 border-bottom d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								@if($first->sender_type == 'user' && $first->user->profile_pic != "")
								<img src="{{asset('uploads/users/'.$first->user->profile_pic)}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
								@else 
								<img src="{{asset('public/image/avatar.jpg')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
								@endif
							</div>
							<div class="flex-1 pl-3">
								<strong>{{$first->sender_type == 'guest' ? "Guest User" : $first->user->name}}</strong>
							</div>
							<div class="flex-grow-1 pl-3 text-right">
								<a href="#" data-target="#vendorList" data-toggle="modal"><i class="fa fa-share"></i></a>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4">
							<div class="chat-message-left pb-4">
								<div>
									@if($first->sender_type == 'user' && $first->user->profile_pic != "")
									<img src="{{asset('uploads/users/'.$first->user->profile_pic)}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
									@else 
									<img src="{{asset('public/image/avatar.jpg')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
									@endif
									<div class="text-muted small text-nowrap mt-2">{{CustomValue::showTime($first->created_at)}}</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">{{$first->sender_type == 'guest' ? "Guest User" : $first->user->name}}</div>
									{{$first->message}}
								</div>
							</div>
						@foreach($first->chat as $history)
							@if($history->sender == 'admin')
							<div class="chat-message-right pb-4">
								<div>
									<img src="{{asset('public/image/logo.png')}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">{{CustomValue::showTime($history->created_at)}}</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									@if($history->message == "Share Vendor")
									<ul class="vendor-list">
										@foreach(\App\VendorLead::where(['chat_id'=>$history->id, 'vendor_type'=>'vendor'])->get() as $vendor)
										<li>{{$vendor->vendor->business_name}}<span>{{\App\VendorContactInformation::where('vendor_id',$vendor->vendor_id)->pluck('mobile_number')->first()}}</span></li>
										@endforeach
										@php $google = \App\VendorLead::where(['chat_id'=>$history->id, 'vendor_type'=>'google'])->get() @endphp
										@if($google)
										@foreach($google as $vendor)
										<li>{{$vendor->google->name}}<span>{{$vendor->google->phone}}</span></li>
										@endforeach
										@endif
									</ul>
									@else
									{{$history->message}}
									@endif
								</div>
							</div>
							@else
							<div class="chat-message-left pb-4">
								<div>
									@if($first->sender_type == 'user' && $first->user->profile_pic != "")
									<img src="{{asset('uploads/users/'.$first->user->profile_pic)}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
									@else 
									<img src="{{asset('public/image/avatar.jpg')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
									@endif
									<div class="text-muted small text-nowrap mt-2">{{CustomValue::showTime($history->created_at)}}</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">{{$first->sender_type == 'guest' ? "Guest User" : $first->user->name}}</div>
									{{$history->message}}
								</div>
							</div>
							@endif
						@endforeach
						</div>
					</div>

					<div class="flex-grow-0 py-3 px-4 border-top">
						<div class="form-group d-flex">
							<input type="hidden" value="{{$first->id}}" id="chat_id"/>
							<input type="text" class="form-control" id="chatSend" placeholder="Type your message">
							<button class="btn btn-primary" onClick="sendMessage()">Send</button>
						</div>
					</div>
				@endif

				<!-- Modal -->
<div class="modal fade" id="vendorList" tabindex="-1" role="dialog" aria-labelledby="vendorListLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="vendorListLabel">Vendor List</h5>
			</div>
			<div class="modal-body">
					<div class="row">
						<div class="col-md-5">
							<input type="text" class="form-control" id="category" placeholder="Search Category" onkeydown="getCategory(this)"/>
							<input type="hidden" id="cat" value=""/>
							<ul class="category-list d-none"></ul>
						</div>
						<div class="col-md-5">
							<input type="text" class="form-control" placeholder="Location" id="location" value="{{$first->location ?? ''}}"/>
							<input type="hidden" id="lat" value="{{$first->lat_lng ?? ''}}"/>
							<input type="hidden" id="lng" value="{{$first->lat_lng ?? ''}}"/>
							<input type="hidden" id="state" value=""/>
						</div>
						<div class="col-md-2">
							<input type="button" class="btn btn-primary btn-md" value="Go" onClick="searchList()"/>
						</div>
					</div>
					<div class="modal-list pt-3">
						
					</div>
					<div class="modal-google-list pt-3">
					</div>
					<input type="hidden" id="vendor" value=""/>
					<input type="hidden" id="google_search" value=""/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onClick="shareVendor()">Share</button>
			</div>
		</div>
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
						<input type="hidden" id="vendor_key" value=""/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="saveVendor()">Save</button>
				</div>
			</div>
		</div>
	</div>