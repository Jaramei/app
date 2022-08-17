@section('after-styles')

    {!! Minify::stylesheet(array('/css/packages/core/jquery.dynatable.css'))->withFullUrl() !!}

@stop


<div class="row">

    <div class="card">

        <div class="card-content">

            <div class="card-title">{{ trans('core::default.modules.languages.list') }}</div>
            @if(!$data->isEmpty())

                <div>

                    <table id="dataTable" class="responsive-table ">

                        <thead class="blue-grey darken-1">

                            <th>{{ trans('core::default.fields.name') }}</th>
                            <th>{{ trans('core::default.fields.slug') }}</th>
                            <th>{{ trans('core::default.fields.status') }}</th>
                            <th>{{ trans('core::default.fields.action') }}</th>
                            <th></th>

                        </thead>

                        <tbody>

                        @foreach($data as $d)

                            <tr>
                                <td><strong>{{$d->name}}</strong></td>
                                <td>{{$d->slug}}</td>
                                <td>@if($d->active)<button class="btn green z-depth-0">{{trans('core::default.buttons.active')}}</button>@else<button class="btn red z-depth-0">{{trans('core::default.buttons.deactivate')}}</button>@endif </td>
                                <td><a href="{{ route('languages.delete',$d->id) }}"><i class="material-icons md-18">mode_delete</i> {{ trans('core::default.buttons.delete') }}</a></td>
                                <td><a href="{{ route('languages.edit',$d->id) }}"><i class="material-icons md-18">mode_edit</i> {{ trans('core::default.buttons.edit') }}</a></td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                $result is empty

            @endif

        </div>


    </div>

</div>

@section('after-scripts')

    {!! Minify::javascript(asset('js/packages/core/jquery.dynatable.js')) !!}


    <script type="text/javascript">

        $( document ).ready(function() {

            $('#dataTable').dynatable({
                dataset:{
                    perPageDefault: 5,
                    perPageOptions: [10,20,50]
                }

            });

        });

    </script>


@stop