
@section('after-styles')

    {!! Minify::stylesheet(array('/css/packages/core/jquery.dynatable.css'))->withFullUrl() !!}

@stop


<div class="card">

    <div class="card-content">

        <div class="col s12">

            <ul class="tabs">
                <li class="tab col s3 all"><a href="#all">Wszystkie</a></li>
                @foreach($languages as $lang)
                    <li class="tab col s3"><a href="#{{$lang->slug}}">{{$lang->slug}}</a></li>
                @endforeach

            </ul>

        </div>

    </div>

</div>


<div class="row">


    <div class="card">

        <div class="card-content">

            <div class="card-title">{{ trans('core::default.modules.languages.list') }}</div>
            @if(!$data->isEmpty())

                <div>

                    <table id="dataTable" class="responsive-table ">

                        <thead class="blue-grey darken-1">

                        <th>{{ trans('core::default.fields.name') }}</th>
                        <th data-dynatable-column="lang">{{ trans('core::default.fields.lang') }}</th>
                        <th>{{ trans('core::default.fields.status') }}</th>
                        <th>{{ trans('core::default.fields.action') }}</th>
                        <th></th>

                        </thead>

                        <tbody>

                        @foreach($data as $d)

                            <tr>
                                <td><strong>{{$d->name}}</strong></td>
                                <td>{{ strtoupper($d->lang->slug) }}</td>
                                <td>@if($d->active)<button class="btn green z-depth-0">{{trans('core::default.buttons.active')}}</button>@else<button class="btn red z-depth-0">{{trans('core::default.buttons.deactivate')}}</button>@endif </td>
                                <td><a href="{{ route('products.categories.destroy',$d->id) }}"><i class="material-icons md-18">mode_delete</i> {{ trans('core::default.buttons.delete') }}</a></td>
                                <td><a href="{{ route('products.categories.edit',$d->id) }}"><i class="material-icons md-18">mode_edit</i> {{ trans('core::default.buttons.edit') }}</a></td>

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

        $(document).ready(function() {

            var dynatable = $('#dataTable').dynatable({
                dataset: {
                    perPageDefault: 5,
                    perPageOptions: [5,20],


                },inputs: {

                    perPageText:''

                }
            }).data('dynatable');

            $('.tab').click(function(e) {

                var value = $(e.target).text().toUpperCase();
                    dynatable.queries.add("lang",value);
                    dynatable.process();
            });


            $(document).on('click', '.all', function () {
                dynatable.queries.remove("lang");
                dynatable.process();
            });



        });

    </script>


@stop