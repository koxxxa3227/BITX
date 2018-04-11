@extends("layouts.app")

@push('style')
    <style>
        .custom-select {
            display            : block;
            width              : 100%;
            height             : 34px;
            padding            : 6px 12px;
            font-size          : 14px;
            line-height        : 1.428571429;
            color              : #555;
            vertical-align     : middle;
            background-color   : #fff;
            background-image   : none;
            border             : 1px solid #ccc;
            border-radius      : 4px;
            -webkit-box-shadow : inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow         : inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition : border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition         : border-color ease-in-out .15s, box-shadow ease-in-out .15s;
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

        <form action="{{action('Admin\ActionController@addBonus', $user->id)}}" method="post" id="payment_list_form"
              class="mt-2">
            @csrf
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
            @endif
            <div class="text-right">
                <button type="button" class="btn btn-primary" id="add_bonus">Добавить бонус</button>
                <button type="submit" class="btn btn-primary d-none" id="success">Подтвердить</button>
            </div>
            <table class="table text-center">
                <thead>
                <tr>
                    <th class="text-center">Дата</th>
                    <th class="text-center">Тип</th>
                    <th class="text-center">Сумма</th>
                    <th class="text-center">Платёжная система</th>
                    <th class="text-center">Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->created_at->format('d.m.Y H:i')}}</td>
                        <td>{{$payment->type}}</td>
                        <td>{{$payment->amount}} <i class="fa fa-usd"></i></td>
                        <td>{{__($payment->payment_system)}}</td>
                        <td>@lang("Payment Status $payment->status_id")</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{$payments->links()}}
            </div>
        </form>
    </div>

    <div class="row d-none" id="bonus_line">
        <div class="col-md-4 col-md-offset-8">
            <div class="form-group">
                <label for="bonus_amount">Сумма</label>
                <input type="text" name="bonus_amount" id="bonus_amount" class="form-control">
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#add_bonus').on('click', function (e) {
            e.preventDefault();

            $(this).toggleClass('d-none');
            $('#success').toggleClass('d-none');

            var bonus = $('#bonus_line').clone().removeAttr('id').removeClass('d-none').addClass('bonus');

            $('#payment_list_form #add_bonus').after(bonus);
        });

        $(function () {
            $(document).on('submit', '#payment_list_form', function (e) {
                e.preventDefault();

                $.post($(this).attr('action'), $(this).serialize(), function (json) {
                    if (json.result) {
                        $.get(location.href, function (result) {
                            var new_content = $('#payment_list_form', result).html();
                            $('#payment_list_form').html(new_content);
                            $('#alert-success').setTimeout(function () {
                                $(this).addClass('d-none');
                            }, 2000);
                        });
                    }
                }, "json");
            })
        });
    </script>
@endpush