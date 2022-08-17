<div class="card">

    <div class="card-content">

        <div class="card-title">{{ trans('core::default.modules.metadata.title') }}</div>

        <div class="row">

            <div class="input-field col s6"> {{ Form::text('title',null,['length'=>70]) }} <label for="title" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.metadata-title') }}</label> </div>
            <div class="input-field col s6"> {{ Form::text('keywords',null,['length'=>160]) }} <label for="keywords" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.keywords') }}</label></div>

            <div class="input-field col s12"> {{ Form::text('description',null,['length'=>160]) }} <label for="description" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.description') }}</label></div>

        </div>

    </div>

</div>