@hasrole('operator')

@extends('layouts.app_')

@section('title-block')Страница Оператора - Отправка заказа@endsection

@section('content')
    {{--    <h1>Страница Оператора</h1>--}}
    {{--    <p>Страница Оператора</p>--}}
    {{--    {{ json_decode(Auth::user(), true )['name'] }}--}}
    {{--    {{ Auth::user()->name }}--}}
    {{--    {{ json_decode(Auth::user(), true )['email'] }}--}}
    {{--    {{ Auth::id() }}--}}
    {{--    {{ Auth::check()}}--}}

    <div class="page-header">
        <h3><u><b>Отправка заказа.</b></u>
            <small>Оператор - {{ $operFullName }}</small>
        </h3>
    </div>
    <h5><b>Отделение № {{ $operPoint->point_number}} <small>Адрес - {{ $operPoint->city->city_name }}
                , {{ $operPoint->point_address }}</small></b></h5>

    @if (isset($userSender))
        <div class="page-header">
            <h4><u><b>Данные отправителя</b></u></h4>
        </div>
        @if ($userSender->user_phone == "##########")
            <h3 style="color: brown">Клиент не найден введите данные клиента</h3>
            <form action="{{ route('add_new_express_user') }}" method="get">
                <div class="form-row">
                    <div class="col-md-2 mb-2">
                        <label for="validationDefault01">Телефон</label>
                        <input type="text" class="form-control" id="validationDefault01" name="user_phone"
                               placeholder="Телефон нового клиента" value="{{$package->user_phone_sender}}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault02">ФИО</label>
                        <input type="text" class="form-control" id="validationDefault02" placeholder="Имя нового клиента"
                               value="" name="user_name" required>
                    </div>
                    <button class="btn btn-primary" name="add_new_espress_user" type="submit">Добавить нового клиента</button>
                </div>
            </form>
        @endif
        <form>
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
                    <!--                 <input type="text" class="form-control" name="point_num" id="validationDefault03" value="--><?//= $_SESSION['point'] ?><!--" required>-->
                    <input type="text" class="form-control" name="point_num" id="validationDefault03"
                           value="{{ $operPoint->point_number}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault04">Адрес отделения</label>
                    <!--                 <input type="text" class="form-control" name="point_address" id="validationDefault04"  value="--><?//=$_SESSION['address'] ?><!--" required>-->
                    <input type="text" class="form-control" name="point_address" id="validationDefault04"
                           value="{{ $operPoint->city->city_name }}, {{ $operPoint->point_address }}" required>
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

            @if (!isset($_GET['phone_phone_recive']))

                <div class="form-row">
                    <div class="col-md-4 mb-4">
                        <label for="phone_num_reciver" class="sr-only"></label>
                        <input type="text" class="form-control" id="phone_num_reciver" name="phone_phone_recive"
                               placeholder="Телефон получателя">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Найти получателя</button>
        </form>
    @else
        @if ($userReciver->user_phone == "##########")
            </form>
            <h3 style="color: brown">Клиент не найден введите данные клиента</h3>
            <form action="{{ route('add_new_express_user') }}" method="get">
                <div class="form-row">
                    <div class="col-md-2 mb-2">
                        <label for="validationDefault01">Телефон</label>
                        <input type="text" class="form-control" id="validationDefault01" name="user_phone"
                               placeholder="Телефон нового клиента" value="{{$package->phone_phone_recive}}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault02">ФИО</label>
                        <input type="text" class="form-control" id="validationDefault02" placeholder="Имя нового клиента"
                               value="" name="user_name" required>
                    </div>
                    <button class="btn btn-warning" name="add_new_express_user" type="submit">Добавить нового клиента</button>
                </div>
            </form>
        @endif
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

        <div class="page-header">
            <h4><u><b>Отделение получателя</b></u></h4>
        </div>
{{--        !! {{$cityRecive->city_name}} - {{$pointRecive->id}}--}}

        <div class="form-row">
            <div class="col-md-2 mb-2">
                <label for="validationDefault03">Город получателя</label>
                <select class="form-select form-control" aria-label="Default select example" id="validationDefault03"
                        name="city_id">
                    <option disabled selected>Выберите город</option>

                    @foreach ($citiesList as $id => $city)

                        <option
                            value={{$city->id}} @if($city->id == $cityRecive->id)  selected @endif> {{$city->city_name}} </option>

                    @endforeach
                </select>
                <button class="btn btn-primary" name="findpoint" value="findpoint" type="submit">Найти отделения в городе</button>
            </div>
            {{--        </div>--}}
            @if ($city_id)
                <div class="col-md-4 mb-4">
                    <label for="validationDefault03">Номер отделения</label>
                    <select class="form-select form-control" aria-label="Default select example"
                            id="validationDefault03" name="point_id">
                        <option disabled selected>Выберите отделение в г.{{$cityRecive->city_name}}</option>
                        @foreach ($cityRecive->point->all() as $id => $point)

                            <option value={{$point->id}}
                            @if ($point->id == $pointRecive->id && isset($go_cost)) selected @endif>
                                №{{$point->point_number}} - г.{{$cityRecive->city_name}}
                                , {{$point->point_address}} </option>

                        @endforeach
                    </select>
                    <!--                     <button class="btn btn-primary" type="submit">Посчитать стоимость</button>-->
                </div>
                <div class="col-md-2 mb-2">
                    <label for="validationDefault04"><b>Расчет стоимости</b></label>
                    <button class="btn btn-primary form-control" name="go_cost" value="cost" type="submit">Посчитать стоимость</button>
                </div>


                @if (isset($go_cost) && isset($pointRecive->id))

                <div class="text" style="margin-left: 220px;margin-top: 0px;">
                    <!--                     <h4>Заказ <b>98006300258</b> от <b>20.12.2020</b></h4>-->
                    <table>
                        <tr>
                            <td><u><b>Отправитель:</b></u></td>
                            <td>{{$userSender->user_phone}} {{$userSender->user_name}}  отделение №{{ $operPoint->point_number}} г.{{ $operPoint->city->city_name }}, {{ $operPoint->point_address }}</td>
                        </tr>
                        <tr>
                            <td><u><b>Получатель:</b></u></td>
                            <td>{{$userReciver->user_phone}} {{$userReciver->user_name}}  отделение №{{ $pointRecive->point_number}} г.{{ $pointRecive->city->city_name }}, {{ $pointRecive->point_address }}</td>
                        </tr>
                        <tr>
                            <td><u><b>Cтоимость доставки:</b></u></td><td><input type="hidden" name="sendPockagePrice" value="{{$sendPockagePrice}}">{{$sendPockagePrice}} грн</td>
                        </tr>
                        <tr>
                            <td>  <div class="form-check">
                                    <input type="checkbox" name="pay_beznal" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Оплата безналичная</label>
                                </div>
                            </td>
                            <td>  <div class="form-check">
                                    <input type="checkbox" name="pay" class="form-check-input" id="exampleCheck11">
                                    <label class="form-check-label" for="exampleCheck1">Оплата совершена</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="pay_reciver" class="form-check-input" id="exampleCheck12">
                                    <label class="form-check-label" for="exampleCheck12">Платит получатель</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
                    <button class="btn btn-primary" name="send_offer" value="send_offer" type="submit">Оформить заказ</button>

                @endif

            @endif
{{--        </div>--}}
    @endif

    @else
        <form action="{{ route('operSend') }}" class="form-inline">
            <div class="form-group mb-2  mx-sm-3">
                <label for="user_phone_sender" class="sr-only"></label>
                <input type="text" class="form-control" id="user_phone_sender" name="user_phone_sender"
                       placeholder="Телефон отправителя">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Оформить отправку</button>
        </form>
    @endif
    </div><hr>
    <p><a href='{{ route('oper') }}'>Назад в меню оператора</a></p>




@endsection
@else
    {{ redirect(route('nome'))->withErrors(["К этой странице нету доступа"]) }}
    @endhasrole
