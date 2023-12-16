<?php

use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_subscription;
use App\Models\webUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Cpr_ad_category;

$cats = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();

$Boost = Cpr_Add_post::where('plan', 'Boost')->where('plan_date', Auth::guard('webUser')->user()->boost_plan_date)->where('status', 1)->count('id');
$totalBoost = 10 - $Boost;
$Premium = Cpr_Add_post::where('plan', 'Premium')->where('plan_date', Auth::guard('webUser')->user()->premium_plan_date)->where('status', 1)->count('id');
$totalPremium = 20 - $Premium;
?>
@extends('web.layout.app')
@section('body')
<div id="page-content">
    <!--Collection Banner-->


    <!--Container-->
    <div class="container pt-2">
        <!--Main Content-->
        <div class="flash-message">

            @if(Session::has('error'))

            <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
            @if(Session::has('success'))

            <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a></p>
            @endif

        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row mb-4 mt-5 mb-lg-5 pb-lg-5">
            <div class="col-xl-3 col-lg-2 col-md-12 mb-4 mb-lg-0">
                <!-- Nav tabs -->
                <ul class="nav flex-column bg-light h-100 dashboard-list" role="tablist">
                    <li><a class="nav-link active" data-bs-toggle="tab" href="#dashboard" id="dash" onclick="changeTab('dash')">Dashboard</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#account-details" onclick="changeTab('PROFILE')" id="PROFILE">Profile</a></li>
                    <!-- <li><a class="nav-link" data-bs-toggle="tab" href="#address">Addresses</a></li> -->
                    <li><a class="nav-link" data-bs-toggle="tab" href="#wishlist">Service in Wishist</a></li>
                    <!-- <li><a class="nav-link" data-bs-toggle="tab" href="#wallet">WALLET</a></li> -->
                    <!-- <li><a class="nav-link" href="{{route('AddPost.index')}}">POST AD</a></li> -->
                    @if(Auth::guard('webUser')->user()->account_type == 'v')
                    <li><a class="nav-link" data-bs-toggle="tab" href="#adPost" id="pna" onclick="changeTab('pna')">Post New Service.</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#myad" id="mad" onclick="changeTab('mad')">My Posted Services</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#orders" id="mres" onclick="changeTab('mres')">My Service Responses</a></li>
                    @endif
                    <li><a class="nav-link" data-bs-toggle="tab" href="#Enquiries" id="menq" onclick="changeTab('menq')">My Service Queries</a></li>
                    <!--<li><a class="nav-link" data-bs-toggle="tab" href="#reviews" id="rvw">Rate & Reviews</a></li>-->
                    <li><a class="nav-link" data-bs-toggle="tab" href="#notifications" id="notif" onclick="changeTab('notif')">Notifications ({{$notiCount}})</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#Chating" id="Chat" onclick="changeTab('Chat')">Chat</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#subscriptions" id="sbsc" onclick="changeTab('sbsc')">Subscription</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#Settings" onclick="changeTab('set')" id="set">Account Settings</a></li>
                    <li><a class="nav-link" href="{{url('logoutWeb')}}">logout</a></li>
                </ul>
                <!-- End Nav tabs -->
            </div>

            <div class="col-xl-9 col-lg-10 col-md-12">
                <!-- Tab panes -->
                <div class="tab-content dashboard-content">
                    <!-- Dashboard -->
                    <div id="dashboard" class="tab-pane fade active show">
                        <h3>Hello <span style="color:#bc322d">{{Auth::guard('webUser')->user()->firstName}}</span></h3>

                        <div class="row user-profile mt-4">
                            <div class="col-12 col-lg-6">
                                <div class="profile-img">
                                    <div class="img">
                                        @if(isset($user->companyLogo))
                                        <img src="{{asset('public/user/'.$user->companyLogo)}}" alt="profile" width="65" />
                                    </div>
                                    @elseif(isset($user->image))
                                    <img src="{{asset('public/user/'.$user->image)}}" alt="profile" width="65" />
                                </div>
                                @else
                                <img src="webassets/images/profile.png" alt="profile" width="65" />
                            </div>
                            @endif
                            <div class="detail ms-3">
                                <h5 class="mb-1">{{Auth::guard('webUser')->user()->firstName}} {{Auth::guard('webUser')->user()->lastName}}</h5>


                            </div>
                            <div class="lbl">
                                @if(isset($user->companyName))
                                Corporate User
                                @else
                                Individual User
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <ul class="profile-order mt-3 mt-lg-0">
                            @if(Auth::guard('webUser')->user()->account_type == 'v')
                            <li>
                                <span onclick="changePannel('mad');">
                                    <h3 class="mb-1">{{$adcnt}}</h3>
                                    Service<br>Posted
                                </span>
                            </li>
                            @endif
                            <li>
                                <span onclick="changePannel('mres');">
                                    <h3 class="mb-1">{{$rscnt}}</h3>
                                    Service <br> Responses
                                </span>
                            </li>

                        </ul>
                    </div>
                </div>


                @if(Auth::guard('webUser')->user()->account_type == 'v')
                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead class="alt-font">
                            <tr>
                                <th>SERVICE ID</th>
                                <th>IMAGE</th>
                                <th>SERVICE DETAILS</th>
                                <th>PRICE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($ad as $key => $ad)
                            <tr>
                                <td>{{++$key}}</td>
                                <?php
                                $pic = Cpr_Add_images::where('ad_id', $ad->id)->orderBy('image_order', 'ASC')->first();
                                ?>

                                <td>
                                    @if(isset($pic->image))
                                    <img src="{{asset('public/ad/'.$pic->image)}}" style="width:70px">
                                    @endif
                                </td>
                                <td style="width:35%;">
                                    <p>{{$ad->title}}</p>
                                    <p>{{date('d-m-Y',strtotime($ad->created_at))}}</p>
                                </td>
                                <td class="text-success">₹&nbsp;{{$ad->price}}</td>
                                <td>
                                    <a class="link-underline view sizelink" href="javascript:void(0)">
                                        @if($ad->status == 1)
                                        Published
                                        @else
                                        Unpublished
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a class="link-underline" onclick="editAd({{$ad->id}});" href="#sizechart">Edit</a>
                                    <br>
                                    <a class="link-underline" href="{{url('deleteAdd/'.$ad->id)}}" onclick="return confirm('Are You Sure?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                 @if(!empty($enquiries))
                @foreach($enquiries as $key => $enquir)

                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">

                        <tbody>

                            <tr>
                                <td>{{++$key}}</td>
                                <?php
                                $pic = Cpr_Add_images::where('ad_id', $enquir->ad_id)->orderBy('image_order', 'ASC')->first();
                                ?>
                                <td>
                                    @if(isset($pic->image))
                                    <img src="{{asset('public/ad/'.$pic->image)}}" style="width:70px">
                                    @endif
                                </td>
                                <td style="width:35%;">
                                    <p>{{$enquir->title}}</p>
                                    <p>{{date('d-m-Y',strtotime($enquir->created_at))}}</p>
                                </td>
                                <td class="text-success">₹&nbsp;{{$enquir->price}}</td>

                                <td>

                                    <a class="link-underline" onclick="changeTab('Chat')" href="{{url('startChat/'.$enquir->ad_id)}}">Start chat</a>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                @endforeach
                @endif
                @endif
            </div>
            <div id="Chating" class="tab-pane fade">


                @if(Session::has('ad_id'))
                <?php
                $nad = Cpr_Add_post::find(session()->get('ad_id'));
                ?>
                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">

                        <tbody>

                            <tr>

                                <?php
                                $pic = Cpr_Add_images::where('ad_id', $nad->id)->orderBy('image_order', 'ASC')->first();
                                ?>

                                <td>
                                    @if(isset($pic->image))
                                    <img src="{{asset('public/ad/'.$pic->image)}}" style="width:70px">
                                    @endif
                                </td>
                                <td style="width:35%;">
                                    <p>{{$nad->title}}</p>
                                    <p>{{date('d-m-Y',strtotime($nad->created_at))}}</p>
                                </td>
                                <td class="text-success">₹&nbsp;{{$nad->price}}</td>


                            </tr>


                        </tbody>
                    </table>
                </div>
                @if($nad->user_id == Auth::guard('webUser')->user()->id)
                <?php
                $enq = Cpr_ad_enquiry::where('ad_id', $nad->id)->orderByDesc('id')->get();
                ?>
                @if(!empty($enq))
                @foreach($enq as $enqui)
                <div class="accordion accordion-flush" id="accordionFlushExample{{$enqui->id}}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne{{$enqui->id}}">
                            <button class="accordion-button collapsed" id="acco{{$enqui->id}}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$enqui->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$enqui->id}}">
                                <span>{{$enqui->name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:center;">{{$enqui->email}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:right;">{{$enqui->phone}}</span>&nbsp;&nbsp;&nbsp;&nbsp;Offer:<span>{{$enqui->subject}}</span>



                            </button>
                        </h2>
                        <div id="flush-collapseOne{{$enqui->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample{{$enqui->id}}">
                            <div class="accordion-body">Message:&nbsp;&nbsp;&nbsp;{{$enqui->message}}.</div>
                            <?php
                            $chats = Cpr_ad_chat::where('ad_id', $nad->id)->where('sender_id', $enqui->user_id)->orderByDesc('id')->get();
                            ?>
                            @if(!empty($chats))
                            @foreach($chats as $chat)
                            <div class="accordion-body">
                                <?php
                                $chatFile = Cpr_ad_chat_file::where('chat_id', $chat->id)->get();
                                $senderDetail = webUser::find($chat->receiver_id);
                                ?>
                                <i class="an an-chat" aria-hidden="true"></i>
                                @if(isset($senderDetail))
                                Send By {{$senderDetail->firstName}}{{$senderDetail->lastName}} on {{date('M d Y H:i A',strtotime($chat->created_at))}}
                                @endif
                                <br>{{$chat->message}}.
                                <br>
                                {{$chat->chat_file_name}}.

                                @if(!empty($chatFile))
                                @foreach($chatFile as $image)

                                <a href="{{asset('public/ad_chat/'.$image->chatfile)}}" target="_blank" rel="noopener noreferrer" download><i class="an an-file-ar" aria-hidden="true"></i></a>
                                <!-- <li>JPEG</li>
                                            <li>PNG</li> -->
                                @endforeach
                                @endif
                            </div>
                            @endforeach
                            @endif
                            <fieldset class="dashboard-content mb-4 bg-grey">
                                <form action="{{url('chating')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-telephone">file<span class="required-f">*</span></label>
                                            <input name="chatfile[]" placeholder="" value="" id="chatfile" class="form-control" multiple type="file">
                                            <input name="sender_id" placeholder="" value="{{$enqui->user_id}}" class="form-control" type="hidden">
                                            <input name="ad_id" placeholder="" value="{{$enqui->ad_id}}" class="form-control" type="hidden">
                                            <input name="receiver_id" placeholder="" value="{{Auth::guard('webUser')->user()->id}}" class="form-control" type="hidden">
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-telephone">file Name<span class="required-f">*</span></label>
                                            <input name="chatfilename" placeholder="" value="" id="chatfilename" class="form-control" type="text">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                            <label for="input-telephone">Message<span class="required-f">*</span></label>
                                            <textarea class="form-control" name="chatMessage" id="chatMessage"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" onclick="changeAcco('acco{{$enqui->id}}')" class="btn btn-primary rounded">Send</button>
                                </form>
                            </fieldset>
                        </div>
                    </div>

                </div>
                @endforeach
                @endif
                @else
                <?php
                $author = webUser::find($nad->user_id);
                ?>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" id="acco" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <span>{{$author->firstName}} {{$author->laststName}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:center;">{{$author->email}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align:right;">{{$author->phone}}</span>

                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <?php
                            $enq = Cpr_ad_enquiry::where('ad_id', $nad->id)->where('user_id', Auth::guard('webUser')->user()->id)->first();

                            $chats = Cpr_ad_chat::where('ad_id', $nad->id)->where('sender_id', Auth::guard('webUser')->user()->id)->orderByDesc('id')->get();
                            ?>
                            <div class="accordion-body">
                                My Offer : {{$enq->subject}} <br>

                                Message:&nbsp;&nbsp;&nbsp;{{$enq->message}}.</div>

                            @if(!empty($chats))
                            @foreach($chats as $chat)
                            <div class="accordion-body">
                                <?php
                                $chatFile = Cpr_ad_chat_file::where('chat_id', $chat->id)->get();
                                $senderDetail = webUser::find($chat->receiver_id);
                                ?>
                                <i class="an an-chat" aria-hidden="true"></i>
                                @if(isset($senderDetail))
                                Send By {{$senderDetail->firstName}}{{$senderDetail->lastName}} on {{date('M d Y H:i A',strtotime($chat->created_at))}}
                                @endif
                                <br>{{$chat->message}}.
                                <br>
                                {{$chat->chat_file_name}}.

                                @if(!empty($chatFile))
                                @foreach($chatFile as $image)

                                <a href="{{asset('public/ad_chat/'.$image->chatfile)}}" target="_blank" rel="noopener noreferrer" download><i class="an an-file-ar" aria-hidden="true"></i></a>
                                <!-- <li>JPEG</li>
                                            <li>PNG</li> -->
                                @endforeach
                                @endif
                            </div>
                            @endforeach
                            @endif
                            <fieldset class="dashboard-content mb-4 bg-grey">
                                <form action="{{url('chating')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-telephone">file<span class="required-f">*</span></label>
                                            <input name="chatfile[]" placeholder="" value="" id="chatfile" class="form-control" multiple type="file">
                                            <input name="sender_id" placeholder="" value="{{$enq->user_id}}" class="form-control" type="hidden">
                                            <input name="ad_id" placeholder="" value="{{$enq->ad_id}}" class="form-control" type="hidden">
                                            <input name="receiver_id" placeholder="" value="{{Auth::guard('webUser')->user()->id}}" class="form-control" type="hidden">
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-telephone">file Name<span class="required-f">*</span></label>
                                            <input name="chatfilename" placeholder="" value="" id="chatfilename" class="form-control" type="text">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                            <label for="input-telephone">Message<span class="required-f">*</span></label>
                                            <textarea class="form-control" name="chatMessage" id="chatMessage"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" onclick="changeAcco('acco')" class="btn btn-primary rounded">Send</button>
                                </form>
                            </fieldset>
                        </div>
                    </div>

                </div>
                @endif

                @endif
            </div>
            <!-- End Dashboard -->
            <div id="myad" class="tab-pane fade">
                <h3>My Service</h3>





                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead class="alt-font">
                            <tr>
                                <th>SERVICE ID</th>
                                <th>IMAGE</th>
                                <th>SERVICE DETAILS</th>
                                <th>PRICE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($ads as $key => $nad)
                            <tr>
                                <td>{{++$key}}</td>
                                <?php
                                $pic = Cpr_Add_images::where('ad_id', $nad->id)->orderBy('image_order', 'ASC')->first();
                                ?>

                                <td>
                                    @if(isset($pic->image))
                                    <img src="{{asset('public/ad/'.$pic->image)}}" style="width:70px">
                                    @endif
                                </td>
                                <td style="width:35%;">
                                    <p>{{$nad->title}}</p>
                                    <p>{{date('d-m-Y',strtotime($nad->created_at))}}</p>
                                </td>
                                <td class="text-success">₹&nbsp;{{$nad->price}}</td>
                                <td>
                                    <a class="link-underline view" href="javascript:void(0)">
                                        @if($nad->status == 1)
                                        Published
                                        @else
                                        Unpublished
                                        @endif</a>
                                </td>
                                <td>
                                    <a class="link-underline" onclick="editAd({{$nad->id}});" href="javascript:void(0)">Edit</a>
                                    <br>
                                    <a class="link-underline" href="{{url('deleteAdd/'.$nad->id)}}" onclick="return confirm('Are You Sure?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Orders -->
            <div id="orders" class="product-order tab-pane fade">
                <h3>Orders</h3>
                @foreach($ads2 as $key => $nad)
                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">

                        <tbody>

                            <tr>
                                <td>{{++$key}}</td>
                                <?php
                                $pic = Cpr_Add_images::where('ad_id', $nad->id)->orderBy('image_order', 'ASC')->first();
                                ?>

                                <td>
                                    @if(isset($pic->image))
                                    <img src="{{asset('public/ad/'.$pic->image)}}" style="width:70px">
                                    @endif
                                </td>
                                <td style="width:35%;">
                                    <p>{{$nad->title}}</p>
                                    <p>{{date('d-m-Y',strtotime($nad->created_at))}}</p>
                                </td>
                                <td class="text-success">₹&nbsp;{{$nad->price}}</td>
                                <td>
                                    <?php
                                    $cnt = Cpr_ad_enquiry::where('ad_id', $nad->id)->count();
                                    ?>
                                    {{$cnt}}
                                </td>
                                <td>
                                    @if($user->plan != 'free_new')
                                    <a class="link-underline" onclick="changeTab('Chat')" href="{{url('startChat/'.$nad->id)}}">View</a>
                                    @else
                                    <a class="link-underline sizelink" id="showplan" onclick="changeTab('sbsc')" href="#show_response">View</a>
                                    @endif

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                @endforeach
            </div>
            <!-- End Orders -->
            <div id="Enquiries" class="product-order tab-pane fade">
                <h3>My Service Enquiries</h3>
                @if(!empty($enquiries))
                @foreach($enquiries as $key => $enquir)

                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">

                        <tbody>

                            <tr>
                                <td>{{++$key}}</td>
                                <?php
                                $pic = Cpr_Add_images::where('ad_id', $enquir->ad_id)->orderBy('image_order', 'ASC')->first();
                                ?>
                                <td>
                                    @if(isset($pic->image))
                                    <img src="{{asset('public/ad/'.$pic->image)}}" style="width:70px">
                                    @endif
                                </td>
                                <td style="width:35%;">
                                    <p>{{$enquir->title}}</p>
                                    <p>{{date('d-m-Y',strtotime($enquir->created_at))}}</p>
                                </td>
                                <td class="text-success">₹&nbsp;{{$enquir->price}}</td>

                                <td>

                                    <a class="link-underline" onclick="changeTab('Chat')" href="{{url('startChat/'.$enquir->ad_id)}}">Start chat</a>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                @endforeach
                @endif
            </div>

            <!-- Orders tracking -->
            <div id="orderdetails" class="order-tracking tab-pane fade">
                <h3>Orders tracking</h3>
                <form class="orderstracking-from mt-3" method="post" action="#">
                    <p class="mb-3">To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                    <div class="row align-items-center">
                        <div class="form-group col-md-5 col-lg-5">
                            <label for="orderId">Order ID <span class="required-f">*</span></label>
                            <input name="orderId" placeholder="Order ID" value="" id="orderId" type="text" required>
                        </div>
                        <div class="form-group col-md-5 col-lg-5">
                            <label for="billingEmail">Billing email <span class="required-f">*</span></label>
                            <input name="billingEmail" placeholder="Billing email" value="" id="billingEmail" type="text" required>
                        </div>
                        <div class="form-group col-md-2 col-lg-2">
                            <button type="submit" class="btn rounded w-100 h-100"><span>Track</span></button>
                        </div>
                    </div>
                </form>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <h3>Status for order no: 000123</h3>
                        <!-- Status Order -->
                        <div class="row mt-3">
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="product-img mb-3 mb-sm-0">
                                    <img class="blur-up lazyload" data-src="webassets/images/products/product-6-1.jpg" src="webassets/images/products/product-6-1.jpg" alt="product" title="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-8">
                                <div class="tracking-detail d-flex-center">
                                    <ul>
                                        <li>
                                            <div class="left"><span>Order name</span></div>
                                            <div class="right"><span>Sunset Sleep Scarf Top</span></div>
                                        </li>
                                        <li>
                                            <div class="left"><span>customer number</span></div>
                                            <div class="right"><span>000123</span></div>
                                        </li>
                                        <li>
                                            <div class="left"><span>order date</span></div>
                                            <div class="right"><span>14 Nov 2021</span></div>
                                        </li>
                                        <li>
                                            <div class="left"><span>Ship Date</span></div>
                                            <div class="right"><span>16 Nov 2021</span></div>
                                        </li>
                                        <li>
                                            <div class="left"><span>shipping address</span></div>
                                            <div class="right"><span>55 Gallaxy Enque, 2568 steet, 23568 NY</span></div>
                                        </li>
                                        <li>
                                            <div class="left"><span>Carrier</span></div>
                                            <div class="right"><span>Ipsum</span></div>
                                        </li>
                                        <li>
                                            <div class="left"><span>carrier tracking number</span></div>
                                            <div class="right"><span>000123</span></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 mt-4 mt-lg-0">
                                <div class="tracking-map map-section ratio ratio-16x9 h-100">
                                    <iframe src="https://www.google.com/maps/embed?pb=" allowfullscreen="" height="650"></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- End Status Order -->
                        <!-- Tracking Steps -->
                        <div class="tracking-steps nav mt-5 mb-4 clearfix">
                            <div class="step done"><span>order placed</span></div>
                            <div class="step current"><span>preparing to ship</span></div>
                            <div class="step"><span>shipped</span></div>
                            <div class="step"><span>delivered</span></div>
                        </div>
                        <!-- End Tracking Steps -->
                        <!-- Order Table -->
                        <div class="table-responsive order-table">
                            <table class="table table-bordered table-hover align-middle text-center mb-0">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>14 Nov 2021</td>
                                        <td>08.00 AM</td>
                                        <td>Shipped</td>
                                        <td>Canada</td>
                                    </tr>
                                    <tr>
                                        <td>15 Nov 2021</td>
                                        <td>12.00 AM</td>
                                        <td>Shipping info received</td>
                                        <td>California</td>
                                    </tr>
                                    <tr>
                                        <td>16 Nov 2021</td>
                                        <td>10.00 AM</td>
                                        <td>Origin scan</td>
                                        <td>Landon</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Order Table -->
                    </div>
                </div>
            </div>
            <!-- End Orders tracking -->

            <!-- Address -->
            <div id="address" class="address tab-pane">
                <h3>Addresses</h3>
                <p class="xs-fon-13 margin-10px-bottom">The following addresses will be used on the checkout page by default.</p>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h4 class="billing-address">Shipping address</h4>
                        <a class="link-underline view" href="#">Edit</a>
                        <p>No 40 Baria Sreet <br> 133/2 NewYork City, <br> NY, United States.</p>

                        <div class="accordion add-address mt-3" id="address1">
                            <button class="collapsed btn btn--small rounded" type="button" data-bs-toggle="collapse" data-bs-target="#shipping" aria-expanded="false" aria-controls="shipping">Add Address</button>
                            <div id="shipping" class="accordion-collapse collapse" data-bs-parent="#address">
                                <form class="address-from mt-3" method="post" action="#">
                                    <fieldset>
                                        <h2 class="login-title mb-3">Shipping details</h2>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-firstname1">First Name <span class="required-f">*</span></label>
                                                <input name="firstname" placeholder="First Name" value="" id="input-firstname1" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-lastname1">Last Name <span class="required-f">*</span></label>
                                                <input name="lastname" placeholder="Last Name" value="" id="input-lastname1" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-email1">Email <span class="required-f">*</span></label>
                                                <input name="email" placeholder="Email" value="" id="input-email1" type="email" required>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-telephone1">Telephone <span class="required-f">*</span></label>
                                                <input name="telephone" placeholder="Telephone" value="" id="input-telephone1" type="tel">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-company1">Company</label>
                                                <input name="company" placeholder="Company" value="" id="input-company1" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-address-11">Address <span class="required-f">*</span></label>
                                                <input name="address_1" placeholder="Address" value="" id="input-address-11" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-address-21">Apartment <span class="required-f">*</span></label>
                                                <input name="address_2" placeholder="Apartment" value="" id="input-address-21" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-city1">City <span class="required-f">*</span></label>
                                                <input name="city" placeholder="City" value="" id="input-city1" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-postcode1">Post Code <span class="required-f">*</span></label>
                                                <input name="postcode" placeholder="Post Code" value="" id="input-postcode1" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-country1">Country <span class="required-f">*</span></label>
                                                <select name="country_id" id="input-country1">
                                                    <option value="">Select Country</option>
                                                    <option value="244">Aaland Islands</option>
                                                    <option value="1">Afghanistan</option>
                                                    <option value="2">Albania</option>
                                                    <option value="3">Algeria</option>
                                                    <option value="4">American Samoa</option>
                                                    <option value="5">Andorra</option>
                                                    <option value="6">Angola</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                                <label for="input-zone1">Region / State <span class="required-f">*</span></label>
                                                <select name="zone_id" id="input-zone1">
                                                    <option value="">Select Region / State</option>
                                                    <option value="3513">Aberdeen</option>
                                                    <option value="3514">Aberdeenshire</option>
                                                    <option value="3515">Anglesey</option>
                                                    <option value="3516">Angus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn rounded mt-1"><span>Add Address</span></button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h4 class="billing-address">Billing address</h4>
                        <a class="link-underline view" href="#">Edit</a>
                        <p>No 40 Baria Sreet <br> 133/2 NewYork City, <br> NY, United States.</p>

                        <div class="accordion add-address mt-3" id="address2">
                            <button class="collapsed btn btn--small rounded" type="button" data-bs-toggle="collapse" data-bs-target="#billing" aria-expanded="false" aria-controls="billing">Add Address</button>
                            <div id="billing" class="accordion-collapse collapse" data-bs-parent="#address">
                                <form class="address-from mt-3" method="post" action="#">
                                    <fieldset>
                                        <h2 class="login-title mb-3">Billing details</h2>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-firstname2">First Name <span class="required-f">*</span></label>
                                                <input name="firstname" placeholder="First Name" value="" id="input-firstname2" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-lastname2">Last Name <span class="required-f">*</span></label>
                                                <input name="lastname" placeholder="Last Name" value="" id="input-lastname2" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-email2">Email <span class="required-f">*</span></label>
                                                <input name="email" placeholder="Email" id="input-email2" type="email" required>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-telephone2">Telephone <span class="required-f">*</span></label>
                                                <input name="telephone" placeholder="Telephone" value="" id="input-telephone2" type="tel">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-company2">Company</label>
                                                <input name="company" placeholder="Company" value="" id="input-company2" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-address-12">Address <span class="required-f">*</span></label>
                                                <input name="address_1" placeholder="Address" value="" id="input-address-12" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-address-22">Apartment <span class="required-f">*</span></label>
                                                <input name="address_2" placeholder="Apartment" value="" id="input-address-22" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-city2">City <span class="required-f">*</span></label>
                                                <input name="city" placeholder="City" value="" id="input-city2" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-postcode2">Post Code <span class="required-f">*</span></label>
                                                <input name="postcode" placeholder="Post Code" value="" id="input-postcode2" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-country2">Country <span class="required-f">*</span></label>
                                                <select name="country_id" id="input-country2">
                                                    <option value="">Select Country</option>
                                                    <option value="244">Aaland Islands</option>
                                                    <option value="1">Afghanistan</option>
                                                    <option value="2">Albania</option>
                                                    <option value="3">Algeria</option>
                                                    <option value="4">American Samoa</option>
                                                    <option value="5">Andorra</option>
                                                    <option value="6">Angola</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                                <label for="input-zone2">Region / State <span class="required-f">*</span></label>
                                                <select name="zone_id" id="input-zone2">
                                                    <option value="">Select Region / State</option>
                                                    <option value="3513">Aberdeen</option>
                                                    <option value="3514">Aberdeenshire</option>
                                                    <option value="3515">Anglesey</option>
                                                    <option value="3516">Angus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn rounded mt-1"><span>Add Address</span></button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Address -->
            <div id="adPost" class="tab-pane fade">
                <h3> Add new Service </h3>
                <div class="account-login-form bg-light-gray padding-20px-all">
                    @if(isset($user->company_category) && isset($user->plan))
                    <form action="{{route('AddPost.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="account-head"> Service Details </h3>
                        <fieldset class="dashboard-content mb-4 bg-grey">
                            <div class="row">

                                <div class="form-group col-md-4 col-lg-4 col-xl-4" id="cat">
                                    <label for="">Select Category <span class="required-f">*</span></label>
                                    <input name="category[]" placeholder="Enter" value="{{$user->company_category}}" class="form-control" type="hidden">

                                    <select class="form-control" name="category[]" onchange="getSub(this.value,'')" id="maincat" disabled>
                                        <option value="">Select</option>
                                        @foreach($cat as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        document.getElementById('maincat').value = "{{$user->company_category}}"
                                    </script>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4" id="SubCat">
                                    <label for="">Select Sub Category<span class="required-f">*</span></label>
                                    <select class="form-control" name="category[]" data-type="SubCat" onchange="getSubSub(this)" id="sub">
                                        <option value="">Select</option>
                                        @foreach($subcat as $subcats)
                                        <option value="{{$subcats->id}}">{{$subcats->category_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="form-group col-md-4 col-lg-4 col-xl-4" id="endCat">
                                    <label for="">Select Country<span class="required-f">*</span></label>
                                    <select class="form-control" name="country">
                                        <option value="India">India</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="">Select State<span class="required-f">*</span></label>
                                    <select class="form-control" name="state" id="adstate" onchange="getCity(this.value,'')">
                                        <option value="">Select</option>
                                        @foreach($state as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="">Select City<span class="required-f">*</span></label>
                                    <select class="form-control" name="city" id="city">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-firstname"> Service Title <span class="required-f">*</span></label>
                                    <input name="title" placeholder="Enter" value="" id="title" class="form-control" type="text">
                                    <input placeholder="Enter" value="" name="adId" id="pro_id" class="form-control" type="hidden">
                                </div>
                            </div>
                        </fieldset>
                        <h3 class="account-head"> Photo & Media</h3>
                        <fieldset class="dashboard-content mb-4 bg-grey">
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-firstname"> Add Photo <span class="required-f">*</span></label>
                                    <p>Add at least 2 photos for this category, after upload pictures<br>
                                        text box with value 1 - is the title picture. You can change the order of pictures by changing the value of text boxes</p>
                                    <div class="file_input_wrap col-sm-12 mt-3 mb-3">

                                        <span class="file_input_">
                                            <input name="images[]" placeholder="Enter" value="" id="files" class="form-control" accept="image/*" type="file" multiple required>
                                        </span>
                                        <p id="plus">+</p>

                                        <!-- wisj -->

                                        <div class="row file_img" id="file_img">



                                        </div>

                                        <!-- endwis -->
                                    </div>
                                    <p>Each picture must not exceed 500 kb
                                        Supported formats are <b>.jpg</b>, <b>.gif</b> and <b>*.png</b> <br>
                                        Minimum Image Dimension : 300 px X 300 Px <br>

                                    </p>
                                </div>
                            </div>
                            @if($user->plan !='free')
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-telephone">Video Url</label>
                                    <input name="video_url" placeholder="" value="" type="url" id="video_url" class="form-control">

                                </div>
                            </div>
                            @endif
                        </fieldset>


                        <h3 class="account-head"> Service Details </h3>
                        <fieldset class="dashboard-content mb-4 bg-grey">
                            <div class="row">

                                <div class="form-group col-md-4 col-lg-4 col-xl-4" id="filters">
                                    <label for="input-telephone">Price <span class="required-f">*</span></label>
                                    <input name="price" placeholder="" value="" id="price" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-telephone">Description<span class="required-f">*</span></label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>

                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="customCheckbox clearfix mb-2">
                                        <input id="negotiable" name="negotiable" type="checkbox">
                                        <label for="negotiable">Checkbox Negotiable </label>
                                    </div>
                                </div>


                            </div>
                        </fieldset>

                        <h3 class="account-head"> Standard Service </h3>
                        <fieldset class="dashboard-content mb-4 bg-grey Sponsor_div">
                            <div class="row">
                                <div class="col-sm-8 text-center">

                                    <p style=" line-height: normal;">Upgrade Package in Subscription section<br>.</p>

                                </div>
                            </div>
                            <div class="row">
                                <?php
                                    $subs =  Cpr_subscription::find($user->plan);
                                    $free = Cpr_Add_post::where('plan',$user->plan)->where('user_id',Auth::guard('webUser')->user()->id)->where('status', 1)->count('id');
                                    $totalFree = $subs->number_of_enquiries - $free;
                                ?>
                                @if(isset($subs))
                                    <div class="col-sm-4">
    
                                    <span class="ad_price_wrap border_Sponsor mb-3">
                                        <input type="radio" name="plan" id="" value="{{$subs->id}}" checked>
                                        <h4 class="mb-2">{{$subs->name}}
                                           
                                            <span>Active</span>
                                            
                                        </h4>
                                        <p>Validity: {{$subs->validity_days}} days</p>
                                        <p>Remaining Services: {{$totalFree}}/{{$subs->number_of_enquiries}}</p>
                                        <div class="ad_days mt-4">
                                            <span class="bg_clr">Services: {{$subs->number_of_enquiries}}</span>
                                            <!-- <span class="border_clr">1 Days</span> -->
                                        </div>
                                        <div class="ad_price mt-4">₹ {{$subs->price}}</div>
                                    </span>
                                </div>
                                @endif
                                <!--@if($user->plan=='free')-->
                                <!--<div class="col-sm-4">-->
                                <!--    <span class="ad_price_wrap border_Sponsor mb-3">-->
                                <!--        <input type="radio" name="plan" id="free" value="free" onclick="return false;" onkeydown="return false;" {{$user->plan=='free'?'checked':''}}>-->

                                <!--        <h4 class="mb-2">Basic-->


                                <!--            <span>Active</span>-->


                                <!--        </h4>-->
                                <!--        <p>Validity: 3 days</p>-->
                                <!--        <p>Bid/Auction Features: Not Available </p>-->
                                <!--        <p>Featured Services: 1</p>-->
                                <!--        <p>Video URL: Not Available</p>-->
                                <!--        <p>Categories Access: 3</p>-->
                                <!--        <p>Remaining Service: {{$totalFree}}/5</p>-->
                                <!--        <div class="ad_days mt-4">-->
                                <!--            <span class="bg_clr">Services: 5</span>-->
                                            <!-- <span class="border_clr">1 Days</span> -->
                                <!--        </div>-->
                                <!--        <div class="ad_price mt-4">₹ 0</div>-->
                                <!--    </span>-->
                                <!--</div>-->
                                <!--@endif-->
                                <!--@if($user->plan=='Boost')-->
                                <!--<div class="col-sm-4">-->


                                <!--    <span class="ad_price_wrap border_Sponsor mb-3">-->
                                <!--        <input type="radio" name="plan" id="Boost" value="Boost" onclick="return false;" onkeydown="return false;" {{$user->plan=='Boost'?'checked':''}}>-->

                                <!--        <h4 class="mb-2">Boost-->

                                <!--            <span>Active</span>-->

                                <!--        </h4>-->
                                <!--        <p> Validity: 15 days</p>-->

                                <!--        <p>Bid/Auction Features: 5 </p>-->
                                <!--        <p>Featured Services: 5</p>-->
                                <!--        <p>Video URL: Available</p>-->
                                <!--        <p>Categories Access: 10</p>-->
                                <!--        <p>Remaining Service: {{$totalBoost}}/10</p>-->
                                <!--        <div class="ad_days mt-4">-->
                                <!--            <span class="bg_clr">Services: 10</span>-->
                                <!--        </div>-->
                                <!--        <div class="ad_price mt-4">₹ 1,800</div>-->
                                <!--    </span>-->

                                <!--</div>-->
                                <!--@endif-->
                                <!--@if($user->plan=='Premium')-->
                                <!--<div class="col-sm-4">-->

                                <!--    <span class="ad_price_wrap border_Sponsor mb-3">-->
                                <!--        <input type="radio" name="plan" id="Premium" value="Premium" onclick="return false;" onkeydown="return false;" {{$user->plan=='Premium'?'checked':''}}>-->

                                <!--        <h4 class="mb-2"> Premium-->

                                <!--            <span>Active</span>-->

                                <!--        </h4>-->
                                <!--        <p>Validity: 30 days</p>-->

                                <!--        <p>Bid/Auction features: Unlimited </p>-->
                                <!--        <p>Featured Services: 10</p>-->
                                <!--        <p>Video URL: Available</p>-->
                                <!--        <p>Categories Access: 20</p>-->
                                <!--        <p>Remaining Service: {{$totalPremium}}/20</p>-->
                                <!--        <div class="ad_days mt-4">-->
                                <!--            <span class="bg_clr">Services: 20</span>-->
                                <!--        </div>-->
                                <!--        <div class="ad_price mt-4">₹ 17,000</div>-->
                                <!--    </span>-->
                                <!--</div>-->
                                <!--@endif-->
                            </div>
                            <div class="row">
                                <div class="col-sm-8 text-center">
                                    <p style=" line-height: normal;">By clicking on Post Ad, you accept the Terms of Use, confirm that you will abide by the Safety Tips, and declare that this posting does not include any Prohibited Items.</p>

                                </div>
                            </div>

                        </fieldset>

                        <button type="submit" class="btn btn-primary rounded">POST SERVICE</button>

                    </form>
                    @else
                    <h6>Please Complete Your Profile and Choose a Subscription Plan to Add new Service </h6>
                    @endif
                </div>
            
            </div>
            <!-- Account Details -->
            <div id="account-details" class="tab-pane fade">
                <h3> Personal Information: </h3>
                <div class="account-login-form bg-light-gray padding-20px-all">
                    <form action="{{url('updateProfile/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset>

                            <div class="row">
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-firstname">First Name<span class="required-f">*</span></label>
                                    <input name="firstname" placeholder="First Name" value="{{$user->firstName}}" id="firstname" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-firstname">Last Name<span class="required-f">*</span></label>
                                    <input name="lastName" placeholder="Last Name" value="{{$user->lastName}}" id="firstname" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-email">Email<span class="required-f">*</span></label>
                                    <input name="email" placeholder="Email" value="{{$user->email}}" id="email" class="form-control" type="email">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-email">Phone<span class="required-f">*</span></label>
                                    <input name="phone" placeholder="phone" value="{{$user->phone}}" id="phone" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-email">Gender<span class="required-f">*</span></label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">Select</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <script>
                                        document.getElementById('gender').value = "{{$user->gender}}"
                                    </script>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-email">Current Location <span class="required-f">*</span></label>
                                    <input name="location" placeholder="loction" value="{{$currentUserInfo->countryName}},{{$currentUserInfo->regionName}},{{$currentUserInfo->cityName}}" id="loction" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-email">Profile Picture <span class="required-f">*</span>
                                        @if($user->image)
                                        <a href="{{asset('public/user/'.$user->image)}}" target="_blank" rel="noopener noreferrer">
                                            <i class="an an-file-ar" aria-hidden="true" style="font-size: 23px;padding-left: 20px;"></i>
                                        </a>
                                        @endif
                                    </label>
                                    <input name="image" placeholder="Number" value="" id="input-email" class="form-control" type="file">
                                </div>

                            </div>
                            <hr>
                            @if(Auth::guard('webUser')->user()->account_type =='v')
                            <h3> Corporate Information: </h3>
                            <div class="row">
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-email">Company Category<span class="required-f">*</span></label>
                                    <select class="form-control" name="company_category" id="company_category">
                                        <option value="">Select</option>
                                        @foreach($cats as $cate)
                                        <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        document.getElementById('company_category').value = "{{$user->company_category}}"
                                    </script>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">Company Name <span class="required-f">*</span></label>
                                    <input name="companyName" placeholder="" value="{{$user->companyName}}" id="input-telephone" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">Company Email <span class="required-f">*</span></label>
                                    <input name="companyEmail" placeholder="" value="{{$user->companyEmail}}" id="input-telephone" class="form-control" type="email">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">Company Phone <span class="required-f">*</span></label>
                                    <input name="companyPhone" placeholder="" value="{{$user->companyPhone}}" id="input-telephone" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">Company Website <span class="required-f">*</span></label>
                                    <input name="companyWebsite" placeholder="" value="{{$user->companyWebsite}}" id="input-telephone" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">Company Address <span class="required-f">*</span></label>
                                    <input name="companyAddress" placeholder="" value="{{$user->companyAddress}}" id="input-telephone" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">Company Logo <span class="required-f">*</span>
                                        @if($user->companyLogo)
                                        <a href="{{asset('public/user/'.$user->companyLogo)}}" target="_blank" rel="noopener noreferrer">
                                            <i class="an an-file-ar" aria-hidden="true" style="font-size: 23px;padding-left: 20px;"></i>
                                        </a>
                                        @endif
                                    </label>
                                    <input name="companyLogo" placeholder="" value="" id="input-telephone" class="form-control" type="file">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">GST Certificate<span class="required-f">*</span>
                                        @if($user->cac_certificate)
                                        <a href="{{asset('public/user/'.$user->cac_certificate)}}" target="_blank" rel="noopener noreferrer">
                                            <i class="an an-file-ar" aria-hidden="true" style="font-size: 23px;padding-left: 20px;"></i>
                                        </a>
                                        @endif
                                    </label>
                                    <input name="cac_certificate" placeholder="" value="" id="input-telephone" class="form-control" type="file">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-telephone">GST Certificate Number <span class="required-f">*</span></label>
                                    <input name="cac_certificate_number" placeholder="" value="{{$user->cac_certificate_number}}" id="input-telephone" class="form-control" type="text">
                                </div>

                            </div>
                            @endif
                        </fieldset>
                        <button type="submit" class="btn btn-primary rounded">Save</button>
                    </form>
                </div>
            </div>
            <!-- End Account Details -->
            <div id="Settings" class="tab-pane fade">
                <h3> Settings: </h3>
                <div class="account-login-form bg-light-gray padding-20px-all">
                    <form action="{{url('updateProfilepassword/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset>

                            <div class="row">
                                <div class="form-group col-md-4 col-lg-4 col-xl-4 "><label for="input-password" class="mt-4 pt-2">Change Password </label></div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-password">Password <span class="required-f">*</span></label>
                                    <input name="password" placeholder="Password" value="" id="input-password" class="form-control" type="password">
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-password">Confirm Password <span class="required-f">*</span></label>
                                    <input name="password_confirmation" placeholder="Password" value="" id="input-password" class="form-control" type="password">
                                </div>
                            </div>
                            <!-- <div class="row">
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4 "><label for="input-password" class="mt-4 pt-2">Change Contact </label></div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-password">New Number <span class="required-f">*</span></label>
                                            <input name="phone" placeholder="New Number" value="" id="input-password" class="form-control" type="password">
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-password">Confirm Number <span class="required-f">*</span></label>
                                            <input name="phone_confirmation" placeholder="Confirm Number" value="" id="input-password" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4 "><label for="input-password" class="mt-4 pt-2">Change Email </label></div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-password">New Email<span class="required-f">*</span></label>
                                            <input name="email" placeholder="New Email" value="" id="input-password" class="form-control" type="password">
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-password">Confirm Email<span class="required-f">*</span></label>
                                            <input name="password" placeholder="Confirm Email" value="" id="input-password" class="form-control" type="password">
                                        </div>
                                    </div> -->
                            <div class="row">
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <label for="input-password" class="mt-1">Chats </label>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <div class="customRadio clearfix me-3 mb-0">
                                        <input name="mr2" id="chats2" value="2" checked="checked" type="radio" class="padding-10px-right">
                                        <label for="chats2" class="mb-0"> Enable Chats &nbsp;</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                    <div class="customRadio clearfix me-3 mb-0">
                                        <input name="mr2" id="chats3" value="3" type="radio" class="padding-10px-right">
                                        <label for="chats3" class="mb-0">Disable chats</label>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <button type="submit" class="btn btn-primary rounded">Save</button>
                    </form>
                </div>
            </div>
            <!-- Wishlist -->
            <div id="wishlist" class="product-wishlist tab-pane fade">
                <h3>My Wishlist</h3>
                <!-- Grid Product -->
                <div class="grid-products grid--view-items wishlist-grid mt-4">
                    <div class="row">
                        @foreach($wishlist as $wishlist)
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 item position-relative" id="rem{{$wishlist->id}}">
                            <button type="button" class="btn remove-icon close-btn" data-bs-toggle="tooltip" onclick="removeWish({{$wishlist->id}});" data-bs-placement="top"><i class="icon an an-times-r"></i></button>
                            <!-- Product Image -->
                            <div class="product-image">
                                <!-- Product Image -->
                                <a href="{{url('product_detail/'.$wishlist->ad_id)}}" class="product-img">
                                    <!-- image -->
                                    <img class="primary blur-up lazyload" data-src="{{asset('public/ad/'.$wishlist->image)}}" src="{{asset('public/ad/'.$wishlist->image)}}" alt="product" title="product" style=" max-width: 210px;max-height: 130px;width:auto" />
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="hover blur-up lazyload" data-src="{{asset('public/ad/'.$wishlist->image)}}" src="{{asset('public/ad/'.$wishlist->image)}}" alt="product" title="product" style=" max-width: 210px;max-height: 130px;width:auto" />
                                    <!-- End hover image -->
                                    <!-- product label -->

                                    <!-- End product label -->
                                </a>
                                <!-- End Product Image -->
                            </div>
                            <!-- End Product Image -->

                            <!-- Product Details -->
                            <div class="product-details text-center">
                                <!-- Product Name -->
                                <div class="product-name" style="word-wrap: break-word;">
                                    <a href="{{url('product_detail/'.$wishlist->ad_id)}}">{{$wishlist->title}}</a>
                                </div>
                                <!-- End Product Name -->
                                <!-- Product Price -->
                                <div class="product-price">
                                    <span class="price">₹&nbsp;{{$wishlist->price}}</span>
                                </div>
                                <!-- End Product Price -->

                                <!-- End Product Button -->
                            </div>
                            <!-- End Product Details -->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- End Grid Product-->
            </div>
            <!-- End Wishlist -->

            <!-- Orders -->
            <div id="wallet" class="product-order tab-pane fade">
                <h3>WALLET</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="row user-profile mt-4">
                    <div class="col-12 col-lg-6">
                        <div class="profile-img">
                            <div class="img"><img src="webassets/images/avatar-img3.jpg" alt="profile" width="65" /></div>
                            <div class="detail ms-3">
                                <h5 class="mb-1">John Milar</h5>
                                <p>Wallet Balance: <strong>$500</strong></p>
                            </div>
                            <div class="lbl">SILVER USER</div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <ul class="profile-order mt-3 mt-lg-0">
                            <li style=" padding: 37px 10px;">
                                Add Money To Wallet
                            </li>
                            <li style=" padding: 37px 10px;">
                                Withdraw Money
                            </li>

                        </ul>
                    </div>
                </div>



                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
                        <thead class="alt-font">
                            <tr>
                                <th>ADID</th>
                                <th>IMAGE</th>
                                <th>AD DETAILS</th>
                                <th>CREDIT</th>
                                <th>DEBIT</th>
                                <th>BALANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="webassets/images/products/furniture-product1.jpg" style="width:70px"></td>
                                <td>
                                    <p>Honda Car 2021 Model petrol</p>
                                    <p>March 04, 2021</p>
                                    <p>Earned Points</p>
                                </td>
                                <td class="text-success">+Ns 5</td>
                                <td> 0 </td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><img src="webassets/images/products/furniture-product2.jpg" style="width:70px"></td>
                                <td>
                                    <p>Iphone 12 Pro 64 GBRed. </p>
                                    <p>March 04, 2021</p>
                                    <p>Earned Points</p>
                                </td>
                                <td class="text-success">+ Ns 7</td>
                                <td>
                                    0
                                </td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><img src="webassets/images/products/furniture-product1.jpg" style="width:70px"></td>
                                <td>
                                    <p>Honda Car 2021 Model petrol</p>
                                    <p>March 04, 2021</p>
                                    <p>Used Points </p>
                                </td>
                                <td class="text-success">0</td>
                                <td class="text-danger"> -NS 7</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><img src="webassets/images/products/furniture-product2.jpg" style="width:70px"></td>
                                <td>
                                    <p>Iphone 12 Pro 64 GBRed. </p>
                                    <p>March 04, 2021</p>
                                    <p>Used Points </p>
                                </td>
                                <td class="text-success">0</td>
                                <td class="text-danger"> -NS 5</td>
                                <td>15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Orders -->


            <!-- Orders -->
            <div id="reviews" class=" tab-pane fade">

                <div class="row">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="spr-reviews">
                            <h4 class="spr-form-title text-uppercase mb-3">My Reviews on IE Ads</h4>
                            <div class="review-inner">
                                @foreach($review as $rev)
                                <div class="spr-review">
                                    <div class="spr-review-header">
                                        <span class="product-review spr-starratings"><span class="reviewLink">
                                                @if($rev->rating == 5)
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                @elseif($rev->rating == 4)
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($rev->rating == 3)
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($rev->rating == 2)
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @elseif($rev->rating == 1)
                                                <i class="icon an an-star"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @else
                                                <i class="icon an an-star-o"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                <i class="icon an an-star-o mx-1"></i>
                                                <i class="icon an an-star-o"></i>
                                                @endif
                                            </span></span>
                                        <h5 class="spr-review-header-title mt-1">{{$rev->review_title}}</h5>
                                        <span class="spr-review-header-byline"><strong>{{$rev->name}}</strong> on <strong>{{date('M d Y H:i A',strtotime($rev->created_at))}}</strong></span>
                                    </div>
                                    <div class="spr-review-content">
                                        <p class="spr-review-content-body">{{$rev->review}}.</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Orders -->
            <!-- Orders -->
            <div id="notifications" class="product-order tab-pane fade">
                <h3>Notification</h3>
                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->

                <div class="table-responsive order-table mt-4">
                    <table class="table table-bordered table-hover align-middle text-left mb-0">

                        <tbody>
                            @foreach($noti as $not)
                            <tr>
                                <td>
                                    <i class="an an-award" aria-hidden="true">
                                    </i>
                                </td>
                                <td>{{date('M d Y H:i A',strtotime($not->created_at))}}</td>
                                @if($not->title == "Buyer Contacted" || $not->title == "Ad Chat")
                                <td><a class="" onclick="changeTab('Chat')" href="{{url('startChat/'.$not->ad_id)}}">{{$not->title}}</a></td>
                                @else
                                <td>{{$not->title}}</td>
                                @endif
                                <td>
                                    <p>{{$not->notification}}.</p>
                                </td>
                                <td>
                                    <a class="view" href="{{url('deleteNoti/'.$not->id)}}" onclick="return confirm('Are You Sure?')"><i class="an an-trash-alt" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <td><i class="an an-reply-all" aria-hidden="true"></i></td>
                                <td>16-09-2022 12:15 AM</td>
                                <td>Ad Published</td>
                                <td>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>
                                    <a class="link-underline view sizelink" href="#" onclick="return confirm('Are You Sure?')"><i class="an an-trash-alt" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="an an-share-square" aria-hidden="true"></i></td>
                                <td>16-09-2022 12:15 AM</td>
                                <td>Buyer Contacted</td>
                                <td>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>
                                    <a class="link-underline view sizelink" href="#" onclick="return confirm('Are You Sure?')"><i class="an an-trash-alt" aria-hidden="true"></i></a>

                                </td>
                            </tr>
                            <tr>
                                <td><i class="an an-chat" aria-hidden="true"></i></td>
                                <td>16-09-2022 12:15 AM</td>
                                <td>Ad Published</td>
                                <td>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>
                                    <a class="link-underline view sizelink" href="#" onclick="return confirm('Are You Sure?')"><i class="an an-trash-alt" aria-hidden="true"></i></a>
                                </td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Orders -->

            <!-- Orders -->
            <div id="subscriptions" class="product-order tab-pane fade">
                <h3 class="account-head"> Subscription </h3>
                <form action="{{url('payment')}}" method="post">
                    @csrf
                    <fieldset class="dashboard-content mb-4 bg-grey Sponsor_div">
                        <?php

                        ?>
                        <div class="row">
                            @foreach($subscriptions as $subscription)
                                <?php
                                    
                                    $free = Cpr_Add_post::where('plan',$subscription->id)->where('user_id',Auth::guard('webUser')->user()->id)->where('status', 1)->count('id');
                                    $totalFree = $subscription->number_of_enquiries - $free;
                                ?>
                            <div class="col-sm-4">

                                <span class="ad_price_wrap border_Sponsor mb-3">
                                    <input type="radio" name="plan" id="" value="{{$subscription->id}}" {{$user->plan==$subscription->id?'checked':''}}>
                                    <h4 class="mb-2">{{$subscription->name}}
                                        @if($user->plan==$subscription->id)
                                        <span>Active</span>
                                        @endif
                                    </h4>
                                    <p>Validity: {{$subscription->validity_days}} days</p>
                                   
                                    <p>Remaining Services: {{$totalFree}}/{{$subscription->number_of_enquiries}}</p>
                                    <div class="ad_days mt-4">
                                        <span class="bg_clr">Services: {{$subscription->number_of_enquiries}}</span>
                                        <!-- <span class="border_clr">1 Days</span> -->
                                    </div>
                                    <div class="ad_price mt-4">₹ {{$subscription->price}}</div>
                                </span>
                            </div>
                            @endforeach
                            <!--<div class="col-sm-4">-->

                            <!--    <span class="ad_price_wrap border_Sponsor mb-3">-->
                            <!--        <input type="radio" name="plan" id="" value="free" {{$user->plan=='free'?'checked':''}}>-->

                            <!--        <h4 class="mb-2">Basic-->
                            <!--            @if($user->plan=='free')-->
                            <!--            <span>Active</span>-->
                            <!--            @endif-->
                            <!--        </h4>-->
                            <!--        <p>Validity: 3 days</p>-->
                            <!--        <p>Bid/Auction Features: Not Available </p>-->
                            <!--        <p>Featured Services: 1</p>-->
                            <!--        <p>Video URL: Not Available</p>-->
                            <!--        <p>Categories Access: 3</p>-->
                            <!--        <p>Remaining Services: {{$totalFree}}/5</p>-->
                            <!--        <div class="ad_days mt-4">-->
                            <!--            <span class="bg_clr">Services: 5</span>-->
                                        <!-- <span class="border_clr">1 Days</span> -->
                            <!--        </div>-->
                            <!--        <div class="ad_price mt-4">₹ 0</div>-->
                            <!--    </span>-->
                            <!--</div>-->
                            <!--<div class="col-sm-4">-->
                            <!--    <span class="ad_price_wrap border_Sponsor mb-3">-->
                            <!--        <input type="radio" name="plan" id="" value="Boost" {{$user->plan=='Boost'?'checked':''}}>-->

                            <!--        <h4 class="mb-2">Boost-->
                            <!--            @if($user->plan=='Boost')-->
                            <!--            <span>Active</span>-->
                            <!--            @endif-->
                            <!--        </h4>-->
                            <!--        <p> Validity: 15 days</p>-->

                            <!--        <p>Bid/Auction Features: 5 </p>-->
                            <!--        <p>Featured Services: 5</p>-->
                            <!--        <p>Video URL: Available</p>-->
                            <!--        <p>Categories Access: 10</p>-->
                            <!--        <p>Remaining Services: {{$totalBoost}}/10</p>-->
                            <!--        <div class="ad_days mt-4">-->
                            <!--            <span class="bg_clr">Services: 10</span>-->
                            <!--        </div>-->
                            <!--        <div class="ad_price mt-4">₹ 1,800</div>-->
                            <!--    </span>-->
                            <!--</div>-->
                            <!--<div class="col-sm-4">-->


                            <!--    <span class="ad_price_wrap border_Sponsor mb-3">-->
                            <!--        <input type="radio" name="plan" id="" value="Premium" {{$user->plan=='Premium'?'checked':''}}>-->

                            <!--        <h4 class="mb-2"> Premium-->
                            <!--            @if($user->plan=='Premium')-->
                            <!--            <span>Active</span>-->
                            <!--            @endif-->
                            <!--        </h4>-->
                            <!--        <p>Validity: 30 days</p>-->

                            <!--        <p>Bid/Auction features: Unlimited </p>-->
                            <!--        <p>Featured Services: 10</p>-->
                            <!--        <p>Video URL: Available</p>-->
                            <!--        <p>Categories Access: 20</p>-->
                            <!--        <p>Remaining Services: {{$totalPremium}}/20</p>-->
                            <!--        <div class="ad_days mt-4">-->
                            <!--            <span class="bg_clr">Services: 20</span>-->
                            <!--        </div>-->
                            <!--        <div class="ad_price mt-4">₹ 17,000</div>-->
                            <!--    </span>-->

                            <!--</div>-->


                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <p style=" line-height: normal;">Select the subscription and pay the fees.Once fees is approved, You subscription will be active. </p>

                            </div>
                        </div>

                    </fieldset>
                    <center>
                        <button type="submit" class="btn btn-primary rounded">Pay/Save</button>
                    </center>
                </form>
            </div>
            <!-- End Orders -->
        </div>
        <!-- End Tab panes -->
    </div>
</div>
<!--End Main Content-->
</div>
<!--End Container-->
</div>
<div id="sizechart" class="mfpbox mfp-with-anim mfp-hide">
    <h1 class="text-center text-capitalize mb-4">Add Responses</h1>
    <div class="row">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive order-table mt-4">
                <table class="table table-bordered table-hover align-middle text-left mb-0">
                    <thead>
                        <td>#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Offer</td>
                        <td>Message</td>
                        <td>Action</td>
                    </thead>
                    <tbody id="responseData">

                    </tbody>
                </table>
            </div>

        </div>

        <div class="response-msg"></div>

        <!-- End Contact Form -->

    </div>

    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
</div>
<div id="show_response" class="mfpbox mfp-with-anim mfp-hide">
    <h1 class="text-center text-capitalize mb-4">Alert!</h1>
    <div class="row">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            
            <center>
            <div class="response-msg">
                You Have to Choose A Subscription Plan To Show Your Services Responces 
            </div>
            </center>
        </div>


        <!-- End Contact Form -->
       

    </div>
    <a class="nav-link" data-bs-toggle="tab" href="#subscriptions" id="sbsc" onclick="changeTab('sbsc')"><button title="Close (Esc)" type="button" class="mfp-close">×</button></a>
    
</div>
<script>



const element = document.getElementById("showplan");
element.addEventListener("click", myFunction);

function myFunction() {
  document.getElementById("sbsc").click();
}


    function removeWish(id) {

        var element = document.getElementById("rem" + id);
        element.classList.add("removeWish");
        jQuery.ajax({

            type: 'GET',

            url: "{{url('removeWish')}}?id=" + id,

            dataType: 'JSON',

            success: function() {

                document.querySelectorAll(".removeWish").forEach(el => el.remove());


            }

        });

    }

    function changeTab(params) {

        localStorage.setItem('activeTab', params);

    }

    function changeAcco(params) {
        localStorage.setItem('activeAcco', params);

    }

    function exampleFunction() {

        const cat = localStorage.getItem('activeTab');
        var tab = document.getElementById(cat);
        tab.click();
        const acco = localStorage.getItem('activeAcco');
        var accord = document.getElementById(acco);
        accord.click();
    }
</script>
<script>
    function getSub(id, filval) {

        if (id != "") {
            jQuery.ajax({
                type: 'GET',
                url: "{{url('getSub')}}?id=" + id,
                dataType: 'JSON',
                success: function(responce) {
                    console.log(responce.data);
                    let template = '';
                    responce.data.forEach((element, index) => {
                        template += `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${element.id}">${element.category_name}</option>`;
                    });
                    console.log(template);
                    document.querySelector('#sub').innerHTML = template;
                    document.querySelectorAll(".tamp").forEach(el => el.remove());
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    getFilter(id, filval);
                }
            }); //ajax close
        } else {
            document.querySelector('#sub').innerHTML = `<option value="">Select</option>`;
            document.querySelectorAll(".tamp").forEach(el => el.remove());
            document.querySelectorAll(".filt").forEach(el => el.remove());
            getFilter(id, filval);
        }
    }

    function getSubSub(e) {
        let uper = e.dataset.type;
        let id = e.value;
        jQuery.ajax({
            type: 'GET',
            url: "{{url('getSub')}}?id=" + id,
            dataType: 'JSON',
            success: function(responce) {
                console.log(responce.data);
                console.log(responce.data.length);
                if (responce.data.length > 0) {
                    let template = '';
                    responce.data.forEach((element, index) => {
                        template += `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${element.id}">${element.category_name}</option>`;
                    });
                    let newSub = "";
                    newSub += `<div class="form-group tamp col-md-4 col-lg-4 col-xl-4" id="SubCat${uper}">
                                <label for="input-email">Select Sub Category<span class="required-f">*</span></label>
                                <select class="form-control" name="category[]" data-type="SubCat${uper}" onchange="getSubSub(this)" id="sub${uper}">
                                ${template}
                                </select>
                            </div>`
                    console.log(newSub);
                    document.querySelectorAll(".tamp").forEach(el => el.remove());
                    var d1 = document.getElementById(uper);
                    d1.insertAdjacentHTML('afterend', newSub);
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    getFilter(id, '');
                } else if (responce.data.length == 0 && uper == 'SubCat') {
                    document.querySelectorAll(".tamp").forEach(el => el.remove());
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    getFilter(id, '');
                } else {
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    getFilter(id, '');
                }
            }
        }); //ajax close

    }

    function getFilter(e, filval) {
        // let uper = e.dataset.type;

        let id = e;
        jQuery.ajax({
            type: 'GET',
            url: "{{url('getFilter')}}?id=" + id,
            dataType: 'JSON',
            success: function(responce) {
                console.log("responce", responce);
                console.log('filval', filval);
                if (responce.length > 0) {
                    let template = '';
                    console.log(responce);
                    responce.forEach((element, index) => {
                        let filter = '';
                        element.filter_value.forEach(ele => {
                            let sel = "";
                            if (filval != '') {
                                filval.forEach(elem => {
                                    if (elem.filter_value_id == ele.id) {
                                        sel = "selected"
                                    }

                                });
                            }
                            filter += `<option value="${ele.id}" ${sel}>${ele.filter_value}</option>`;


                        });
                        // const countAll = document.querySelectorAll('.filt').length;
                        template += `<div class="form-group filt col-md-4 col-lg-4 col-xl-4">
                                            <label for="">${element.filter_name}<span class="required-f">*</span></label>
                                            <select class="form-control" name="filter[${index}]">
                                            <option value="">Select</option>
                                            ${filter}
                                            </select>
                                            <input type="hidden" name="upper_cat_id" value="${id}">
                                        </div>`;

                    });
                    console.log(template);
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    var d1 = document.getElementById("filters");
                    d1.insertAdjacentHTML('beforebegin', template);

                } else {
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                }

            }
        }); //ajax close

    }


    document.querySelector("#files").addEventListener("change", (e) => {
        // const myNode = document.getElementById("file_img");
        // while (myNode.lastElementChild) {
        //     myNode.removeChild(myNode.lastElementChild);
        // }

        //new portion
        const files = document.querySelector('#files').files;
        const data1 = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            data1.append('files[]', file);
        }

        data1.append("_token", "{{ csrf_token() }}");
        $.ajax({
            type: 'POST',
            url: "{{ url('uploadImages')}}",
            data: data1,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: (response) => {
                let template = response.map((images, index) => {



                    return `<div class="col-6 col-sm-6 col-md-3 col-lg-3 item position-relative ml-5 mb-2"  id="oldimage${images.id}">
                                        <button type="button" class="btn remove-icon close-btn" data-bs-toggle="tooltip" onclick="removeImage(${images.id})" data-bs-placement="top"><i class="icon an an-times-r"></i></button>
                                      
                                        <div class="product-image">
                                          

                                                
                                                <img class="primary blur-up lazyload" data-src="public/ad/${images.image}" src="public/ad/${images.image}" alt="product" title="product" style="width:100%;height:100px" />
                                                
                                               
                                          
                                         
                                        
                                            </div>
                                            <center>
                                            <input type="number" class="form-control" name="imageorder${index}" min="1" onchange="setImageOrder(this.value,${images.id})" placeholder="order" value="${images.image_order}" style="width:65px;height:25px;">
                                            </center>
                                        
                                    </div>`;

                }).join(' ');
                var d1 = document.getElementById('file_img');
                d1.insertAdjacentHTML('beforeend', template);
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
    document.querySelector("#plus").addEventListener("click", (e) => {
        document.getElementById("files").click();
    });

    function removeImage(id) {
        jQuery.ajax({

            type: 'GET',

            url: "{{url('removeImage')}}?id=" + id,

            dataType: 'JSON',

            success: function() {

                document.getElementById("oldimage" + id).remove();

            }

        });
    }


    window.onload = function deleteTempImages() {

        jQuery.ajax({

            type: 'GET',

            url: "{{url('deleteTempImages')}}",

            dataType: 'JSON',

            success: function(response) {
                exampleFunction()
            }

        });
    }

    function setImageOrder(val, id) {

        jQuery.ajax({

            type: 'GET',

            url: "{{url('setImageOrder')}}?val=" + val + "&id=" + id,

            dataType: 'JSON',

            success: function(response) {

            }

        });
    }

    function getCity(state, cityVal) {

        jQuery.ajax({

            type: 'GET',

            url: "{{url('ajaxcity')}}?state=" + state,

            dataType: 'JSON',

            success: function(response) {

                const template = response.cities.map((city, index) => {

                    if (cityVal == city.id) {
                        var sel = "selected"
                    } else {
                        var sel = ""
                    }

                    return `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${city.id}" ${sel}>${city.name}</option>`;

                }).join(' ');



                $('#city').html(template);



            }

        });

    }

    function changePannel(tb) {
        var tab = document.getElementById(tb);
        console.log(tab);
        tab.click();
    }

    function editAd(adId) {

        changePannel('pna');
        document.querySelectorAll(".tamp").forEach(el => el.remove());
        document.querySelectorAll(".filt").forEach(el => el.remove());

        jQuery.ajax({

            type: 'GET',

            url: "{{url('editAd')}}?id=" + adId,

            dataType: 'JSON',

            success: function(response) {

                console.log("category", response.adMapCat);
                if (response.adMapCat.length > 1) {
                    var sndCat = response.adMapCat[1].category_id;
                } else {
                    var sndCat = '';
                }
                editgetSub(response.adMapCat[0].category_id, sndCat)

                document.getElementById('maincat').value = response.adMapCat[0].category_id
                document.getElementById("maincat").disabled = true;
                getCity(response.data.state, response.data.city);
                document.getElementById('pro_id').value = response.data.id
                document.getElementById('title').value = response.data.title
                document.getElementById('adstate').value = response.data.state
                document.getElementById('price').value = response.data.price
                document.getElementById('description').value = response.data.description
                document.getElementById('video_url').value = response.data.video_url
                if (response.data.negotiable == "on") {
                    document.getElementById('negotiable').checked = true;
                }
                let template = response.adimage.map((images, index) => {

                    return `<div class="col-6 col-sm-6 col-md-3 col-lg-3 item position-relative ml-5 mb-2"  id="oldimage${images.id}">
                                        <button type="button" class="btn remove-icon close-btn" data-bs-toggle="tooltip" onclick="removeImage(${images.id})" data-bs-placement="top"><i class="icon an an-times-r"></i></button>
                                      
                                        <div class="product-image">
                                          

                                                
                                                <img class="primary blur-up lazyload" data-src="public/ad/${images.image}" src="public/ad/${images.image}" alt="product" title="product" style="width:100%;height:100px" />
                                                
                                               
                                          
                                         
                                        
                                            </div>
                                            <center>
                                            <input type="number" class="form-control" name="imageorder${index}" min="1" onchange="setImageOrder(this.value,${images.id})" placeholder="order" value="${images.image_order}" style="width:65px;height:25px;">
                                            </center>
                                        
                                    </div>`;

                }).join(' ');
                document.getElementById("file_img").innerHTML = template;
                document.getElementById("files").required = false;



                if (response.adMapFilter.length > 0) {
                    console.log(response.adMapFilter[0].cat_id);
                    console.log("filter", response.adMapFilter);
                    getFilter(response.adMapFilter[0].cat_id, response.adMapFilter)
                }
                for (let index = 1; index < response.adMapCat.length; index++) {
                    let val = index + 1
                    editgetSubSub(response.adMapCat[index].category_id, response.adMapCat[val].category_id)
                }

            }

        });
    }

    function getRes(id) {
        jQuery.ajax({

            type: 'GET',

            url: "{{url('getRes')}}?id=" + id,

            dataType: 'JSON',

            success: function(response) {

                let template = response.data.map((element, index) => {

                    return `<td>${index+1}</td>
                        <td>${element.name}</td>
                        <td>${element.email}</td>
                        <td>${element.phone}</td>
                        <td>N${element.subject}</td>
                        <td>${element.message}</td>
                        <td><a href="javascript:void(0)" class="link-underline" onclick="discus()">Start Discussion</a></td>`;
                }).join(' ');
                document.getElementById("responseData").innerHTML = template;


            }
        });

    }



    function editgetSubSub(id, subid) {

        jQuery.ajax({
            type: 'GET',
            url: "{{url('getSub')}}?id=" + id,
            dataType: 'JSON',
            success: function(responce) {
                console.log(responce.data);
                console.log(responce.data.length);
                if (responce.data.length > 0) {
                    let template = '';
                    responce.data.forEach((element, index) => {

                        if (subid == element.id) {
                            var sel = "selected"
                        } else {
                            var sel = ""
                        }
                        template += `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${element.id}" ${sel}>${element.category_name}</option>`;
                    });
                    let newSub = "";
                    newSub += `<div class="form-group tamp col-md-4 col-lg-4 col-xl-4" id="SubCat${id}">
                                <label for="">Select Sub Category<span class="required-f">*</span></label>
                                <select class="form-control" name="category[]" data-type="SubCat${id}" onchange="getSubSub(this)" id="sub${id}" disabled>
                                ${template}
                                </select>
                            </div>`
                    console.log(newSub);

                    var d1 = document.getElementById('endCat');
                    d1.insertAdjacentHTML('beforebegin', newSub);
                }

            }
        }); //ajax close

    }

    function editgetSub(id, subid) {


        jQuery.ajax({
            type: 'GET',
            url: "{{url('getSub')}}?id=" + id,
            dataType: 'JSON',
            success: function(responce) {
                console.log(responce.data);
                let template = '';
                responce.data.forEach((element, index) => {
                    if (subid == element.id) {
                        var sel = "selected"
                    } else {
                        var sel = ""
                    }
                    template += `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${element.id}" ${sel}>${element.category_name}</option>`;
                });
                console.log(template);
                document.querySelector('#sub').innerHTML = template;
                document.getElementById("sub").disabled = true;
            }
        }); //ajax close

    }
    
</script>
@endsection
