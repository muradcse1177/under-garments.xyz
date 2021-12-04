@extends('frontend.layout')
@section('title', 'Signup/Login || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('myOrder', 'active')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
    <style>
        form, input, label, p {
            color: black !important;
        }
        .form-group > select > option{
            color: black !important;
        }
        @media screen and (max-width: 600px) {

        }
    </style>

@endsection
@section('content')
    <main class="main login-page" style="margin-bottom: -30px;">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="login-popup">
                    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                        @if ($message = Session::get('errorMessage'))
                            <center><h3 style="color: red;">{{$message}} </h3></center>
                        @endif
                        <ul class="nav nav-tabs text-uppercase" role="tablist">
                            <li class="nav-item">
                                <a href="#sign-in" class="nav-link active">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a href="#sign-up" class="nav-link">Sign Up</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="sign-in">
                                {{ Form::open(array('url' => 'verifyUser',  'method' => 'post')) }}
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Email address/Phone Number *</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Password *</label>
                                        <input type="text" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1" checked>
                                        <label for="remember1">Remember me</label>
                                        <a href="{{url('forgotPasswordLink')}}">Lost your password?</a>
                                    </div>
                                    <button  type="submit" class="btn btn-primary">Sign Up</button>
                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane" id="sign-up">
                                {{ Form::open(array('url' => 'insertNewUser',  'method' => 'post')) }}
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Your email address *</label>
                                        <input type="text" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Phone Number *</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address *</label>
                                        <input type="text" class="form-control" name="address" id="address" required>
                                    </div>
                                    <p>Your personal data will be used to support your experience
                                        throughout this website, to manage access to your account,
                                        and for other purposes described in our <a href="{{url('http://localhost/underwear/pages/1')}}" class="text-primary">privacy policy</a>.</p>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                        <input type="checkbox" class="custom-checkbox" id="remember" name="remember" checked>
                                        <label for="remember" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                                    </div>
                                    <button  type="submit" class="btn btn-primary">Sign Up</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
@endsection
