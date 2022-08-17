@extends('core::partials.app')


@section('content')


    @include('core::common.header')

    @include('core::packages.list',['data'=>$data])

    @include('core::common.messages',['errors'=>$errors])

    {{Form::open(['files' => true])}}

        @include('core::packages.form',['button'=>trans('core::default.buttons.add')])

    {{Form::close()}}

@endsection