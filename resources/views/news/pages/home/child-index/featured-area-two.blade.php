<div class="featured-area-two ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>Newest apartment</h3>
        </div>
        <div class="featured-slides owl-carousel owl-theme">
            @foreach ($properties as $item)
                <div class="featured-item with-white-color">
                    <div class="featured-image">
                        <a href="{{ route('property.detail',['slug' => $item->slug]) }}"><img src="{{ asset('images/property') }}/{{ $item->image }}"
                                style="height: 320px !important;" alt="{{ $item->name }}"></a>
                        <div class="price">$ {{ number_format($item->price) }}</div>
                    </div>
                    <div class="featured-top-content">
                        <span>{{ $item->address }}</span>
                        <h3>
                            <a href="{{-- {{ route('property.detail',['slug' => $item->slug]) }} --}}">{{ $item->name }}</a>
                        </h3>
                        <p>{{ $item->type }} <span>({{ $item->area }} m<sup>2</sup> )</span></p>
                        <ul class="featured-list">
                            <li><i class='bx bx-bed'></i> {{ $item->bed }} Bedrs</li>
                            <li><i class='bx bxs-bath'></i> {{ $item->bath }} Baths</li>
                            <li><i class='bx bxs-city'></i> {{ $item->city }}</li>
                        </ul>
                    </div>
                    
                    <div class="featured-bottom-content">
                        <ul class="rating-list">
                            <li><i class="bx bxs-star"></i></li>
                            <li><i class="bx bxs-star"></i></li>
                            <li><i class="bx bxs-star"></i></li>
                            <li><i class="bx bxs-star"></i></li>
                            <li class="color-gray"><i class="bx bxs-star"></i></li>
                            <li>Average</li>
                        </ul>

                        <div class="featured-btn">
                            <a href="{{-- {{ route('property.detail',['slug' => $item->slug]) }} --}}" class="default-btn">KNOW DETAILS <span></span></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="view-featured-btn">
            <a href="{{ route('property.index') }}" class="default-btn">View all <span></span></a>
        </div>
    </div>
</div>