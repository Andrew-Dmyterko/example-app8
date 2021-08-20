@hasrole('operator')

@extends('layouts.app_')

@section('title-block')Заказ оформлен.@endsection

@section('content')

    <div class="page-header">
        <h3><b>Заказ оформлен.</b></h3>
        <h3><u><b>Чек  заказа.</b></u>
        <small>Использвйте QR-код для отслеживания.</small>
        </h3>
    </div>
    <hr>
    <div class="box" style="overflow: hidden; margin-left: 5px">
        <div class="image" style="width: 200px; float: left;">
            {!! QrCode::size(200)->generate(route('packageTrack', ['packageTrack' => $package->order_num])); !!}

{{--            <img src="tmp/tmp.png" alt="" style="float: left; width: 200px;"/>--}}
        </div>
        <div class="text" style="margin-left: 220px;">
            <h4>Заказ <b>{{$package->order_num}}</b> от <b>{{date("d.m.y",$package->timePkgCreate)}}</b></h4>
            <table>
                <tr>

                    <h6>
                        <td><u><b>Отправитель:</b></u></td>
                        <td>{{ $userSender->user_phone }} {{ $userSender->user_name }} отделение №" {{$package->point_num}} {{$operPoint->city->city_name}} {{$operPoint->point_address}}</td>
                    </h6>
                </tr>
                <tr>
                    <h6>
                        <td><u><b>Получатель:</b></u></td>
                        <td>{{ $userReciver->user_phone }} {{ $userReciver->user_name }} отделение №" {{ $pointRecive->point_number }} г. {{ $pointRecive->city->city_name }} {{ $pointRecive->point_address}}</td>
                    </h6>
                </tr>
                <tr>
                    <h6><td><u><b>Посылка:</b></u> </td><td>{{$package->pack_descr}}</td></h6>
                </tr>
                <tr>
                    <h6><td><u><b>Доставка:</b></u> </td><td> !!!! </td></h6>
                </tr>
                <tr>
                    <h6><td><u><b>Цена доставки:</b></u> </td><td>{{$package->pack_price_send}} грн</td></h6>
                </tr>
                <tr>
                    <h6><td><u><b>Подпись отправителя:</b></u> </td><td>   ______________ {{ $userSender->user_name }}</td></h6>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <!--     тут текст под картинкой   ...-->
    </div>

    </div><hr>
    <p><a href='{{ route('oper') }}'>Назад в меню оператора</a></p>

@endsection
@else
    {{ redirect(route('nome'))->withErrors(["К этой странице нету доступа"]) }}
    @endhasrole
    {{--    <h1>Страница Оператора</h1>--}}
    {{--    <p>Страница Оператора</p>--}}
    {{--    {{ json_decode(Auth::user(), true )['name'] }}--}}
    {{--    {{ Auth::user()->name }}--}}
    {{--    {{ json_decode(Auth::user(), true )['email'] }}--}}
    {{--    {{ Auth::id() }}--}}
    {{--    {{ Auth::check()}}--}}



