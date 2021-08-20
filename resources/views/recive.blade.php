@hasrole('operator')

@extends('layouts.app_')

@section('title-block')Страница Оператора - Получение заказа@endsection

@section('content')


    <div class="page-header">
        <h3><u><b>Получение заказа.</b></u>
            <small>Оператор - {{ $operFullName }}</small>
        </h3>
    </div>
    <h5><b>Отделение № {{ $operPoint->point_number}} <small>Адрес - {{ $operPoint->city->city_name }}
                , {{ $operPoint->point_address }}</small></b></h5><hr>

    @if (isset($userSender))
        <div class="page-header">
            <h4><u><b>Номер отправления {{$package->order_num}}</b></u></h4>
        </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label for="validationDefault01">Телефон</label>
                    <input type="text" class="form-control" id="validationDefault01" name="user_phone_sender"
                           placeholder="Телефон отправителя" value="{{ $userSender->user_phone }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationDefault02">ФИО</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Имя отправителя"
                           value="{{ $userSender->user_name }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationDefaultUsername">Дисконтная карта #</label>
                    <input type="text" class="form-control" id="validationDefaultUsername"
                           placeholder="Дисконтная карта" value="{{ $userSender->user_client_card }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validation1">Число отправок</label>
                    <input type="text" class="form-control" id="validation1" placeholder="Число отправок"
                           value="{{ $userSender->user_count }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validation2">Скидка %</label>
                    <input type="text" class="form-control" id="validation2" placeholder="Скидка клиента %"
                           value="{{ $userSender->user_bonus }}%" required>
                </div>
            </div>
            <div class="page-header">
                <h4><u><b>Отделение отправки</b></u></h4>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Номер отделения</label>
                    <input type="text" class="form-control" name="point_num" id="validationDefault03"
                           value="{{$package->point_s->point_number}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault04">Адрес отделения</label>
                    <input type="text" class="form-control" name="point_address" id="validationDefault04"
                           value="{{ $package->point_s->city->city_name }}, {{ $package->point_s->point_address }}" required>
                </div>
            </div>
            <div class="page-header">
                <h4><u><b>Данные о посылке</b></u></h4>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="validationDefault03">Описание посылки</label>
                    <input type="text" class="form-control" name="pack_descr" id="validationDefault03"
                           placeholder="Описание посылки" value="{{ $package->pack_descr }}" required>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="validationDefault14">Оц.Стоим.</label>
                    <input type="text" class="form-control" name="pack_price" id="validationDefault14"
                           placeholder="Price" value="{{ $package->pack_price }}" required>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="validationDefault14">Ст.Дост.</label>
                    <input type="text" class="form-control" name="pack_price" id="validationDefault14"
                           placeholder="PriceSend" value="{{ $package->pack_price_send }}" required>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="validationDefault04">Вес (кг)</label>
                    <input type="text" class="form-control" name="pack_weight" id="validationDefault04"
                           placeholder="Вес" value="{{ $package->pack_weight }}" required>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="validationDefault04">Длина (cм)</label>
                    <input type="text" class="form-control" name="pack_length" id="validationDefault04"
                           placeholder="Длина" value="{{ $package->pack_length }}" required>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="validationDefault04">Ширина (cм)</label>
                    <input type="text" class="form-control" name="pack_width" id="validationDefault04"
                           placeholder="Ширина" value="{{ $package->pack_width }}" required>
                </div>
                <div class="col-md-1 mb-3">
                    <label for="validationDefault04">Высота (cм)</label>
                    <input type="text" class="form-control" name="pack_height" id="validationDefault04"
                           placeholder="Высота" value="{{ $package->pack_height }}" required>
                </div>
            </div>
            <div class="page-header">
                <h4><u><b>Данные о получателе</b></u></h4>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label for="validationDefault01">Телефон</label>
                    <input type="text" class="form-control" id="validationDefault01" name="phone_phone_recive"
                           placeholder="Телефон отправителя" value="{{ $userReciver->user_phone }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationDefault02">ФИО</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Имя отправителя"
                           value="{{ $userReciver->user_name }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationDefaultUsername">Дисконтная карта #</label>
                    <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Дисконтная карта"
                           value="{{ $userReciver->user_client_card }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validation1">Число отправок</label>
                    <input type="text" class="form-control" id="validation1" placeholder="Число отправок"
                           value="{{ $userReciver->user_count }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validation2">Скидка %</label>
                    <input type="text" class="form-control" id="validation2" placeholder="Скидка клиента %"
                           value="{{ $userReciver->user_bonus }}%" required>
                </div>
            </div>

        @if ($package->pay_reciver = 'on')
            <label><b>К оплате {{ $package->pack_price_send }} грн.</b></label>
                <input type="checkbox" name="pay"  id="exampleCheck11">
                <label  for="exampleCheck1">Оплата совершена</label>
        @else
            <label><b>Посылка уплочена отправителем</b></label>
        @endif
        <form action="{{route('operReciveDo')}}"  method="get" class="form-inline">
            <input type="hidden" name="packageId" value="{{$package->id}}">
            <button type="submit" class="btn btn-primary mb-2">Получить посылку</button>
        </form>

    @else
        <form action="{{ route('operRecive') }}" class="form-inline">
            <div class="form-group mb-2  mx-sm-3">
                <label for="order" class="sr-only"></label>
                <input type="text" class="form-control" id="order" name="order" placeholder="Номер деклрации">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Найти отправление</button>
        </form>
    @endif
    <hr>
    <p><a href='{{ route('oper') }}'>Назад в меню оператора</a></p>

@endsection
@else
    {{ redirect(route('nome'))->withErrors(["К этой странице нету доступа"]) }}
    @endhasrole
