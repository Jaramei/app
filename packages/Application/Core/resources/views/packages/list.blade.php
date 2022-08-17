<div class="row">

    <div class="card">

        <div class="card-content">

            <div class="card-title">{{ trans('core::default.modules.packages.list') }}</div>
            @if(!$data->isEmpty())

                <div>

                    <table class="responsive-table">

                        <thead>

                        <th>{{ trans('core::default.fields.name') }}</th>
                        <th>{{ trans('core::default.fields.version') }}</th>
                        <th>{{ trans('core::default.fields.provider') }}</th>
                        <th>{{ trans('core::default.fields.status') }}</th>
                        <th></th>
                        <th></th>

                        </thead>

                        <tbody>

                        @foreach($data as $d)

                            <tr>
                                <td><strong>{{$d->name}}</strong></td>
                                <td>{{$d->version}}</td>
                                <td>{{$d->provider}}</td>
                                <td>@if($d->status)<button class="btn green z-depth-0">{{trans('core::default.buttons.active')}}</button>@else<button class="btn red z-depth-0">{{trans('core::default.buttons.deactivate')}}</button>@endif </td>
                                <td><a href="{{ route('packages.delete',$d->id) }}"><i class="material-icons md-18">mode_delete</i> {{ trans('core::default.buttons.delete') }}</a></td>
                                <td><a href="{{ route('packages.edit',$d->id) }}"><i class="material-icons md-18">mode_edit</i> {{ trans('core::default.buttons.edit') }}</a></td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

              <span class="uppercase">Result is empty</span>

            @endif

        </div>


    </div>

</div>

