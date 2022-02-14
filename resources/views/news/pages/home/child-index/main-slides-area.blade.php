<div class="main-slides-area">
    <div class="home-slides owl-carousel owl-theme">

        @foreach ($slider as $item)
            <img src='{{ asset("images/slider/$item->thumb") }}' alt="{{ $item->name }}">
        @endforeach

    </div>
    <div class="main-slides-content">
        <div class="container">
            <div class="content">
                <h1 class="wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
                    To each their home.℠ <br />
                    <h3 class='color-white'>Let’s find a home that’s perfect for you </h3>
                </h1>
            </div>
            <div class="tab slides-list-tab wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                <div class="tab_content">
                    <div class="tabs_item">
                        <div class="main-slides-search-form">
                            <form action="{{-- {{ route('apartment.search') } --}}}" method="GET">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label><i class='bx bx-search'></i></label>
                                            <input type="text" class="form-control" required name="keyword"
                                                placeholder="Enter keywords">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label><i class='bx bxs-map'></i></label>
                                            <div class="select-box">
                                                <select name="city">
                                                    <option value="">Location</option>
                                                    @foreach ($city as $index => $item)


                                                        <option value="{{ $item[0]['city_slug'] }}">
                                                            {{ $item[0]['city'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label><i class='bx bx-home'></i></label>
                                            <div class="select-box">
                                                <select name="type">
                                                    <option value="">Type of apartment </option>
                                                    @foreach ($type as $item)

                                                        <option value="{{ $item->type }}">{{ $item->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button type="submit"><i class='bx bx-search'></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>