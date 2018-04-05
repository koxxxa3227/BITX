@extends("layouts.app")

@section("content")
    <div class="container my-2">
        <div class="row">
            @include('components.cabinet.menu', ['value'=> '2'])
        </div>
        <div class="row">
            <form action="{{action('Profile\ActionController@paymentsRequest')}}" class="deposit_form" method="post">
                @csrf
                <div class="col-md-5 text-center">
                    <div class="form-group">
                        <p>Что бы вывести средства, укажите сумму <br> и выберите электронный кошелёк</p>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="withdraw_amount">Укажите сумму вывода (<i class="fa fa-usd"></i>)</label>
                            <input type="number" min="0" value="" class="form-control" name="withdraw_amount" id="withdraw_amount">
                        </div>
                        <div class="col-md-6">
                            <label for="left_amount">Остаток средств после вывода (<i class="fa fa-usd"></i>)</label>
                            <input type="text" class="form-control" name="left_amount" id="left_amount" value="{{$me->money}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 text-center d-block d-md-none">
                    <h4>Выберите систему пополнения:</h4>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/logo-payeer.png" alt="" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="payeer">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/PerfectMoney.png" alt="" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="pm">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/ADVCASH.png" alt="" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="adv">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/bitcoin.png" alt="" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="btc">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/ETH.png" alt="" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="eth">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-styled">Вывести</button>
                    </div>
                </div>

                <div class="col-md-7 text-center d-none d-md-block">
                    <label for="payment_system_mobile">Выберите систему пополнения:</label>
                    <select name="payment_system_mobile" id="payment_system_mobile">
                        <option value="payeer">Payeer</option>
                        <option value="pm">Perfect Money</option>
                        <option value="adv">Advcash</option>
                        <option value="btc">BTC</option>
                        <option value="eth">ETH</option>
                    </select>
                    <button class="btn btn-primary btn-block mt-2">Вывести</button>
                </div>
            </form>
        </div>
        <div class="row my-2">
            <div class="col-md-6 col-md-offset-3">
                <div class="table-responsive">
                    <h4 class="text-center">История выплат:</h4>
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th class="text-center">Дата</th>
                            <th class="text-center">Сумма (<i class="fa fa-usd"></i>)</th>
                            <th class="text-center">Система</th>
                            <th class="text-center">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($myPayments as $myPayment)
                            <tr>
                                <td>{{$myPayment->created_at->format("d.M.Y H:i")}}</td>
                                <td>{{$myPayment->amount}}</td>
                                <td>{{$myPayment->payment_system}}</td>
                                <td>{{$myPayment->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#withdraw_amount').on('input', function(){
            var left = '{{$me->money}}' - $(this).val();
           $('#left_amount').val(left <= 0 ? '0.00' : left);
        });
    </script>
@endpush