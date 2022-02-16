@php
    // dd(Session::get('userInfo'));
@endphp
<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('assets/images/black-logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('assets/images/black-logo.png') }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('property.index')}}" class="nav-link {{  Request::is('home/property') ? 'active' : ''  }}">
                                Property
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('news')}}" class="nav-link {{  Request::is('home/news') ? 'active' : ''  }}">
                                News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link {{  Request::is('home/contact') ? 'active' : ''  }}">Contact</a>
                        </li>
                    </ul>
                    <div class="others-options d-flex align-items-center">                            
                        <div class="option-item">
                            <a href="{{ route('user.property') }}" class="default-btn">Post + <span></span></a>
                        </div>
                        <div class="option-item">
                            <div class="user-box">
                                @if(Route::has('auth/login'))
                                    @if (Session::get('userInfo') != null)    
                                      
                                        @if (true)                                        
                                            <a href="{{ route('dashboard') }}">
                                                <i class='bx bxs-dashboard'></i>
                                            </a>
                                        @else
                                            <ul class="navbar-nav m-auto">
                                                <li class="nav-item">
                                                    <a href="#">
                                                        <i class='bx bxs-dashboard'></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="nav-item">
                                                            <a href="{{-- {{ route('user.dashboard') }} --}}" class="nav-link">Tổng quan</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="{{-- {{ route('user.profile') }} --}}" class="nav-link">Hồ sơ</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="{{-- {{ route('user.changepwd') }} --}}" class="nav-link">Đổi mật khẩu</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="{{-- {{ route('logout') }} --}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                                            class="nav-link">Đăng xuất</a>
                                                        </li>
                                                        <form action="{{-- {{ route('logout') }} --}}" id="logout-form" method="post">
                                                            @csrf
                                                        </form>
                                                    </ul>
                                                </li>
                                            </ul>
                                        @endif
                                    @else
                                        <a href="{{ route('auth/login') }}"><i class='bx bxs-user'></i></a>
                                        <a href="{{ route('register') }}"><i class='bx bxs-user-plus'></i></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>
            <div class="container">
                <div class="option-inner">
                    <div class="others-options d-flex align-items-center">
                        <div class="option-item">
                            <a href="{{-- {{ route('user.property') }} --}}" class="default-btn">Post + <span></span></a>
                        </div>
                        <div class="option-item">                                
                            <div class="user-box">
                                @if(Route::has('login'))
                                @auth
                                    @isset (Auth::user()->role->role)                                        
                                        <a href="{{ route('dashboard') }}">
                                            <i class='bx bxs-dashboard'></i>
                                        </a>
                                    @else
                                        <ul class="navbar-nav m-auto">
                                            <li class="nav-item">
                                                <a href="#">
                                                    <i class='bx bxs-dashboard'></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="nav-item">
                                                        <a href="{{ route('user.dashboard') }}" class="nav-link">Tổng quan</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('user.profile') }}" class="nav-link">Hồ sơ</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('user.changepwd') }}" class="nav-link">Đổi mật khẩu</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                                        class="nav-link">Đăng xuất</a>
                                                    </li>
                                                    <form action="{{ route('logout') }}" id="logout-form" method="post">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </li>
                                        </ul>
                                    @endisset
                                @else
                                    <a href="{{ route('login') }}"><i class='bx bxs-user'></i></a>
                                    <a href="{{ route('register') }}"><i class='bx bxs-user-plus'></i></a>
                                @endif
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>