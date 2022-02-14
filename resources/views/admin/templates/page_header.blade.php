@php
    $pageTitle = 'Manage ' . ucfirst($controllerName); 
    $pageButton= sprintf('<a href="%s" class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>', route($controllerName));
    if($pageIndex == true) {
        $pageButton= sprintf('<a href="%s" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>', route($controllerName . '/form'));
    }
@endphp


<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{  $pageTitle }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $pageButton !!}
    </div>
</div>