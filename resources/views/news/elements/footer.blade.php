@php
    $setting = App\Models\Setting::first();
@endphp
<footer class="footer-area pt-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <div class="widget-logo">
                        <a href="index.html">
                            <img src="{{ asset('assets/images/white-logo.png') }}" alt="image">
                        </a>
                    </div>
                    <p>
                        @if ($setting)                                
                        {{ $setting->description }}
                        @endif
                    </p>
                    @if ($setting) 
                    <ul class="widget-social">
                        <li>
                            <a href="{{ $setting->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li>
                        <li>
                            <a href="{{ $setting->twitter }}" target="_blank"><i
                                    class='bx bxl-twitter'></i></a>
                        </li>
                        <li>
                            <a href="{{ $setting->instagram }}" target="_blank"><i
                                    class='bx bxl-instagram'></i></a>
                        </li>
                        <li>
                            <a href="{{ $setting->pinterest }}" target="_blank"><i
                                    class='bx bxl-pinterest-alt'></i></a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
           
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Links</h3>
                    <ul class="widget-info">
                        <li class='null'>
                            <a href="/">Home</a>
                        </li>
                        <li class='null'>
                            <a href="properties">Property</a>
                        </li>
                        <li class='null'>
                            <a href="news">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Contact</h3>
                    <ul class="widget-info">
                        <li>
                            <i class='bx bxs-map'></i>
                            @if ($setting)
                            {{ $setting->address }}                                    
                            @endif
                        </li>
                        <li>
                            <i class='bx bxs-phone'></i>
                            @if ($setting)                                
                            <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                            @endif
                        </li>
                        <li>
                            <i class='bx bx-envelope'></i>
                            @if ($setting)                                
                            <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Newsletter</h3>

                    <div class="widget-newsletter">
                        <form class="newsletter-form" data-bs-toggle="validator" novalidate="true">
                            <input type="email" class="input-newsletter" placeholder="Email Address" name="EMAIL" required="" autocomplete="off">
    
                            <button type="submit" class="disabled" style="pointer-events: all; cursor: pointer;"><i class="bx bx-envelope"></i></button>
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>

                        <div class="newsletter-content">
                            <p>Sign up for our latest news and articles. We won’t give you spam emails.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-area-content">
                <p>
                    Copyright © 2021. All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</footer>
<div class="go-top">
    <i class='bx bx-chevron-up'></i>
</div>