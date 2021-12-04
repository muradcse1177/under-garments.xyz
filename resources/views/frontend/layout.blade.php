<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{url('public/logo.ico')}}">
    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'public/asset/woolmart/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="preload" href="{{url('public/asset/woolmart/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{url('public/asset/woolmart/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{url('public/asset/woolmart/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{url('public/asset/woolmart/fonts/wolmart87d5.ttf?png09e')}}" as="font" type="font/ttf" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/vendor/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/vendor/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/vendor/magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet"  href="{{url('public/asset/toast/jquery.toast.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/vendor/photoswipe/photoswipe.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/vendor/photoswipe/default-skin/default-skin.min.css')}}">

    <link rel="stylesheet"  href="{{url('public/asset/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Default CSS -->
    @yield('css')
    <style>
        @media screen and (max-width: 600px) {
            .logo {
                display: none;
            }
            .onSticky {
                top:0;
                position:fixed;
                z-index: 1001;
                background-color: #00BAA3;
                padding: 15px;
            }
            .ms-sear {
                background-color:  white;
                border: 2px solid #00BAA3;
            }
            .divider{
                display: none;
            }
            .mainSlide{
                display: none;
            }
            .footerDiv{
                display: none;
            }
            .services{
                margin-top: -30px;
            }
            .s_shop{
                display: none;
            }
            .aaaaaaaa{
                display: none;
            }
            .p_category{
                display: none;
            }
            .middclasssok {
                margin-top: -30px;
            }

        }
        @media screen and (min-width: 768px) {
            .ms-sear{
                display: none;
            }
            .catHeader {
                margin-left: 10px;
            }
            .catHeaderSee {
                margin-right: 10px;
            }
        }
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #17642a;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        form, input, label, p,select,textarea {
            color: black !important;
        }
        .form-group > select > option{
            color: black !important;
        }
        .centered {
            height: 100px;
            width: 100px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }
        #loading {
            position: fixed;
            display: block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
        }

        #loading-image {
            height: 200px;
            width: 200px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
        }
    </style>
</head>
<?php
    use Illuminate\Support\Facades\DB;
    $categories = DB::table('categories')->where('type','1')->where('status','1')->orWhere('type','3')->where('status','1')->take(12)->get();
?>
<body class="home">
<div id="loading">
    <img id="loading-image" src="{{url('public/loading.gif')}}" alt="Loading..." />
</div>

<div class="page-wrapper">
    <!-- Start of Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <p class="welcome-msg">Welcome to Under-Garments.Xyz</p>
                </div>
                <div class="header-right">
                    <a href="{{url('contact')}}" class="d-lg-show"> Contact Us</a>
                    @if (Cookie::get('user_id') == null)
                        <span class="divider d-lg-show"></span>
                        <a href="{{url('signup')}}"><i
                                class="w-icon-account"></i>Login</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="{{url('signup')}}" class="ml-0 d-lg-show">Sign Up</a>
                    @else
                        <span class="delimiter d-lg-show">/</span>
                        <a href="{{url('logout')}}" class="ml-0 d-lg-show">Log Out</a>
                    @endif
                </div>
            </div>
        </div><br>
        <!-- End of Header Top -->
        <div class="header-middle middclasssok">
            <div class="container onSticky">
                <div class="header-left mr-md-4">
                    <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                    </a> &nbsp;
                    {{ Form::open(array('url' => 'searchProduct',  'method' => 'get')) }}
                        <input type="text" class="form-control ms-sear" name="mbSearch" id="mbSearch" placeholder="Search Here..." required />
                    {{ Form::close() }}
                    <a href="{{url('homepage')}}" class="logo ml-lg-0">
                        <div class='aaaaaaaa'>
                            <img  src="{{url('public/logo.png')}}" alt="logo" style="background-color:white; width: 180px; height: 90px; border: 2px solid #00BAA3 ;"/>
                        </div>
                    </a>
                    {{ Form::open(array('url' => 'searchProduct',  'method' => 'get','class' => 'header-search hs-expanded hs-round d-none d-md-flex input-wrapper ms-sear')) }}
                    {{ csrf_field() }}
                        <div class="select-box">
                            <select id="category" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search Here..." required />
                            <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
                    {{ Form::close() }}
                </div>
                <div class="header-right ml-4">
                    <div class="header-call d-xs-show d-lg-flex align-items-center">
                        <a href="tel:#" class="w-icon-call"></a>
                        <div class="call-info d-lg-show">
                            <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                <a href="mailto:#" class="text-capitalize">Live Chat</a> or :</h4>
                            <a href="tel:#" class="phone-number font-weight-bolder ls-50">{{'+8801880-198606'}}</a>
                        </div>
                    </div>
                    <a class="wishlist label-down link d-xs-show" href="{{url('wishlist')}}">
                        <i class="w-icon-heart"></i>
                        <span class="wishlist-label d-lg-show">Wishlist</span>
                    </a>
                    <a class="compare label-down link d-xs-show" href="{{url('compare')}}">
                        <i class="w-icon-compare"></i>
                        <span class="compare-label d-lg-show">Compare</span>
                    </a>
                    <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                        <div class="cart-overlay"></div>
                        <a href="#" class="cart-toggle label-down link">
                            <i class="w-icon-cart">
                                <span class="cart-count"></span>
                            </i>
                            <span class="cart-label">Cart</span>
                        </a>
                        <div class="dropdown-box">
                            <div class="cart-header">
                                <span>Shopping Cart</span>
                                <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <div class="products" style="height: auto;">
                                <div class="cart-action">
                                    <a href="{{url('cart')}}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                    <a href="{{url('checkout')}}" class="btn btn-primary  btn-rounded">Checkout</a>
                                </div>
                                <div class="m_output">

                                </div><hr>
                                <div class ='product_lists'>

                                </div>
                            </div>
                        </div>
                        <!-- End of Dropdown Box -->
                    </div>
                </div>
            </div>
            <div id="mbSearchForm" style="margin-top: 50px; margin-left: 30px;margin-right: 30px; width:100%; height: auto; display: none; z-index: 999;">
            </div>
        </div>
        <!-- End of Header Middle -->

        <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
            <div class="container">
                <div class="inner-wrap">
                    <div class="header-left">
                        <div class="dropdown category-dropdown has-border" data-visible="true">
                            <a href="#" class="category-toggle text-dark" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="true" data-display="static"
                               title="Browse Categories">
                                <i class="w-icon-category"></i>
                                <span>All Categories</span>
                            </a>
                            <div class="dropdown-box">
                                <ul class="menu vertical-menu category-menu">
                                    @foreach($categories as $cat)
                                        <li><a href="{{url('shop-by-cat/'.$cat->id)}}">{{$cat->name}}</a>
                                            <?php
                                                $sub_categories = DB::table('subcategories')->where('cat_id',$cat->id)->where('type','1')->where('status','1')->orWhere('type','3')->where('status','1')->get();
                                                if(count($sub_categories)>0){
                                                    ?>
                                                        <ul class="megamenu subDiv">
                                                            <li>
                                                                <ul>
                                                                    @foreach($sub_categories as $s_cat)
                                                                        <li><a href="{{url('shop-by-subCat/'.$s_cat->id)}}">{{$s_cat->name}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                <?php
                                                    }
                                                ?>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{url('shop')}}"
                                           class="font-weight-bold text-primary text-uppercase ls-25">
                                            View All Categories<i class="w-icon-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <nav class="main-nav">
                            <ul class="menu active-underline">
                                <li class="@yield('home')">
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="@yield('shop')">
                                    <a href="{{url('shop')}}">Shop</a>
                                </li>
                                @if (Cookie::get('user_id') == null)
                                    <li class="">
                                        <a href="{{url('signup')}}">Login</a>
                                    </li>
                                    <li class="">
                                        <a href="{{url('signup')}}">Sign UP</a>
                                    </li>
                                @endif
                                @if(Cookie::get('user_type') == 2)
                                    <li class="@yield('myOrder')">
                                        <a href="{{url('myProductOrder')}}">My Account</a>
                                    </li>
                                    <li class="@yield('wishlist')">
                                        <a href="{{url('wishlist')}}">Wishlist</a>
                                    </li>
                                    <li class="@yield('compare')">
                                        <a href="{{url('compare')}}">Compare</a>
                                    </li>
                                @endif
                                <li class="@yield('contact')">
                                    <a href="{{url('contact')}}">Contact Us</a>
                                </li>
                                <li class="@yield('about')">
                                    <a href="{{url('about')}}">About Us</a>
                                </li>
                                @if (!Cookie::get('user_id') == null)
                                    <li class="">
                                        <a href="{{url('logout')}}">Log Out</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="header-right">
                        <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                        <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
        <div class="footer-newsletter bg-primary">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="icon-box icon-box-side text-white">
                            <div class="icon-box-icon d-inline-flex">
                                <i class="w-icon-envelop3"></i>
                            </div>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                    Our Newsletter</h4>
                                <p class="text-white">Get all the latest information on Events, Sales and Offers.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                        <form action="#" method="get"
                              class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                            <input type="email" class="form-control mr-2 bg-white"  name="email" id="n_email"
                                   placeholder="Your E-mail Address" required/>
                            <button class="btn btn-dark btn-rounded newsletter_email" type="submit">Subscribe<i
                                    class="w-icon-long-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footerDiv">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-about">
                            <a href="{{url('/')}}" class="logo-footer">
                                <img src="{{url('public/logo.png')}}" alt="logo-footer" width="80"
                                     height="45" />
                            </a>
                            <div class="widget-body">
                                <p class="widget-about-title">Got Question? Call us 24/7</p>
                                <a href="tel:18005707777" class="widget-about-call">+8801880-198606</a>
                                <p class="widget-about-desc">Register now to get updates on coupons now.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h3 class="widget-title">Company</h3>
                            <ul class="widget-body">
                                <li><a href="{{url('about')}}">About Us</a></li>
                                <li><a href="{{url('contact')}}">Contact Us</a></li>
                                <li><a href="{{url('pages/1')}}">Privacy Policy</a></li>
                                <li><a href="{{url('pages/2')}}">Term and Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4>
                            <ul class="widget-body">
                                <li><a href="{{url('login')}}">Login In</a></li>
                                <li><a href="{{url('signup')}}">Sign Up</a></li>
                                <li><a href="{{url('cart')}}">View Cart</a></li>
                                <li><a href="{{url('checkout')}}">Checkout</a></li>
                                <li><a href="{{url('myProductOrder')}}">Track My Order</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>
                            <ul class="widget-body">
                                <li><a href="{{url('pages/3')}}">Payment Methods</a></li>
                                <li><a href="{{url('pages/4')}}">Money-back guarantee!</a></li>
                                <li><a href="{{url('pages/5')}}">Return Policy</a></li>
                                <li><a href="{{url('pages/6')}}">Shipping Method Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-left">
                    <p class="copyright">Copyright © {{Date('Y')}} Under-Garments.Xyz. All Rights Reserved. Design And Developed by <a href="https://parallax-soft.com/" style="color: darkgreen;" target="_blank"><b>Parallax Soft Inc.</b> </a></p>
                </div>
                <div class="footer-right">
                    <span class="payment-label mr-lg-8">We're using safe payment for</span>
                    <figure class="payment">
                        <img src="{{url('public/asset/woolmart/images/payment.png')}}" alt="payment" width="159" height="25" />
                    </figure>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>
<!-- End of Page-wrapper-->

<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="{{url('/')}}" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="{{url('shop')}}" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Shop</p>
    </a>
    <div class="header-search hs-toggle dir-up">
        <img src="{{url('public/logo.ico')}}" height="60" width="100">
    </div>
    <div class="cart-dropdown dir-up">
        <a href="{{url('cart')}}" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <div class="dropdown-box">
            <div class="m_output">

            </div>
            <div class="cart-action">
                <a href="{{url('cart')}}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                <a href="{{url('checkout')}}" class="btn btn-primary  btn-rounded">Checkout</a>
            </div>
        </div>
        <!-- End of Dropdown Box -->
    </div>
    @php
        if(Cookie::get('user_type') == 2){
            $link = 'myProductOrder';
       }
       else{
           $link = 'signup';
       }
    @endphp
    <a href="{{url($link)}}" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Account</p>
    </a>

</div>
<!-- End of Sticky Footer -->

<!-- Start of Scroll Top -->
<a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
<!-- End of Scroll Top -->

<!-- Start of Mobile Menu -->

<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#categories" class="nav-link active">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link">Main Menu</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane" id="main-menu">
                <ul class="mobile-menu">
                    <li class="@yield('home')">
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="@yield('shop')">
                        <a href="{{url('shop')}}">Shop</a>
                    </li>
                    @if (Cookie::get('user_id') == null)
                        <li class="">
                            <a href="{{url('signup')}}">Login</a>
                        </li>
                        <li class="">
                            <a href="{{url('signup')}}">Sign UP</a>
                        </li>
                    @endif
                    @if(Cookie::get('user_type') == 2)
                        <li class="@yield('myOrder')">
                            <a href="{{url('myProductOrder')}}">My Account</a>
                        </li>
                        <li class="@yield('wishlist')">
                            <a href="{{url('wishlist')}}">Wishlist</a>
                        </li>
                        <li class="@yield('compare')">
                            <a href="{{url('compare')}}">Compare</a>
                        </li>
                    @endif
                    <li class="@yield('contact')">
                        <a href="{{url('contact')}}">Contact Us</a>
                    </li>
                    <li class="@yield('about')">
                        <a href="{{url('about')}}">About Us</a>
                    </li>
                    @if (!Cookie::get('user_id') == null)
                        <li class="">
                            <a href="{{url('logout')}}">Log Out</a>
                        </li>
                    @endif
                    <li class="@yield('trackOrder')">
                        <a href="#"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                    </li>
                    <li class="@yield('dailyDeals')">
                        <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                    </li>
                </ul>

            </div>
            <?php
            $categories = DB::table('categories')->where('type','1')->where('status','1')->orWhere('type','3')->where('status','1')->get();
            ?>
            <div class="tab-pane active" id="categories">
                <ul class="mobile-menu">
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{url('shop-by-cat/'.$cat->id)}}">{{$cat->name}}</a>
                            <?php
                            $sub_categories = DB::table('subcategories')->where('cat_id',$cat->id)->where('type','1')->where('status','1')->orWhere('type','3')->where('status','1')->get();
                            if(count($sub_categories)>0){
                            ?>
                            <ul>
                                @foreach($sub_categories as $s_cat)
                                    <li><a href="{{url('shop-by-subCat/'.$s_cat->id)}}">{{$s_cat->name}}</a></li>
                                @endforeach
                            </ul>
                            <?php
                            }
                            ?>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{url('shop')}}"
                           class="font-weight-bold text-primary text-uppercase ls-25">
                            View All Categories<i class="w-icon-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- End of Mobile Menu -->
<!-- Plugin JS File -->
<script src="{{url('public/asset/woolmart/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/zoom/jquery.zoom.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/skrollr/skrollr.min.js')}}"></script>

<script src="{{url('public/asset/woolmart/vendor/sticky/sticky.min.js')}}"></script>
<!-- Main JS -->
<script src="{{url('public/asset/woolmart/js/main.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{url('public/asset/toast/jquery.toast.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/zoom/jquery.zoom.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{url('public/asset/woolmart/vendor/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{url('public/asset/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

</body>
<script>
    $(document).ajaxStart(function() {
        $(".loading").show();
    }).ajaxStop(function() {
        $(".loading").hide();
    });
    $(window).on('load', function () {
        $('#loading').show();
    })
    $(function(){
        getCart();
        $('.submit').on('click',function(){
            var id = $(this).data('id');
            $('#'+id+'productForm').submit(function(e){
                e.preventDefault();
                var quantity = $("#"+id+"q").val();
                if($(".selectChecker").val() == 1){
                    var size = $(".size").val();
                }
                else{
                    var size = 0;
                }
                $.ajax({
                    type: 'POST',
                    url:  '{{ url('product/cart_add') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "quantity": quantity,
                        "size": size,
                    },
                    dataType: 'json',
                    success: function(response){
                        var msg= response.output;
                        $('#ch'+id).show();
                        if(response.error){
                            $.toast({
                                heading: 'Sorry!',
                                text: msg.message,
                                showHideTransition: 'slide',
                                icon: 'error',
                                position: {
                                    left: 0,
                                    top: 300
                                },
                                stack: false
                            })
                        }
                        else{
                            $.toast({
                                heading: 'Thank You!!',
                                text: msg.message,
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: {
                                    left: 0,
                                    top: 300
                                },
                                stack: false
                            })
                            getCart();
                        }
                    }
                });
            });
        });
    });
    $(document).on('click', '.wToCart', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var quantity = 1;
        var fromWishlist = 1;
        $.ajax({
            type: 'POST',
            url:  '{{ url('product/cart_add') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "quantity": quantity,
                "fromWishlist": fromWishlist,
            },
            dataType: 'json',
            success: function(response){
                var msg= response.output;
                $('#ch'+id).show();
                if(response.error){
                    $.toast({
                        heading: 'Sorry!',
                        text: msg.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                else{
                    $.toast({
                        heading: 'Thank You!!',
                        text: msg.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                    getCart();
                }
            }
        });
        window.setTimeout(function() {
            window.location.href = '{{ url('/') }}/wishlist';
        }, 1000);
    });
    $(document).on('click', '.cToCart', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var quantity = 1;
        var fromCompareList = 1;
        $.ajax({
            type: 'POST',
            url:  '{{ url('product/cart_add') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "quantity": quantity,
                "fromCompareList": fromCompareList,
            },
            dataType: 'json',
            success: function(response){
                var msg= response.output;
                $('#ch'+id).show();
                if(response.error){
                    $.toast({
                        heading: 'Sorry!',
                        text: msg.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                else{
                    $.toast({
                        heading: 'Thank You!!',
                        text: msg.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                    getCart();
                }
            }
        });
        window.setTimeout(function() {
            window.location.href = '{{ url('/') }}/compare';
        }, 1000);
    });
    function getCart(){
        $.ajax({
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            url: '{{ url('product/cart_fetch') }}',
            dataType: 'json',
            success: function(response){
                $('.product_lists').html(response.output.list);
                $('.m_output').html(response.m_output);
                $('.cart-count').html(response.output.count);
            }
        });
    }
    getDetails();
    function getDetails(){
        $.ajax({
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            url: '{{ url('/') }}/product/cart_details',
            dataType: 'json',
            success: function(response){
                $('#tbody').html(response.output);
                $('.s_total').html(response.total['s_total']+' Taka');
                $('.ship_Charge').html(response.total['delivery']+' Taka');
                $('.g_total').html(response.total['g_total']+' Taka');
                getCart();
            }
        });
    }
    $(document).on('click', '.cart_delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            url: '{{ url('/') }}/product/cart_delete',
            dataType: 'json',
            success: function(response){
                var msg= response.output;
                if(!response.error){
                    $.toast({
                        heading: 'ধন্যবাদ',
                        text: msg.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                    getCart();
                    getDetails();
                }
            }
        });
    });
    $(document).on('click', '.quantity-plus', function(e){
        e.preventDefault();
        var parts = location.href.split('/');
        var lastSegment = parts.pop() || parts.pop();
        var id = $(this).data('id');
        var quantity = $("#"+id+"q").val();
        $.ajax({
            type: 'POST',
            url: '{{ url('/') }}/getProductMiqty',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            dataType: 'json',
            success: function(response){
                var products = response.products;
                var minqty = products.minqty;
                quantity = parseInt(quantity) + parseInt(minqty);
                $("#"+id+"q").val(quantity);
                if(lastSegment == 'cart'){
                    var donateValue = $("#donateCheck").val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/') }}/productQuantityChange',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "quantity": quantity,
                            "donateValue": donateValue
                        },
                        dataType: 'json',
                        success: function(response){
                            if(!response.error){
                                $.toast({
                                    heading: 'Thanks',
                                    text: 'Cart Updated Sucessfully',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    position: {
                                        left: 0,
                                        top: 300
                                    },
                                    stack: false
                                })
                                getCart();
                                getDetails();
                            }
                        }
                    });
                }
            }
        });
    });
    $(document).on('click', '.quantity-minus', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var quantity = $("#"+id+"q").val();
        var parts = location.href.split('/');
        var lastSegment = parts.pop() || parts.pop();
        $.ajax({
            type: 'POST',
            url: '{{ url('/') }}/getProductMiqty',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            dataType: 'json',
            success: function(response){
                var products = response.products;
                var minqty = products.minqty;
                if(quantity > parseInt(minqty)){
                    quantity = parseInt(quantity) - parseInt(minqty);
                }
                $("#"+id+"q").val(quantity);
                if(lastSegment == 'cart'){
                    var donateValue = $("#donateCheck").val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/') }}/productQuantityChange',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "quantity": quantity,
                            "donateValue": donateValue
                        },
                        dataType: 'json',
                        success: function(response){
                            if(!response.error){
                                $.toast({
                                    heading: 'Thanks',
                                    text: 'Cart Updated Sucessfully',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    position: {
                                        left: 0,
                                        top: 300
                                    },
                                    stack: false
                                })
                                getCart();
                                getDetails();
                            }
                        }
                    });
                }
            }
        });

    });
    $('#search').on('input', function() {
        var val = $('#search').val();
        $.ajax({
            type: 'GET',
            url: '{{url('/')}}/getProductSearchDesktopByName',
            data: {val:val},
            dataType: 'json',
            success: function(response){
                var data = response.data;

                $( "#search" ).autocomplete({
                    source: data
                });
            }
        });
    });
    $('#mbSearch').on('input', function() {
        var val = $('#mbSearch').val();
        $.ajax({
            type: 'GET',
            url: '{{url('/')}}/getProductSearchByName',
            data: {val:val},
            dataType: 'json',
            success: function(response){
                var data = response.data;
                if(data == ''){
                    $('#mbSearchForm').fadeOut();
                }
                else{
                    $('#mbSearchForm').fadeIn();
                    $('#mbSearchForm').html(data);
                }
            }
        });
        $(document).on('click', 'li', function(){
            $('#mbSearch').val($(this).text());
            $('#mbSearchForm').fadeOut();
        });
    });
    $(document).on('click', '.wishlistProduct', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            url: '{{ url('/') }}/add_wishlist',
            dataType: 'json',
            success: function(response){
                var data = response.data;
                if(data == 1){
                    $.toast({
                        heading: 'Thank You!!',
                        text: 'Product Added to Wishlist.',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 2){
                    $.toast({
                        heading: 'Sorry!!',
                        text: 'Product Already Added to Wishlist.',
                        showHideTransition: 'slide',
                        icon: 'danger',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 0){
                    window.location.replace('{{url('signup')}}');
                }
            }
        });
    });
    $(document).on('click', '.compareProduct', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            url: '{{ url('/') }}/add_comparelist',
            dataType: 'json',
            success: function(response){
                var data = response.data;
                if(data == 1){
                    $.toast({
                        heading: 'Thank You!!',
                        text: 'Product Added to Compare List.',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 2){
                    $.toast({
                        heading: 'Sorry!!',
                        text: 'Product Already Added to Compare List.',
                        showHideTransition: 'slide',
                        icon: 'danger',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 0){
                    window.location.replace('{{url('signup')}}');
                }
            }
        });
    });
    $(document).on('click', '.newsletter_email', function(e){
        e.preventDefault();
        var id = $('#n_email').val();
        $.ajax({
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id
            },
            url: '{{ url('/') }}/newsletter_email_insert',
            dataType: 'json',
            success: function(response){
                var data = response.data;
                if(data == 1){
                    $.toast({
                        heading: 'Thank You!!',
                        text: 'Subscribed successfully.',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 2){
                    $.toast({
                        heading: 'Sorry!!',
                        text: 'Already Subscribed.',
                        showHideTransition: 'slide',
                        icon: 'danger',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 3){
                    $.toast({
                        heading: 'Sorry!!',
                        text: 'Invalid Email Format.',
                        showHideTransition: 'slide',
                        icon: 'danger',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
                if(data == 0){
                    $.toast({
                        heading: 'Sorry!!',
                        text: 'Please Try Again.',
                        showHideTransition: 'slide',
                        icon: 'danger',
                        position: {
                            left: 0,
                            top: 300
                        },
                        stack: false
                    })
                }
            }
        });
    });

</script>
<script>
    $(document).ajaxStart(function() {
        $(".loading").show();
    }).ajaxStop(function() {
        $(".loading").hide();
    });
    $(window).on('load', function () {
        $('#loading').hide();
    })

</script>
@yield('js')
</html>
