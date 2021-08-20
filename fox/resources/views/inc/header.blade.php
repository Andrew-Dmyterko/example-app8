<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{route('home')}}"><img class="mb-2" src="/images/logo11.png" alt="Hashtag" width="270" height="35"></a></h5>
        <form action="{{ route('packageTrack') }}" method="get"  class="form-inline">
            @csrf  {{--добавили токен в форму--}}
            <div class="form-group mb-2  mx-sm-3">
                <label for="trackNum" class="sr-only"></label>
                <input type="text" class="form-control" id="trackNum" name="trackNum" placeholder="Номер декларации">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Отследить посылку</button>
        </form>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('home') }}">Главная</a>
        <a class="p-2 text-dark" href="{{ route('about') }}">Про нас</a>
        <a class="p-2 text-dark" href="{{ route('contact') }}">Контакты</a>
        <a class="p-2 text-dark" href="{{ route('contact-data') }}">Сообщения</a>
        @hasrole('admin')
        <a class="p-2 text-dark" href="{{ route('admin') }}">AdminPanel</a>
        @endhasrole
        @hasrole('operator')
        <a class="p-2 text-dark" href="{{ route('oper') }}">OperPanel</a>
        @endhasrole
        @hasrole('manager')
        <a class="p-2 text-dark" href="{{ route('manager') }}">ManagerPanel</a>
        @endhasrole
        @hasrole('sklad')
        <a class="p-2 text-dark" href="{{ route('sklad') }}">SkladPanel</a>
        @endhasrole
        @auth
            <a class="p-2 text-dark" href="{{ route('logoutMy') }}">Logout {{ Auth::user()->name }}</a>
        @else
            <a class="p-2 text-dark" href="{{ route('register') }}">Регистрация</a>
            <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
        @endauth

    </nav>
</header>


