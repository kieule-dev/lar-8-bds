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
                    <th class="column-title">Article Info</th>
                    <th class="column-title">Slug</th>
                    <th class="column-title">Category</th>
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
                            $slug            = $val['slug'];
                            $view            = $val['view'];
                            $comment         = 2;
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $thumb           = Template::showItemThumb1($controllerName, $val['image'], $val['name'], 250, 120);;
                            // $description     = Hightlight::show($val['short_description'], $params['search'], 'short_description');
                            $description     = substr($val['short_description'], 0, 100); 
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']);
                            $type            = Template::showItemSelect1($controllerName, $id, $itemsCategory, 'type', $val['category_name']);
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created_at']);
                            $modifiedHistory = Template::showItemHistory($val['updated_by'], $val['updated_at']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="20%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Description:</strong> {!! $description !!} ...</p>
                                <p>{!! $thumb !!}</p>
                            </td>
                            <td>{!! $slug   !!}</td>
                            <td>{!! $type   !!}</td>
                            <td>{!! $view   !!}</td>
                            <td>{!! $comment   !!}</td>
                            <td>{!! $status !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
           