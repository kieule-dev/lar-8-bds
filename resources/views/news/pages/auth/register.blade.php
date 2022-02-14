@extends('news.main')

@section('content')
<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Register</h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                {{-- <li>Trang</li> --}}
                <li>register</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('assets/images/page-banner.png') }}" alt="image">
    </div>
</div>


<div class="register-area ptb-100">
    <div class="container">
        <div class="register-form">
            <h2>Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                     name="name" value="{{ old('name') }}" required autocomplete="name" 
                     autofocus class="form-control" placeholder="First and last name">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
                </div>
                <div class="form-group">
                    <input tid="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" required autocomplete="email" 
                    class="form-control" placeholder="Email address">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                     name="password" required autocomplete="new-password"
                      class="form-control" placeholder="Password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" 
                    name="password_confirmation" required autocomplete="new-password" 
                    class="form-control" placeholder="Password confirmation">
                    
                </div>
                <button type="submit" class="default-btn">Confirm <span></span></button>
            </form>
        </div>
    </div>
</div>
@endsection
