<div class="blog-area pt-100">
    <div class="container pd-25">
        <div class="section-title">
            <h3>Articles and Blogs</h3>
            <p>We always update the latest apartments to serve you. Beautiful apartments are waiting for you.
                 Please choose an apartment for yourself </p>
        </div>


        @foreach ($posts as $key => $item)
            @php
                $a[$key] = $item;
                
            @endphp
        @endforeach

        <div class="blog-slides-two owl-carousel owl-theme owl-loaded owl-drag">

            <div class="owl-stage-outer owl-height" style="height: 633.938px;">
                <div class="owl-stage" style=""> {{-- transform: translate3d(-3978px, 0px, 0px); transition: all 0.5s ease 0s; width: 9282px; --}}

                    <div class="owl-item cloned" style="width: 1296px; margin-right: 30px;">
                        <div class="row justify-content-center">

                            <div class="col-lg-6 col-md-12">
                                <div class="single-blog-item">
                                    <a href="{{ route('news.detail', ['slug' => $a[0]->slug]) }}">
                                        <img class='okk1' src='{{ asset('images/article') . '/' . $a[0]->image }}' alt="image">
                                    </a>

                                    <div class="blog-content">
                                        <span class="tag"><a
                                                href="blog.html">{{ $a[0]->category->name }}</a></span>
                                        <h3>
                                            <a href="{{ route('news.detail', ['slug' => $a[0]->slug]) }}">{{ $a[0]->name }}</a>
                                        </h3>

                                        <div class="bottom-content d-flex justify-content-between align-items-center">
                                            <div class="blog-author d-flex align-items-center">
                                                <img src="{{ asset('images/user') . '/' . $a[0]->user->avatar }}"
                                                    class="rounded-circle" alt="image">
                                                <span>
                                                    <a href="{{ route('news.detail', ['slug' => $a[0]->slug]) }}">{{ $a[0]->user->username }}</a>
                                                </span>
                                            </div>

                                            <p><i class="bx bx-calendar"></i>{{ $a[0]->created_at->format('d/m/Y') }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">

                                @foreach ($a as $key => $item)
                                    @if ($key > 0)


                                        <div class="blog-side-item">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4">
                                                    <div class="left">
                                                        <a href="{{ route('news.detail', ['slug' => $item->slug]) }}">
                                                            <img src="{{ asset('images/article') . '/' . $item->image }}"
                                                                alt="image">
                                                        </a>

                                                        <span class="tag">
                                                            <a href="{{ route('news.detail', ['slug' => $item->slug]) }}">{{ $item->category->name }}</a></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <div class="blog-content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('news.detail', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                                        </h3>

                                                        <div
                                                            class="bottom-content d-flex justify-content-between align-items-center">
                                                            <div class="blog-author d-flex align-items-center">
                                                                <img src="{{ asset('images/user') . '/' . $item->user->avatar }}"
                                                                    class="rounded-circle" alt="image">
                                                                <span><a
                                                                        href="blog-details.html">{{ $item->user->username }}</a></span>
                                                            </div>

                                                            <p>
                                                                <i class="bx bx-calendar"></i>{{ $a[0]->created_at->format('d/m/Y') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                @endforeach

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
