@extends('backend.layout')
@section('title', 'User ')
@section('page_header', 'User Management')
@section('mainUserLiAdd','active menu-open')
@section('userLiAdd','active')
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
                    {{ Form::open(array('url' => 'insertUser',  'method' => 'post','enctype'=>'multipart/form-data')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" class="form-control name" name="name" placeholder="Name"  required>
                        </div>
                        <div class="form-group">
                            <label for="name" >Email</label>
                            <input type="email" class="form-control email" name="email" placeholder="Email"  required>
                        </div>
                        <div class="form-group">
                            <label for="phone" >Phone </label>
                            <input type="tel" class="form-control phone" name="phone" placeholder="Phone" pattern="\+?(88)?0?1[3456789][0-9]{8}\b"  required>
                        </div>
                        <div class="form-group">
                            <label for="password" >Password</label>
                            <input type="password" class="form-control password" name="password" placeholder="Password"  required>
                        </div>
                        <div class="form-group">
                            <label for="address" >Address</label>
                            <input type="text" class="form-control address" name="address" placeholder="Address"  required>
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
                    <h3 class="box-title">User List </h3>
                    {{ Form::open(array('url' => 'selectUserFromUserPanel',  'method' => 'get')) }}
                    {{ csrf_field() }}
                    <div class="pull-right">
                        <span>
                            <select class="form type" name="userType" required>
                                <option value="" selected>Select User Type</option>
                                <option value="All">All User</option>
                            </select> &nbsp;
                            <button type="submit" rel="tooltip"  class=" pull-right" style="height: 23px; text-align: center; background-color: darkgreen; color: white" >
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </span>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Photo </th>
                            <th>Name </th>
                            <th>Phone </th>
                            <th>Address </th>
                            <th>Designation</th>
                            <th>Status </th>
                            <th>Tools  </th>
                        </tr>
                        @foreach($users as $user)
                            <?php $noImage ="public/asset/images/noImage.jpg"; ?>
                            <tr>
                                <td>
                                    @if($user->photo)
                                    <div class="text-left">
                                        <img src="{{ $user->photo }}" class="rounded" height="35px" width="35px">
                                    </div>
                                    @else
                                    <div class="text-left">
                                        <img src="{{$noImage}}" class="rounded" height="35px" width="35px">
                                    </div>
                                    @endif
                                </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->phone}} </td>
                                <td> {{$user->address}} </td>
                                <td> {{$user->designation}} </td>
                                <td>
                                    @if ($user->status == 1)
                                        <a href=""><button type="button" rel="tooltip" class="btn btn-success" >
                                            <i class="fa fa-check-circle-o"></i>
                                        </button></a>
                                    @else
                                        <a href=""><button type="button" rel="tooltip" class="btn btn-warning" >
                                            <i class="fa fa-close"></i>
                                        </button></a>@endif
                                </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$user->u_id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" rel="tooltip"  class="btn btn-danger delete" data-id="{{$user->u_id}}">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $users->links() }}
                    </table>
                    <div class="modal modal-danger fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Are you delete ?</h4>
                                </div>
                                <div class="modal-body">
                                    <center><p>Are you delete ??</p></center>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::open(array('url' => 'deleteUser',  'method' => 'post')) }}
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">না</button>
                                    <button type="submit" class="btn btn-outline">Yes</button>
                                    <input type="hidden" name="id" id="id" class="id">
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
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
        $.ajax({
            url: 'getAllUserType',
            type: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                var data = response.data;
                var len = data.length;
                for( var i = 0; i<len; i++){
                    var id = data[i]['id'];
                    var name = data[i]['name'];
                    $(".type").append("<option value='"+id+"'>"+name+"</option>");
                }

            },
            failure: function (msg) {
                alert('an error occured');
            }
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getUserListByID',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.name').val(data[0]['name']);
                    $('.phone').val(data[0]['phone']);
                    $('.email').val(data[0]['email']);
                    $('.address').val(data[0]['address']);
                    $('.id').val(data[0]['id']);
                    $('.select2').select2();
                }
            });
        }
    </script>
@endsection
