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
    </style>
@endpush

@section("content")
    <div class="container my-2">
        <h3 class="text-center">Заказы на выплаты</h3>
        <div class="table-responsive">
            <table class="table mt-2 text-center table-hover">
                <thead>
                <tr>
                    <th class="text-center">Логин</th>
                    <th class="text-center">Сумма</th>
                    <th class="text-center">Платежная система</th>
                    <th class="text-center">Дата создания</th>
                    <th class="text-center">Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr class="{{$payment->status == "Оплачено" ? "success" : ""}}">
                        <td>{{$payment->user->login}}</td>
                        <td>{{$payment->amount}} <i class="fa fa-usd"></i></td>
                        <td>{{$payment->payment_system}}</td>
                        <td>{{$payment->created_at->format("d.M.Y H:i")}}</td>
                        <td>
                            <form action="{{action('Admin\ActionController@updatePaymentStatus', $payment->id)}}" method="post">
                                @csrf
                                <select name="status" id="status" class="custom-select" onchange="this.form.submit();" {{$payment->status == "Оплачено" ? "disabled" : ""}}>
                                    <option value="В обработке" {{$payment->status == "В обработке" ? "selected" : ""}}>В обработке</option>
                                    <option value="Ожидается оплата" {{$payment->status == "Ожидается оплата" ? "selected" : ""}}>Ожидается оплата</option>
                                    <option value="Оплачено" {{$payment->status == "Оплачено" ? "selected" : ""}}>Оплачено</option>
                                    <option value="Не оплачено" {{$payment->status == "Не оплачено" ? "selected" : ""}}>Не оплачено</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection