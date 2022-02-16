@extends('news.main')
@section('content')

<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>News</h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                {{-- <li>Trang</li> --}}
                <li>News</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('assets/images/page-banner.png') }}" alt="image">
    </div>
</div>


<div class="blog-area-without-color ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            @if ($posts->count() > 0)
            <div class="col-lg-8 col-md-12">
                <div class="row justify-content-center">
                    @foreach ($posts as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="blog-item bottom-30">
                            <a href="{{--    --}}"><img src="{{ asset('images/article') }}/{{ $item->image }}"
                                style="height: 320px !important;" alt="{{ $item->name }}"></a>
                            <div class="blog-content">
                                <span><a href="{{--      --}}">{{ $item->category->name }}</a></span>
                                <h3>
                                    <a href="{{--    --}}">{{ $item->name }}</a>
                                </h3>
                            </div>
                            <div class="blog-bottom-content d-flex justify-content-between align-items-center">
                                <div class="blog-author d-flex align-items-center">
                                    <img src="{{ asset('upload/user') }}/{{ $item->user->profile_path }}" class="rounded-circle" alt="{{ $item->user->name }}">
                                    <span><a href="#">{{ $item->user->name }}</a></span>
                                </div>
                                <p><i class='bx bx-calendar'></i>{{ $item->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>                        
                    @endforeach
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-8 col-md-12">
                <div class="error-area ptb-100">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="error-content">
                                    <h3>Không thể tìm thấy tin tức bạn muốn</h3>
                                    <a href="news" class="default-btn">Tin tức<span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-4 col-md-12">
                <aside class="widget-area">
                    <div class="widget widget_search">
                        <h3 class="widget-title">Search</h3>
                        <form class="search-form" action="{{-- {{ route('news.search') }} --}}" method="GET">
                            <input type="search" name="search" class="search-field" placeholder="Enter keywords">
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>
                    <div class="widget widget_categories">
                        <h3 class="widget-title">Category</h3>
                        <ul>
                            @foreach ($categories as $item)
                            <li><a href="{{-- {{ route('news.category',['slug' => $item->slug]) }} --}}">{{ $item->name }}</a><span>{{ $item->post->count() }}</span></li>                                
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget_fido_posts_thumb">
                        <h3 class="widget-title">Featured Posts </h3>
                        @foreach ($hots as $item)
                        <article class="item">
                            <a href="{{--    --}}" class="thumb">
                                <span class="fullimage cover bg1" role="img"></span>
                            </a>
                            <div class="info">
                                <h4 class="title usmall">
                                    <a href="{{--    --}}">{{ $item->name }}</a>
                                </h4>
                                <span><i class='bx bx-calendar'></i>{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </article>                            
                        @endforeach
                    </div>
                    <div class="widget widget_tag_cloud">
                        <h3 class="widget-title">Topic</h3>
                        <div class="tagcloud">
                            @foreach ($tags as $item)
                            <a href="{{-- {{ route('news.tag',['slug' => $item->slug]) }} --}}">{{ $item->name }}</a>                                
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

@endsection
