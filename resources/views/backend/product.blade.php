@extends('backend.layout')
@section('title','Product')
@section('page_header', 'Product  Management')
@section('proLiAdd','active')
@section('extracss')
    <link rel="stylesheet" href="public/asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
                    {{ Form::open(array('url' => 'insertProducts',  'method' => 'post','enctype'=>'multipart/form-data')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> Category Name</label>
                                <select class="form-control select2 cat_name" name="catId" style="width: 100%;" required>
                                    <option value="" selected> Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label> Sub Category Name</label>
                                <select class="form-control select2 subcat_name" name="subcat_name" style="width: 100%;">
                                    <option value="" selected>Select  Sub  Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control name" id="name"  name="name" placeholder="Product Name " required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control company" id="company"  name="company" placeholder="Company Name ">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Type</label>
                                <input type="text" class="form-control type" id="type"  name="type" placeholder="Type">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Original Price</label>
                                <input type="number" class="form-control price" id="price"  name="price" min="1" placeholder="Price" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Discounted Price</label>
                                <input type="number" class="form-control dis_price" id="dis_price"  name="dis_price" min="1" placeholder="Discount Price">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Unit</label>
                                <input type="text" class="form-control unit" id="unit"  name="unit" placeholder="Unit" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Minimum Amount</label>
                                <input type="number" class="form-control minqty" id="minqty"  min="1" name="minqty" placeholder="Minimum Amount" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control status" name="status" style="width: 100%;" required>
                                    <option value="" selected>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">In Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Thumbnail (Must be w-300px * h-338px)</label>
                                <input type="file" class="form-control product_photo" accept="image/*" name="product_photo" placeholder="Photo" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Slider photo(Must be w-800px * h-990px)</label>
                                <input type="file" class="form-control slider" accept="image/*" name="slider[]" placeholder="Photo" required multiple>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="textarea description" id="description" placeholder="Description " name="description"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Specification</label>
                                <textarea class="textarea specification" id="specification" placeholder="Specification " name="specification"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
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
                    <h3 class="box-title">Product  List </h3>
                    {{ Form::open(array('url' => 'productSearchFromAdmin',  'method' => 'get')) }}
                    {{ csrf_field() }}
                    <div class="pull-right">
                        <span>
                            <input type="text" name="proSearch" size="9" value="<?php if(isset($key)) echo $key;?>"> &nbsp;
                            <button type="submit" rel="tooltip"  class=" pull-right" style="height: 25px; text-align: center; background-color: darkgreen; color: white" >
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
                            <th> #  </th>
                            <th> Photo  </th>
                            <th> Name  </th>
                            <th> price  </th>
                            <th> Unit  </th>
                            <th> Company </th>
                            <th> Type </th>
                             <th>Tools</th>
                        </tr>
                        <?php $i=1?>
                        @foreach($products as $product)
                            <?php $noImage ="public/asset/no_image.jpg"; ?>
                            <tr>
                                <td> {{$i}} </td>
                                <td>
                                    @if($product->photo)
                                        <div class="text-left">
                                            <img src="{{ $product->photo }}" class="rounded" height="50px" width="50px">
                                        </div>
                                    @else
                                        <div class="text-left">
                                            <img src="{{$noImage}}" class="rounded" height="50px" width="50px">
                                        </div>
                                    @endif
                                </td>
                                <td> {{$product->name}} </td>
                                <td> {{$product->price}} </td>
                                <td> {{$product->unit}} </td>
                                <td> {{$product->company}} </td>
                                <td> {{$product->type}} </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$product->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" rel="tooltip"  class="btn btn-danger delete" data-id="{{$product->id}}">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                    </table>
                    {{ $products->links() }}
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
                                    {{ Form::open(array('url' => 'deleteProduct',  'method' => 'post')) }}
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
    <script src="public/asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>

        $(document).ready(function(){
            $('.textarea').wysihtml5();
            $.ajax({
                url: 'getAllCategory',
                type: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (response) {
                    var data = response.data;
                    var len = data.length;
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var name = data[i]['name'];
                        $(".cat_name").append("<option value='"+id+"'>"+name+"</option>");
                    }

                },
                failure: function (msg) {
                    alert('an error occured');
                }
            });
            $(".cat_name").change(function(){
                var id =$(this).val();
                $('.subcat_name').find('option:not(:first)').remove();
                $.ajax({
                    type: 'GET',
                    url: 'getSubCategoryListAll',
                    data: {id:id},
                    dataType: 'json',
                    success: function(response){
                        var data = response.data;
                        var len = data.length;
                        for( var i = 0; i<len; i++){
                            var id = data[i]['id'];
                            var name = data[i]['name'];
                            $(".subcat_name").append("<option value='"+id+"'>"+name+"</option>");
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
                url: 'getProductList',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.name').val(data.name);
                    $('.company').val(data.company);
                    $('.genre').val(data.genre);
                    $('.type').val(data.type);
                    $('.id').val(data.id);
                    $('.price').val(data.price);
                    $('.unit').val(data.unit);
                    $('.minqty').val(data.minqty);
                    $('.dis_price').val(data.discount_price);
                    $(".product_photo").prop('required',false);
                    $(".slider").prop('required',false);
                    $('#description ~ iframe').contents().find('.wysihtml5-editor').html(data.description);
                    $('#specification ~ iframe').contents().find('.wysihtml5-editor').html(data.specification);
                    //Also works $('.wysihtml5-sandbox').contents().find('.wysihtml5-editor').html(data.description);

                }
            });
        }
    </script>
@endsection
