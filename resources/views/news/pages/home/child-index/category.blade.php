

<div class="case-study-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h3>Category</h3>
            <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibendum auctor nisi elit
                consequat ipsum nec sagittis sem nibh id elit.</p>
        </div>
     
        <div class="case-study-slides owl-carousel owl-theme owl-loaded owl-drag">

            <div class="owl-stage-outer owl-height" style="height: 342.273px;">
                <div class="owl-stage"
                    style="transform: translate3d(-2652px, 0px, 0px); transition: all 0.5s ease 0s; width: 5304px;">

                    @foreach ($category as $key => $item)
                        @php
                           
                            $name = $item->name;
                            $key = $key +1;
                        @endphp


                        <div class="owl-item active " style="width: 412px; margin-right: 30px;">
                            <div class="case-study-item ">
                                <div class="image">
                                    <a href="{{route('property.category', ['name'=> $item->name ])}}">
                                        <img src="{{asset('images/case-study/case-study-').$key.'.jpg' }}" alt="image">
                                    </a>
                                </div>

                                <div class="content">
                                    <h3>
                                        <a href="{{route('property.category', ['name'=> $item->name ])}}">{{ $name }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="bx bx-left-arrow-alt"></i></button>
                <button type="button" role="presentation" class="owl-next"><i class="bx bx-right-arrow-alt"></i></button></div>
            <div class="owl-dots disabled"></div>
        </div>
    </div>
</div>
