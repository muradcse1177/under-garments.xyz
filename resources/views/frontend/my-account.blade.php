@extends('frontend.layout')
@section('title', 'Profile || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('myOrder', 'active')
@section('css')
    <link rel='stylesheet' type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
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
                    <li><a href="demo1.html">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content pt-2">
            <div class="container">
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
                                    <a href="wishlist.html" class="link-to-tab">
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
                                    <a href="wishlist.html" class="link-to-tab">
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
                                    <a href="#">
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
                                    <th>Order No</th>
                                    <th>Status</th>
                                    <th>Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tr>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><button type='button' class='btn btn-secondary btn-sm btn-flat transact' data-id='{{$order['sales_id']}}'><i class='fa fa-search'></i> Details</button></td>
                                        <td>{{$order['sales_date']}}</td>
                                        <td>{{$order['pay_id']}}</td>
                                        <td><button type='button' class='btn btn-success btn-sm btn-flat u_search' data-id='{{$order['user_id']}}'>{{$order['status']}} </button></td>
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

                        <div class="tab-pane" id="account-downloads">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-downloads mr-2">
                                        <i class="w-icon-download"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title ls-normal">Downloads</h4>
                                </div>
                            </div>
                            <p class="mb-4">No downloads available yet.</p>
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
                                <div class="col-sm-6 mb-6">
                                    <div class="ecommerce-address billing-address pr-lg-8">
                                        <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <th>Company:</th>
                                                    <td>Conia</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>Wall Street</td>
                                                </tr>
                                                <tr>
                                                    <th>City:</th>
                                                    <td>California</td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td>United States (US)</td>
                                                </tr>
                                                <tr>
                                                    <th>Postcode:</th>
                                                    <td>92020</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>1112223334</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                        <a href="#"
                                           class="btn btn-link btn-underline btn-icon-right text-primary">Edit
                                            your billing address<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-6">
                                    <div class="ecommerce-address shipping-address pr-lg-8">
                                        <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>John Doe</td>
                                                </tr>
                                                <tr>
                                                    <th>Company:</th>
                                                    <td>Conia</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>Wall Street</td>
                                                </tr>
                                                <tr>
                                                    <th>City:</th>
                                                    <td>California</td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td>United States (US)</td>
                                                </tr>
                                                <tr>
                                                    <th>Postcode:</th>
                                                    <td>92020</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                        <a href="#"
                                           class="btn btn-link btn-underline btn-icon-right text-primary">Edit your
                                            shipping address<i class="w-icon-long-arrow-right"></i></a>
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
                            <form class="form account-details-form" action="#" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First name *</label>
                                            <input type="text" id="firstname" name="firstname" placeholder="John"
                                                   class="form-control form-control-md">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last name *</label>
                                            <input type="text" id="lastname" name="lastname" placeholder="Doe"
                                                   class="form-control form-control-md">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="display-name">Display name *</label>
                                    <input type="text" id="display-name" name="display_name" placeholder="John Doe"
                                           class="form-control form-control-md mb-0">
                                    <p>This will be how your name will be displayed in the account section and in reviews</p>
                                </div>

                                <div class="form-group mb-6">
                                    <label for="email_1">Email address *</label>
                                    <input type="email" id="email_1" name="email_1"
                                           class="form-control form-control-md">
                                </div>

                                <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                <div class="form-group">
                                    <label class="text-dark" for="cur-password">Current Password leave blank to leave unchanged</label>
                                    <input type="password" class="form-control form-control-md"
                                           id="cur-password" name="cur_password">
                                </div>
                                <div class="form-group">
                                    <label class="text-dark" for="new-password">New Password leave blank to leave unchanged</label>
                                    <input type="password" class="form-control form-control-md"
                                           id="new-password" name="new_password">
                                </div>
                                <div class="form-group mb-10">
                                    <label class="text-dark" for="conf-password">Confirm Password</label>
                                    <input type="password" class="form-control form-control-md"
                                           id="conf-password" name="conf_password">
                                </div>
                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                            </form>
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
                            <span class="pull-right">&nbsp;&nbsp;;&nbsp;;&nbsp;Order Id: <span id="transid"></span></span>
                        </p>
                        <table class="table table-bordered">
                            <thead>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Total</th>
                            </thead>
                            <tbody id="detail">
                            <tr>
                                <td colspan="3" align="right"><b> Delivery Charge</b></td>
                                <td><span id="delivery"></span></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><b> Delivery Charge</b></td>
                                <td><span id="discount"></span></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><b>Grand Total </b></td>
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
                        $('#discount').html(response.data.discount);
                        $('#delivery').html(response.data.delivery_charge);
                    }
                });
            });

            $("#transaction").on("hidden.bs.modal", function () {
                $('.prepend_items').remove();
            });
        });
    </script>
@endsection
