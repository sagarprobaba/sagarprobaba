<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Profile baba</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/css/bootstrap-reset.css')}}" rel="stylesheet">

    <link href="{{asset('public/admin/css/multi-select.css')}}" media="screen" rel="stylesheet" type="text/css">

    <!--external css-->
    <link href="{{asset('public/admin/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admin/css/table-responsive.css')}}" rel="stylesheet" />
    <!--right slidebar-->
    <link href="{{asset('public/admin/css/slidebars.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('public/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/admin/css/style-responsive.css')}}" rel="stylesheet" />

    
    <link href="{{asset('public/css/notify.css')}}" rel="stylesheet">

    <!--toastr-->
    <link href="{{ asset('public/admin/assets/toastr-master/toastr.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('public/admin/assets/advanced-datatable/media/css/jquery.dataTables.css') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        .dt-buttons{
            margin: 12px 0 3px 10px;
        }
        .dataTables_filter label{
            display: flex;
        }
        .adv-table .dataTables_filter label input {
            width: 350px;
            display: block;
            height: calc(2.25rem + 2px);
            padding: 16px;
            font-size:14px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>

    <script src="{{asset('public/admin/js/jquery.js')}}"></script>

    <?php
        $aid=session('id');
        $admin=\App\Admin::find($aid);

        if($admin->photo!=''){
            $admin_photo="<img src='".url('/uploads/admin/photo/'.$admin->profile_pic)."' style='width:30px;height:30px;'  class='user-image img-circle' alt='User Image'>";
        }else{
            $admin_photo="<img src='".asset('public/admin/img/profile-avatar.jpg')."' style='width:30px;height:30px;' class='user-image img-circle' alt='User Image'>";
        }

        if($admin->name!=''){
            $admin_name=$admin->name;

        }else{
            $admin_name='Admin';
        }

    ?>
</head>

<body>
    <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
            </div>
            <!--logo start-->
            <a href="javascript:void()" class="logo" >Admin<span>Panel</span></a>
            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            {!!$admin_photo!!}
                            <span class="username">{{$admin_name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="{{url('/admin/profile')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>

                            <li><a href="{{url('/admin/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                    <li class="sb-toggle-right">
                        <i class="fa  fa-align-right"></i>
                    </li>
                </ul>
            </div>

        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                @include('admin.layout.sidebar')
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('top')

                <section class="panel">

                    <div class="panel-body">

                        <div class="adv-table">

                            @yield('container')

                        </div>

                    </div>

                </section>

            </section>

        </section>
        <!--main content end-->
        

        <div id="msgbox-area" class="msgbox-area"></div>
        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                 {{ date("Y") }} &copy; {{ config('app.name') }} by Knack IT Solutions
                <a href="#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-database.js"></script>
    <script src="{{asset('public/js/firebase.js')}}" ></script>
    
    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/admin/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('public/admin/js/respond.min.js')}}" ></script>

    <script src="{{asset('public/admin/js/jquery.multi-select.js')}}"></script>
    <!--right slidebar-->
    <script src="{{asset('public/admin/js/slidebars.min.js')}}"></script>
    <!--common script for all pages-->
    <script src="{{asset('public/admin/js/common-scripts.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!--toastr-->
    <script src="{{ asset('public/admin/assets/toastr-master/toastr.js') }}"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7U89RzBTCmuQTrNvrUlgaMT7phsiCQw&libraries=geometry,places&callback=initMap"></script>
    <script src="{{asset('public/admin/assets/advanced-datatable/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('public/js/message_notify.js')}}" ></script>

    <script type="text/javascript">
        $(document).on('change','.form_filter',function(){
            filter_data();
        });

        $(document).on('click', '#pagination_data a', function(e){
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                // headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: url,
                type: 'get',
                cache: false,
                datatype: 'html',
                beforeSend: function() {
                    newurl = window.location.protocol + "//" + window.location.host + window.location.pathname +"?"+url;
                    ChangeUrl('page', url);
                },
                success: function(data) {
                    filter_sussce(data)
                },
                error: function(xhr,textStatus,thrownError) {

                }
            });
        });

        $('#filter').submit(function (e){
            e.preventDefault();
            filter_data();
        });

        function filter_data(){

            var form_data,url,newurl;

            form_data = $('#filter').serialize();
            var form_data = form_data.replace(/[^&]+=\.?(?:&|$)/g, '');

            url = $('#filter').attr('action');

            $.ajax({
                // headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                url: url,
                type: 'get',
                data: form_data,
                cache: false,
                datatype: 'Json',
                beforeSend: function() {

                    @if (isset($export_data))
                        $("#export_datadd").attr("href", "{{ route('export_data',$export_data) }}?"+form_data);
                    @endif

                    newurl = window.location.protocol + "//" + window.location.host + window.location.pathname +"?"+form_data;
                    ChangeUrl('page', newurl);
                },
                success: function(data) {
                    filter_sussce(data);
                },
                error: function(xhr,textStatus,thrownError) {
                }
            });
        }

        function filter_sussce(data){
            $('#lawyer_count').html(data.lawyer_count);
            $('#pagination_data').html(data.pagination_html);

            $('#add_prodect_ajax').fadeOut('slow',function(){

                $('#add_prodect_ajax').html(data.data).fadeIn('fast');

            });
        }

        function ChangeUrl(page, url) {
            if (typeof (history.pushState) != "undefined") {
                var obj = { Page: page, Url: url };
                history.pushState(obj, obj.Page, obj.Url);
            } else {
                alert("Browser does not support HTML5.");
            }
        }

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editable-sample').DataTable({
                "sPaginationType": "full_numbers"
            });
            $('.filterBtn').html('<i class="fa fa-refresh" aria-hidden="true"></i>Reset');
        });
        $('#my-select').multiSelect();
        $('#servicesccff').change(function() {
            var qcv = $(this).val();
            $.ajax({
                url:"{{url('/admin/ajax/Issueffff')}}",
                type:"GET",
                data:{'serid': qcv},
                success:function(output){
                    $('#Issueffff').html(output);
                }
            });
        });
        $(document).on("click",'.reset-btn',function(){
            location.reload(true);
        });

        $(document).on("click",'.back-btn',function(){
            history.back();
        });

        $(document).on("click",'.filterBtn',function(){
            var url = window.location.href;
            var a = url.indexOf("?");
            var b =  url.substring(a);
            var c = url.replace(b,"");
            window.location.href=c;
        });
    </script>

    @if (isset($menudd))
    <script src="{{asset('public/admin/menu/jquery-menu-editor.min.js')}}"></script>
    <script src="{{asset('public/admin/menu/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js')}}"></script>
    <script src="{{asset('public/admin/menu/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')}}"></script>

    <script>
        jQuery(document).ready(function () {
            $('.select_url').select2();
            /* =============== DEMO =============== */
        // menu items
        var arrayjson = {!! isset($menudata->data) ? $menudata->data : "[]" !!};
        // icon picker options
        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
        // sortable list options
        var sortableListOptions = {
            placeholderCss: {'background-color': "#cccccc"}
        };

        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));

        $(document).ready(function () {
            editor.setData(arrayjson);
        });

        $('#btnReload').on('click', function () {
            editor.setData(arrayjson);

        });
        $('#btnOutput').on('click', function () {
            var str = editor.getString();
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                url: "{{ url('admin/save/'.$slug) }}",
                type: 'POST',
                data: {'data': str},
                success: function(data) {
                    alert(data.massage)
                    console.log(data.success);
                    location.reload();
                }
            });
        });

        $("#btnUpdate").click(function(){
            editor.update();
        });

        $('#btnAdd').click(function(){
            editor.add();
        });

        $('.select_url').on('change', function() {
            var val = $(this).val();
            var text = $(this).children("option:selected").text();
            $('.ffffffff').val(val);
            $('#text').val(text);
        });


        $('.linksends').click(function(){
            var serid = $(this).val();
            var serviceid = "serid="+serid;
            $.ajax({
                url:"{{url('/admin/link')}}",
                type:"GET",
                data:serviceid,
                success:function(res){
                    $('.select_url').html(res);

                }
            });
        });

        var serid = $('input[name=optradio]:checked', '#frmEdit').val();
        var serviceid = "serid="+serid;
        $.ajax({
            url:"{{url('/admin/link')}}",
            type:"GET",
            data:serviceid,
            success:function(res){
                $('.select_url').html(res);
            }
        });
        /* ====================================== */


        });
    </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {


            $("#nav-accordion a").each(function() {
              var pageUrl = window.location.href.split(/[?#]/)[0];
                if (this.href == pageUrl) {
                    $(this).addClass("active");
                    $(this).parent().addClass("active"); // add active to li of the current link
                    $(this).parent().parent().prev().addClass("active"); // add active class to an anchor
                    $(this).parent().parent().prev().click(); // click the item to make it drop
                }
            });

            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': true,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }
            @if(session('success'))
            toastr.success('<strong>Success!</strong> {{ session('success') }}');
            @endif

            @if(session('error'))
            toastr.error('<strong>Error!</strong> {{session('error')}}.');
            @endif

            @if(Session::has('errors'))
            @foreach ($errors->all() as $error)
            toastr.error('<strong>Error!</strong> {{ $error }}');
            @endforeach
            @endif

            $(document).on("click",'#loading-btn',function(){
                location.reload(true);
            });
        });
    </script>
    <script type="text/javascript">
        function initMap() {
                        
            var input = document.getElementById('location');
            if(input){
                var searchBox = new google.maps.places.SearchBox(input);

                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // For each place, get the icon, name and location.
                    const bounds = new google.maps.LatLngBounds();

                    places.forEach((place) => {
                        // console.log(place);
                        if (!place.geometry || !place.geometry.location) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        if (!place.address_components) {
                            console.log("Returned place contains no address components");
                            return;
                        }
                        place.address_components.forEach((address) => {
                            if(address.types[0] == "administrative_area_level_1"){
                                $("#state").val(address.long_name);
                            }
                        })

                        $("#lat").val(place.geometry.location.lat());
                        $("#lng").val(place.geometry.location.lng());
                    });
                });
            }

            var input = document.getElementById('searchTextField');
            if(input){
                var locate = {
                    lat: 28.7041,
                    lng: 77.1025
                };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 14,
                    center: locate,
                });
                let markers = [];
                markers.push(
                    new google.maps.Marker({
                        position: locate,
                        map: map,
                    })
                );

                var searchBox = new google.maps.places.SearchBox(input);

                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach((marker) => {
                        marker.setMap(null);
                    });

                    // For each place, get the icon, name and location.
                    const bounds = new google.maps.LatLngBounds();

                    places.forEach((place) => {
                        if (!place.geometry || !place.geometry.location) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        // Create a marker for each place.
                        markers.push(
                            new google.maps.Marker({
                                map,
                                title: place.name,
                                position: place.geometry.location,
                            })
                        );
                        input.value = "";
                        setLocation(place);

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            }

        }

        function setLocation(place) {
            
            let locations = [];
            let input = [];
            if($("#locations").val() !=''){
                input = JSON.parse($("#locations").val());
            }
            if(input.length > 0){
                input.forEach((loc) => {
                    locations.push(loc);
                })
            }
            locations.push([place.formatted_address, place.geometry.location]);
            showLocation(locations);
        }

        function showLocation(locations) {
            
            $("#show_location").empty();
            $("#locations").val(JSON.stringify(locations));
            var list = "";

            locations.forEach((loc, key) => {
                list = list+"<li>"+loc[0]+"<span class='btn-danger btn-xs delete_loc' onClick='delete_loc(this)' style='margin:30px' id='"+key+"'><i class='fa fa-trash-o'></i></span></li>";
            });

            $("#show_location").html(list);
        }

        function delete_loc(e) {
            var key = e.getAttribute('id');
            let input = [];
            let locations = [];
            if($("#locations").val() !=''){
                input = JSON.parse($("#locations").val());
            }
            delete input[key];
            if(input.length > 0){
                input.forEach((loc) => {
                    locations.push(loc);
                })
            }
            showLocation(locations);
        }

        $('.javascript_select').select2({width: '100%'});

        $(document).ready(function() {
            var val = $('.select_state').attr('select_val')
            select_city(val);
        });
        // select_country
        $('.select_country').change(function() {

            var val = $(this).val();
            select_state(val);
        });
        // select_country end

        // select_state
        $('.select_state').change(function() {

            var val = $(this).val();
            select_city(val);
        });
        // select_state end

        function select_state(val) {
            $('.select_state').empty();
            if (val === "") {
                val = '';
            }
            var select_state = $('.select_state').attr('select_val');
            var qs = "country_id=" + val;
            $.ajax({
                url: "{{url('/getstate')}}",
                type: "GET",
                data: qs,
                success: function(output) {
                    var options = "<option value=''>Select State</option>";
                    output.forEach(function(val,i){
                        options+="<option value='"+val.id+"'>"+val.name+"</option>";
                    })
                    $('.select_state').html(options);
                    $('.select_state option').each(function() {
                        if ($(this).val() == select_state) {
                            $(this).prop('selected', true);
                        }
                    });
                }
            });
        }

        function select_city(val) {
            $('.select_city').empty();
            if (val === "") {
                val = null;
            }
            var select_city = $('.select_city').attr('select_val');
            var qc = "state_id=" + val;

            $.ajax({
                url: "{{url('/getcity')}}",
                type: "GET",
                data: qc,
                success: function(output) {
                    var options = "<option value=''>Select City</option>";
                    output.forEach(function(val,i){
                        options+="<option value='"+val.id+"'>"+val.name+"</option>";
                    })
                    $('.select_city').html(options);

                    $('.select_city option').each(function() {
                        if ($(this).val() == select_city) {
                            $(this).prop('selected', true);
                        }
                    });
                }
            });
        }

        function sendTokenToServer(fcm_token) {
                //console.log($user_id);
                $.ajax({
                    url: "/save-token",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "fcm_token": fcm_token,
                    },
                    success: function(output){
                        console.log(output)
                    },
                    error: function(res){
                        console.log(res)
                    }
                });

            }  

        function showNotification(body,title,chat,type) {
            var url,data;
            if(type == undefined || type == "history"){
                url = "/admin/web_chat";
                data = {
                    "_token": "{{ csrf_token() }}",
                    "chat_id": chat
                }
            }
            else if(type == "new"){
                url = "/admin/assign-query";
                data = {
                    "_token": "{{ csrf_token() }}",
                    "chat_id": chat,
                    "type": type
                }
            }
            msgboxboxPersistent.show(
                title,
                body,
                "Show", () => {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: data,
                        success: function(output){
                            window.location.replace(output)
                        },
                        error: function(res){
                            console.log(res)
                        }
                    });
            });
        }

        $(document).on('click', '#pagination_data a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                },
                url: url,
                type: 'get',
                cache: false,
                success: function(data) {
                    history.go();
                },
                error: function(xhr, textStatus, thrownError) {}
            });
        });

		function ChangeUrl(page, url) {
            if (typeof(history.pushState) != "undefined") {
                var obj = {
                    Page: page,
                    Url: url
                };
                history.pushState(obj, obj.Page, obj.Url);
            } else {
                alert("Browser does not support HTML5.");
            }
        }
    </script>

    @yield('javascript')

</body>
</html>
