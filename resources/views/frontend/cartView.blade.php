@extends('frontend.frontLayout')
@section('title', 'বাজার List')
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
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">আপনার বাজার List </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th></th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>দাম </th>
                            <th>Amount</th>
                            <th>ইউনিট</th>
                            <th>মোট</th>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
                <div class="box-header with-border d_header" style="display: none;">
                    <h3 class="box-title">আপনার ডোনেট List </h3>
                </div>
                <div class="box-body table-responsive" id="donateTable" style="display: none;">
                    <table class="table table-bordered" >
                        <thead>
                        <th></th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>দাম </th>
                        <th>Amount</th>
                        <th>ইউনিট</th>
                        <th>মোট</th>
                        </thead>
                        <tbody id="tbodyModal">
                        </tbody>
                    </table>
                </div>
                <div class="box-body table-responsive">
                    @if(Cookie::get('user_id') != null && $count >0)
                        {{ Form::open(array('url' => 'getPaymentCartView',  'method' => 'post')) }}
                        {{ csrf_field() }}
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="cash" name="cash">
                            <label class="form-check-label" for="cash">ক্যাশ অন ডেলিভারি</label>
                        </div>
                        <h4>
                            <a href='#'>
                                <input type="hidden" class="in_donate" name="donate" value="">
                                <button type='submit' class='btn allButton active'>Order প্লেস করুন</button>
                            </a>
                            <a href='#' class="donatehref">
                                <button type='button' class='btn allButton active donate'>ডোনেট করুন</button>
                            </a>
                        </h4>
                        {{ Form::close() }}
                    @endif
                    @if(Cookie::get('user_id') == null )
                        <h4> আপনার Order সম্পন্ন্য করতে   <a href='{{url('login')}}'>
                                <button type='button' class='btn allButton active'>লগ ইন</button></a> করুন</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $(".donate").click(function(){
                $("#donateTable").show();
                $(".d_header").show();
            });
        });

        getDetails();
        $(document).on('click', '.cart_delete_donate', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                url: '{{ url('/') }}/product/cart_delete_donate',
                dataType: 'json',
                success: function(response){
                    //console.log(response);
                    if(!response.error){
                        $.ajax({
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            url: '{{ url('/') }}/product/donate',
                            dataType: 'json',
                            success: function(response){
                                // console.log(response);
                                if(!response.error){
                                    $('#tbodyModal').html(response.output);
                                    $("#donateTable").show();
                                }
                            }
                        });
                    }
                }
            });
        });
        $(document).on('click', '.cart_delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                url: '{{ url('/') }}/product/cart_delete',
                dataType: 'json',
                success: function(response){
                    //console.log(response);
                    if(!response.error){
                        getDetails();
                        getCart();
                        $("#donateTable").show();
                    }
                }
            });
        });
        $(document).on('change', '.quantity', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var value = $("#q"+id).val();
            $.ajax({
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id":id,
                    'value':value
                },
                url: '{{ url('/') }}/product/donateQuantityChange',
                dataType: 'json',
                success: function(response){
                     // console.log(response);
                    if(!response.error){
                        $('#tbodyModal').html(response.output);
                    }
                }
            });
        });
        function getDetails(){
            $.ajax({
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                url: '{{ url('/') }}/product/cart_details',
                dataType: 'json',
                success: function(response){
                    //console.log(response.output);
                    $('#tbody').html(response.output);
                    getCart();
                }
            });
        }

    </script>
@endsection
