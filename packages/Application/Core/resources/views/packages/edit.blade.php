@extends('core::partials.app')

@section('content')

    <div class="card blue-grey">
        <div class="card-content white-text">
            <a href="{{ route(Request::segment(3).'.index') }}" class="white-text"><i class="material-icons md-48 left m-t-15">keyboard_arrow_left</i></a>
            <span class="card-title white-text no-margin"><h5>{{$model->name}}</h5></span>
            <h6>{{trans('core::default.fields.version')}}: {{$model->version}}</h6>
        </div>
    </div>

    @include('core::common.messages',['errors'=>$errors])

        {!! Form::model($model, array('route' => array('packages.update', $model->id), 'method'=>'PUT')) !!}

            @include('core::packages.form',['button'=>trans('core::default.buttons.edit')])

        {{Form::close()}}

@endsection