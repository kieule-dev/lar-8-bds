@extends('news.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
                <h2>Login</h2>
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    {{-- <li>Trang</li> --}}
                    <li>Login</li>
                </ul>
            </div>
        </div>
        <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
            <img src="{{ asset('assets/images/page-banner.png') }}" alt="image">
        </div>
    </div>
    <div class="login-area ptb-100">
        <div class="container">
            <div class="login-form">
                {{-- <div class="card fat"> --}}
                    <div class="card-body">
                        <h4 class="card-title kk_1231">Log in</h4>
                        @include ('news.templates.error')
                        @include ('news.templates.alert')
                        {!! Form::open([
                                            'method' => 'POST',
                                            'url' => route("$controllerName/postLogin"),
                                            'id' => 'auth-form',
                                        ]) !!}

                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control', 'required' => true, 'data-eye' => true]) !!}
                        </div>

                        <div class="form-group no-margin">
                            <button type="submit" class="btn btn-primary btn-block default-btn">
                                Confirm
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
