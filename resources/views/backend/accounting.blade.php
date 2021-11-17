@extends('backend.layout')
@section('title','Accounting')
@section('page_header', 'Accounting Management')
@section('accountingLiAdd','active')
@section('content')
@section('extracss')
    <style>
        .allButton{
            background-color: darkgreen;
            margin-top: 10px;
            color: white;
        }
        .medicine_text{
            color: darkgreen;
            font-size: 20px;
        }
    </style>
@endsection
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
                    <h3 class="box-title rembut2" ><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-eye"></i> Report </button></h3>
                    <h3 class="box-title" ><a href="{{url('accountName')}}" target="_blank" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus-square"></i> Accounting Name </a></h3>
                    <h3 class="box-title" ><a href="{{url('accountHead')}}" target="_blank" type="button" class="btn btn-block btn-success btn-flat"> <i class="fa fa-plus-square"></i> Accounting Head </a></h3>
                </div>
                <div class="divform" style="display:none">
                    {{ Form::open(array('url' => 'insertAccounting',  'method' => 'post')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Accounting Name</label>
                            <select class="form-control select2 name_id" name="name_id" style="width: 100%;" required>
                                <option value="" selected>Select Accounting</option>
                                @foreach($names as $a)
                                    <option value="{{$a->id}}">{{$a->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Head Name</label>
                            <select class="form-control select2 head_id" name="head_id" style="width: 100%;" required>
                                <option value="" selected> Select Head Name </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Accounting Type</label>
                            <select class="form-control select2 type" name="type" style="width: 100%;" required>
                                <option value="" selected>Select Accounting Type</option>
                                <option value="Cash In" >Cash In</option>
                                <option value="Cash Out" >Cash Out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="text" class="form-control date" id="date"  name="date" placeholder="Date" required>
                        </div>
                        <div class="form-group">
                            <label for="">Purpose</label>
                            <input type="text" class="form-control purpose" id="purpose"  name="purpose" placeholder="Purpose" required>
                        </div>
                        <div class="form-group">
                            <label for="">Person</label>
                            <input type="text" class="form-control person" id="person"  name="person" placeholder="Person" required>
                        </div>
                        <div class="form-group">
                            <label for="">Total Amount</label>
                            <input type="number" class="form-control amount" id="amount"  name="amount" placeholder="Total Amount" required>
                        </div>
                        <div class="form-group">
                            <label for="">Given portion</label>
                            <input type="number" class="form-control amount1" id="amount1"  name="amount1" placeholder="Given portion " required>
                        </div>
                        <div class="form-group">
                            <label for="">Rest Amount</label>
                            <input type="number" class="form-control amount2" id="amount2"  name="amount2" placeholder="Rest Amount" required>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" id="id" class="id">
                        <button type="submit" class="btn allButton">Save</button>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="divform2" style="display:none;">
                    {{ Form::open(array('url' => 'getAccountingReportByDate',  'method' => 'post')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Accountingের Name</label>
                            <select class="form-control select2 name_id" name="name_id" style="width: 100%;" required>
                                <option value="" selected>Select Accounting</option>
                                @foreach($names as $a)
                                    <option value="{{$a->id}}">{{$a->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>হেড Name</label>
                            <select class="form-control select2 head_id" name="head_id" style="width: 100%;" required>
                                <option value="" selected>Slect Head Name</option>
                            </select>
                        </div>
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
                        <button type="submit" class="btn allButton">Submit</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Accounting  List </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tools</th>
                            <th>Date  </th>
                            <th>Accounting </th>
                            <th>Accounting Head </th>
                            <th>Accounting Type  </th>
                            <th>Purpose  </th>
                            <th>Person  </th>
                            <th>Total Cost</th>
                            <th>Given</th>
                            <th>Rest</th>
                        </tr>
                        @php
                          $sum=0;
                          $sum1=0;
                          $sum2=0;
                        @endphp
                        @foreach($accountings as $accounting)
                            <tr>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$accounting->acc_id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                                <td style="text-align: right;"> {{$accounting-> date}} </td>
                                <td style="text-align: right;"> {{$accounting-> name}} </td>
                                <td style="text-align: right;"> {{$accounting-> head}} </td>
                                <td style="text-align: right;"> {{$accounting->type}} </td>
                                <td style="text-align: right;"> {{$accounting->purpose}} </td>
                                <td style="text-align: right;"> {{$accounting->person}} </td>
                                <td style="text-align: right;"> {{$accounting->amount}}/- </td>
                                <td style="text-align: right;"> {{$accounting->amount1}}/- </td>
                                <td style="text-align: right;"> {{$accounting->amount2}}/- </td>
                                @php
                                    $sum = $sum + $accounting->amount;
                                    $sum1 = $sum1 + $accounting->amount1;
                                    $sum2 = $sum2 + $accounting->amount2;
                                @endphp
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" style="text-align: right;"><b>Total-</b></td>
                            <td style="text-align: right;"><b>{{$sum}} /-</b></td>
                            <td style="text-align: right;"><b>{{$sum1}} /-</b></td>
                            <td style="text-align: right;"><b>{{$sum2}} /-</b></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align: right;"><b>Balance:-</b> </td>
                            <td colspan="3" style="text-align: center;"><b>{{$sum-($sum1+$sum2)}} /-</b></td>
                        </tr>
                    </table>
                    {{ $accountings->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        $( function() {
            $('#date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
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
        $(document).ready(function(){
            $(".addbut").click(function(){
                $(".divform").show();
                $(".rembut").show();
                $(".addbut").hide();
                $(".divform2").hide();
            });
            $(".rembut").click(function(){
                $(".divform").hide();
                $(".addbut").show();
                $(".rembut").hide();
                $(".divform2").hide();
            });
            $(".rembut2").click(function(){
                $(".divform2").show();
                $(".divform").hide();
            });

        });
        $(function(){
            $('.select2').select2()
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
                url: 'getAccountingListById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.type').val(data.type);
                    $('.date').val(data.date);
                    $('.purpose').val(data.purpose);
                    $('.amount').val(data.amount);
                    $('.person').val(data.person);
                    $('.amount1').val(data.amount1);
                    $('.amount2').val(data.amount2);
                    $('.id').val(data.id);
                    $('.select2').select2()
                }
            });
        }
        $(".name_id").change(function(){
            var id =$(this).val();
            $('.head_id').find('option:not(:first)').remove();
            $.ajax({
                type: 'GET',
                url: 'getAccountHeadListAll',
                data: {id:id},
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    var len = data.length;
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var name = data[i]['head'];
                        $(".head_id").append("<option value='"+id+"'>"+name+"</option>");
                    }
                }
            });
        });
    </script>
@endsection
