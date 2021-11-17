@extends('frontend.loginLayout')
@section('title','Email ')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>বাজার - সদাই</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Email </p>
            @if ($message = Session::get('errorMessage'))
                <center><p style="color: red">{{$message}} </p></center>
            @endif
            {{ Form::open(array('url' => 'verifyEmail',  'method' => 'post')) }}
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" class="form-control email"  name="email" placeholder="Email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

