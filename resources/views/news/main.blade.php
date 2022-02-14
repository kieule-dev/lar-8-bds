
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   @include('news.elements.head')
</head>

<body>


	@include('news.elements.navbar-area')
  
    @yield('content')

	@include('news.elements.footer')
    

	@include('news.elements.script')
	@stack('scripts')
</body>

</html>