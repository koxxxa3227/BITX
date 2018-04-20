@extends("layouts.app")

@section("content")
    <div class="container">
        <h2 class="text-center">Пользователи сайта:</h2>
        <div class="table-responsive">
            <table class="mt-2 table text-center table-hover">
                <thead>
                <tr>
                    <th class="text-center">Логин</th>
                    <th class="text-center">Почта</th>
                    <th class="text-center">Роль</th>
                    <th class="text-center">Кол-во денег</th>
                    <th class="text-center">Рефер</th>
                    <th class="text-center">Кол-во рефералов</th>
                    <th class="text-center">Skype</th>
                    <th class="text-center">Telegram</th>
                    <th class="text-center">Опции</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->login}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <i class="fa fa-{{$user->role == "admin" ? "user-circle" : "user"}}"></i> {{__($user->role)}}
                        </td>
                        <td><i class="fa fa-usd"></i> {{$user->money}}</td>
                        <td>{{$user->ref_login ?: "Без приглашения"}}</td>
                        <td>{{refs($user->login)}}</td>
                        <td>{{$user->skype}}</td>
                        <td>{{$user->telegram}}</td>
                        <td>
                            <a class="mr-1" href="{{action('Admin\PageController@editUser', $user->id)}}"
                               title="Редактировать"><i class="fa fa-edit"></i></a>
                            <a class="mr-1" href="{{action('Admin\PageController@retrofittingPage', $user->id)}}"
                               title="Создать пополнение"><i class="fa fa-credit-card"></i></a>
                            <a class="mr-1" href="{{action('Admin\PageController@openDeposit', $user->id)}}"
                               data-toggle="tooltip" data-placement="right" title="Открыть депозит">%</a>
                            <a class="mr-1" href="{{action('Admin\PageController@retroActivelyPage', $user->id)}}"
                               title="Создать вывод"><i class="icon-money"></i></a>
                            <a class="mr-1" href="{{action('Admin\PageController@refsPage', $user->id)}}"
                               title="Реферавльные вознаграждения"><i class="fa fa-reply"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection