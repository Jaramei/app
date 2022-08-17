<div class="card">

        <div class="card-content">
            <span class="card-title">{{ trans('core::default.modules.languages.form.add') }}</span>

            <div class="row">
                <div class="input-field col s6">
                    {{ Form::text('name',null) }}
                    <label for="name" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.name') }}</label>
                </div>
                <div class="input-field col s6">
                    {{ Form::text('slug',null) }}
                    <label for="slug" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.slug') }}</label>
                </div>


        </div>

    </div>

</div>

<div class="card">
    <div class="card-content">
        <div class="card-title">{{ trans('core::default.fields.active') }}</div>
        <div class="switch">
            <label>
                Off
                {!! Form::checkbox('active',1, isset($model) ? $model->active : true) !!}
                <span class="lever"></span>
                On
            </label>
        </div>


    </div>

</div>


<div class="card">

    <div class="card-content">

        {{ Form::submit($button,['class'=>'btn z-depth-0']) }}

    </div>

</div>
