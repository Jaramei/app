@extends('core::partials.app')

@section('content')

Dashboard


@if(auth()->user()->hasRole('Developer'))

    You are Developer Role.

    @endif

@endsection