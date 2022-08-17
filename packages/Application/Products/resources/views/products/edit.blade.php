@extends('core::partials.app')

@section('content')

  {!! Form::model($model, array('route' => array('products.update', $model->id), 'method'=>'PUT')) !!}

        @include('core::products.form',['button'=>trans('Products::default.buttons.edit')])

   {!!  Form::close() !!}

 @stop