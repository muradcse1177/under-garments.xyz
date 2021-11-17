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
            </div>
            <div class="divform" style="display:none">
                {{ Form::open(array('url' => 'insertAccountHead',  'method' => 'post')) }}
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
                        <label for="">হেড</label>
                        <input type="text" class="form-control head" id="head"  name="head" placeholder="হেড Name " required>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" id="id" class="id">
                    <button type="submit" class="btn allButton">Save</button>
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
                        <th>Name  </th>
                        <th>হেড  </th>
                    </tr>
                    @foreach($accountings as $accounting)
                        <tr>
                            <td class="td-actions">
                                <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$accounting->h_id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td> {{$accounting-> name}} </td>
                            <td> {{$accounting-> head}} </td>
                        </tr>
                    @endforeach
                </table>
                {{ $accountings->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
    <script>
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
                url: 'getAccountingHeadListById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.name_id').val(data.name_id);
                    $('.head').val(data.head);
                    $('.select2').select2()
                }
            });
        }
    </script>
@endsection
