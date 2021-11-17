@extends('frontend.layout')
@section('title', 'Home || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('home', 'active')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo1.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
    <style>
        .submit {
            background-color: #00BAA3;
            border: none;
            color: white;
            padding: 4px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <!-- Start of Main-->
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
                        <div class="banner banner-fixed intro-slide intro-slide{{$i}} br-sm" style="background-image: url({{'public/asset/images/'.$ph->slide}}); background-color: #262729;"></div>
                            <?php
                            $i++;
                            ?>
                    @endforeach
                </div>
            </div>
        </diV>
        <section class="category-ellipse-section services" style="background-color: #f3f3f3;"><br><br>
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
            </div><br>
        </section>
        <div class="container">
            <div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1icon-box-wrapper appear-animate br-sm mt-6 mb-6"
                 data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'loop': false,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
                <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                        <p class="text-default">For all orders over (Conditional)</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side icon-box-primary">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                        <p class="text-default">We ensure secure payment</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side icon-box-primary icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                        <p class="text-default">Any back within 30 days</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side icon-box-primary icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                        <p class="text-default">Call or email us 24/7</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php
                foreach ($pro_categories as $category){
            ?>
            <div class="product-wrapper-1 appear-animate mb-5">
                <div class="title-link-wrapper pb-1 mb-4" style="background-color: #00BAA3;">
                    <h2 class="title ls-normal mb-0 catHeader">{{$category->name}}</h2>
                    <a href="{{url('shop-by-cat/'.$category->id)}}" class="font-size-normal font-weight-bold ls-25 mb-0 catHeaderSee">See More<i class="w-icon-long-arrow-right"></i></a>
                </div>
                <?php
                    $products= DB::table('products')
                        ->where('cat_id', $category->id)
                        ->where('status', 1)
                        ->inRandomOrder()->take(15)->get();
                ?>
                <div class="owl-carousel owl-theme product-wrapper row cols-md-5 cols-sm-2 cols-2" data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 2
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '992': {
                                        'items': 3
                                    },
                                    '1200': {
                                        'items': 5
                                    }
                                }
                            }">
                    @foreach($products as $product)
                        <div class="product-wrap">
                            <div class="product product-simple text-center">
                                <form class="form-inline" id="{{$product->id.'productForm'}}">
                                    <figure class="product-media">
                                        <a href="{{url('product-by-id/'.$product->id)}}">
                                            <img src="{{$product->photo}}" alt="Product"
                                                 width="330" height="338" />
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart wishlistProduct"
                                               title="Add to wishlist" data-id="{{$product->id}}" id="{{'wish'.$product->id}}"></a>
                                            <a href="#" class="btn-product-icon btn-compare w-icon-compare compareProduct"
                                               title="Add to Compare" data-id="{{$product->id}}" id="{{'com'.$product->id}}"></a>
                                        </div>
                                        <div class="product-action">
                                            <a href="{{url('product-by-id/'.$product->id)}}" class="btn-product btn-quickview" title="Quick View">Quick
                                                View</a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name">
                                            <a href="">{{$product->unit}}</a>
                                        </h4>
                                        <h3 class="product-name">
                                            <a href="{{url('product-by-id/'.$product->id)}}">{{$product->name}}</a>
                                        </h3>
                                        <div class="product-pa-wrapper">
                                            <input type="hidden" name="quantity" id="{{$product->id.'q'}}" value="{{$product->minqty}}">
                                            <div class="product-price">
                                                <ins class="new-price">{{$product->discount_price.' Taka'}}</ins><del class="old-price">{{$product->price.' Taka'}}</del>
                                            </div>
                                            <div class="product-action">
                                                <button type="submit" data-id="{{$product->id}}" id="{{'bg'.$product->id}}" class="submit">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <?php } ?>
        </div>
    </main>
@endsection
@section('js')
@endsection
