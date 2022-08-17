@extends('core::partials.app')


@section('content')

    <div class="card">

        <div class="card-content">

            <div class="col s8">
                <h5 class="no-margin"><strong>{{ trans('core::default.menu.users') }}</strong></h5> <h6>{{trans('core::default.header.description.users')}}</h6>
            </div>

        </div>

    </div>

    @include('core::users.list',['data'=>$data])

    @include('core::common.messages',['errors'=>$errors])


    {{Form::open(['files' => true])}}

    @include('core::users.form',['button'=>trans('core::default.buttons.users.add')])

    {{Form::close()}}

@endsection
