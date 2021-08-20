@hasrole('admin')

    @extends('layouts.app_')

    @section('title-block')Страница Администратора@endsection

    @section('content')
        <div class="page-header">
            <h3><u><b>Страница Администратора</b></u>
                <small>Login - {{ Auth::user()->name }}</small>
                <h5><b>Full name - {{ Auth::user()->user_name }}</b></h5>
            </h3>
        </div>
        <h6><b>Автообработка посылок лог:</b></h6>
        <hr>
        @foreach($logsToView as $order => $log)

            <p><a href='{{route('packageTrack', ['trackNum' => $order])}}'>{{$order}} => </a>{{$log}}</p>

        @endforeach

    @endsection
@else
    {{ redirect(route('home'))->withErrors(["К этой странице нету доступа"]) }}
@endhasrole

{{--    {{ json_decode(Auth::user(), true )['name'] }}--}}

{{--    {{ json_decode(Auth::user(), true )['email'] }}--}}
{{--    {{ Auth::id() }}--}}
{{--    {{ Auth::check()}}--}}
