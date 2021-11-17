@extends('backend.layout')
@section('title','Sub Category')
@section('page_header', 'Sub  Category Management')
@section('subCatLiAdd','active')
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
                    {{ Form::open(array('url' => 'insertSubcategory',  'method' => 'post','enctype'=>'multipart/form-data')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label> Type</label>
                            <select class="form-control select2 cat_type" name="cat_type" style="width: 100%;" required="requred">
                                <option value="" selected> Select Type</option>
                                <option value="1">Product</option>
                                <option value="2">Service</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Category Name</label>
                            <select class="form-control select2 cat_name" name="catId" style="width: 100%;" required>
                                <option value="" selected> Select Category</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Sub Category Name</label>
                            <input type="text" class="form-control name" id="name"  name="name" placeholder="Name " required>
                        </div>
                        <div class="form-group">
                            <label for="">Photo (190px*190px)</label>
                            <input type="file" class="form-control image" id="image" accept="image/*"  name="image" placeholder="Name ">
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
                    <h3 class="box-title">Sub Category  List </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Photo  </th>
                            <th>Sub Category  </th>
                            <th>Category  </th>
                            <th>Type  </th>
                            <th>Tools</th>
                        </tr>
                        @foreach($subcategories as $subcategory)
                            <tr>
                                <td> <img src="{{@$subcategory->image}}" height="60" width="60"> </td>
                                <td> {{$subcategory-> name}} </td>
                                <td> {{$subcategory->catName}} </td>
                                <td>  @if ($subcategory->type ==1){{'Product' }} @elseif ($subcategory->type ==2){{'Service' }}  @else{{'ক্রয় বিক্রয়'}} @endif </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$subcategory->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" rel="tooltip"  class="btn btn-danger delete" data-id="{{$subcategory->id}}">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $subcategories->links() }}
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
                                    {{ Form::open(array('url' => 'deleteSubCategory',  'method' => 'post')) }}
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
            $(".cat_type").change(function(){
                var id =$(this).val();
                $('.cat_name').find('option:not(:first)').remove();
                $.ajax({
                    type: 'GET',
                    url: 'getCategoryListAll',
                    data: {id:id},
                    dataType: 'json',
                    success: function(response){
                        var data = response.data;
                        var len = data.length;
                        for( var i = 0; i<len; i++){
                            var id = data[i]['id'];
                            var name = data[i]['name'];
                            $(".cat_name").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });
        });
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
        $(function(){
            $('.select2').select2()
            $(document).on('click', '.edit', function(e){
                e.preventDefault();
                $('.divform').show();
                var id = $(this).data('id');
                getRow(id);
            });
            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                $('#modal-danger').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getSubCategoryList',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.name').val(data.name);
                    $('.id').val(data.id);
                }
            });
        }
    </script>
@endsection
