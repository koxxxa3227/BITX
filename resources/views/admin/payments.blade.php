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

        tr.success td{
            background: rgba(76, 147, 76, .3) !important;
            color : #474747 !important;
        }


        tr.canceled td{
            background : rgba(255, 0, 0, .3) !important;
            color      : #474747 !important;
        }
    </style>
@endpush

@section("content")
    <div class="container my-2">
        <h3 class="text-center">Пополнение и выплаты</h3>
        <div class="table-responsive">
            <table class="table mt-2 text-center table-hover">
                <thead>
                <tr>
                    <th class="text-center">Логин</th>
                    <th class="text-center">Рефер</th>
                    <th class="text-center">Тип</th>
                    <th class="text-center">Сумма</th>
                    <th class="text-center">Платежная система</th>
                    <th class="text-center">Дата создания</th>
                    <th class="text-center">Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr class="{{$payment->status_id == 2 ? "success" : ""}} {{$payment->status_id == 3 ? "canceled" : ""}}">
                        <td>{{$payment->user->login}}</td>
                        <td>{{$payment->user->ref_login}}</td>
                        <td>{{$payment->type}}</td>
                        <td>{{$payment->amount}} <i class="fa fa-usd"></i></td>
                        <td>{{$payment->payment_system}}</td>
                        <td>{{$payment->created_at->format("d.M.Y H:i")}}</td>
                        <td>
                            <form action="{{action('Admin\ActionController@updatePaymentStatus', [$payment->id])}}" method="post">
                                @csrf
                                <select name="status_id" id="status" class="custom-select" onchange="this.form.submit();" {{$payment->status_id != 1 ? "disabled" : ""}}>
                                    <option value="1" {{$payment->status_id == 1 ? "selected" : ""}}>В обработке</option>
                                    <option value="2" {{$payment->status_id == 2 ? "selected" : ""}}>Обработан</option>
                                    <option value="3" {{$payment->status_id == 3 ? "selected" : ""}}>Отменен</option>
                                </select>
                                <input type="text" name="type" hidden value="{{$payment->type == "Пополнение" ?: 0}}">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection