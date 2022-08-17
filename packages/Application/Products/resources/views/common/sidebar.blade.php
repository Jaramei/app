 <li class="no-paddding active">
        <div class="collapsible-header">
            <a href="#">
                <i class="material-icons">{{ ($package->icon) }}</i>{{ trans(($package->name).'::default.name')}}
            </a>
        </div>
        <div class="collapsible-body">
            <ul>
                <li><a href="{{route('products.categories.index')}}">{{ trans(($package->name).'::default.categories.name')}}</a></li>
                <li><a href="{{route(lcfirst($package->name).'.index')}}">{{ trans(($package->name).'::default.name')}}</a></li>

            </ul>
        </div>
 </li>