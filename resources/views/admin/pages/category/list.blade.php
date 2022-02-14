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
                    <th class="column-title">Category Name</th>
                    <th class="column-title">Slug</th> 
                    <th class="column-title">Status</th>
                    {{-- <th class="column-title">Hiện thị Home</th>--}}
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
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']);
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created_at']);
                            $modifiedHistory = Template::showItemHistory($val['updated_by'], $val['updated_at']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="25%">{!! $name !!}</td>
                            <td>{!! $slug !!}</td>
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
           