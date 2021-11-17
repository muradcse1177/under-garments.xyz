@extends('backend.layout')
@section('title', 'POS Sale Management')
@section('page_header', 'POS Sale Management')
@section('posSale','active')
@section('posSaleBar','sidebar-collapse')
@section('extracss')
    <style>
        .alnright { text-align: right; }
    </style>
@endsection
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
            <h4><i class="icon fa fa-warning"></i> Sorry!</h4>
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Sale</h3>
                </div>
                <div class="box-body">
                    {{ Form::open(array('url' => 'insertPOSSale',  'method' => 'post')) }}
                    {{ csrf_field() }}
                    <div class="form-group col-sm-4">
                        <label for="">Customer Name</label>
                        <input type="text"  class="form-control name" id="name" name="name" placeholder="Customer Name" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Payment Type</label>
                        <select class="form-control select2 payment_type" name="payment_type" style="width: 100%;" required>
                            <option value="" selected> Select Payment Type</option>
                            <option value="cash">Cash Payment</option>
                            <option value="bank">Bank Payment</option>
                            <option value="bkash">Bkash Payment</option>
                            <option value="rocket">Rocket Payment</option>
                            <option value="nagad">Nagad Payment</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Date</label>
                        <input type="text"  class="form-control date" id="date" name="date" value="{{Date('Y-m-d')}}" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Customer Phone</label>
                        <input type="tel"  class="form-control phone" id="phone" name="phone" placeholder="Customer Phone" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Customer Email</label>
                        <input type="email"  class="form-control email" id="email" name="email" placeholder="Customer Email" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Customer Address</label>
                        <input type="text"  class="form-control address" id="address" name="address" placeholder="Customer address" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Order Notes</label>
                        <textarea  class="form-control notes" id="notes" rows="4" name="notes" placeholder="Order Notes"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text"  class="form-control p_name" id="p_name" name="p_name" placeholder="Write Product Name/ID">
                            </div>
                            <div class="productDiv" id="productDiv">
                                @foreach($products as $product)
                                    <div class="col-sm-2 productClass"  data-id="{{$product->id}}" id="{{$product->id}}" style="border: 2px solid darkgreen; margin: 5px 5px 5px 5px;border-radius: 25px;">
                                        <div class="product-panel">
                                            <div class="item-image position-relative overflow-hidden">
                                                <img src="{{url($product->photo)}}"  alt="" class="img-responsive" style="margin-top: 10px;">
                                            </div>
                                            <div class="panel-footer border-0 bg-white" style="margin-bottom: 5px;">
                                                <p style="text-align: center;"><b>{{$product->id}}</b></p>
                                                <p style="text-align: center;"><b>{{$product->name}}</b></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered posTable">
                                <tr>
                                    <th>Item Information * </th>
                                    <th>Unit * </th>
                                    <th>Quantity  * </th>
                                    <th>Price </th>
                                    <th>Discount % </th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                <tbody class="posRow" id="posRow">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="5"> <b>Sale Discount:</b></td>
                                        <td class="text-right" > <input class="form-control alnright sale_discount" type="number" name="sale_discount" min="0" value="0"></td>
                                        <td class="td-actions text-center" colspan="2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5"> <b>Total Tax:</b></td>
                                        <td class="text-right" > <input class="form-control alnright total_tax" type="number" name="total_tax" min="0" value="0"></td>
                                        <td class="td-actions text-center" colspan="2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5"> <b>Shipping Cost:</b></td>
                                        <td class="text-right" > <input class="form-control alnright shipping_cost" type="number" name="shipping_cost" min="0" value="0"></td>
                                        <td class="td-actions text-center" colspan="2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5"> <b>Grand Total:</b></td>
                                        <td class="text-right" > <input class="form-control alnright g_total" type="number" min="1" name="g_total" value="0" readonly></td>
                                        <td class="td-actions text-center" colspan="2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5"> <b>Paid Amount:</b></td>
                                        <td class="text-right" > <input class="form-control alnright paid_amount" type="number" name="paid_amount" min="0" value="0"></td>
                                        <td class="td-actions text-center" colspan="2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" ><button type="submit" class="btn btn-success btn-flat">Save Sale</button></td>
                                        <td class="text-right" colspan="4"> <b>Due Amount:</b></td>
                                        <td class="text-right" > <input class="form-control alnright due_amount" type="number" name="due_amount" min="0" value="0" readonly></td>
                                        <td class="td-actions text-center" colspan="2">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'></script>
    <script>
        $('.select2').select2();
        const id_array = [];
        $( function() {
            $('#date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
        $(function(){
            $(document).on('click', '.productClass', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                if(id_array.includes(id)){
                    $('#p_quantity'+id).val(parseInt($('#p_quantity'+id).val())+1);
                    var q_val = parseInt($('#p_quantity'+id).val());
                    var p_val = $('#p_price'+id).val();
                    var d_val = $('#p_discount'+id).val();
                    var p_val_new = p_val*q_val-p_val*q_val*(d_val/100);
                    $('#p_total_price'+id).val(p_val_new);
                    var total = 0;
                    for (var i=0; i<id_array.length;i++){
                        total = parseInt(total) + parseInt($('#p_total_price'+id_array[i]).val());
                    }
                    total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
                    $('.g_total').val(total);
                    var paid_amount = $('.paid_amount').val();
                    $('.due_amount').val(total-parseInt(paid_amount));
                }
                else{
                    id_array.push(id);
                    $.cookie("c_p_id", id_array);
                    $.ajax({
                        type: 'GET',
                        url: '{{url('/')}}/getPOSProductAdd',
                        data: {val:id},
                        dataType: 'json',
                        success: function(response){
                            var products = response.data;
                            var html = '';
                            html += '<tr class="inputFormRow">';
                            html += '<td> <input class="form-control p_name" id="p_name'+products.id+'" data-id="'+products.id+'" name="product_name[]" value="'+products.name+'" placeholder="Write Product Name/ID" readonly>' +
                                '<input class="form-control p_id" id="p_id'+products.id+'" type="hidden" value="'+products.id+'" name="p_id[]"> </td>';
                            html += '<td class="text-right"> <input class="form-control alnright p_unit" name="p_unit[]" id="p_unit'+products.id+'" value="'+products.unit+'" readonly ></td>';
                            html += '<td class="text-right"> <input class="form-control alnright p_quantity" type="number" min="0" data-id="p_quantity-'+products.id+'" name="p_quantity[]" id="p_quantity'+products.id+'" value="'+products.minqty+'" required></td>';
                            html += '<td class="text-right"> <input class="form-control alnright p_price" type="number" name="p_price[]" id="p_price'+products.id+'" value="'+products.discount_price+'" readonly><input type="hidden" id=""></td>';
                            html += '<td class="text-right"> <input class="form-control alnright p_discount" type="number" min="0" data-id="p_discount-'+products.id+'" name="p_discount[]" id="p_discount'+products.id+'" value="0" required></td>';
                            html += '<td class="text-right"> <input class="form-control alnright p_total_price" type="number" name="p_total_price[]" id="p_total_price'+products.id+'" value="'+products.discount_price+'" readonly></td>';
                            html += '<td class="td-actions text-center"> <button type="button" rel="tooltip" class="btn btn-danger remove" id="rem'+products.id+'" data-id="'+products.id+'"> <i class="fa fa-times"></i> </button>' +
                                ' <td class="td-actions text-center"><a href="product-by-id/'+products.id+'" target="_blank"> <button type="button" rel="tooltip" id="addMore" class="btn btn-success" data-id=""> <i class="fa fa-eye"></i> </button></a> </td></td>';
                            html += '<tr>';
                            $('#posRow').append(html);
                            var total = 0;
                            for (var i=0; i<id_array.length;i++){
                                total = parseInt(total) + parseInt($('#p_total_price'+id_array[i]).val());
                            }
                            total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
                            $('.g_total').val(total);
                            var paid_amount = $('.paid_amount').val();
                            $('.due_amount').val(total-parseInt(paid_amount));
                        }
                    });
                }
            });
        });
        $(document).on('click', '.remove', function () {
            $(this).closest('.inputFormRow').remove();
            var id = $(this).data('id');
            var total = 0;
            const index = id_array.indexOf(id);
            if (index > -1) {
                id_array.splice(index, 1);
            }
            for (var i=0; i<id_array.length;i++){
                total = parseInt(total) + parseInt($('#p_total_price'+id_array[i]).val());
            }
            total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
            $('.g_total').val(total);
            var paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total-parseInt(paid_amount));
        });
        $(".p_name").keyup(function(){
            var val = $('.p_name').val();
            $.ajax({
                type: 'GET',
                url: '{{url('/')}}/getPOSProductSearch',
                data: {val:val},
                dataType: 'json',
                success: function(response){
                    var products = response.data;
                    var div = '';
                    for (var i=0; i<products.length; i++){
                        div += '<div class="col-sm-2 productClass" id="'+products[i].id+'" data-id="'+products[i].id+'"style="border: 2px solid darkgreen; margin: 5px 5px 5px 5px;border-radius: 25px;">';
                        div += '<div class="product-panel">';
                        div += '<div class="item-image position-relative overflow-hidden">';
                        div += '<img src="'+products[i].photo+'"  alt="" class="img-responsive" style="margin-top: 10px;">';
                        div += ' </div>';
                        div += '<div class="panel-footer border-0 bg-white" style="margin-bottom: 5px;">';
                        div += ' <p style="text-align: center;"><b>'+products[i].id+'</b></p>';
                        div += ' <p style="text-align: center;"><b>'+products[i].name+'</b></p>';
                        div += '</div></div></div>';
                    }
                    $("#productDiv").html(div);
                }
            });
        });
        $(document).on('change', 'input', function() {
            var dataID = $(this).data('id');
            var dataIDArray = dataID.split('-');
            var id = dataIDArray[1];
            if(dataIDArray[0] == 'p_quantity'){
                var q_val = $('#p_quantity'+id).val();
                var p_val = $('#p_price'+id).val();
                var d_val = $('#p_discount'+id).val();
                var p_val_new = p_val*q_val-p_val*q_val*(d_val/100);
                $('#p_total_price'+id).val(p_val_new);
                var total = 0;
                for (var i=0; i<id_array.length;i++){
                    total = parseInt(total) +  parseInt($('#p_total_price'+id_array[i]).val());
                }
                total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
                $('.g_total').val(total);
                var paid_amount = $('.paid_amount').val();
                $('.due_amount').val(total-parseInt(paid_amount));
            }
            if(dataIDArray[0] == 'p_discount'){
                var q_val = $('#p_quantity'+id).val();
                var p_val = $('#p_price'+id).val();
                var d_val = $('#p_discount'+id).val();
                var p_val_new = p_val*q_val-p_val*q_val*(d_val/100);
                $('#p_total_price'+id).val(p_val_new);
                var total = 0;
                for (var i=0; i<id_array.length;i++){
                    total = parseInt(total) +  parseInt($('#p_total_price'+id_array[i]).val());
                }
                total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
                $('.g_total').val(total);
                var paid_amount = $('.paid_amount').val();
                $('.due_amount').val(total-parseInt(paid_amount));
            }

        });
        $(".sale_discount").keyup(function(){
            var total = 0;
            for (var i=0; i<id_array.length;i++){
                total = parseInt(total) +  parseInt($('#p_total_price'+id_array[i]).val());
            }
            total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
            $('.g_total').val(total);
            var paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total-parseInt(paid_amount));
         });
        $(".total_tax").keyup(function(){
            var total = 0;
            for (var i=0; i<id_array.length;i++){
                total = parseInt(total) +  parseInt($('#p_total_price'+id_array[i]).val());
            }
            total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
            $('.g_total').val(total);
            var paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total-parseInt(paid_amount));
         });
        $(".shipping_cost").keyup(function(){
            var total = 0;
            for (var i=0; i<id_array.length;i++){
                total = parseInt(total) +  parseInt($('#p_total_price'+id_array[i]).val());
            }
            total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val());
            $('.g_total').val(total);
            var paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total-parseInt(paid_amount));
         });
        $(".paid_amount").keyup(function(){
            var total = 0;
            for (var i=0; i<id_array.length;i++){
                total = parseInt(total) +  parseInt($('#p_total_price'+id_array[i]).val());
            }
            total = total - parseInt($('.sale_discount').val()) + parseInt($('.total_tax').val()) + parseInt($('.shipping_cost').val()) ;
            var paid_amount = $('.paid_amount').val();
            $('.due_amount').val(total-parseInt(paid_amount));
         });
    </script>
@endsection
