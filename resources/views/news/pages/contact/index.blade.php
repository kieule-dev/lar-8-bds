@extends('news.main')
@section('content')


<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Contact</h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
              
                <li>Contact</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('images/page-banner.png') }}" alt="image">
    </div>
</div>


<div class="contact-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="contact-form">
                    <div class="title">
                        <h3>Contact us</h3>
                    </div>
                    <form id="contactForm">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>First and last name </label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                        data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required
                                        data-error="Please enter your email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" name="phone" id="phone" required
                                        data-error="Please enter your phone number" class="form-control">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Topic</label>
                                    <input type="text" name="subject" id="subject" class="form-control"
                                        required data-error="Please enter your subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="5"
                                        required data-error="Please enter your message"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <a href="#" id="contact" class="default-btn">Send <span></span></a>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if ($setting)
            <div class="col-lg-4 col-md-12">
                <div class="contact-address">
                    <h3>Our information</h3>
                    <p>{{ $setting->desctiption }}</p>
                    <ul class="address-info">
                        <li>
                            <i class='bx bxs-map'></i>
                            {{ $setting->address }}
                        </li>
                        <li>
                            <i class='bx bxs-phone'></i>
                            <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                        </li>
                        <li>
                            <i class='bx bx-envelope'></i>
                            <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
