<div class="facilities-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h3>Facilities of Our Fido</h3>
            <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibendum auctor nisi elit
                consequat ipsum nec sagittis sem nibh id elit.</p>
        </div>

        <div class="row justify-content-center">



            @foreach ($facilities as $val)
                @php
                    $image = $val->image;
                    $name = $val->name;
                @endphp

                <div class="col-lg-4 col-md-6">
                    <div class="single-facilities">
                        <div class="image">
                            <img src="assets/images/facilities/{{ $image }}" alt="{{ $name }}">
                        </div>

                        <h3>{{ $name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
