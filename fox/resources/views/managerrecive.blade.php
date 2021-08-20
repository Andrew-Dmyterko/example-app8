@hasrole('manager')

@extends('layouts.app_')

@section('title-block')Страница Менеджера@endsection

@section('content')

    <div class="page-header">
        <h2><u><b>Рабочее место Менеджера.</b></u>
            <small>Login - {{ $operName }}</small>
            <h5><b>Полное имя - {{ $operFullName }}</b></h5>
        </h2>
    </div>
    <h5><b>Отделение  № {{ $operPoint->point_number}}</b></h5>
    <h6><b>Адрес - {{ $operPoint->city->city_name }}, {{ $operPoint->point_address }} </b></h6>
        <hr>
        <h5><b>Готовые на выдачу посылки:</b></h5>
        <hr>
    <form action="{{route('managerToRecive')}}" method="get">
    @foreach($packages as $id =>$package)
        <div class="text">
            <h6>Заказ <b>{{$package->order_num}}</b> создан <b>{{date("d.m.y, H:m:s", $package['timePkgCreate'])}}</b></h6>
            <table>
                <tr>
                    <td><u><b>Отправитель:</b></u></td>
                    <td>{{$package->user_s->user_phone}} {{$package->user_s->user_name}} отделение №" {{$package->point_s->point_number}} г.{{$package->point_s->city->city_name}} {{$package->point_s->point_address}}</td>
                </tr>
                <tr>
                    <td><u><b>Получатель:</b></u></td>
                    <td>{{$package->user_r->user_phone}} {{$package->user_r->user_name}} отделение №" {{$package->point_r->point_number}} г.{{$package->point_r->city->city_name}} {{$package->point_r->point_address}}</td>
                </tr>
                <tr>
                    <td>
                        <u><b>К выдаче:  </b></u>
                    </td>
                    <td>
                        <input type="checkbox" name="packget[]" value="{{$package->id}}" id="exampleCheck1" style="margin-left: 5px">  Выдать посылку
                    </td>
                </tr>
            </table>
        </div>
    <hr>
    @endforeach
    <button class="btn btn-primary" name="send_offer" value="send_offer" type="submit">Выдать посылки</button>
    </form>
@endsection
@else
    {{ redirect(route('home'))->withErrors(["К этой странице нету доступа"]) }}
@endhasrole

{{--    {{ json_decode(Auth::user(), true )['name'] }}--}}

{{--    {{ json_decode(Auth::user(), true )['email'] }}--}}
{{--    {{ Auth::id() }}--}}
{{--    {{ Auth::check()}}--}}
