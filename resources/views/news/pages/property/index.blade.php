@extends('news.main')
@section('content')


<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Property</h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                {{-- <li>Trang</li> --}}
                <li>property</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('assets/images/page-banner.png') }}" alt="image">
    </div>
</div>


<div class="featured-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>Featured apartment</h3>
        </div>
        <div class="row justify-content-center">
            @if ($properties->count() > 0)
            @foreach ($properties as $item)
            <div class="col-lg-4 col-md-6">
                <div class="featured-item bottom-30">
                    <div class="featured-image">
                        <a href="{{ route('property.detail',['slug' => $item->slug]) }}">
                            <img src="{{ asset('images/property') }}/{{ $item->image }}"
                               style="height: 320px !important;" alt="{{ $item->name }}"></a>
                        <div class="price">$ {{ number_format($item->price) }}</div>
                    </div>
                    <div class="featured-top-content">
                        <span>{{ $item->address }}</span>
                        <h3>
                            <a href="{{ route('property.detail',['slug' => $item->slug]) }}">{{ $item->name }}</a>
                        </h3>
                        <p>{{ $item->type }} <span>({{ $item->area }}/m<sup>2</sup>)</span></p>
                        <ul class="featured-list">
                            <li><i class='bx bx-bed'></i> {{ $item->bed }} Phòng ngủ</li>
                            <li><i class='bx bxs-bath'></i> {{ $item->bath }} Phòng tắm</li>
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
                            <a href="{{ route('property.detail',['slug' => $item->slug]) }}" class="default-btn">KNOW DETAILS <span></span></a>
                        </div>
                    </div>
                </div>
            </div>                
            @endforeach
            @else
            <div class="col-lg-8 col-md-12">
                <div class="error-area ptb-100">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="error-content">
                                    <h3>Không thể tìm thấy căn hộ bạn muốn</h3>
                                    <a href="news" class="default-btn">Tin tức<span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-12 col-md-12 col-sm-12">
                {{ $properties->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
