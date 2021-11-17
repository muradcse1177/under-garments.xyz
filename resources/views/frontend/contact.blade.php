@extends('frontend.layout')
@section('title', 'Contact || Under-Garments.Xyz Best Online Under Garments, Sex and Beauty Shop in Bangladesh')
@section('contact', 'active')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/asset/woolmart/css/demo3.min.css')}}">
@endsection
@section('content')
    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">Contact Us</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav mb-10 pb-1" style="margin-bottom: 10px; margin-top: 10px;">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content contact-us">
            <div class="container">
                <section class="content-title-section mb-10">
                    <h3 class="title title-center mb-3"> Please Contact Us</h3>
                </section>
                <!-- End of Contact Title Section -->

                <section class="contact-information-section mb-10">
                    <div class="row cols-xl-3 cols-md-3 cols-sm-2 cols-1">
                        <div class="icon-box text-center icon-box-primary">
                                <span class="icon-box-icon icon-email">
                                    <i class="w-icon-envelop-closed"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Email</h4>
                                <p>sales@Under-Garments.Xyz</p>
                            </div>
                        </div>
                        <div class="icon-box text-center icon-box-primary">
                                <span class="icon-box-icon icon-headphone">
                                    <i class="w-icon-headphone"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Phone</h4>
                                <p>+8801880-198606</p>
                            </div>
                        </div>
                        <div class="icon-box text-center icon-box-primary">
                                <span class="icon-box-icon icon-map-marker">
                                    <i class="w-icon-map-marker"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title">Address</h4>
                                <p>Block-C, Banashree, Dhaka</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End of Contact Information section -->

                <hr class="divider mb-10 pb-1">
                <div class="row">
                    @if ($message = Session::get('successMessage'))
                    <div class="col-md-12 mb-4">
                        <div class="alert alert-success alert-button">
                            <a href="#" class="btn btn-success btn-rounded">Well Done</a>
                            {{ $message }}
                        </div>
                    </div>
                    @endif
                    @if ($message = Session::get('errorMessage'))
                    <div class="col-md-12 mb-4">
                        <div class="alert alert-warning alert-button">
                            <a href="#" class="btn btn-warning btn-rounded">Sorry</a>
                            {{ $message }}
                        </div>
                    </div>
                    @endif
                </div>
                <section class="contact-section">
                    <div class="row gutter-lg pb-3">
                        <div class="col-lg-12 mb-8">
                            <h4 class="title mb-3">Contact Us</h4>
                            {{ Form::open(array('url' => 'insertContactUs',  'method' => 'post','class'=>'form contact-us-form')) }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control"  id="name" name="name" placeholder="Enter name"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone" pattern="\+?(88)?0?1[3456789][0-9]{8}\b" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea  class="form-control" id="purpose" name="purpose" placeholder="Purpose write here..." rows="5" required></textarea>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-dark btn-rounded contact" name="save" value= "1"> Send Now</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </section>
                <!-- End of Contact Section -->
            </div>

            <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
{{--            <div class="google-map contact-google-map" id="googlemaps">--}}
{{--                <iframe width="100%" height="350" style="border:0" loading="lazy" allowfullscreen="" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAOc0-5SE59M8qVpKbDKPPt7bda9xiOEaE--}}
{{--					&amp;q=Bazar Sadai">--}}
{{--                </iframe>--}}
{{--            </div>--}}
            <!-- End Map Section -->
        </div>
        <!-- End of PageContent -->
    </main>
    <!-- End of Main -->

@endsection
@section('js')
@endsection
