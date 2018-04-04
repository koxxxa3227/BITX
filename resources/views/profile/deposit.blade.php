@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            @include('components.cabinet.menu', ['value' => '1'])
        </div>
        <div class="row">
            <form action="" class="deposit_form">
                {{csrf_field()}}
                <div class="col-md-5 text-center">
                    <div class="form-group">
                        <label for="invest_plan">Выберите инвестиционный план:</label> <br>
                        <select name="invest_plan" id="invest_plan">
                            <option value="">-Выберите План-</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="payment_amount">Введите сумму пополнения (<i class="fa fa-usd"></i>)</label>
                            <input type="number" min="1" class="form-control" name="payment_amount" id="payment_amount">
                        </div>
                        <div class="col-md-6">
                            <label for="income_amount">Доход после пополнения (<i class="fa fa-usd"></i>)</label>
                            <input type="text" class="form-control" name="income_amount" id="income_amount" readonly>
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
                        <button class="btn btn-primary btn-styled">Инвестировать</button>
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
                </div>
            </form>
        </div>
        <div class="row my-2">
            <div class="col-md-6 col-md-offset-3">
                <div class="table-responsive">
                    <h4 class="text-center">История пополнений:</h4>
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
                        <tr>
                            <td>25.12.2017</td>
                            <td>1500</td>
                            <td>Payeer</td>
                            <td>Success</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection