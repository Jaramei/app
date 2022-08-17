<div class="card">

    <div class="card-content">
        <span class="card-title">{{ trans('core::default.modules.packages.form.add') }} </span>

        <div class="row">

            <div class="input-field col s4">
                {{ Form::text('name',null) }}
                <label for="name" @if(Request::segment(5) == 'edit') class="active" @endif>Name</label>
            </div>

            <div class="input-field col s4">
                {{ Form::text('version',null) }}
                <label for="version" @if(Request::segment(5) == 'edit') class="active" @endif>Version</label>
            </div>

            <div class="input-field col s4">
                {{ Form::text('author',null) }}
                <label for="author" @if(Request::segment(5) == 'edit') class="active" @endif>Author</label>
            </div>

            <div class="input-field col s4">
                {{ Form::text('provider',null) }}
                <label for="author" @if(Request::segment(5) == 'edit') class="active" @endif>Provider</label>
            </div>

            <div class="input-field col s4">
                {{ Form::text('controller',null) }}
                <label for="url" @if(Request::segment(5) == 'edit') class="active" @endif>Controller</label>
            </div>

            <div class="input-field col s4">
                {{ Form::text('icon',null) }}
                <label for="icon" @if(Request::segment(5) == 'edit') class="active" @endif>Icon</label>
            </div>

            <div class="input-field col s12">
                {{ Form::text('description',null) }}
                <label for="url" @if(Request::segment(5) == 'edit') class="active" @endif>Description</label>
            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-content">
        <div class="card-title no-margin">{{ trans('core::default.modules.packages.translations') }} </div>
        <p>Tłumaczenia nazwy modułu w dostępnych językach wyświetlanej w pasku adresu strony w przeglądarce.</p>
        {{ Form::hidden('package_id',Request::segment(4)) }}
        <div class="row m-t-15">

            @foreach($languages as $lang)

                <div class="input-field col s2">

                  <input type="text" name="languages[{{$lang->id}}]" value="@if($model) @if(array_key_exists($lang->id,$translations)){{$translations[$lang->id]}}@endif @endif" />
                  <label for="url" @if(Request::segment(5) == 'edit') class="active" @endif>{{ $lang->name }}</label>

                </div>


            @endforeach

        </div>

    </div>

</div>

@if(!isset($model))

<div class="card">

    <div class="card-content">

        <div class="card-title no-margin">{{ trans('core::default.modules.packages.create-files.title') }}</div>
        <p>{{ trans('core::default.modules.packages.create-files.description') }}</p>
        <div class="switch m-t-20">
            <label>
                Off
                {!! Form::checkbox('createFiles','1') !!}
                <span class="lever"></span>
                On
            </label>
        </div>

    </div>


</div>

@endif

@if(isset($model) )

<div class="card">

    <div class="card-content">
        <div class="card-title">{{ trans('core::default.fields.active') }}</div>
        <div class="switch">
            <label>
                Off
                {!! Form::checkbox('status','1', isset($model) ? $model->status : true) !!}
                <span class="lever"></span>
                On
            </label>
        </div>
    </div>

</div>

@endif

<div class="card">

    <div class="card-content">

        {{ Form::submit($button,['class'=>'btn z-depth-0']) }}

    </div>

</div>
