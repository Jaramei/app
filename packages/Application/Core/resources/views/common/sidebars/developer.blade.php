@if(auth()->user()->hasRole('Developer'))

    <li class="no-paddding">
        <div class="collapsible-header @if(Request::segment(3) == 'users') active @endif">
            <a href="{{route('users.index')}}">
                <i class="material-icons">navigate_next</i>{{ trans('core::default.menu.users') }}
            </a>
        </div>
    </li>

    <li class="no-paddding">
        <div class="collapsible-header @if(Request::segment(3) == 'languages') active @endif">
            <a href="{{route('languages.index')}}">
                <i class="material-icons">navigate_next</i>{{ trans('core::default.menu.languages') }}
            </a>
        </div>
    </li>

    <li class="no-paddding">
        <div class="collapsible-header @if(Request::segment(3) == 'packages') active @endif">
            <a href="{{route('packages.index')}}">
                <i class="material-icons">navigate_next</i>{{ trans('core::default.menu.packages') }}
            </a>
        </div>
    </li>

@endif