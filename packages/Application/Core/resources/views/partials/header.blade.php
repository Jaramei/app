<header class="mn-header navbar-fixed">
    <nav class="blue-grey darken-1">
        <div class="nav-wrapper row">
            <section class="material-design-hamburger navigation-toggle">
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                    <span class="material-design-hamburger__layer"></span>
                </a>
            </section>
            <div class="header-title col s3">
                <span class="chapter-title">{{ config('app.name') }}</span>
            </div>

            <ul class="right col s9 m3 nav-right-menu">

                <li><a href="{{route('logout')}}"><i class="material-icons">exit_to_app</i></a></li>
                <li><li class="hide-on-small-and-down"><a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large"><i class="material-icons">notifications_none</i></a></li></li>
                <li class="uppercase blue-grey-text lighten-5">{{ app()->getLocale() }}</li>
                <li><a href="javascript:void(0)" data-activates="language" class="dropdown-button dropdown-right show-on-large">
                <i class="material-icons">translate</i></a></li>
                <li><a href="{{Config::get('app.url')}}" target="_blank" class="waves-effect waves-light btn z-depth-0 blue-grey lighten-2">{{trans('core::default.layout.goToWeb')}}</a></li>

<li>   </li>
            </ul>


            <form class="left search col s6 hide-on-small-and-down">
                <div class="input-field">
                    <input id="search" type="search" placeholder="{{ __('core::default.search.products') }}" autocomplete="off">
                    <label for="search"><i class="material-icons search-icon">search</i></label>
                </div>
                <a href="javascript: void(0)" class="close-search"><i class="material-icons">close</i></a>
            </form>

            <ul id="language" class="dropdown-content notifications-dropdown">
                <li class="notificatoins-dropdown-container">
                    <ul>
                        <li class="notification-drop-title">Available Language</li>

                        @foreach($languages as $lang)

                            <li><a href="{{route('translations.switch',$lang->slug)}}">
                                <div class="notification">
                                    <p class="no-margin p-t-5">{{ $lang->name }}</p>
                                </div>
                                </a>
                            </li>

                        @endforeach

                    </ul>
                </li>
            </ul>


            <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                <li class="notificatoins-dropdown-container">
                    <ul>
                        <li class="notification-drop-title">Today</li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle cyan"><i class="material-icons">done</i></div>
                                    <div class="notification-text"><p><b>Alan Grey</b> uploaded new theme</p><span>7 min ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle deep-purple"><i class="material-icons">cached</i></div>
                                    <div class="notification-text"><p><b>Tom</b> updated status</p><span>14 min ago</span></div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>