@extends('frontend.layout')
@section('title', 'Shop || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('shop', 'active')
@section('css')
    <link rel='stylesheet' type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo1.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
    <style>
        .submit {
            background-color: #00BAA3; /* Green */
            border: none;
            color: white;
            padding: 4px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <diV class="container mainSlide">
            <div class="intro-wrapper mb-6">
                <div class="owl-carousel owl-theme owl-nav-inner owl-nav-md row cols-1 gutter-no animation-slider"
                     data-owl-options="{
                        'nav': true,
                        'dots': false
                    }">
                    <?php
                    $i =1;
                    ?>
                    @foreach($slides as $ph)
                        <div class="banner banner-fixed intro-slide intro-slide{{$i}} br-sm" style="background-image: url({{url('public/asset/images/'.$ph->slide)}}); background-color: #262729;"></div>
                        <?php
                        $i++;
                        ?>
                    @endforeach
                </div>
            </div>
        </diV>
        <section class="category-ellipse-section p_category" style="background-color: #f3f3f3;"><br>
            <h2 class="title title-center mb-5">All Categories</h2>
            <div class="container mt-1 mb-2">
                <div class="row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                    @foreach($pro_categories as $pro_cat)
                        <div class="category category-ellipse">
                            <figure class="category-media">
                                <a href="{{url('shop-by-cat/'.$pro_cat->id)}}">
                                    <img src="{{url($pro_cat->image)}}" alt="Categroy"
                                         width="190" height="190" style="background-color: #5C92C0;" />
                                </a>
                            </figure>
                            <div class="category-content">
                                <h4 class="category-name">
                                    <a href="{{url('shop-by-cat/'.$pro_cat->id)}}">{{$pro_cat->name}}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
        </section>
        <div class="page-content">
            <div class="container" style="margin-top: 20px;">
                <!-- Start of Shop Banner -->
                <div class="shop-content row gutter-lg mb-10">
                    <!-- Start of Sidebar, Shop Sidebar -->
                    <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                        <!-- Start of Sidebar Overlay -->
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                        <!-- Start of Sidebar Content -->
                        <div class="sidebar-content scrollable">
                            <!-- Start of Sticky Sidebar -->
                            <div class="sticky-sidebar">
                                <div class="filter-actions">
                                    <label>Filter :</label>
                                    <a href="#" class="btn btn-dark btn-link filter-clean">Reset</a>
                                </div>
                                <!-- Start of Collapsible widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title"><label>All Categories</label></h3>
                                    <ul class="widget-body filter-items search-ul">
                                        @foreach($pro_categories as $pro_cat)
                                            <li><a href="{{url('shop-by-cat/'.$pro_cat->id)}}">{{$pro_cat->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End of Collapsible Widget -->

                                <!-- Start of Collapsible Widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title"><label>Price</label></h3>
                                    <div class="widget-body">
                                        <ul class="filter-items search-ul">
                                            <li><a href="{{url('shop-by-price/1-1000')}}">1.00 - 1000.00</a></li>
                                            <li><a href="{{url('shop-by-price/1000-10000')}}">1000.00 - 10000.00 </a></li>
                                            <li><a href="{{url('shop-by-price/10000-50000')}}">10000.00 - 50000.00 </a></li>
                                            <li><a href="{{url('shop-by-price/50000-100000')}}">50000.00 - 100000.00 </a></li>
                                            <li><a href="{{url('shop-by-price/100000-un')}}">100000.00+  Taka</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Sidebar Content -->
                        </div>
                        <!-- End of Sidebar Content -->
                    </aside>

                    <!-- Start of Shop Main Content -->
                    <div class="main-content">
                        <nav class="toolbox">
                            <div class="toolbox-left">
                                <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                        btn-icon-left d-block d-lg-none"><i
                                        class="w-icon-category"></i><span>Filters</span></a>
                            </div>
                            <div class="toolbox-right">

                                <div class="toolbox-item toolbox-layout">
                                    <a href="#" class="icon-mode-grid btn-layout active">
                                        <i class="w-icon-grid"></i>
                                    </a>

                                </div>
                            </div>
                        </nav>
                        @if ($message = Session::get('successMessage'))
                            <div class="col-md-12 mb-4">
                                <div class="alert alert-success alert-button">
                                    <a href="#" class="btn btn-success btn-rounded">Well Done</a>
                                    {{ $message }}
                                </div>
                            </div>
                        @endif
                        @if ($message = Session::get('errorMessage'))
                            <div class="col-md-12 mb-4">
                                <div class="alert alert-warning alert-button">
                                    <a href="#" class="btn btn-warning btn-rounded">Sorry</a>
                                    {{ $message }}
                                </div>
                            </div>
                        @endif

                        <div class="product-wrapper row cols-md-4 cols-sm-2 cols-2 productDiv">
                            @foreach($products as $product)
                                @php
                                $price = $product->price;
                                $Image ="";
                                   if(!empty($product->photo))
                                       $Image =url('/').'/'.$product->photo;
                                   else
                                       $Image =url('/')."/public/asset/no_image.jpg";
                            @endphp
                                <div class="product-wrap">
                                    <div class="product product-simple text-center">
                                        <form class="form-inline" id="{{$product->id.'productForm'}}">
                                            <figure class="product-media">
                                                <a href="{{url('products/'.$product->id.'/'.$product->slug)}}">
                                                    <img src="{{$Image}}" alt="Product" width="330" height="338" />
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlistProduct" title="Add to wishlist" data-id="{{$product->id}}" id="{{'wish'.$product->id}}"></a>
                                                    <a href="#" class="btn-product-icon btn-compare w-icon-compare compareProduct" title="Add to Compare" data-id="{{$product->id}}" id="{{'com'.$product->id}}"></a>
                                                </div>
                                                <div class="product-action">
                                                    <a href="{{url('products/'.$product->id.'/'.$product->slug)}}" class="btn-product btn-quickview" title="Quick View">Quick View</a>
                                                </div>
                                            </figure>
                                            <div class="product-details">
                                                <h4 class="product-name"><a href="">{{$product->minqty.'  '.$product->unit}}</a></h4>
                                                <h3 class="product-name"><a href="{{url('products/'.$product->id.'/'.$product->slug)}}">{{$product->name}}</a></h3>
                                                <div class="product-pa-wrapper">
                                                    <input type="hidden" name="quantity" id="{{$product->id.'q'}}" value="{{$product->minqty}}">
                                                    <div class="product-price">
                                                        <ins class="new-price">{{$product->discount_price.' Taka'}}</ins><del class="old-price">{{$price.' Taka'}}</del>
                                                    </div>
                                                    @if($product->size == null)
                                                        <div class="product-action">
                                                            <button type="submit" data-id="{{$product->id}}" id="{{'bg'.$product->id}}" class="submit">Add To Cart</button>
                                                        </div>
                                                    @else
                                                        <div class="product-action">
                                                            <a href="{{url('products/'.$product->id.'/'.$product->slug)}}"class="submit">View Options</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <input type="hidden" name="loadCounter" id="loadCounter" value="0">
                        </div>
                    </div>
                    <!-- End of Shop Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->

@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(".withPick").click(function(){
                $(".photoShow").show();
                $(".withPick").hide();
                $(".withoutPick").show();
            });
            $(".trade_button").click(function(){
                $("#trade_name").show();
                $("#generic_name").hide();
                $("#company_name").hide();
            });
            $(".generic_button").click(function(){
                $("#generic_name").show();
                $("#trade_name").hide();
                $("#company_name").hide();
            });
            $(".company_button").click(function(){
                $("#company_name").show();
                $("#trade_name").hide();
                $("#generic_name").hide();
            });
        });

        $(window).scroll(function () {
            if ($(window).height() + $(window).scrollTop() == $(document).height()) {
                var loadCounter = parseInt($("#loadCounter").val());
                var parts = window.location.href.split('/');
                var baseUrl = '{{url('/')}}/';
                 $.ajax({
                    type: 'GET',
                    url: '{{url('getProductOnScroll')}}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id":loadCounter,
                        "part3":parts[3],
                        "part4":parts[4],
                    },
                    dataType: 'json',
                    success: function(response){
                        var html = '';
                        var data = response.data;
                        for(var i =0; i<data.length; i++){
                            html += '<div class="product-wrap">';
                            html += '<div class="product product-simple text-center">';
                            html += '<form class="form-inline" id="'+data[i].id+'productForm">';
                            html += '<figure class="product-media">';
                            html += '<a href="'+baseUrl+'products/'+data[i].id+'/'+data[i].slug+'"> <img src="'+baseUrl+data[i].photo+'" alt="Product" width="330" height="338" /> </a>';
                            html += '<div class="product-action-vertical">';
                            html += '<a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlistProduct" title="Add to wishlist" data-id="'+data[i].id+'" id="wish'+data[i].id+'"></a>';
                            html += '<a href="#" class="btn-product-icon btn-compare w-icon-compare compareProduct" title="Add to Compare" data-id="'+data[i].id+'" id="com'+data[i].id+'"></a> </div>';
                            html += '<div class="product-action"> <a href="'+baseUrl+'products/'+data[i].id+'/'+data[i].slug+'" class="btn-product btn-quickview" title="Quick View">Quick View</a> </div> </figure>';
                            html += '<div class="product-details">';
                            html += '<h4 class="product-name"><a href="">'+data[i].minqty+'  '+data[i].unit+'</a></h4>';
                            html += '<h3 class="product-name"><a href="'+baseUrl+'products/'+data[i].id+'/'+data[i].slug+'">'+data[i].name+'</a></h3>';
                            html += '<div class="product-pa-wrapper">';
                            html += '<input type="hidden" name="quantity" id="'+data[i].id+'q" value="'+data[i].minqty+'">';
                            html += '<div class="product-price"> <ins class="new-price">'+data[i].discount_price+' Taka'+'</ins><del class="old-price">'+data[i].price+' Taka'+'</del> </div>';
                            html += '<div class="product-action">';
                            html += '<button type="submit" data-id="'+data[i].id+'" id="bg'+data[i].minqty+'" class="submit">Add To Cart</button> </div>';
                            html += '<div class="product-action"> <a href="'+baseUrl+'products/'+data[i].id+'/'+data[i].slug+'"class="submit">View Options</a> </div> </div> </div> </form> </div> </div>';
                        }
                        $('.productDiv').append(html);
                        $("#loadCounter").val(parseInt(parseInt(response.id)+1));
                    }
                });
            }
        });
    </script>
@endsection
