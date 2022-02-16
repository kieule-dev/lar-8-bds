<div class="partner-area ptb-100">
    <div class="container">

        <div class="partner-title">
            <h3>We Only Work With The Best Companies Around The Globe</h3>
        </div>

        <ul class="partner-custom-row">

            @foreach ($companies as $val)
                @php
                    $image = $val->image;
                    $name = $val->name;
                @endphp

                <li>
                    <img src='{{asset("images/companies/$image")}}' alt="{{$name}}">
                </li>
            @endforeach

        </ul>
    </div>
</div>
