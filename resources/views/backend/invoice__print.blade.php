<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Invoice</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="public/asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="public/asset/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="public/asset/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="public/asset/dist/css/AdminLTE.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body onload="window.print();">
        <div class="wrapper">
            <section class="invoice" id="printDiv">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <img src="{{url('public/logo.png')}}" height="70" width="150">
                            <small class="pull-right">Date: {{$order_details->created_at}}</small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Under-Garments.Xyz</strong><br>
                            Address: Banasree, C-Block, Rampura, Dhaka-1219<br>
                            Phone: +8801707011562<br>
                            Email: sales@Under-Garments.Xyz
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{$order_details->name}}</strong><br>
                            Address: {{$order_details->address}}<br>
                            Phone: {{$order_details->phone}}<br>
                            Email: {{$order_details->email}}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{$order_details->id}}</b><br>
                        <b>TX-ID:</b> {{$order_details->tx_id}}<br>
                        <b>Payment Type:</b> {{ucfirst($order_details->payment_method)}}<br>
                        <b>Payment No.:</b>{{$order_details->payment_number}}
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Discount</th>
                                    <th>Amount</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    $subTotal = 0;
                                ?>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{ucfirst($product->unit)}}</td>
                                        <td>{{number_format($product->discount,2).'/-'}}</td>
                                        <td>{{number_format($product->discount_price,2).'/-'}}</td>
                                        <td>{{number_format($product->discount_price*$product->quantity,2).'/-'}}</td>
                                    </tr>
                                    <?php
                                        $i++;
                                        $subTotal += $product->discount_price*$product->quantity;
                                    ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <b >Payment Methods:{{ucfirst($order_details->payment_method)}}</b>
                        @if(@$order_details->order_notes)
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                Order Notes:{{ucfirst($order_details->order_notes)}}
                            </p>
                        @endif
                    </div>
                    <div class="col-xs-2">

                    </div>
                    <div class="col-xs-4">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>{{number_format($subTotal,2).'/-'}}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td>{{number_format($order_details->delivery_charge,2).'/-'}}</td>
                                </tr>
                                <tr>
                                    <th>G.Charge:</th>
                                    <td>{{number_format($order_details->gateway_charge,2).'/-'}}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{number_format($order_details->discount,2).'/-'}}</td>
                                </tr>
                                <tr>
                                    <th>Paid</th>
                                    <td>{{number_format($order_details->paid,2).'/-'}}</td>
                                </tr>
                                <tr>
                                    <th>Due</th>
                                    <td>{{number_format($order_details->due,2).'/-'}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>{{number_format($order_details->total,2).'/-'}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align: center;">
                            Invoice made by <b>Under-Garments.Xyz</b>.&copy; Under-Garments.xyz,{{Date('Y')}}. Helpline:+8801707011562.
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
