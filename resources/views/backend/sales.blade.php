@extends('backend.layout')
@section('title', 'Sales Report')
@section('page_header', 'Sales Report Management')
@section('salesLiAdd','active')
@section('content')

    @if ($message = Session::get('successMessage'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thank You!!</h4>
            {{ $message }}</b>
        </div>
    @endif
    @if ($message = Session::get('errorMessage'))

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Sorry!!</h4>
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="divform">
                    {{ Form::open(array('url' => 'getProductSalesOrderListByDate',  'method' => 'post')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">From Date</label>
                            <input type="text" class="form-control from_date" id="from_date"  name="from_date" placeholder="From Date " required value="@if(isset($from_date)){{$from_date}} @endif">
                        </div>
                        <div class="form-group">
                            <label for="">To Date</label>
                            <input type="text" class="form-control to_date" id="to_date"  name="to_date" placeholder="To Date " required value="@if(isset($to_date)){{$to_date}} @endif">
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" id="id" class="id">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Buyer Name</th>
                            <th>Buyer Phone</th>
                            <th>Address</th>
                            <th>Pay ID</th>
                            <th>Payment Method</th>
                            <th>Payment Number</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Discount</th>
                            <th>Gateway</th>
                            <th>Tax</th>
                            <th>Order Notes</th>
                            <th>Status</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                        </tr>
                        @foreach($orders as $order)
                          <tr>
                            <td>{{$order['id']}}</td>
                            <td>{{$order['sales_date']}}</td>
                            <td>{{$order['name']}}</td>
                            <td>{{$order['phone']}}</td>
                            <td>{{$order['address']}}</td>
                            <td>{{$order['pay_id']}}</td>
                            <td>{{$order['payment_method']}}</td>
                            <td>{{$order['payment_number']}}</td>
                            <td> {{$order['amount'].'/-'}}</td>
                              <td> {{$order['paid'].'/-'}}</td>
                              <td> {{$order['due'].'/-'}}</td>
                            <td> {{$order['discount'].'/-'}}</td>
                            <td> {{$order['gateway_charge'].'/-'}}</td>
                            <td> {{$order['tax'].'/-'}}</td>
                              <td> {{$order['order_notes']}}</td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control  status" name="status" style="width: 100%;" required>
                                        <option value="Received&{{$order['sales_id']}}" @if($order['status'] == 'Received'){{'Selected'}} @endif>Received</option>
                                        <option value="Processing&{{$order['sales_id']}}" @if($order['status'] == 'Processing'){{'Selected'}} @endif>Processing</option>
                                        <option value="Shipped&{{$order['sales_id']}}" @if($order['status'] == 'Shipped'){{'Selected'}} @endif>Shipped</option>
                                        <option value="Delivered&{{$order['sales_id']}}" @if($order['status'] == 'Delivered'){{'Selected'}} @endif>Delivered</option>
                                    </select>
                                </div>
                            </td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat transact' data-id='{{$order['sales_id']}}'><i class='fa fa-search'></i> Details</button></td>
                            <td><a href="{{url('printInvoice?salesId='.$order['sales_id'])}}"><button type='button' class='btn btn-success btn-sm btn-flat print' data-id='{{$order['sales_id']}}'><i class='fa fa-print'></i> Print</button></a></td>
                          </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" align="right"><b>Total</b></td>
                            <td ><b>{{$sum.'/-'}}</b> </td>
                            <td ><b>{{$paidSum.'/-'}}</b> </td>
                            <td ><b>{{$dueSum.'/-'}}</b> </td>
                            <td ><b>{{$discountSum.'/-'}}</b> </td>
                            <td ><b>{{$gatewaySum.'/-'}}</b> </td>
                            <td ><b>{{$taxSum.'/-'}}</b> </td>
                            <td colspan="3" align="right"></td>
                        </tr>
                    </table>
                    {{ $orders->links() }}
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
                    <h4 class="modal-title"><b>Order Details </b></h4>
                </div>
                <div class="modal-body">
                    <p>
                        Date: <span id="date"></span>
                        <span class="pull-right">Order ID: <span id="transid"></span></span>
                    </p>
                    <table class="table table-bordered">
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
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $( function() {
            $('#from_date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
        $( function() {
            $('#to_date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
        $(".status").change(function(){
            var id =$(this).val();
            $.ajax({
                type: 'GET',
                url: 'changeOrderStatus',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    location.reload();
                }
            });
        });
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
