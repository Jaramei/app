<li class="no-paddding">
    <div class="collapsible-header @if(Request::segment(2) == lcfirst($package->name)) active @endif"">
        <a href="{{route(lcfirst($package->name).'.index')}}">
            <i class="material-icons">{{ ($package->icon) }}</i>{{ trans(($package->name).'::default.name')}}
        </a>
    </div>
</li>