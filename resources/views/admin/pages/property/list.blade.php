@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Property Info</th>
                    <th class="column-title">Style</th>
                    <th class="column-title">Purpose</th>
                    <th class="column-title">View</th>
                    <th class="column-title">Comment</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">Created</th>
                    <th class="column-title">Modified</th>
                    <th class="column-title">Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php


                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $type            = Hightlight::show($val['type'], $params['search'], 'type');
                            $purpose         = Hightlight::show($val['purpose'], $params['search'], 'purpose');
                            $view            = $val['view'];
                            $thumb           = Template::showItemThumb1($controllerName, $val['image'], $val['name']);
                            $comment         = 0;
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']);
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created_at']);
                            $modifiedHistory = Template::showItemHistory($val['updated_by'], $val['updated_at']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td >
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p>{!! $thumb !!}</p>
                            </td>
                            <td>{!! $type !!}</td>
                            <td>{!!  $purpose !!}</td>
                            <td>{!!  $view !!}</td>
                            <td>{!!  $comment !!}</td>
                            <td>{!! $status !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 10])
                @endif



            </tbody>
        </table>
    </div>
</div>
           