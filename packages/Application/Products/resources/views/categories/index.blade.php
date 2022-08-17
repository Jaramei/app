@extends('core::partials.app')

@section('content')

    @include('Products::common.header',['name'=>'Products::default.categories.name','description'=>'Products::default.categories.description'])

    @include('core::common.messages',['errors'=>$errors])

    @include('Products::categories.list',['data'=>$data])

    {{Form::open(['files' => true])}}

        @include('Products::categories.form',['button'=>trans('Products::default.buttons.add')])

    {{Form::close()}}


@stop