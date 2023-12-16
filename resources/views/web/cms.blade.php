@extends('web.layout.app')
@section('body')
<div id="page-content">
    <!--Collection Banner-->
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
    <div class="collection-header mb-4">

        <img src="{{asset('public/footer/'.$data->image)}}" style="width:100%">
    </div>
    <!--End Collection Banner-->

    <!--Main Content-->
    <div class="container">
        <!-- CMS Content -->
        <div class="text-content">
            <br><br>
            <div class="col-sm-12" style="padding:0 20px">
            {!! $data->content !!}
            </div>
            
            <br><br><br><br><br><br>
        </div>
        @if($data->slug == "contact-us")
        <div class="row mb-5">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <!-- Contact Form -->
                <div class="formFeilds contact-form form-vertical mt-2 mt-md-0">
                    <h1 class="text-center text-capitalize mb-4">Drop Us A Line</h1>
                     <form action="{{url('contactMsg')}}" method="post" id="contact-form" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="ContactFormName" name="name" class="form-control" placeholder="Name" />
                                    <span class="error_msg" id="name_error"></span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="email" id="ContactFormEmail" name="email" class="form-control" placeholder="Email" />
                                    <span class="error_msg" id="email_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" min_length="10"  id="ContactFormPhone" name="phone" pattern="[0-9\-]*" placeholder="Phone Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input type="text" id="ContactSubject" name="subject" class="form-control" placeholder="Subject" />
                                    <span class="error_msg" id="subject_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea id="ContactFormMessage" name="message" class="form-control" rows="4" placeholder="Message"></textarea>
                                    <span class="error_msg" id="message_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group mailsendbtn mb-0 w-100">
                                    <input class="btn w-100 rounded" type="submit" value="Send Message" />
                                    <div class="loading"><img class="img-fluid" src="assets/images/ajax-loader.gif" alt="loading"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="response-msg"></div>
                </div>
                <!-- End Contact Form -->
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <!-- Contact Details -->
                <div class="contact-details">
                    <ul class="list-unstyled">
                        <li class="mb-4 address"><strong class="d-block mb-2">ADDRESS :</strong>
                            <p class="m-0"><i class="icon an an-map-marker-al me-2 d-none"></i> Address</p>
                        </li>
                        <li class="mb-3 phone"><strong>PHONE : </strong><i class="icon an an-phone me-2 d-none"></i> (+91)9977885566</li>
                        <li class="email"><strong>EMAIL:</strong><i class="icon an an-envelope-l me-2 d-none"></i>support@profilebaba.com</li>
                    </ul>
                    <hr>
                    
                   
                    <div class="follow-us">
                        <label class="d-block mb-3"><strong>STAY CONNECTED</strong></label>
                        <div class="social-sharing d-flex-center">
                            <a href="#" class="d-flex-center btn btn-link btn--share share-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i class="icon an an-facebook m-0 pb-1 px-1"></i><span class="d-none share-title">Facebook</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i class="icon an an-twitter m-0 pb-1 px-1"></i><span class="d-none share-title">Tweet</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest" data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i class="icon an an-pinterest-p pb-1 m-0 px-1"></i> <span class="d-none share-title">Pin it</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-instagram" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Instagram"><i class="icon an an-instagram m-0 pb-1 px-1"></i><span class="d-none share-title">Instagram</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-tikTok" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on TikTok"><i class="icon an an-tiktok m-0 pb-1 px-1"></i><span class="d-none share-title">TikTok</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-whatsapp" data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Whatsapp"><i class="icon an an-whatsapp m-0 pb-1 px-1"></i><span class="d-none share-title">Whatsapp</span></a>
                        </div>
                    </div>
                </div>
                <!-- End Contact Details -->
            </div>
        </div>
        
        @endif
        <!-- End CMS Content -->
    </div>
    <!--End Main Content-->
</div>
@endsection