@extends("layouts.app")

@push('style')
    <style>
        .custom-select{
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.428571429;
            color: #555;
            vertical-align: middle;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>
@endpush

@section("content")
    <div class="container my-2">
        <form action="{{action('Admin\ActionController@editUserSaver', $user->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input type="text" class="form-control" id="login" name="login" value="{{$user->login}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="role">Роль</label>
                        <select name="role" id="role" class="custom-select">
                            <option {{$user->role == "admin" ? "selected" : ""}} value="admin">@lang("admin")</option>
                            <option {{$user->role == "user" ? "selected" : ""}} value="user">@lang('user')</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="money">Кол-во денег</label>
                        <input type="text" class="form-control" id="money" name="money" value="{{$user->money}}">
                    </div>
                    <div class="form-group">
                        <label for="skype">Skype</label>
                        <input type="text" class="form-control" id="skype" name="skype" value="{{$user->skype}}">
                    </div>
                    <div class="form-group">
                        <label for="telegram">Telegram</label>
                        <input type="text" class="form-control" id="telegram" name="telegram"
                               value="{{$user->telegram}}">
                    </div>
                </div>
            </div>
            <div class="text-right d-block d-xs-none">
                <button class="btn btn-primary btn-styled">Сохранить</button>
            </div>

            <div class="d-none d-xs-block">
                <button class="btn btn-primary btn-block">Сохранить</button>
            </div>
        </form>
    </div>
@endsection