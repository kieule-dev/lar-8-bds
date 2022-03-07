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
                    <th class="column-title"> Name</th>
                    <th class="column-title">Phone</th>
                    <th class="column-title">Message</th>
                    <th class="column-title">Slug Property</th>
                    <th class="column-title">Created</th>
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
                            $name            = $val['name'];
                            $phone           = $val['phone'];
                            $message         = $val['message']; 
                            $property         = $val['slug_properties']; 
                            $createdHistory  = Template::showItemHistory1( $val['created_at']);                         
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td>{!! $name !!} </td>
                            <td>{!! $phone !!} </td>
                            <td>{!! $message !!} </td>
                            <td>{!! $property !!} </td>
                          
                            <td>{!! $createdHistory !!}</td>
                         
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
           