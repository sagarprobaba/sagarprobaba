@extends('admin.layout.master')
@section('page_title','Web Chat')
@section('page_heading','Web Chat')
@section('top')
@include('admin.layout.top')
@endsection
@section('container')

		<div class="card">
			<div class="row g-0">
				
				<div class="col-12 col-lg-12 col-xl-12">

					<div class="position-relative">
						<div class="chat-messages p-4">

                            <div class="chat-message-left pb-4">
								<div>
									<img src="{{asset('public/image/avatar.jpg')}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:34 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">{{$chat->sender_type == "user" ? $chat->user->name : "Guest"}}</div>
									{{$chat->message}}
								</div>
							</div>
                            @foreach($chat->chat as $data)
                            @if($data->sender == "admin")
							<div class="chat-message-right pb-4">
								<div>
									<img src="{{asset('public/image/logo.png')}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:34 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">{{$data->admin->name}}</div>
									{{$data->message}}
								</div>
							</div>
                            @else
							<div class="chat-message-left pb-4">
								<div>
									<img src="{{asset('public/image/avatar.jpg')}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:34 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">{{$chat->sender_type == "user" ? $chat->user->name : "Guest"}}</div>
									{{$data->message}}
								</div>
							</div>
                            @endif
                            @endforeach
						</div>
					</div>

				</div>
			</div>
		</div>
        
@endsection