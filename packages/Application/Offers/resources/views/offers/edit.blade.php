@extends('core::partials.app')

@section('content')

    <div class="card blue-grey">
        <div class="card-content white-text">
            <div class="row">

                <div class="col s8">
                    <a href="{{ route(Request::segment(2).'.index') }}" class="white-text"><i class="material-icons md-48 left m-t-15">keyboard_arrow_left</i></a>
                    <span class="card-title white-text no-margin"><h5><strong>{{$model->name}}</strong></h5></span>
                    <p class="white-text lighten-3">@if($model->parent_id) {{ $model->parent->name }} @endif</p>

                </div>

                <div class="col s2 p-t-10"><p>{{ trans('core::default.layout.last_updated')}} <br/> {{$model->updated_at}} </p></div>
                <div class="col s2 p-t-10"><p>{{ trans('core::default.layout.user')}} <br/> {{$model->user->name}}</p></div>

            </div>

        </div>
    </div>

    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a href="#tab-1">OPIS</a></li>
            <li class="tab col s3"><a href="#tab-2">MEDIA</a></li>
        </ul>
    </div>
    <div id="tab-1" class="col s12">

    @include('core::common.messages',['errors'=>$errors])

    {!! Form::model($model, array('route' => array('offers.update', $model->id), 'method'=>'PUT','files'=>true)) !!}

        @include('Offers::offers.form',['button'=>trans('Offers::default.buttons.edit'),'trans'=>'Offers::default.titles.edit'])

   {!!  Form::close() !!}


    </div>

    <div id="tab-2" class="col s12">Test 2</div>

 @stop