@extends('frontend.loginLayout')
@section('title','Password')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>বাজার - সদাই</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"> নতুন Password </p>
            @if ($message = Session::get('errorMessage'))
                <center><p style="color: red">{{$message}} </p></center>
            @endif
            {{ Form::open(array('url' => 'passwordUpdate',  'method' => 'post')) }}
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="password" class="form-control password"  name="password" placeholder=" নতুন Password" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <input type="hidden" name="id" value="{{$id}}"/>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

