<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('public/image/favicon.png')}}" />

    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/range.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/icon.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/chat.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/responsive.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    @yield('head')

    <link rel="stylesheet" href="{{asset('public/components/search.min.css') }}">
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-217177723-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-217177723-1');
    </script>

    <style>
        a:focus {
            outline: none;
        }

        .ui.search>.results {
            margin-top: 0;
            width: 100%;
            z-index: 999;
        }

        .ui.search .prompt {
            border-radius: 21px;
        }
    </style>
</head>

<body>
    <header>
        <section class="menu-bar">
            <div class="container">
                <div class="menu-items">

                    <div class="logo"> <a href="{{ url('/') }}"><img class="img-responsive" src="{{asset('public/image/logo.png') }}"><span class="fl1">Profile</span><span class="fl2">Baba</span></a> </div>

                    <div class="bar-icon"> <img src="{{asset('public/image/menu-icon.png') }}"> </div>
                    <div class="search-icon"> <i class="fa fa-search"> </i></div>
                    <div class="center-menu">
                        <ul>
                            <?php
                            $query = \App\Menu::where('position', 'header');
                            ?>
                            @if (Auth::user())
                            <?php
                            $query->where("need_login", '0');
                            ?>
                            @endif
                            <?php
                            $menudata = $query->get();
                            ?>
                            @foreach ($menudata as $menu)
                            <li><a href="{{ CustomValue::check_url($menu['href']) }}">
                                    <?php echo $menu['name'];  ?></a></li>
                            @endforeach
                        </ul>
                        <div class="search-box">



                            <form class="" action="{{ route('vendor_filter')}}" method="get">
                                <div class="form-group">

                                    <div class="ui search">
                                        <div class="ui left icon input">
                                            <input class="prompt form-control" type="text" placeholder="Search" name="name" value="{{ request()->name }}">
                                            <button type="submit" class="go">Go</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tp-right">
                        <ul>
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}" class="log-btn">Log In</a></li>
                            <li><a href="{{ route('register') }}" class="log-btn">Register</a></li>
                            @else
                            <li style="width:100%"><span><img src="{{ CustomValue::filecheck(Auth::user()->profile_photo,'/uploads/users/')}}">
                                    <h5>{{ Auth::user()->name }}</h5> <i class="fa fa-sort-desc" aria-hidden="true">
                                </span></i>
                                <ul>
                                    <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </section>

    </header>

    <div class="fabs">
        <div class="chat">
            <div class="chat_header">
                <div class="chat_option">
                    <div class="header_img">
                        <!-- <img src="{{asset('public/image/logo.png')}}"/> -->
                    </div>
                    <span id="chat_head">ProfileBaba</span> <span class="offline">(Offline)</span>
                    <span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i class="fullscreen fa fa-window-maximize"></i></span>
        
                </div>
    
            </div>
                <div id="chat_fullscreen" class="chat_conversion chat_converse">
                    <span class="chat_msg_item chat_msg_item_admin">
                        <div class="chat_avatar chat_baba">
                            <img src="{{asset('public/image/logo.png')}}"/>
                        </div>Hey there! How may I help you?<br>
                        What are you looking for and where?
                    </span>
                </div>

                <div class="fab_field">
                    <a id="fab_send" class="fab"><i class="fa fa-send"></i></a>
                    <textarea id="chatSend" name="chat_message" placeholder="Send a message" class="chat_field chat_message"></textarea>
                </div>
        </div>
        <a id="prime" class="fab"><i class="prime fa fa-comment"></i></a>
    </div>

    @yield('container')

    <footer>
        <section class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-block">
                            <ul class="list">
                                <?php
                                $footerdata = \App\Menu::where('position', 'footer')->get();
                                ?>
                                @foreach ($footerdata as $footer)
                                <li><a href="{{ CustomValue::check_url($footer['href']) }}">
                                        <?php echo $footer['name'];  ?></a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </footer>
    
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-database.js"></script>
    <script src="{{asset('public/js/firebase.js')}}" ></script>
    
    <script src="{{asset('public/js/jquery.min.js') }}"></script>
    <script src="{{asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('public/js/menumaker.js') }}"></script>
    <script src="{{asset('public/js/owl.carousel.min.js') }}"></script>
    <script src="{{asset('public/js/custom.js') }}"></script>
    <script src="{{asset('public/js/chat.js') }}"></script>
    <script src="{{asset('public/js/jquery.form-validator.js') }}"></script>
    <script src="{{asset('public/js/custom_laravel.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script src="{{asset('public/components/api.min.js') }}"></script>
    <script src="{{asset('public/components/search.min.js') }}"></script>
    
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMfsTk4NHW07RutlBqQ9hl95QtELwvCWk&libraries=geometry,places&callback=initMap"></script>
    <script src="{{asset('public/js/message_notify.js')}}" ></script>

    <script>
        $(document).ready(function() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('../firebase-messaging-sw.js')
                .then(function(registration) {
                    console.log('Registration successful, scope is:', registration.scope);
                }).catch(function(err) {
                    console.log('Service worker registration failed, error:', err);
                });
            }

            $('.ui.search')
                .search({
                    apiSettings: {
                        url: "{{ route('ajax.search.auto') }}?title={query}"
                    },
                    fields: {
                        results: 'items',
                        title: 'name',
                        url: 'html_url'
                    },
                    minCharacters: 1
                });

            getUserChat();
        });

        function getUserChat(){
            $.ajax({
                    url: '/getchat',
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "chat_id": 0
                    },
                    success: function(output){
                        if(output.length > 0){
                            output.forEach((value)=>{
                                if(value.sender == "user"){
                                    msg = '<span class="chat_msg_item chat_msg_item_user">'+value.message+'</span>';
                                    $(".chat_conversion").append(msg);
                                    document.getElementsByClassName("chat_conversion")[0].scrollTop += 100;
                                }
                                else{
                                    setChatMessage(value.message, value.id);
                                }
                            })
                        }
                    },
                    error: function(res){
                        console.log(res)
                    }
                });
        }

        $(".filbtn2").click(function() {
            $(".fxsidebar").addClass("fx");
        });
        $(".filcut2").click(function() {
            $(".fxsidebar").removeClass("fx");
        });

        function toggleChat() {
            $("#chatForm").toggleClass('visibility');
        }

    </script>
    <script>
        $(".tp-right ul li span").click(function() {
            $(".tp-right ul ul").slideToggle();
        });


        $(".bar-icon").click(function() {
            $(".center-menu ul").toggleClass("visibility");
            $(".center-menu").toggleClass("mobile-menu");
            $(".center-menu .search-box").removeClass("visibility");
        });

        $(".search-icon").click(function() {
            $(".center-menu ul").removeClass("visibility");
            $(".center-menu").removeClass("mobile-menu");
            $(".center-menu .search-box").toggleClass("visibility");
        });

        $('.javascript_select').select2({
            width: '100%'
        });


        function initMap() {
            // The location of Uluru
            var locate = {
                lat: 28.7041,
                lng: 77.1025
            };
            var location = $("#google_location").val();
            console.log(location)
            if (location != "" && location != undefined) {
                var arr = location.split("@")[1].split(",");
                locate = {
                    lat: parseFloat(arr[0]),
                    lng: parseFloat(arr[1])
                };
            }
            console.log(locate)
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: locate,
            });
            // The marker, positioned at Uluru
            let markers = [];
            markers.push(
                new google.maps.Marker({
                    position: locate,
                    map: map,
                })
            );

            var input = document.getElementById('searchTextField');

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

        
        function sendChatMessage() {
            var msg = '<span class="chat_msg_item chat_msg_item_user">'+$("#chatSend").val()+'</span>';
            $(".chat_conversion").append(msg);
            $.ajax({
                url: "/chat",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'message': $("#chatSend").val(),
                },
                success: function(output){
                    
                    $("#chatSend").val('');
                    if(output.message != undefined){
                        var msg = '<span class="chat_msg_item chat_msg_item_admin"><div class="chat_avatar chat_baba"><img src="{{asset("public/image/logo.png")}}"/></div>'+output.message+'</span>';
                        $(".chat_conversion").append(msg);
                        window.scrollBy(0,100);
                    }
                }
            });
        }

        function sendTokenToServer(fcm_token) {
            //console.log($user_id);
            $.ajax({
                url: "/save-user-token",
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
                url = "/getchat";
                data = {
                    "_token": "{{ csrf_token() }}",
                    "chat_id": chat
                }
            }
            
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(output){
                        setChatMessage(output, chat);
                    },
                    error: function(res){
                        console.log(res)
                    }
                });
            
        }

        async function setChatMessage(output, chat){
            if(output != undefined){
                var msg = "";
                if(output == "Share Vendor"){
                    var list = '<ul class="vendor-list">';
                    await $.ajax({
                        url: "/getVendorForChat",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "chat_id": chat
                        },
                        success: function(output){
                            output.forEach(function(value,key) {
                                list = list+ '<li>'+value.business_name+'<span>'+value.mobile_number+'</span></li>'
                            })
                        }
                    });
					list = list + '</ul>';
                    msg = '<span class="chat_msg_item chat_msg_item_admin"><div class="chat_avatar chat_baba"><img src="{{asset("public/image/logo.png")}}"/></div>'+list+'</span>';
                }
                else{
                    msg = '<span class="chat_msg_item chat_msg_item_admin"><div class="chat_avatar chat_baba"><img src="{{asset("public/image/logo.png")}}"/></div>'+output+'</span>';
                }
                $(".chat_conversion").append(msg);
                document.getElementsByClassName("chat_conversion")[0].scrollTop += 100;
            }
        }

    </script>
    @yield('javascript')
</body>

</html>