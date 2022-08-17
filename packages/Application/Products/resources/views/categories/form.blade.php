<div class="card">

        <div class="card-content">

            <div class="col s12">

                <ul class="tabs">

                     @foreach($languages as $lang)
                            <li class="tab col s3"><a href="#{{$lang->slug}}">{{$lang->slug}}</a></li>
                     @endforeach

                </ul>

            </div>

        </div>

</div>

            @foreach($languages as $lang)

                <div id="{{$lang->slug}}">

                    <div class="card">

                        <div class="card-content">

                            <div class="card-title">{{ $lang->name }}</div>

                            <div class="row">

                                <div class="input-field col s6">
                                    {{ Form::text('data['.$lang->id.'][name]',null) }}
                                    <label for="name">Name</label>
                                </div>

                                <div class="file-field input-field col s6">

                                    <div class="btn z-depth-0"><span>File</span>
                                        {{ Form::file('data['.$lang->id.'][photo]') }}</div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="@if(!Request::segment(4) == 'edit') Upload one or more files @else {{ $model->photo }} @endif">
                                    </div>

                                </div>

                            </div>

                     </div>

                </div>

                 <div class="card">

                        <div class="card-content">

                            <div class="card-title">{{ trans('core::default.modules.metadata.title') }} {{ $lang->slug }}</div>

                            <div class="row">

                                <div class="input-field col s6"> {{ Form::text('data['.$lang->id.'][title]',null,['length'=>70]) }} <label for="title" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.metadata-title') }}</label> </div>
                                <div class="input-field col s6"> {{ Form::text('data['.$lang->id.'][keywords]',null,['length'=>160]) }} <label for="keywords" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.keywords') }}</label></div>
                                <div class="input-field col s12">{{ Form::text('data['.$lang->id.'][description]',null,['length'=>160]) }} <label for="description" @if(Request::segment(5) == 'edit') class="active" @endif>{{ trans('core::default.fields.description') }}</label></div>

                            </div>

                        </div>

                  </div>


                    {{ Form::textarea('data['.$lang->id.'][body]',null,['class'=>'trumbowyg']) }}


                    <div class="card">
                        <div class="card-content">
                            <div class="card-title">{{ trans('core::default.fields.active') }}</div>
                            <div class="switch">
                                <label>
                                    Off
                                    {!! Form::checkbox('data['.$lang->id.'][active]',1, isset($model) ? $model->active : true) !!}
                                    <span class="lever"></span>
                                    On
                                </label>
                            </div>


                        </div>


                </div>

                </div>

            @endforeach





    <div class="card">

        <div class="card-content">

            {{ Form::submit($button,['class'=>'btn z-depth-0']) }}

        </div>

    </div>

