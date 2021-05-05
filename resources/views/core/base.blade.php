<!doctype html>
<html lang="@yield('language', config('app.locale'))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-57x57.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-114x114.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-144x144.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-60x60.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-120x120.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-76x76.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('webmagic/dashboard/img/favicon/apple-touch-icon-152x152.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('webmagic/dashboard/img/favicon/favicon-196x196.png')}}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{asset('webmagic/dashboard/img/favicon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{asset('webmagic/dashboard/img/favicon/favicon-32x32.png')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{asset('webmagic/dashboard/img/favicon/favicon-16x16.png')}}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{asset('webmagic/dashboard/img/favicon/favicon-128.png')}}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{asset('webmagic/dashboard/img/favicon/mstile-144x144.png')}}" />
    <meta name="msapplication-square70x70logo" content="{{asset('webmagic/dashboard/img/favicon/mstile-70x70.png')}}" />
    <meta name="msapplication-square150x150logo" content="{{asset('webmagic/dashboard/img/favicon/mstile-150x150.png')}}" />
    <meta name="msapplication-wide310x150logo" content="{{asset('webmagic/dashboard/img/favicon/mstile-310x150.png')}}" />
    <meta name="msapplication-square310x310logo" content="{{asset('webmagic/dashboard/img/favicon/mstile-310x310.png')}}" />

    {{-- Styles loading --}}
    @stack('styles')
    @stack('after-styles')
    {{-- END Styles loading --}}
</head>
<body class="@yield('body_class') {{$class}}" {!! $dynamic_fields !!}>

    {{--<div class="wrapper">--}}

    {{-- Content area --}}
    @yield('base_content')

    <div class="col-xs-12 alert-section"></div>
    {{--</div>--}}

    @include('dashboard::components._modal')

    {{-- Scripts area --}}
    <script id="data-locale" type="application/json">
        {"locale": "{{App::getLocale()}}"}
    </script>
    <div style="display: none;" id="_token-csrf">{{csrf_token()}}</div>

    {{-- Scripts loading --}}
    <script>
        if(localStorage.getItem("sidebarCollapse") == 'true'){
            document.getElementsByTagName('body')[0].classList += ' ' + 'sidebar-collapse';
        }
    </script>
    @stack('scripts')
    @stack('after-scripts')

    <script>
        let timerUpdate;
        let input = $('.js_autoupdate').find('input');

        reloadPage = function(){

            let autoupdate = localStorage.getItem("autoupdate");


            if(autoupdate === 'false'){
                autoupdate = false;
            }

            $(input).prop('checked', autoupdate);

            if(autoupdate){
                timerUpdate = setTimeout(function () {
                    location.reload();
                }, 10000)
            }
        };
        reloadPage();

        $(input).on('change', function () {

            let autoupdate = $(this).prop('checked');

            localStorage.setItem("autoupdate", autoupdate);

            reloadPage();

            if(!autoupdate){
                clearTimeout(timerUpdate);
            }
        });
    </script>
    {{-- END Scripts --}}
</body>
</html>
