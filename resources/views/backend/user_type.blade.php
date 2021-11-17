@extends('backend.layout')
@section('title', 'User ')
@section('page_header', 'User Management')
@section('mainUserLiAdd','active menu-open')
@section('userTypeLiAdd','active')
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
                    {{ Form::open(array('url' => 'insertUserType',  'method' => 'post')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">User </label>
                            <input type="text" class="form-control name" id="name"  name="name" placeholder="Name " required>
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <select class="form-control" name="type">
                                <option selected>Select User </option>
                                <option value="1">Panel User</option>
                                <option value="2">Not Panel User</option>
                            </select>
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
                    <h3 class="box-title">User Type List </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name </th>
                        </tr>
                        @foreach($user_types as $user_type)
                            <tr>
                                <td> {{$user_type->name}} </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $user_types->links() }}
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
        });
        $(".rembut").click(function(){
            $(".divform").hide();
            $(".addbut").show();
            $(".rembut").hide();
        });

    });
</script>
@endsection
