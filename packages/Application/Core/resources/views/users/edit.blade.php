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


<div class="card blue-grey">
    <div class="card-content white-text">
        <span class="card-title white-text no-margin"><h5>{{$model->name}}</h5></span>
        <p>{{$model->roles()->first()->name}}</p>
    </div>
</div>


    {!! Form::model($model, array('route' => array('users.update', $model->id), 'method'=>'PUT')) !!}

    @include('core::users.form',['button'=>trans('core::default.buttons.users.edit')])

    {!!  Form::close() !!}

@endsection
