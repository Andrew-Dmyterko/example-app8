@section('aside')
    <div class="aside">

        @hasrole('admin')
        <h4>Админ </h4>
        <p>Поехали посылки</p>
            <form action="{{route('adminGoPackage')}}" method="get">
                <button class="btn btn-primary" name="goPackage" value="goPackage" type="submit">Go package</button>
            </form>

        <p><a href='{{ route('admin') }}'>Назад в меню Admin</a></p>
    @else
            <h4>Боковая панель</h4>
            <p>Это просто боковая панель</p>
        @endhasrole
        @show
    </div>
