<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Application')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">

        <!-- Styles -->
        @yield('before-styles')
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


        {!! Minify::stylesheet(array('/css/packages/core/plugins/materialize/css/materialize.min.css',
                                     '/css/packages/core/plugins/material-preloader/css/materialPreloader.min.css',
                                     '/css/packages/core/nestable.css',
                                     '/js/packages/core/plugins/trumbwyg/ui/trumbowyg.css',
                                     '/css/packages/core/alpha.css',
                                     '/css/packages/core/spacing.css',
                                     '/css/packages/core/custom.css'))->withFullUrl()  !!}

        @yield('after-styles')

</head>


<body>

@include('core::partials.loader')

<div class="mn-content fixed-sidebar">

@include('core::partials.header')

@include('core::partials.sidebar')

        <main class="mn-inner">

                @yield('content')

        </main>

</div>


@yield('before-scripts')

{!! Minify::javascript(array('/js/packages/core/plugins/jquery/jquery-2.2.0.min.js',
                             '/js/packages/core/plugins/moment/moment.min.js',
                             '/js/packages/core/plugins/jquery-blockui/jquery.blockui.js',
                             '/js/packages/core/plugins/materialize/js/materialize.min.js',
                             '/js/packages/core/plugins/material-preloader/js/materialPreloader.min.js',
                             '/js/packages/core/jquery.nestable.js',
                             '/js/packages/core/plugins/trumbwyg/trumbowyg.js',
                             '/js/packages/core/alpha.js',
                             '/js/packages/core/custom.js')) !!}

@yield('after-scripts')

<script type="text/javascript">

    Materialize.updateTextFields();

</script>

</body>
</html>
