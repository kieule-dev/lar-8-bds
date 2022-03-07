<div class="facilities-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h3>Facilities of Our Fido</h3>
            <p> If you're considering building a home, there are many questions you'll likely face along the way. Should you buy a house-and-land package, design a custom home or knock down an old house and rebuild? Find out where you should start. </p>
        </div>

        <div class="row justify-content-center">



            @foreach ($facilities as $val)
                @php
                    $image = $val->image;
                    $name = $val->name;
                @endphp

                <div class="col-lg-4 col-md-6">
                    <div class="single-facilities">
                        
                        <div class="image">  <img src="{{ asset("images/facilities/$image") }}" alt="{{ $name }}">  </div>
                        <h3>{{ $name }}</h3>
                        
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
