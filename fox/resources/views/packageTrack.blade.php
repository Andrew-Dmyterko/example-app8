@extends('layouts.app_')

@section('title-block')Отслеживание посылки {{$package->order_num}}@endsection

@section('content')
{{--    <h1>Отслеживание посылки</h1>--}}
<div style="margin-left: 20px; margin-right: 500px">
    <div class="page-header">
        <h2><u><b>{{$package->order_num}}</b></u>
        <small>Статус заказа</small>
        </h2>
    </div>
{{--    {{url()->previous()}}--}}
{{--    {{Auth::user()->user_name}}--}}
{{--    <br>{{route('packageTrack')}}--}}
{{--    <br>{{Request::path()}}--}}
    <h4>Заказ {{$package->order_num}} от <?=date("d.m.y",$package->timePkgCreate)?></h4>
    <table>
        <tr>
            @auth()
                <h5><td><u><b>Отправитель:</b></u></td> <td> {{$userSend->user_name}} т.{{$userSend->user_phone}} отделение № {{ $pointSender->point_number }} г. {{ $pointSender->city->city_name }} {{ $pointSender->point_address}}</td></h5>
            @else
                <h5><td><u><b>Отправитель:</b></u></td> <td>Информация недоступна. Авторизируйтесь.</td></h5>
            @endauth
        </tr>
        <tr>
            @auth()
                <h5><td><u><b>Получатель:</b></u> </td><td>{{$userRecive->user_name}} т.{{$userRecive->user_phone}}  отделение № {{ $pointReciver->point_number }} г. {{ $pointReciver->city->city_name }} {{ $pointReciver->point_address}}</td></h5>
            @else
                <h5><td><u><b>Получатель:</b></u> </td><td>Информация недоступна. Авторизируйтесь.</td></h5>
            @endauth
        </tr>
    </table>
    <div>
        <br>
        <div>
            <table class="table table-bordered table-sm table-hover">
                <!--            <table border="2" >-->
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Дата статуса</th>
                    <th scope="col">Где посылка</th>
                </tr>
                </thead>
                <tbody>
                <?php $id = 0;?>
                <?php foreach($packageTracks as $value){ ?>
                <tr>
                    <th scope="row"><?=++$id?></th>
<!--                    --><?php //define('TIMEZONE1', 'Europe/Kiev'); date_default_timezone_set(TIMEZONE1); ?>
                    <td><small><?=date("d.m.y H:i:s",$value["package_status_data"])?></small></td>
                    <td><?=$value["package_status_message"]?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <p><a href='{{ route('home') }}'>Назад</a></p>
</div>



{{--    @foreach($package as $el)--}}
{{--        <div class="alert alert-info">--}}
{{--            <h3>{{ $el->point_address }}</h3>--}}
{{--            <h3>{{ $el->order_num }}</h3>--}}
{{--            <p>{{ $el->status_msg }}</p>--}}
{{--            <p><small>{{ $el->created_at }}</small></p>--}}
{{--            <a href="{{ route('contact-data-one', $el->id) }}"><button class="btn btn-warning">Детальнее</button></a>--}}
{{--        </div>--}}
{{--    @endforeach--}}
@endsection


