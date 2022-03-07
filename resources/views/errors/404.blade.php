@extends('news.main')

@section('content')
<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Not found </h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
            
                <li>Error</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('images/page-banner.png') }}" alt="image">
    </div>
</div>




<div class="error-area ptb-100">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="{{ asset('assets/images/error.png') }}" alt="error">
                    <h3>Error 404 : Can't find the page you want </h3>
                    <a href="{{route('home')}}" class="default-btn">Home<span></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection