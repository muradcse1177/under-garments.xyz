@extends('frontend.layout')
@section('title', 'Checkout || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('checkout', 'active')
@section('css')
    <link rel='stylesheet' type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
    <style>
        .addDiv{
            margin-top: 10px;
        }
        .befAddDiv{
            margin-bottom: 10px;
        }
        @media screen and (max-width: 600px) {
            .checkout {
                margin-bottom: -10px;
            }
        }
    </style>
@endsection
@section('content')
    <main class="main checkout">
        <!-- Start of Breadcrumb -->
        <div class="row">
        </div>
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="{{url('cart')}}">Shopping Cart</a></li>
                    <li class="active"><a href="{{url('checkout')}}">Checkout</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->


        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <hr class="divider">
                <div class="row">
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
                </div>
                @if(!Cookie::get('user_id'))
                    <input type="hidden" id="sample" name="sample" value="3">
                <div class="login-toggle">
                    Returning customer? <a href="#"
                                           class="show-login font-weight-bold text-uppercase text-dark">Login</a>
                </div>
                    {{ Form::open(array('url' => 'verifyUserFromCheckout',  'method' => 'post','class' =>'login-content')) }}
                    {{ csrf_field() }}
                        <p>If you have shopped with us before, please enter your details below.
                            If you are a new customer, please proceed to the Billing section.</p>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Email/Phone *</label>
                                    <input type="text" class="form-control form-control-md" name="phone" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" class="form-control form-control-md" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
                            <label for="remember" class="mb-0 lh-2">Remember me</label>
                            <a href="{{url('forgotPasswordLink')}}" class="ml-3">Lost your password?</a>
                        </div>
                        <button class="btn btn-rounded btn-login" type="submit" value="login"  name="login">Login</button>
                    {{ Form::close() }}
                @endif
                @if($count > 0)
                {{ Form::open(array('url' => 'couponCheck',  'method' => 'post'))}}
                {{ csrf_field() }}
                    <div class="coupon-toggle">
                        Have a coupon? <a href="#"
                                          class="show-coupon font-weight-bold text-uppercase text-dark">Enter your
                            code</a>
                    </div>
                    <div class="coupon-content mb-4">
                        <p>If you have a coupon code, please apply it below.</p>
                        <div class="input-wrapper-inline">
                            <input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2" placeholder="Coupon code" id="coupon_code" required>
                            <button type="submit" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon" value="Apply coupon">Apply Coupon</button>
                        </div>
                    </div>
                {{ Form::close() }}
                @endif
                {{ Form::open(array('url' => 'sales',  'method' => 'post')) }}
                {{ csrf_field() }}
                    <div class="row mb-9">
                        <div class="col-lg-7 pr-lg-4 mb-4">
                            <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                Billing Details
                            </h3>
                            @if(Cookie::get('user_id'))
                            <div class="form-group mt-3">
                                <label for="order-notes">Login Address</label>
                                <div style="border-style: solid; border-color: #d9d7d6; margin-bottom: 10px;">
                                    <div class="befAddDiv" style="margin-left: 15px;">
                                        <?php
                                        ?>
                                        <div class="addDiv"> {{'Name'}} : {{$user->name}}</div>
                                        <div class="addDiv"> {{'Phone'}} : {{$user->phone}}</div>
                                        <div class="addDiv"> {{'Email'}} : {{$user->email}}</div>
                                        <div class="addDiv">{{'Address'}} : {{$user->address}}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(Cookie::get('user_id'))
                                <div class="form-check">
                                    <input class="form-check-input aaa" name="dif_add" type="checkbox" value="dif_add" id="ddd">
                                    <label class="form-check-label" for="ddd">
                                        Ship to a different address?
                                    </label>
                                </div><br>
                            @endif
                            <?php
                                if(!Cookie::get('user_id'))
                                      $class = '';
                                else
                                    $class = 'checkbox-content';
                            ?>
                            <div class="{{$class}}">
                                <div class="form-group">
                                    <input type="text" class="form-control name" name="name" placeholder="Enter Name"  required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control email" name="eeemail" placeholder="Enter Email"  required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control password" name="password" placeholder="Enter Password"  required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control phone" name="phone" placeholder="Enter Phone" pattern="\+?(88)?0?1[3456789][0-9]{8}\b"  required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control address" name="address" placeholder="Address"  required>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <textarea class="form-control mb-0" id="order-notes" name="order_notes" cols="30"
                                          rows="4"
                                          placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                            <div class="order-summary-wrapper sticky-sidebar">
                                <h3 class="title text-uppercase ls-10">Your Order</h3>
                                <div class="order-summary">
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <b>Product</b>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($output as $p)
                                                <tr class="bb-no">
                                                    <td class="product-name">{{$p[0]}} <i
                                                            class="fas fa-times"></i> <span
                                                            class="product-quantity">{{$p[2]}}</span></td>
                                                    <td class="product-total">{{$p[1].' Taka'}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <td>
                                                    <b>Subtotal</b>
                                                </td>
                                                <td>
                                                    <b>{{$total['s_total'].' Taka'}}</b>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>
                                                    <b>Shipping</b>
                                                </th>
                                                <td>
                                                    <b>{{$total['delivery'].' Taka'}}</b>
                                                </td>
                                            </tr>
                                            @if(@$total['g_discount'])
                                            <tr class="order-total">
                                                <th>
                                                    <b>Discount</b>
                                                </th>
                                                <td>
                                                    <b>{{$total['g_discount'].' Taka'}}</b>
                                                </td>
                                            </tr>
                                            @endif
                                            @if(@$total['g_total'])
                                            <tr class="order-total">
                                                <th>
                                                    <b>Gateway Fees</b>
                                                </th>
                                                <td>
                                                    <b>{{.02*$total['g_total'].' Taka'}}</b>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr class="order-total">
                                                <th>
                                                    <b>Total</b>
                                                </th>
                                                <td>
                                                    <b class="g_total_ch">{{$total['g_total'] +.02*$total['g_total'].' Taka'}}</b>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="d_address" id="d_address1" value="Inside Dhaka" checked>
                                                <label class="form-check-label" for="d_address1">
                                                  Inside Dhaka
                                                </label>&nbsp;&nbsp;
                                                <input class="form-check-input" type="radio" name="d_address" id="d_address2" value="Outside Dhaka">
                                                <label class="form-check-label" for="d_address2">
                                                    Outside Dhaka
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if($count > 0)
                                    <div class="payment-methods" id="payment_method">
                                        <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                        <div class="accordion payment-accordion">
                                            <div class="card">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a href="#bkash-payment" class="collapse online"><img src="{{url('public/bkash.png')}}" style="width: 80px; height: 35px;"/></a>
                                                    </div>
                                                    <div id="bkash-payment" class="card-body expanded">
                                                        <div>
                                                            <p style="text-align: justify;">Please complete your Bkash Payment at first, then fill up the form below.<br>
                                                                Total amount you need to send us at <b> = {{ $total['g_total'] + .02*$total['g_total']}}/-</b><br>
                                                                Bkash Personal Number : <b> 01929877307</b> </p>
                                                            <input type="hidden"  name="bkash" id="bkash" value="">
                                                            <input type="text"  name="phone1" id="phone1" class="phone1 form-control" placeholder="Please Enter Your Phone No." required>
                                                            <input type="text"  name="bkashTx" id="bkashTx" class="bkashTx form-control" placeholder="Please Enter Transaction ID" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a href="#rocket-payment" class="expand cash"><img src="{{url('public/rocket.png')}}" style="width: 80px; height: 35px;"/></a>
                                                    </div>
                                                    <div id="rocket-payment" class="card-body collapsed">
                                                        <div>
                                                            <p style="text-align: justify;">Please complete your Rocket Payment at first, then fill up the form below.<br>
                                                                Total amount you need to send us at <b> = {{ $total['g_total'] + .02*$total['g_total']}}/-</b><br>
                                                                Rocket Personal Number : <b> 01929877307</b> </p>
                                                            <input type="hidden"  name="rocket" id="rocket" value="">
                                                            <input type="text"  name="phone2" id="phone2" class="phone2 form-control" placeholder="Please Enter Your Phone No.">
                                                            <input type="text"  name="rocketTx" id="rocketTx" class="rocketTx form-control" placeholder="Please Enter Transaction ID">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a href="#nagad-payment" class="expand bank"><img src="{{url('public/nagad.png')}}" style="width: 80px; height: 35px;"/></a>
                                                    </div>
                                                    <div id="nagad-payment" class="card-body collapsed bank">
                                                        <div>
                                                            <p style="text-align: justify;">Please complete your Nagad Payment at first, then fill up the form below.<br>
                                                                Total amount you need to send us at <b> = {{ $total['g_total'] + .02*$total['g_total']}}/-</b><br>
                                                                Nagad Personal Number : <b> 01929877307</b> </p>
                                                            <input type="hidden"  name="nagad" id="nagad" value="">
                                                            <input type="text"  name="phone3" id="phone3" class="phone3 form-control" placeholder="Please Enter Your Phone No.">
                                                            <input type="text"  name="nagadTx" id="nagadTx" class="nagadTx form-control" placeholder="Please Enter Transaction ID">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group place-order pt-6">
                                        <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
@endsection
@section('js')

    <script>
        $("#bkash-payment").click(function(){
            $("#bkash").val('Bkash');
            $("#rocket").val("");
            $("#nagad").val("");
            $("#phone1").prop('required',true);
            $("#bkashTx").prop('required',true);
            $("#phone2").prop('required',false);
            $("#rocketTx").prop('required',false);
            $("#phone3").prop('required',false);
            $("#nagadTx").prop('required',false);
        });
        $("#rocket-payment").click(function(){
            $("#bkash").val("");
            $("#rocket").val('Rocket');
            $("#nagad").val("");
            $("#phone2").prop('required',true);
            $("#rocketTx").prop('required',true);
            $("#phone1").prop('required',false);
            $("#bkashTx").prop('required',false);
            $("#phone3").prop('required',false);
            $("#nagadTx").prop('required',false);
        });
        $("#nagad-payment").click(function(){
            $("#bkash").val("");
            $("#rocket").val("");
            $("#nagad").val("Nagad");
            $("#phone3").prop('required',true);
            $("#nagadTx").prop('required',true);
            $("#phone1").prop('required',false);
            $("#bkashTx").prop('required',false);
            $("#phone2").prop('required',false);
            $("#rocketTx").prop('required',false);
        });
        $(".aaa").click(function(){
            if($("#ddd").prop('checked') == true){
                $(".checkbox-content").show();
                $('.name').prop('required',true);
                $('.email').prop('required',true);
                $('.phone').prop('required',true);
                $('.password').prop('required',true);
                $('.address').prop('required',true);
            }
            else{
                $(".checkbox-content").hide();
                $('.name').prop('required',false);
                $('.email').prop('required',false);
                $('.phone').prop('required',false);
                $('.password').prop('required',false);
                $('.address').prop('required',false);
            }
        });
        if($("#sample").val() == 3){
            $('.name').prop('required',true);
            $('.email').prop('required',true);
            $('.phone').prop('required',true);
            $('.password').prop('required',true);
            $('.address').prop('required',true);
        }
        else{
            $('.name').prop('required',false);
            $('.email').prop('required',false);
            $('.phone').prop('required',false);
            $('.address').prop('required',false);
            $('.password').prop('required',false);
        }
    </script>
@endsection
