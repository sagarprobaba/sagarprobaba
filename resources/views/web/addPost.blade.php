<?php
use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_subscription;
use App\Models\webUser;
use Illuminate\Support\Facades\Auth;
?>
@extends('web.layout.app')
@section('body')
<div id="page-content">
    <!--Collection Banner-->

    <div class="flash-message">

        @if(Session::has('error'))

        <p class="alert alert-danger">{{ Session::get('error') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @if(Session::has('success'))

        <p class="alert alert-success">{{ Session::get('success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
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
    <!--Container-->
    <div class="container pt-2">
        <!--Main Content-->


        <div class="row mb-4 mt-5 mb-lg-5 pb-lg-5">
            <div class="col-xl-2 col-lg-2 col-md-12 mb-4 mb-lg-0">
                <!-- Nav tabs -->

                <!-- End Nav tabs -->
            </div>

            <div class="col-xl-8 col-lg-10 col-md-12">
                <!-- Tab panes -->
                <div class="tab-content ">
                    <!-- Account Details -->
                    <div id="account-details" class="tab-pane fade active show">
                        <div class="account-login-form bg-light-gray padding-20px-all">
                            <h3 class="mb-3 text-center">Post A Service - Sell Online.</h3>
                            @if(isset(Auth::guard('webUser')->user()->company_category))
                            <form action="{{route('AddPost.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h3 class="account-head"> Service Details </h3>
                                <fieldset class="dashboard-content mb-4 bg-grey">
                                    <div class="row">

                                        <div class="form-group col-md-4 col-lg-4 col-xl-4" id="cat">
                                            <input name="category[]" placeholder="Enter" value="{{Auth::guard('webUser')->user()->company_category}}" class="form-control" type="hidden">

                                            <label for="input-email">Select Category <span class="required-f">*</span></label>
                                            <select class="form-control" name="category[]" onchange="getSub(this.value)" id="maincat" disabled>
                                                <option value="">Select</option>
                                                @foreach($cat as $cat)
                                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                                @endforeach
                                            </select>
                                            <script>
                                                document.getElementById('maincat').value = "{{Auth::guard('webUser')->user()->company_category}}"
                                            </script>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4" id="SubCat">
                                            <label for="input-email">Select Sub Category<span class="required-f">*</span></label>
                                            <select class="form-control" name="category[]" data-type="SubCat" onchange="getSubSub(this)" id="sub">
                                                <option value="">Select</option>
                                                @foreach($subcat as $subcat)
                                                <option value="{{$subcat->id}}">{{$subcat->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-email">Select Country<span class="required-f">*</span></label>
                                            <select class="form-control" name="country">
                                                <option value="India">India</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-email">Select State<span class="required-f">*</span></label>
                                            <select class="form-control" name="state" onchange="getCity(this.value)">
                                                <option value="">Select</option>
                                                @foreach($state as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-email">Select City<span class="required-f">*</span></label>
                                            <select class="form-control" name="city" id="city">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                            <label for="input-firstname"> Service Title <span class="required-f">*</span></label>
                                            <input name="title" placeholder="Enter" value="" id="input-firstname" class="form-control" type="text">
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
                                    @if(isset(Auth::guard('webUser')->user()->id))
                                        @if(Auth::guard('webUser')->user()->plan != "free")
                                            <div class="row">
                                                <div class="form-group col-md-12 col-lg-12 col-xl-12" >
                                                    <label for="input-telephone">Video Url</label>
                                                    <input name="video_url" placeholder="" value="" type="url" id="input-telephone" class="form-control">
                                                    
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </fieldset>


                                <h3 class="account-head"> Service Details </h3>
                                <fieldset class="dashboard-content mb-4 bg-grey">
                                    <div class="row">

                                        <div class="form-group col-md-4 col-lg-4 col-xl-4" id="filters">
                                            <label for="input-telephone">Price <span class="required-f">*</span></label>
                                            <input name="price" placeholder="" value="" id="input-telephone" class="form-control" required type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                            <label for="input-telephone">Description<span class="required-f">*</span></label>
                                            <textarea class="form-control" name="description"></textarea>
                                        </div>

                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="customCheckbox clearfix mb-2">
                                                <input id="offers" name="negotiable" type="checkbox">
                                                <label for="offers">Checkbox Negotiable </label>
                                            </div>
                                        </div>


                                    </div>
                                </fieldset>

                                <h3 class="account-head"> Standard Service </h3>
                               <fieldset class="dashboard-content mb-4 bg-grey Sponsor_div">
                                    <div class="row">
                                        <div class="col-sm-8 text-center">
                                            <p style=" line-height: normal;">Upgrade Package Post Login  in  Subscription section<br>.</p>

                                        </div>
                                    </div>
                                    <div class="row">
                                    @if(isset(Auth::guard('webUser')->user()->plan))
                                        <?php
                                            $subs =  Cpr_subscription::find(Auth::guard('webUser')->user()->plan);
                                            $free = Cpr_Add_post::where('plan',Auth::guard('webUser')->user()->plan)->where('user_id',Auth::guard('webUser')->user()->id)->where('status', 1)->count('id');
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
                                    @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 text-center">
                                            <p style=" line-height: normal;">By clicking on Post Ad, you accept the Terms of Use, confirm that you will abide by the Safety Tips, and declare that this posting does not include any Prohibited Items.</p>

                                        </div>
                                    </div>

                                </fieldset>
                                @if(!isset(Auth::guard('webUser')->user()->id))
                                <h3 class="account-head"> If not a registered user.</h3>
                                <fieldset class="dashboard-content mb-4  Sponsor_div">
                                    <div class="row">

                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="CustomerFirstName" class="d-none">First Name <span class="required">*</span></label>
                                                    <input id="CustomerFirstName" type="text" name="firstName" placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="CustomerLastName" class="d-none">Last Name <span class="required">*</span></label>
                                                    <input id="CustomerLastName" type="text" name="lastName" placeholder="Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="CustomerEmail" class="d-none">Email Address <span class="required">*</span></label>
                                                    <input id="CustomerEmail" autocomplete="false" type="email" name="email" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="CustomerLastName" class="d-none">Phone No. <span class="required">*</span></label>
                                                    <input id="CustomerLastName" autocomplete="false" type="text" name="phone" placeholder="Phone No." required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                                    <input id="CustomerPassword" autocomplete="false" type="password" name="password" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="CustomerConfirmPassword" class="d-none">Confirm Password <span class="required">*</span></label>
                                                    <input id="CustomerConfirmPassword" autocomplete="false" type="Password" name="password_confirmation" placeholder="Confirm Password" required>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </fieldset>
                                @endif
                                @if(!isset(Auth::guard('webUser')->user()->plan))
                                 <a href="{{url('/userdashboard')}}"><button type="button" class="btn btn-primary rounded">Choose A Subscription Plan</button></a>
                                @else
                                <button type="submit" class="btn btn-primary rounded">POST SERVICE</button>
                                @endif
                                <a href="{{url('/userdashboard')}}" class="btn btn-primary rounded pull-right">Back to Dashboard</a>
                            </form>
                            @else
                            <h6 class="mb-3 text-center">Please Complete Your Profile To Post Services</h6>
                            @endif
                        </div>
                    </div>
                    <!-- End Account Details -->


                </div>
                <!-- End Tab panes -->
            </div>
        </div>
        <!--End Main Content-->
    </div>
    <!--End Container-->
</div>
<script>
    function getSub(id) {

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
                    getFilter(id);
                }
            }); //ajax close
        } else {
            document.querySelector('#sub').innerHTML = `<option value="">Select</option>`;
            document.querySelectorAll(".tamp").forEach(el => el.remove());
            document.querySelectorAll(".filt").forEach(el => el.remove());
            getFilter(id);
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
                    getFilter(id);
                } else if (responce.data.length == 0 && uper == 'SubCat') {
                    document.querySelectorAll(".tamp").forEach(el => el.remove());
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    getFilter(id);
                } else {
                    document.querySelectorAll(".filt").forEach(el => el.remove());
                    getFilter(id);
                }
            }
        }); //ajax close

    }

    function getFilter(e) {
        // let uper = e.dataset.type;
        let id = e;
        jQuery.ajax({
            type: 'GET',
            url: "{{url('getFilter')}}?id=" + id,
            dataType: 'JSON',
            success: function(responce) {
                console.log(responce);
                if (responce.length > 0) {
                    let template = '';

                    responce.forEach((element, index) => {
                        let filter = '';
                        element.filter_value.forEach(ele => {

                            filter += `<option value="${ele.id}">${ele.filter_value}</option>`;

                        });
                        // const countAll = document.querySelectorAll('.filt').length;
                        template += `<div class="form-group filt col-md-4 col-lg-4 col-xl-4">
                                            <label for="input-email">${element.filter_name}<span class="required-f">*</span></label>
                                            <select class="form-control" name="filter[${index}]">
                                            <option value="">Select</option>
                                            ${filter}
                                            </select>
                                            <input type="hidden" name="upper_cat_id" value="${id}">
                                        </div>`;

                    });
                    console.log(template);
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

   function loadimage() {
        jQuery.ajax({

            type: 'GET',

            url: "{{url('loadimage')}}",

            dataType: 'JSON',

            success: function(images) {
                
            }

        });
    }
    window.onload = function deleteTempImages() {

        jQuery.ajax({

            type: 'GET',

            url: "{{url('deleteTempImages')}}",

            dataType: 'JSON',

            success: function(response) {

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
    function getCity(state) {

        jQuery.ajax({

            type: 'GET',

            url: "{{url('ajaxcity')}}?state=" + state,

            dataType: 'JSON',

            success: function(response) {

                const template = response.cities.map((city, index) => {

                    return `${index === 0 ? `<option value="">Select</option>` : ``}<option value="${city.id}">${city.name}</option>`;

                }).join(' ');



                $('#city').html(template);



            }

        });

    }
</script>
@endsection