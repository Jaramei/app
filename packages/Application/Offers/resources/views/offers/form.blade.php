
        <div class="card">

            <div class="card-content">

                <div class="card-title">{{ trans($trans)}}</div>

                <div class="row">

                    <div class="input-field col s4">
                        {{ Form::text('name',null) }}
                        <label for="name" @if(Request::segment(5) == 'edit') class="active" @endif>Name</label>
                    </div>

                    <div class="input-field col s4">
                        {{ Form::select('parent_id',$offerCategory,null, ['placeholder' => 'Please select category','class' => 'form-control border-input']) }}
                    </div>

                    <div class="file-field input-field col s4">
                        <div class="btn z-depth-0"><span>File</span>
                         {{ Form::file('upload') }}</div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="@if(!Request::segment(4) == 'edit') Upload one or more files @else {{ $model->photo }} @endif">
                            </div>

                    </div>

            </div>

        </div>

    </div>


            {{ Form::textarea('body',null,['class'=>'trumbowyg']) }}


   @include('core::common.form.meta')


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




