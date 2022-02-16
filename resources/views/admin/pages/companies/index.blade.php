@extends('admin.main')
@php
    use App\Helpers\Template as Template;
    $xhtmlButtonFilter = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status'], $params['search']);
    $xhtmlAreaSeach    = Template::showAreaSearch($controllerName, $params['search']);
@endphp

@section('content')
    
    @include ('admin.templates.page_header', ['pageIndex' => true])
    @include ('admin.templates.zvn_notify')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Filter'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-7">{!! $xhtmlButtonFilter !!}</div>
                        <div class="col-md-5">{!! $xhtmlAreaSeach !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'List'])
                @include('admin.pages.companies.list')
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
