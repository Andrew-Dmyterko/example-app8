

    <h4>Создаем нового пользователя</h4>

    <form action="{{ route('addoper') }}" method="post">
        @csrf  {{--добавили токен в форму--}}

        <div class="form-group">
            <label  for="name">Введите имя</label>
            <input  type="text" name="name" placeholder="Введите имя" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label  for="user_name">Введите полное имя пользователя</label>
            <input  type="text" name="user_name" placeholder="Полное имя пользователя" id="user_name" class="form-control">
        </div>

        <div class="form-group">
            <label  for="email">Email</label>
            <input  type="text" name="email" placeholder="Введите email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label  for="group">Выберите группу</label>
            <select class="form-select form-control" aria-label="Default select example" id="validationDefault03" required name="group">
                <option value='operator' selected>Оператор</option>
                <option value='sklad' >Кладовшик</option>
                <option value='manager' >Менеджер</option>
                <option value='admin'>Администратор</option>
            </select>
        </div>

        <div class="form-group">
            <label  for="group">Выберите отделение</label>
            <select class="form-select form-control" aria-label="Default select example" id="validationDefault03" required name="point">
                <option disabled selected>Выберите отделение</option>
                @foreach ($point->all() as $point)
                    <option value='{{$point->id}}'>{{$point->id}} - {{$point->point_number}} - {{$point->city->city_name}} {{$point->point_address}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label  for="password">Пароль</label>
            <input  type="password" name="password"  placeholder="Ввведите пароль" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label  for="password_confirmation">Повторите пароль</label>
            <input  type="password" name="password_confirmation"  placeholder="Повторите пароль" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>


