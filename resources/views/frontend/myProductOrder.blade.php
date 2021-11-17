@extends('frontend.layout')
@section('title', 'Profile || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('myOrder', 'active')
@section('css')
    <link rel='stylesheet' type="text/css" href="{{url('public/asset/customize.css')}}">
    <link rel='stylesheet' type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
    <style>
    </style>
@endsection
@section('content')
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header" style="margin-top: -1px;">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>
        <br>
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('homepage')}}">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content pt-2">
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
                <div class="tab tab-vertical row gutter-lg">
                    <ul class="nav nav-tabs mb-6" role="tablist">
                        <li class="nav-item">
                            <a href="#account-dashboard" class="nav-link active">Dashboard</a>
                        </li><hr>
                        <li class="nav-item">
                            <a href="#account-orders" class="nav-link">Orders</a>
                        </li><hr>
                        <li class="nav-item">
                            <a href="#account-addresses" class="nav-link">Addresses</a>
                        </li><hr>
                        <li class="nav-item">
                            <a href="#account-details" class="nav-link">Account details</a>
                        </li><hr>
                        <li class="nav-item">
                            <a href="#wishlist" class="nav-link">Wishlist</a>
                        </li><hr>
                        <li class="nav-item">
                            <a href="#comparelist" class="nav-link">Compare</a>
                        </li><hr>
                        <li class="nav-item">
                            <a href="{{url('logout')}}" class="nav-link">Logout</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-6">
                        <div class="tab-pane active in" id="account-dashboard">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-orders" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Orders</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-addresses" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-address">
                                                    <i class="w-icon-map-marker"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Addresses</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-details" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-account">
                                                    <i class="w-icon-user"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Account Details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#wishlist" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-wishlist">
                                                    <i class="w-icon-heart"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Wishlist</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#comparelist" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-compa">
                                                    <i class="w-icon-compare"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Compare</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="{{url('logout')}}">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Logout</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane mb-4" id="account-orders">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                </div>
                            </div>

                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th>Details</th>
                                    <th>Date</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tr>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><button type='button' class='btn btn-dark btn-rounded btn-icon-right transact' data-id='{{$order['sales_id']}}'><i class='fa fa-search'></i></button></td>
                                        <td>{{$order['sales_date']}}</td>
                                        <td>{{$order['id']}}</td>
                                        <td>{{$order['status']}}</td>
                                        <td> {{$order['amount'].'/-'}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" style="text-align: right"><b>Total</b></td>
                                    <td><b>{{$sum.'/-'}}</b></td>
                                </tr>
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                            <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane" id="account-addresses">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                                </div>
                            </div>
                            <p>The following addresses will be used on the checkout page
                                by default.</p>
                            <div class="row">
                                <div class="col-sm-12 mb-6">
                                    <div class="ecommerce-address billing-address pr-lg-8">
                                        <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                        {{ Form::open(array('url' => 'changeAddress',  'method' => 'post',  'class' => 'form account-details-form')) }}
                                        {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="text" id="address" name="address" value="{{@$users->address}}" class="form-control form-control-md">
                                            </div>
                                            <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="account-details">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                </div>
                            </div>
                            {{ Form::open(array('url' => 'updateProfile',  'method' => 'post',  'class' => 'form account-details-form')) }}
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{@$users->name}}" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Your email address *</label>
                                    <input type="text" class="form-control" name="email" value="{{@$users->email}}" id="email" required>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Phone Number *</label>
                                    <input type="text" class="form-control" name="phone" value="{{@$users->phone}}" id="phone" required>
                                </div>
                                <div class="form-group">
                                    <label>Address *</label>
                                    <input type="text" class="form-control" name="address" value="{{@$users->address}}" id="address" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Password *</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                            {{ Form::close() }}
                        </div>
                        <div class="tab-pane mb-4" id="wishlist">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Whislist</h4>
                                </div>
                            </div>
                            <table class="shop-table cart-table">
                                <thead>
                                <tr>
                                    <th class="product-name"><span>Product</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Price</span></th>
                                    <th class="product-subtotal"><span>Subtotal</span></th>
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
                                                <a href="{{url('product-by-id/'.$product->product_id)}}">
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
                                            <a href="{{url('product-by-id/'.$product->product_id)}}">
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
                            </table><br>
                            <a href="{{url('shop')}}" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane mb-4" id="comparelist">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Compare List</h4>
                                </div>
                            </div>
                            <table class="shop-table cart-table">
                                <thead>
                                <tr>
                                    <th class="product-name"><span>Product</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Price</span></th>
                                    <th class="product-subtotal"><span>Subtotal</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productsC as $product)
                                    <?php
                                    $url =url('/').'/';
                                    $image = (!empty($product->photo)) ? $url . $product->photo : $url . 'public/asset/no_image.jpg';
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{url('product-by-id/'.$product->product_id)}}">
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
                                            <a href="{{url('product-by-id/'.$product->product_id)}}">
                                                {{$product->name}}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">{{number_format($product->discount_price, 2)}}</span></td>
                                        <td class="product-subtotal">
                                            <span class="amount">{{number_format($product->discount_price, 2)}}</span>
                                        </td>
                                        <td class="product-subtotal">
                                            <button type="submit" data-id="{{$product->product_id}}" id="{{$product->product_id}}" class="btn btn-primary cToCart">
                                                <i class="w-icon-cart"></i><span>&nbsp; Add to Cart</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($countC==0)
                                    <tr>
                                        <td class="product-subtotal" colspan="7" align="center">Compare List empty</td>
                                    <tr>
                                @endif
                                </tbody>
                            </table><br>
                            <a href="{{url('shop')}}" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="transaction">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Order Details</b></h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Date: <span id="date"></span>
                            <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;Order Id: <span id="transid"></span></span>
                        </p>
                        <table class="shop-table account-orders-table mb-6">
                            <thead>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Total</th>
                            </thead>
                            <tbody id="detail">
                            <tr>
                                <td colspan="4" align="right"><b> Delivery Charge </b></td>
                                <td><span id="delivery"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><b> Discount </b></td>
                                <td><span id="discount"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><b> Gateway Charge </b></td>
                                <td><span id="gateway"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><b> Tax </b></td>
                                <td><span id="tax"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><b> Paid </b></td>
                                <td><span id="paid"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><b> Due </b></td>
                                <td><span id="due"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><b>Grand Total </b></td>
                                <td><span id="total"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <br>
@endsection
@section('js')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $(document).on('click', '.transact', function(e){
                e.preventDefault();
                $('#transaction').modal('show');
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: 'transaction',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    dataType: 'json',
                    success:function(response){
                        $('#date').html(response.data.date);
                        $('#transid').html(response.data.transaction);
                        $('#detail').prepend(response.data.list);
                        $('#total').html(response.data.total);
                        $('#delivery').html(response.data.delivery_charge);
                        $('#discount').html(response.data.discount);
                        $('#paid').html(response.data.paid);
                        $('#due').html(response.data.due);
                        $('#tax').html(response.data.tax);
                        $('#gateway').html(response.data.gateway);
                    }
                });
            });

            $("#transaction").on("hidden.bs.modal", function () {
                $('.prepend_items').remove();
            });
        });
    </script>
@endsection
