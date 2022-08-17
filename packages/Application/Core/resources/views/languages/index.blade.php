@extends('core::partials.app')


@section('content')

    <div class="card">

        <div class="card-content">

            <div class="col s8">
                <h5 class="no-margin"><strong>{{ trans('core::default.menu.languages') }}</strong></h5> <h6>{{trans('core::default.header.description.languages')}}</h6>
            </div>

        </div>

    </div>

    @include('core::languages.list',['data'=>$data])

    @include('core::common.messages',['errors'=>$errors])


    {{Form::open(['files' => true])}}

         @include('core::languages.form',['button'=>trans('core::default.buttons.add')])

    {{Form::close()}}

@endsection
