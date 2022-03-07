@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $inputHiddenID    = Form::hidden('id', @$item['id']);

    $elements = [
        [
            'label'   => Form::label('description', 'DescriptionName', $formLabelAttr),
            'element' => Form::text('description', @$item['description'], $formInputAttr )
        ],
        [
            'label'   => Form::label('email', 'Email', $formLabelAttr),
            'element' => Form::text('email', @$item['email'], $formInputAttr )
        ],
        [
            'label'   => Form::label('phone', 'Phone', $formLabelAttr),
            'element' => Form::text('phone', @$item['phone'],  $formInputAttr )
        ],
       
        [
            'label'   => Form::label('time', 'Time', $formLabelAttr),
            'element' => Form::text('time', @$item['time'],  $formInputAttr )
        ],
       
        [
            'label'   => Form::label('address', 'Address', $formLabelAttr),
            'element' => Form::text('address', @$item['address'],  $formInputAttr )
        ],
       
       
       
        [
            'label'   => Form::label('facebook', 'Facebook', $formLabelAttr),
            'element' => Form::text('facebook', @$item['facebook'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('twitter', 'Twitter', $formLabelAttr),
            'element' => Form::text('twitter', @$item['twitter'],  $formInputAttr )
        ],
       
        [
            'label'   => Form::label('instagram', 'Instagram', $formLabelAttr),
            'element' => Form::text('instagram', @$item['instagram'],  $formInputAttr )
        ],
       
        [
            'label'   => Form::label('pinterest', 'Pinterest', $formLabelAttr),
            'element' => Form::text('pinterest', @$item['pinterest'],  $formInputAttr )
        ],
       
      
        [
            'element' => $inputHiddenID . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
                        {!! FormTemplate::show($elements)  !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
