@if (session('news_notify'))
    <div class="alert alert-danger " role="alert">
        <strong>{{ session('news_notify') }}</strong>
        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> --}}
    </div>
@endif