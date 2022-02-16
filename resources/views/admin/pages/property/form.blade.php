@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr     = config('zvn.template.form_input');
    $formInputAttrImgs = config('zvn.template.form_input_imgs');
    $formLabelAttr     = config('zvn.template.form_label');

    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
    $typeValue        = ['default' => 'Select type', 'apartment' => config('zvn.template.type.apartment.name'), 'house' => config('zvn.template.type.house.name')];
    $purposeValue     = ['default' => 'Select purpose', 'sell' => config('zvn.template.purpose.sell.name'), 'lease' => config('zvn.template.purpose.lease.name')];

    $inputHiddenID          = Form::hidden('id', @$item['id']);
    $inputHiddenThumb       = Form::hidden('thumb_current', @$item['image']);
    $inputHiddenThumbDesign = Form::hidden('thumb_design', @$item['design']);
    $inputHiddenThumbAlbum  = Form::hidden('thumb_album', @$item['album']);

  

  

    $elements = [
        [
            'label'   => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', @$item['name'], $formInputAttr )
        ],
        [
            'label'   => Form::label('type', 'Type', $formLabelAttr),
            'element' => Form::select('type', $typeValue, @$item['type'], $formInputAttr)
        ],
        [
            'label'   => Form::label('purpose', 'Purpose', $formLabelAttr),
            'element' => Form::select('purpose', $purposeValue, @$item['purpose'], $formInputAttr)
        ],
       
        [
            'label'   => Form::label('description', 'Description', $formLabelAttr),
            'element' => Form::textarea('description', @$item['description'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('bed', 'Bed', $formLabelAttr),
            'element' => Form::text('bed', @$item['bed'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('bath', 'Bath', $formLabelAttr),
            'element' => Form::text('bath', @$item['bath'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('price', 'Price', $formLabelAttr),
            'element' => Form::text('price', @$item['price'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('area', 'Area', $formLabelAttr),
            'element' => Form::text('area', @$item['area'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('city', 'City', $formLabelAttr),
            'element' => Form::text('city', @$item['city'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('address', 'Address', $formLabelAttr),
            'element' => Form::text('address', @$item['address'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('video', 'Video', $formLabelAttr),
            'element' => Form::text('video', @$item['video'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
       
        [
            'label'   => Form::label('image', 'Image', $formLabelAttr),
            'element' => Form::file('image', $formInputAttr ),
            'thumb'   => (!empty(@$item['id'])) ? Template::showItemThumb($controllerName, @$item['image'], @$item['name']) : null ,
            'type'    => "thumb"
        ],
        [
            'label'   => Form::label('design', 'Design', $formLabelAttr),
            'element' => Form::file('design', $formInputAttr ),
            'thumb'   => (!empty(@$item['id'])) ? Template::showItemThumb($controllerName, @$item['design'], @$item['name']) : null ,
            'type'    => "thumb"
        ],
        [
            'label'   => Form::label('album', 'Album', $formLabelAttr),
            'element' => Form::file('album[]', $formInputAttrImgs),
            'thumb'   => (!empty(@$item['id'])) ? Template::showItemThumbs($controllerName, @$item['album'], @$item['name']) : null ,
            'type'    => "thumb"
        ],
        [
            'element' => $inputHiddenID . $inputHiddenThumb . $inputHiddenThumbDesign. $inputHiddenThumbAlbum. Form::submit('Save', ['class'=>'btn btn-success']),
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
                    
                    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>          
                    <script> var editor = CKEDITOR.replace('description');  </script>
                </div>
            </div>
        </div>
    


@endsection
