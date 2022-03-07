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
                    <th class="column-title">Description</th>
                    <th class="column-title">Email</th>
                    <th class="column-title">Phone</th>
                    <th class="column-title">Time</th>
                    <th class="column-title">Address</th>
                    <th class="column-title">Social</th>        
                    <th class="column-title">Created</th>
                    <th class="column-title">Modified</th>
                    <th class="column-title">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index       = $key + 1;
                            $class       = ($index % 2 == 0) ? "even" : "odd";
                            $id          = $val['id'];
                            $email       = $val['email'];
                            $phone       = $val['phone'];
                            $address     = $val['address'];
                            $time        = $val['time'];
                            $name        = Hightlight::show($val['name'], $params['search'], 'name');
                            $description = Hightlight::show($val['description'], $params['search'], 'description');
                            $facebook    = Hightlight::show($val['facebook'], $params['search'],'facebook');
                            $twitter     = Hightlight::show($val['twitter'], $params['search'],'twitter');
                            $instagram   = Hightlight::show($val['instagram'], $params['search'],'instagram');
                            $pinterest   = Hightlight::show($val['pinterest'], $params['search'],'pinterest');

                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created_at']);
                            $modifiedHistory = Template::showItemHistory($val['updated_by'], $val['updated_at']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="20%">{{ $description }}</td>
                            <td >{{ $email }}</td>
                            <td >{{ $phone }}</td>
                            <td >{{ $time }}</td>
                            <td >{{ $address}}</td>
                            <td width="20%">
                                <p><strong>Facebook:</strong> {!! $facebook !!}</p>
                                <p><strong>Twitter:</strong> {!! $twitter!!}</p>
                                <p><strong>Instagram:</strong> {!! $instagram !!}</p>
                                <p><strong>Pinterest:</strong> {!! $pinterest !!}</p>
                            </td>
                            <td>{!! $createdHistory !!}</td>
                            <td class="modified-{{$id}}">{!! $modifiedHistory !!}</td>
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
           