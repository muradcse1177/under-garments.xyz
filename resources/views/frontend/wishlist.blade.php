@extends('frontend.layout')
@section('title', 'Wish list || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('cart', 'active')
@section('css')
    <link rel='stylesheet' type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
@endsection
@section('content')
    <main class="main cart">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="{{url('wishlist')}}">Wishlist</a></li>
                    <li><a href="{{url('checkout')}}">Checkout</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
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
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <h2 style="text-align: center">Product List</h2>
                        <hr class="divider">
                        <table class="shop-table cart-table">
                            <thead>
                            <tr>
                                <th class="product-name"><span>Product</span></th>
                                <th></th>
                                <th class="product-price"><span>Price</span></th>
                                <th class="product-subtotal"><span>Subtotal</span></th>
                                <th class="product-subtotal"><span>Action</span></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <?php
                                        $url =url('/').'/';
                                        $image = (!empty($product->photo)) ? $url . $product->photo : $url . 'public/asset/no_image.jpg';
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{url('products/'.$product->product_id.'/'.$product->slug)}}">
                                                    <figure>
                                                        <img src="{{url($image)}}" alt="product"
                                                             width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button type="submit" data-id="{{$product->product_id}}" class="btn btn-close wishlist_delete"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{url('products/'.$product->product_id.'/'.$product->slug)}}">
                                               {{$product->name}}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">{{number_format($product->discount_price, 2)}}</span></td>
                                        <td class="product-subtotal">
                                            <span class="amount">{{number_format($product->discount_price, 2)}}</span>
                                        </td>
                                        <td class="product-subtotal">
                                            <button type="submit" data-id="{{$product->product_id}}" id="{{$product->product_id}}" class="btn btn-primary wToCart">
                                                <i class="w-icon-cart"></i><span>&nbsp; Add to Cart</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($count==0)
                                    <tr>
                                        <td class="product-subtotal" colspan="7" align="center">Wishlist empty</td>
                                    <tr>
                                @endif
                            </tbody>
                        </table>
                        @if($count>0)
                            <div class="cart-action mb-6">
                                <a href="{{url('shop')}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                <button type="submit" class="btn btn-rounded btn-danger btn-clear-wishlist" name="clear_cart" value="Clear Cart">Clear Wishlist</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->

@endsection
@section('js')
    <script>
        $(document).on('click', '.btn-clear-wishlist', function(e){
            e.preventDefault();
            var value = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ url('/') }}/clear_cart_wishlist',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "value": value
                },
                dataType: 'json',
                success: function(response){
                    if(!response.error){
                        $.toast({
                            heading: 'Thanks',
                            text: 'Wishlist Cleared Successfully!!',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: {
                                left: 0,
                                top: 300
                            },
                            stack: false
                        })
                        window.location.href = '{{ url('/') }}/homepage';
                    }
                }
            });
        });
        $(document).on('click', '.wishlist_delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                url: '{{ url('/') }}/wishlist_delete',
                dataType: 'json',
                success: function(response){
                    var msg= response.output;
                    if(!response.error){
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
                        window.location.href = '{{ url('/') }}/wishlist';
                    }
                }
            });
        });
    </script>
@endsection
