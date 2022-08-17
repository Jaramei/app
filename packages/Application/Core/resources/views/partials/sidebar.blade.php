<aside id="slide-out" class="side-nav fixed">

    <div class="side-nav-wrapper">

        <div class="sidebar-profile">

          <div class="sidebar-profile-image"></div>

          <div class="sidebar-profile-info">
                <a href="javascript:void(0);" class="account-settings-link">
                    <p><img src="{{url('/img/users/'.Auth::user()->icon)}}" class="center-block"/></p>
                    <h5 class="m-t-30 text-center">{{ Auth::user()->name }}</h5>
                    <span>{{ Auth::user()->roles->first()->name }}<i class="material-icons right">arrow_drop_down</i></span>
                </a>
            </div>
        </div>

        <div class="sidebar-account-settings">
            <ul>

                <li class="no-padding">
                    <a class="waves-effect waves-grey"><i class="material-icons">info_outline</i>{{ trans('core::default.layout.profile') }}</a>
                </li>

                <li class="divider"></li>
                <li class="no-padding">
                    <a class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Sign Out</a>
                </li>
            </ul>
        </div>

        <li class="divider m-b-10"></li>
            <h1 class="time center-align no-margin"></h1>
            <p class="date no-margin center-align"></p>
        <li class="divider m-t-20"></li>


        <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

            {{-- For Developer--}}

            @include('core::common.sidebars.developer')

            {{-- Packages --}}

            @foreach(session('packages') as $package)
                    @include($package->name.'::common.sidebar',['package'=>$package])
            @endforeach

        </ul>


        <div class="footer">
            <p class="copyright">DbCore Platform ©</p>
            <a href="#!">{{ trans('core::default.layout.support') }}</a>
        </div>

    </div>
</aside>