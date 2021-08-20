@hasrole('manager')

    @extends('layouts.app_')

    @section('title-block')Страница Менеджера@endsection

    @section('content')
    {{--    <h1>Страница Оператора</h1>--}}
    {{--    <p>Страница Оператора</p>--}}
    {{--    {{ json_decode(Auth::user(), true )['name'] }}--}}
    {{--    {{ Auth::user()->name }}--}}
    {{--    {{ json_decode(Auth::user(), true )['email'] }}--}}
    {{--    {{ Auth::id() }}--}}
    {{--    {{ Auth::check()}}--}}

        <div class="page-header">
            <h2><u><b>Рабочее место Менеджера.</b></u>
            <small>Login - {{ $operName }}</small>
                <h5><b>Полное имя - {{ $operFullName }}</b></h5>
            </h2>
        </div>
        <h5><b>Отделение  № {{ $operPoint->point_number}}</b></h5>
        <h6><b>Адрес - {{ $operPoint->city->city_name }}, {{ $operPoint->point_address }} </b></h6>

        <div>
            <a href="{{route('managerSendView')}}" class="btn btn-primary">Формирование внешней отправки</a>
            <a href="{{route('managerToReciveViews')}}" class="btn btn-primary">Посылки на выдачу</a>
            <a href="{{route('managerBadPackage')}}" class="btn btn-primary">Брак/Дефектные акты</a>
        </div>

    @endsection
@else
    {{ redirect(route('home'))->withErrors(["К этой странице нету доступа"]) }}
@endhasrole
