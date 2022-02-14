<div class="neighborhood-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>Search by location</h3>
        </div>
        <div class="row justify-content-center">
            @foreach ($city as $item)


                <div class="col-lg-4 col-md-6">
                    <div class="single-neighborhood-box">
                        <a href="{{-- {{ route('property.city',['slug' => $item->city_slug]) }} --}}">
                            <img src="{{ asset('images/property') }}/{{ $item[0]['image'] }}" {{-- src="{{ asset('image/property') }}/{{ $item->image }}" --}}
                                style="height: 320px !important;" alt="{{ $item[0]['city'] }}"></a>
                        {{-- style="height: 320px !important;" alt="{{ $item->city }}"></a> --}}
                        <div class="content">
                            <h3>
                                <a href="{{-- {{ route('property.city',['slug' => $item->city_slug]) }} --}}">{{ $item[0]['city'] }}</a>
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="view-neighborhood-btn">
            <a href="{{ route('property.index') }}" class="default-btn">View all <span></span></a>
        </div>
    </div>
</div>
