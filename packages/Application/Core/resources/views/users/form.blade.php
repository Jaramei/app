
    <div class="card">

        <div class="card-content">
            <span class="card-title">Create a user</span>

            <div class="row">
                <div class="input-field col s4">
                    {{ Form::text('name',null) }}
                    <label for="name" @if(Request::segment(5) == 'edit') class="active" @endif>Name</label>
                </div>
                <div class="input-field col s4">
                    {{ Form::text('email',null) }}
                    <label for="email" @if(Request::segment(5) == 'edit') class="active" @endif>E-mail</label>
                </div>
                <div class="input-field col s4">
                    {{ Form::password('password') }}
                    <label for="password" @if(Request::segment(5) == 'edit') class="active" @endif>Password</label>
                </div>

            </div>

        </div>

    </div>


    <div class="card">

        <div class="card-content">
            <span class="card-title no-margin">{{ trans('core::default.menu.roles') }} </span>

            <input type="hidden" name="roles" />

            <ul>

            @foreach ($roles as $role)

               <li class="inline m-r-10">
                    <input type="checkbox" id="{{$role->id}}" value="{{$role->id}}" name="roles[{{$role->id}}]"
                           @if(Request::segment(5) == 'edit') @if(in_array($role->id,$roles_user)) checked @endif  @endif>
                    <label for="{{$role->id}}">{{$role->name}}</label></li>

            @endforeach
            </ul>


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






