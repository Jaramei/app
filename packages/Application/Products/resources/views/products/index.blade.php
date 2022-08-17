@extends('core::partials.app')

@section('content')

    @include('Products::common.header',['name'=>'Products::default.name','description'=>'Products::default.description'])

    @include('core::common.messages',['errors'=>$errors])

    {{Form::open(['files' => true])}}

        @include('Products::products.form',['button'=>trans('Products::default.buttons.add')])

    {{Form::close()}}


@stop