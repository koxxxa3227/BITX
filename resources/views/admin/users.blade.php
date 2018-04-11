@extends("layouts.app")

@section("content")
    <div class="container">
        <h2 class="text-center">Пользователи сайта:</h2>
        <table class="mt-2 table table-hover">
            <thead>
            <tr>
                <th>Логин</th>
                <td>Почта</td>
                <td>Роль</td>
                <td>Кол-во денег</td>
                <td>Кол-во рефералов</td>
                <td>Skype</td>
                <td>Telegram</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->login}}</td>
                    <td>{{$user->email}}</td>
                    <td><i class="fa fa-{{$user->role == "admin" ? "user-circle" : "user"}}"></i> {{__($user->role)}}</td>
                    <td>{{$user->money}} <i class="fa fa-usd"></i></td>
                    <td>{{refs($user->login)}}</td>
                    <td>{{$user->skype}}</td>
                    <td>{{$user->telegram}}</td>
                    <td>
                        <a href="{{action('Admin\PageController@editUser', $user->id)}}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection