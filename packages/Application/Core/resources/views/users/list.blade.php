<div class="row">

<div class="card">

    <div class="card-content">

        <div class="card-title">Lista użytkowników</div>
        @if(!$data->isEmpty())

            <div>

                <table class="responsive-table">

                    <thead>

                    <th>{{ trans('core::default.fields.name') }}</th>
                    <th>{{ trans('core::default.fields.e-mail') }}</th>
                    <th>{{ trans('core::default.fields.role') }}</th>
                    <th></th>
                    <th></th>

                    </thead>

                    <tbody>

                    @foreach($data as $d)

                        <tr>
                            <td><strong>{{$d->name}}</strong></td>
                            <td>{{$d->email}}</td>
                            <td>@foreach($d->roles as $role) {{$role->name}} @endforeach</td>
                            <td><a href="{{ route('users.delete',$d->id) }}"><i class="material-icons md-18">mode_delete</i> {{ trans('core::default.buttons.delete') }}</a></td>
                            <td><a href="{{ route('users.edit',$d->id) }}"><i class="material-icons md-18">mode_edit</i> {{ trans('core::default.buttons.edit') }}</a></td>

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