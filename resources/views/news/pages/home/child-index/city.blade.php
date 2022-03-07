<div class="neighborhood-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>Find The Neighborhood For You</h3>
            <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibendum auctor nisi elit
                consequat ipsum nec sagittis sem nibh id elit.</p>
        </div>

        <div class="row justify-content-center">
            @php
                $i = 0;
            @endphp
            @foreach ($city as $item)
                @php
                    $i++;
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="single-neighborhood">
                        <a href="{{ route('property.city', ['city' => $item->city_slug]) }}">
                            <img class="img-rep"
                                src='{{ asset("images/neighborhood/neighborhood-small-$i.jpg") }}' alt="image"></a>

                        <div class="content">
                            <h3> <a
                                    href="{{ route('property.city', ['city' => $item->city_slug]) }}">{{ $item->city }}</a>
                            </h3>
                            <a href="{{ route('property.city', ['city' => $item->city_slug]) }}"><span>{{ $item->total }}
                                    Properties</span></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="view-neighborhood-btn">
            <a href="{{ route('property.citys') }}" class="default-btn">VIEW MORE NEIGHBORHOOD <span></span></a>
        </div>
    </div>

    <div class="neighborhood-map-shape">
        <img src=" {{ asset('images/neighborhood/map.png') }}" alt="image">
    </div>
</div>
