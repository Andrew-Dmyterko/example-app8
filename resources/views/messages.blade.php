@extends('layouts.app_')

@section('title-block')Все сообщения@endsection

@section('content')
    <h1>Cообщения</h1>
    @foreach($data as $el)
        <div class="alert alert-info">
            <h3>{{ $el->subject }}</h3>
            <p>{{ $el->email }}</p>
            <p><small>{{ $el->created_at }}</small></p>
            <a href="{{ route('contact-data-one', $el->id) }}"><button class="btn btn-warning">Детальнее</button></a>
        </div>
    @endforeach
@endsection


