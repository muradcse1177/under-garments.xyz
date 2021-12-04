<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{url('public/asset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet"  href="{{url('public/asset/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet"  href="{{url('public/asset/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- daterange picker -->
{{--    <link rel="stylesheet"  href="{{url('public/asset/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">--}}
    <!-- bootstrap datepicker -->
{{--    <link rel="stylesheet"  href="{{url('public/asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">--}}
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet"  href="{{url('public/asset/plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"  href="{{url('public/asset/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
{{--    <link rel="stylesheet"  href="{{url('public/asset/plugins/timepicker/bootstrap-timepicker.min.css')}}">--}}
    <!-- Select2 -->
    <link rel="stylesheet"  href="{{url('public/asset/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet"  href="{{url('public/asset/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet"  href="{{url('public/asset/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet"  href="{{url('public/asset/toast/jquery.toast.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @yield('extracss')
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            position: relative;
            min-height: 1px;
            padding-right: 7px;
            padding-left: 7px;
        }
        .centered {
            height: 200px;
            width: 200px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini @yield('posSaleBar')">
<div class="wrapper">
    <div  id="loading" class="loading" style="">
        <img src="{{url('public/loading.gif')}}" class="centered">
    </div>
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>U</b>G</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Under-garments.xyz</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 1 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="{{url('public/asset/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    @php
                        $Image =url("public/user.png");
                    @endphp
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ $Image}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Cookie::get('user_name') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{$Image}}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Cookie::get('user_name') }}
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{$Image}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Cookie::get('user_name') }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">রিপোর্ট</li>
                <?php
                    $rows =DB::table('role_assign')
                        ->where('user_type', Cookie::get('user_type'))->first();
                    if($rows){
                        $roles = json_decode($rows->role);
                ?>
                @if(in_array(1, $roles))
                    <li class="@yield('dashLiAdd')">
                        <a href="{{ url('dashboard') }}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                @endif
                @if(in_array(39, $roles))
                    <li class="@yield('posSale')">
                        <a href="{{ url('posSale') }}">
                            <i class="fa fa-shopping-cart"></i> <span>POS Sale</span>
                        </a>
                    </li>
                @endif
                @if(in_array(2, $roles))
                    <li class="@yield('accountingLiAdd')">
                        <a href="{{ url('accounting') }}">
                            <i class="fa fa-dashboard"></i> <span>Accounting</span>
                        </a>
                    </li>
                @endif
                @if(in_array(3, $roles))
                    <li class="@yield('salesLiAdd')">
                        <a href="{{ url('salesReport') }}">
                            <i class="fa fa-shopping-bag"></i> <span>Sales Report</span>
                        </a>
                    </li>
                @endif
                <li class="header">Management</li>
                @if(in_array(24, $roles))
                    <li class="treeview  @yield('mainUserLiAdd')">
                        <a href="#">
                            <i class="fa fa-address-book"></i>
                            <span>User</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class ="@yield('userTypeLiAdd')"><a href="{{ url('user_type') }}"><i class="fa fa-circle-o"></i> User Type </a></li>
                            <li class ="@yield('userLiAdd')"><a href="{{ url('user') }}"><i class="fa fa-circle-o"></i> User  </a></li>

                        </ul>
                    </li>
                @endif
                @if(in_array(25, $roles))
                    <li class="@yield('catLiAdd')">
                        <a href ="{{ url('category') }}">
                            <i class="fa fa-bandcamp"></i> <span>Category </span>
                        </a>
                    </li>
                @endif
                @if(in_array(26, $roles))
                    <li class="@yield('sms')">
                        <a href ="{{ url('sms') }}">
                            <i class="fa fa-envelope-square"></i> <span>SMS </span>
                        </a>
                    </li>
                @endif
                @if(in_array(27, $roles))
                    <li class="@yield('subCatLiAdd')">
                        <a href ="{{ url('subcategory') }}">
                            <i class="fa fa-bandcamp"></i> <span> Sub Category </span>
                        </a>
                    </li>
                @endif
                @if(in_array(28, $roles))
                    <li class="@yield('mainSlide')">
                        <a href ="{{ url('mainSlide') }}" >
                            <i class="fa fa-image"></i> <span>Slide Management</span>
                        </a>
                    </li>
                @endif
                @if(in_array(29, $roles))
                    <li class="@yield('proLiAdd')">
                        <a href ="{{ url('product') }}" >
                            <i class="fa fa-shopping-cart"></i> <span>Products</span>
                        </a>
                    </li>
                @endif
                @if(in_array(30, $roles))
                    <li class="@yield('couponLiAdd')">
                        <a href ="{{ url('coupon') }}" >
                            <i class="fa fa-shopping-cart"></i> <span>Coupon</span>
                        </a>
                    </li>
                @endif
                @if(in_array(33, $roles))
                    <li class="@yield('deliveryLiAdd')">
                        <a href ="{{ url('delivery_charge') }}" >
                            <i class="fa fa-delicious"></i> <span> Products Delivery Charge</span>
                        </a>
                    </li>
                @endif
                @if(in_array(36, $roles))
                    <li class="@yield('aboutLiAdd')">
                        <a href ="{{ url('about_us') }}" >
                            <i class="fa fa-address-book-o"></i> <span>About Us</span>
                        </a>
                    </li>
                @endif
                @if(in_array(37, $roles))
                    <li class="@yield('contactLiAdd')">
                        <a href ="{{ url('contact_us') }}" >
                            <i class="fa fa-address-card"></i> <span>Contact Us</span>
                        </a>
                    </li>
                @endif
                @if(in_array(38, $roles))
                    <li class="@yield('roleAssign')">
                        <a href ="{{ url('roleAssign') }}" >
                            <i class="fa fa-address-card"></i> <span>Role Assign</span>
                        </a>
                    </li>
                @endif
                @if(in_array(40, $roles))
                    <li class="@yield('pageSettings')">
                        <a href ="{{ url('pageSettings') }}" >
                            <i class="fa fa-hacker-news"></i> <span>Page Settings</span>
                        </a>
                    </li>
                @endif

                <?php } ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('page_header')
            </h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <center><strong>&copy; Under-Garments.xyz,{{Date('Y')}} । Developed By-  <a href="https://parallax-soft.com/" target="_blank">Parallax Soft Inc.</a></strong></center>
    </footer>
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{url('public/asset/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public/asset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('public/asset/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{url('public/asset/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{url('public/asset/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{url('public/asset/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{url('public/asset/bower_components/moment/min/moment.min.js')}}"></script>
{{--<script src="{{url('public/asset/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>--}}
<!-- bootstrap datepicker -->
{{--<script src="{{url('public/asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
<!-- bootstrap color picker -->
<script src="{{url('public/asset/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
{{--<script src="{{url('public/asset/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>--}}
<!-- SlimScroll -->
<script src="{{url('public/asset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{url('public/asset/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('public/asset/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('public/asset/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('public/asset/dist/js/demo.js')}}"></script>
<script src="{{url('public/asset/toast/jquery.toast.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ajaxStart(function() {
        $(".loading").show();
    }).ajaxStop(function() {
        $(".loading").hide();
    });
    $(window).on('load', function () {
        $('#loading').hide();
    })
</script>
<!-- Page script -->
@yield('js')
</body>
</html>
