<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-block')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app_.css">
</head>
<body>
    @include('inc.header')

    @if (Request::is('/'))
        @include('inc.hero')
    @endif

    @if (!(Request::is(app('router')->getRoutes()->getByName('packageTrack')->uri)
        or Request::is(app('router')->getRoutes()->getByName('operSend')->uri)
        or Request::is(app('router')->getRoutes()->getByName('operRecive')->uri)))
        <div class="container mt-5">

            @include('inc.messages')

            <div class="row">
                <div class="col-9">
                    @yield('content')
                </div>
                <div class="col-3">
                    @include('inc.aside')
                </div>
            </div>

        </div>
{{--    @elseif(!Request::is(app('router')->getRoutes()->getByName('packageTrack')->uri))--}}
    @else
        <div class="container mt-5">
            @include('inc.messages')
        </div>

        @yield('content')
    @endif

    @include('inc.footer')

</body>
</html>

{{--    <br>{{route('packageTrack')}}--}}
{{--    <br>{{Request::path()}}--}}
{{--    <br>{{Request::route()}}--}}
{{--    <br>{{URL::route('packageTrack', [])}}--}}
{{--    <br>{{app('router')->getRoutes()->getByName('packageTrack')->uri}}--}}
