@extends('core::partials.app')

@section('content')

    @include('core::common.header')

    @include('core::languages.list',['data'=>$data])

    <div class="card blue-grey">
        <div class="card-content white-text">
            <span class="card-title white-text no-margin"><h5>{{$model->name}}</h5></span>

        </div>
    </div>

    @include('core::common.messages',['errors'=>$errors])

    {!! Form::model($model, array('route' => array('languages.update', $model->id), 'method'=>'PUT')) !!}

    @include('core::languages.form',['button'=>trans('core::default.buttons.edit')])

    {{Form::close()}}

@endsection