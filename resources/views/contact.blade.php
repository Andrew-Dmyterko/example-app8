@extends('layouts.app_')

@section('title-block')Страница контактов@endsection

@section('content')
    <h1>Страница контактов</h1>

    <form action="{{ route('contact-form') }}" method="post">
        @csrf  {{--добавили токен в форму--}}

        <div class="form-group">
            <label  for="name">Введите имя</label>
            <input  type="text" name="name" placeholder="Введите имя" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label  for="email">Email</label>
            <input  type="text" name="email" placeholder="Введите email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label  for="subject">Тема сообщения</label>
            <input  type="text" name="subject" placeholder="Тема сообщения" id="subject" class="form-control">
        </div>

        <div class="form-group">
            <label    for="message">Сообщение</label>
            <textarea name="message" placeholder="Текст сообщения" id="message" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

@endsection
