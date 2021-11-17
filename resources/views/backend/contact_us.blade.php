@extends('backend.layout')
@section('title', 'Contact Us')
@section('page_header', 'Contact Us Management')
@section('contactLiAdd','active')
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Contact Us</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Contact Us </th>
                            <th>Phone </th>
                            <th>  Time</th>
                            <th>  Purpose </th>
                            <th>Tools</th>
                        </tr>
                        @foreach($lists as $list)
                            <tr>
                                <td> {{$list->name}} </td>
                                <td> {{$list->phone}} </td>
                                <td> {{$list->time}} </td>
                                <td> {{ \Illuminate\Support\Str::limit($list->purpose, 50, $end='...') }} </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success search" data-id="{{$list->id}}">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $lists->links() }}
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade"  tabindex="-1"   id="contactModal"  role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">About Us</h4>
                </div>
                <div class="modal-body">
                   <div id="modalRes">

                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function(){
            $(document).on('click', '.search', function(e){
                e.preventDefault();
                $('#contactModal').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getContactUs',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('#modalRes').html(data.purpose);
                }
            });
        }
    </script>
@endsection
