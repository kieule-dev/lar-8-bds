@extends('news.main')
@section('content')



<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Property</h2>
            <ul>
                <li> <a href="/">Home</a></li>
                <li>property</li>
                <li>city</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('images/page-banner.png') }}" alt="image">
    </div>
</div>

@php
        // $city = $properties->all();
@endphp

<div class="neighborhood-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>Find The Neighborhood For You</h3>
            <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis sem nibh id elit.</p>
        </div>

        <div class="row justify-content-center">
            @php
                $i = 0;
               
            @endphp
            @foreach ($city as $item)
           

                @php
                    $i++;
                    // dd($item);
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="single-neighborhood">
                        <a href="{{route('property.city',['city' => $item->city_slug])}}"><img style="height:300px" class="img-rep" src='{{ asset("images/property/$item->image") }}' alt="image"></a>

                        <div class="content">
                            <h3> <a href="{{route('property.city',['city' => $item->city_slug])}}">{{ $item->city }}</a> </h3>
                            <a href="{{route('property.city',['city' => $item->city_slug])}}"><span>{{ $item->total }} Properties</span></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- <div class="view-neighborhood-btn">
            <a href="neighborhood.html" class="default-btn">VIEW MORE NEIGHBORHOOD <span></span></a>
        </div> --}}
    </div>

    {{-- <div class="neighborhood-map-shape">
        <img src="{{asset('assets/images/neighborhood/map.png')}}" alt="image">
    </div> --}}
</div>

@endsection
