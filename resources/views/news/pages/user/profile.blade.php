@extends('news.main')

@php
    // dd(session('userInfo'));
@endphp


@section('content')
<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Your profile </h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
              
                <li>Your profile</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('images/page-banner.png') }}" alt="image">
    </div>
</div>


<div class="login-area ptb-100">
    <div class="container">
        <div class="login-form">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <h2>Info</h2>
            <form action="{{ route('home.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <a href="#">
                    <img width="100" src="{{ asset('images/user') }}/{{ session('userInfo')['avatar'] }}"
                        alt="{{-- {{ Auth::user()->name }} --}}"></a>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>Representative image </label>
                        <input type="file" name="profile_path" class="form-control-file">
                        @error('profile_path')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ session('userInfo')['id'] }}" class="form-control">
                    <input type="text" name="name" value="{{ session('userInfo')['fullname'] }}" class="form-control" placeholder="Name" >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="email" value="{{ session('userInfo')['email'] }}" class="form-control" placeholder="Email" >
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="phone" value="{{ session('userInfo')['phone'] }}" placeholder="Điện thoại" class="form-control">
                    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="facebook" value="{{ session('userInfo')['facebook'] }}" placeholder="Facebook" class="form-control">
                    @error('facebook')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="address" value="{{ session('userInfo')['address'] }}" placeholder="Địa chỉ" class="form-control">
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="avatar_current" value="{{ session('userInfo')['avatar'] }}" class="form-control">


                <button type="submit" class="default-btn">Update <span></span></button>
            </form>
        </div>
    </div>
</div>
@endsection