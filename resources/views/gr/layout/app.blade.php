<?php
use App\Models\Ver_admin_menu;
$menus = Ver_admin_menu::where('parent',0)->get();
?>
<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">


<head>

    <meta charset="utf-8" />
    <title>PROFILE BABA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/newfevi.png')}}">

    <!-- plugin css -->
    <link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <style>
        .app-search .form-control::placeholder {
            color: #222 !important;
        }

        .navbar-header .btn-topbar i {
            color: #fff !important;

        }

        .navbar-header .user-name-text {
            color: #fff !important;
        }

        .topbar-user {
            background-color: #222 !important;

        }

        .topbar-user .user-name-sub-text {
            color: #fff !important;
        }

        .app-search .form-control {
            color: #e6470f;
            border: 1px solid rgb(230 71 15);
            background: #ffff;
        }
    </style>


</head>





<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar" style="background-color:rgb(64, 81, 137) ;">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo" style="background-color: white;">
                            <a href="{{url('dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22" style="height: 50px;width: auto !important; margin-top: 10px;">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-dark1.png')}}" alt="">
                                </span>
                            </a>

                            <a href="{{url('dashboard')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22"  style="height: 50px;width: auto !important; margin-top: 10px;">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>


                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Lead" aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>


                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Profile Baba</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{auth()->user()->name}}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <!-- <h6 class="dropdown-header">Welcome Anna!</h6>
                                <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                                <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
                                <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
                                <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-soft-success text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
                                <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a> -->
                                <a class="dropdown-item" href="{{url('logout')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

           <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                        <!-- end Dashboard Menu -->
                        @foreach($menus as $menu)
                            
                        
                            @if(isset($menu->link))
                                @if(auth()->user()->menu != 0 || auth()->user()->menu != null)
                                    @if(in_array($menu->id,explode(" ",auth()->user()->menu)))
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="{{route($menu->link)}}">
                                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">{{$menu->name}}</span>
                                            </a>
                
                                        </li>
                                    @elseif(auth()->user()->menu == 0)
                                        <li class="nav-item">
                                            <a class="nav-link menu-link" href="{{route($menu->link)}}">
                                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">{{$menu->name}}</span>
                                            </a>
                
                                        </li>
                                    @else
                                    
                                    @endif    
                                @endif
                            @else
                                
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">{{$menu->name}}</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                                        <ul class="nav nav-sm flex-column">
                                           
                                            @foreach($menu->submenu as $submenu)
                                                @if(auth()->user()->menu != 0 || auth()->user()->menu != null)
                                                     @if(in_array($submenu->id,explode(",",auth()->user()->menu)))
                                                        <li class="nav-item">
                                                            <a href="{{route($submenu->link)}}" class="nav-link" data-key="t-chat">{{$submenu->name}}</a>
                                                        </li>
                                                     @endif
                                                @endif
                                                @if(auth()->user()->menu == 0)
                                                
                                                    <li class="nav-item">
                                                        <a href="{{route($submenu->link)}}" class="nav-link" data-key="t-chat">{{$submenu->name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
        
                                            
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Setup</span>-->
                       <!--     </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->


                                    
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('Staff.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Staff</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                                    
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Classified Ad</span>                            </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->


                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('Category.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Category</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('Filter.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Filter</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('FilterValue.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Filter Value</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                                    
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="{{route('Banner.index')}}">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Banner</span>-->
                       <!--     </a>-->

                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">CMS</span>                            </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->


                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('Pages.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Pages</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('Footer.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Footer</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('subFooter.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Sub Footer</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                                    
                                    
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Vendor</span>                            </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->


                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{route('UserList.index')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Approved Vendor</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('rejectedUser')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Rejected Vendor</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('api_vendors')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Api Vendor With Category</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('api_vendors_without_cat')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Api Vendor Without Category</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                                    
                                    
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Buyer</span>                            </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->


                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('approveBuyer')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Approved Buyer</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('rejectedBuyer')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Rejected Buyer</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                                    
                                    
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Service List</span>                            </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->


                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('adminAddlist')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Service List</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('adminApiAddlist')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Api Service List</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('apicat')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Api Category List</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                                    
                                   
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                       
                        
                       <!--<li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="{{url('adenquiry')}}">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Service Enquiry</span>-->
                       <!--     </a>-->

                       <!-- </li>-->
                       <!-- <li class="nav-item">-->
                       <!--     <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">-->
                       <!--         <i class="ri-apps-2-line"></i> <span data-key="t-apps">Report</span>                            </a>-->
                       <!--     <div class="collapse menu-dropdown" id="sidebarApps">-->
                       <!--         <ul class="nav nav-sm flex-column">-->

                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('adReport')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Service Reports</span>-->
                       <!--                 </a>-->

                       <!--             </li>-->
                                    
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('adCatReport')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Service Category Reports</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('subReport')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Subscribers Reports</span>-->
                       <!--                 </a>-->
                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('userReport')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Users Report</span>-->
                       <!--                 </a>-->

                       <!--             </li>-->
                       <!--             <li class="nav-item">-->
                       <!--                 <a class="nav-link menu-link" href="{{url('contactReport')}}">-->
                       <!--                     <i class="ri-apps-2-line"></i> <span data-key="t-apps">Contact Message</span>-->
                       <!--                 </a>-->

                       <!--             </li>-->
                                    
                       <!--         </ul>-->
                       <!--     </div>-->
                       <!-- </li>-->
                        <!-- 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">BGV Duties</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">
                                            Downloads
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{asset('storage/app/public/document/sampleDoc/addressVerificationSample.xlsx')}}" class="nav-link" data-key="t-products" target="_blank" download>Address Verification</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{asset('storage/app/public/document/sampleDoc/employeeVerificationSample.xlsx')}}" class="nav-link" data-key="t-product-Details">Employee Verification</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{asset('storage/app/public/document/sampleDoc/companyVerificationSample.xlsx')}}" class="nav-link" data-key="t-create-product">Company Verification</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{asset('storage/app/public/document/sampleDoc/shopVerificationSample.xlsx')}}" class="nav-link" data-key="t-orders">
                                                        Shop Verification</a>
                                                </li>
                                                

                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="http://ag.webkype.net/bgc-duty.html" class="nav-link" data-key="t-chat">BGV Duties</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('Uploads.index')}}" class="nav-link" data-key="t-chat">Uploads</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('address.index')}}" class="nav-link" data-key="t-chat">Address Verifiction</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('companyForm.index')}}" class="nav-link" data-key="t-chat">Company Verifiction</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('employeeForm.index')}}" class="nav-link" data-key="t-chat">Employee Verifiction</a>
                                    </li>
                                </ul>
                            </div>
                        </li>-->
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="{{route('subscription_list')}}">-->
                        <!--        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Subscription</span>-->
                        <!--    </a>-->

                        <!--</li> -->
                        




                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('body')
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©Profile Baba
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by @Profile Baba
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->


    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector map-->
    <script src="{{asset('assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('assets/js/pages/dashboard-analytics.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
$(document).ready(function(){
  $(".hamburger-icon").click(function(){
    $("body").toggleClass("menu");
  });
  $(".nav-item").click(function(){
    $(this).toggleClass("open");
  });
  
  
});
</script>
</body>


</html>