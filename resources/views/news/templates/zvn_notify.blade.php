

@if (session('zvn_notify'))
<div class="alert alert-success " role="alert">
    <strong>{{ session('zvn_notify') }}</strong>
    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> --}}
</div>
@endif


