@extends('admin.main')
@php
    use App\Helpers\Template as Template;
@endphp

@section('content')
     
    @include ('admin.templates.zvn_notify')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'List'])
                @include('admin.pages.message.list')
            </div>
        </div>
    </div>
    
    @if (count($items) > 0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.templates.x_title', ['title' => 'Pagination'])
                    @include('admin.templates.pagination')
                </div>
            </div>
        </div>
    @endif
@endsection
