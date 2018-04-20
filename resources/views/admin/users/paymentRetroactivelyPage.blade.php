@extends("layouts.app")

@section("content")
    <div class="container my-2 ajax-page">
        @include('components.admin_user_menu')
        <h2 class="text-center">Создать вывод для {{$user_login}}</h2>
        <form action="{{action('Admin\ActionController@retrofitting', $user_id)}}" method="post" class="ajax-form">
            @csrf
            <input type="text" name="type" hidden value="2">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="payment_system">Платёжная система:</label>
                        <select name="payment_system" id="payment_system" class="form-control" required>
                            <option value="payeer">Payeer</option>
                            <option value="pm">Perfect Money</option>
                            <option value="adv">Advcash</option>
                            <option value="btc">BTC</option>
                            <option value="eth">ETH</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="amount">Сумма:</label>
                        <input type="number" min="0" class="form-control" name="amount" id="amount" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date">Дата:</label>
                        <input type="date" class="form-control" name="payment_date" id="date" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="time">Время:</label>
                        <input type="time" class="form-control" name="payment_time" id="time" required>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Создать вывод</button>
            </div>
        </form>

        <h2 class="text-center">Все выводы пользователя</h2>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                <tr>
                    <th class="text-center" style="font-weight: 700">Сумма</th>
                    <th class="text-center" style="font-weight: 700">Платёжная система</th>
                    <th class="text-center" style="font-weight: 700">Дата</th>
                </tr>
                </thead>
                <tbody>
                @if($payments)
                @foreach($payments as $payment)
                        <tr>
                            <td>{{money($payment->amount)}} <i class="fa fa-usd"></i></td>
                            <td>{{__($payment->payment_system)}}</td>
                            <td>{{$payment->created_at->format('d.m.Y H:i')}}</td>
                            <td><a href="{{action('Admin\ActionController@removePayment', $payment->id)}}">Удалить</a>
                            </td>
                        </tr>
                @endforeach
                @else
                    <tr class="text-center">
                        Нету записей о выводе
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="text-center">
                {{$payments->links()}}
            </div>
        </div>
    </div>
@endsection

