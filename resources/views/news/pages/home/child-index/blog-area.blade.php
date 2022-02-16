<div class="blog-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>News</h3>
        </div>
        <div class="blog-slides owl-carousel owl-theme">
            @foreach ($posts as $post)



                <div class="blog-item">
                    <a href="{{-- {{ route('news.detail',['slug' => $post->slug]) }} --}}"><img src="{{ asset('images/article') }}/{{ $post->image }}"
                            style="height: 320px !important;" alt="{{ $post->name }}"></a>
                    <div class="blog-content">
                        <span><a href="{{-- {{ route('news.detail',['slug' => $post->slug]) }} --}}">{{ $post->category->name }}</a></span>
                        <h3>
                            <a href="{{-- {{ route('news.detail',['slug' => $post->slug]) }} --}}">{{ $post->name }}</a>
                        </h3>
                    </div>
                    <div class="blog-bottom-content d-flex justify-content-between align-items-center">
                        <div class="blog-author d-flex align-items-center">
                            <img src="assets/images/blog/image-1.jpg" class="rounded-circle"
                                alt="{{ $post->user->name }}">
                            <span><a href="#">{{ $post->user->name }}</a></span>
                        </div>
                        <p><i class='bx bx-calendar'></i>{{ $post->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>