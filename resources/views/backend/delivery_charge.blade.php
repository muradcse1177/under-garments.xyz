@extends('backend.layout')
@section('title', ' Product Delivery Charge')
@section('page_header', 'Delivery Charge  Management')
@section('deliveryLiAdd','active')
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
                <div class="box-header with-border">
                    <h3 class="box-title addbut"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus-square"></i> Add New </button></h3>
                    <h3 class="box-title rembut" style="display:none;"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-minus-square"></i> Remove </button></h3>
                </div>
                <div class="divform" style="display:none">
                    {{ Form::open(array('url' => 'insertDeliveryCharge',  'method' => 'post')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Minimum Charge</label>
                            <input type="number"  class="form-control lower" id="lower"   name="lower" placeholder="Minimum Charge" required>
                        </div>
                        <div class="form-group">
                            <label for="">Maximum Charge</label>
                            <input type="number"  class="form-control higher" id="higher"   name="higher" placeholder="Maximum Charge" required>
                        </div>
                        <div class="form-group">
                            <label for="">Product Delivery Charge</label>
                            <input type="number"  class="form-control name" id="name"   name="name" placeholder="Product Delivery Charge" required>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" id="id" class="id">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Delivery Charge</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Maximum Charge</th>
                            <th>Minimum Charge</th>
                            <th>Tools</th>
                        </tr>
                        @foreach($delivery_charges as $delivery_charge)
                            <tr>
                                <td> {{ $delivery_charge->lower }} </td>
                                <td> {{ $delivery_charge->higher }} </td>
                                <td> {{ $delivery_charge->charge }} </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$delivery_charge->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(document).ready(function(){
                $(".addbut").click(function(){
                    $(".divform").show();
                    $(".rembut").show();
                    $(".addbut").hide();
                });
                $(".rembut").click(function(){
                    $(".divform").hide();
                    $(".addbut").show();
                    $(".rembut").hide();
                });

            });
        });
        $(function(){
            $(document).on('click', '.edit', function(e){
                e.preventDefault();
                $('.divform').show();
                var id = $(this).data('id');
                getRow(id);
            });
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getDeliveryCharge',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('#name').val(data.charge);
                    $('.id').val(data.id);
                    $('.lower').val(data.lower);
                    $('.higher').val(data.higher);
                }
            });
        }
    </script>
@endsection
