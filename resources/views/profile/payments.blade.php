@extends("layouts.app")

@push('style')
    <style>
        .col-20p {
            width        : 100%;
            float        : left;
            margin-left  : 15px;
            margin-right : 15px;
        }

        @media (min-width : 769px) {
            .col-20p {
                width : calc(100% / 5 - 30px);
            }
        }
    </style>
@endpush

@section("content")
    <div class="container my-2">
        <div class="row">
            @include('components.cabinet.menu', ['value'=> '2'])
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Пополнить:</h4>
                <form action="{{action('Profile\ActionController@replenishmentRequest')}}" method="post"
                      class="replenishment_frm">
                    @csrf
                    <div class="row text-center">
                        <div class="d-block d-xs-none" id="desktop_replenishment_system">
                            <h4 class="text-center">Выберите систему пополнения:</h4>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/logo-payeer.png" alt="" id="payeer_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="payeer_radio" value="payeer" title="Payeer" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/PerfectMoney.png" alt="" id="pm_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="pm_radio" value="pm" title="Perfect Money" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/ADVCASH.png" alt="" id="adv_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="adv_radio" value="adv" title="ADVCash" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/bitcoin.png" alt="" id="btc_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="btc_radio" value="btc" title="Bitcoin" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/ETH.png" alt="" id="eth_img" class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="eth_radio" value="eth" title="Ethereum" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="replenishment_amount">Укажите сумму пополнения (<i
                                            class="fa fa-usd"></i>)</label>
                                <input type="number" min="0" value="" class="form-control" name="replenishment_amount"
                                       id="replenishment_amount" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="future_amount">Количество средств после пополнения (<i
                                            class="fa fa-usd"></i>)</label>
                                <input type="text" class="form-control" name="future_amount" id="future_amount"
                                       value="{{$me->money}}" readonly>
                            </div>
                        </div>
                        <div class="text-center d-block d-xs-none">
                            <button class="btn btn-primary">Пополнить</button>
                        </div>
                    </div>

                    <div class="row mt-3 d-none d-md-block">
                        <div class="col-md-7 text-center">
                            <label for="payment_system_mobile">Выберите систему пополнения:</label>
                            <select name="payment_system_mobile" id="payment_system_mobile">
                                <option value="payeer">Payeer</option>
                                <option value="pm">Perfect Money</option>
                                <option value="adv">Advcash</option>
                                <option value="btc">BTC</option>
                                <option value="eth">ETH</option>
                            </select>
                            <button class="btn btn-primary btn-block my-2">Пополнить</button>
                        </div>
                    </div>
                </form>
                @if(isset($popup) && !empty($popup))
                    @if($wallet_info = getTheContent($popup))
                        <div class="modal fade in show" id="myModal" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Запрос принят. Инструкции для {{__($wallet_info->wallet)}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        {!! $wallet_info->content !!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" data-dismiss="modal"
                                                id="close-modal">
                                            Ок
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-6 text-center">
                <h4 class="text-center">Вывести:</h4>
                <form action="{{action('Profile\ActionController@paymentsRequest')}}" class="deposit_form"
                      method="post">
                    @csrf
                    <div class="row text-center">
                        <div class="d-block d-xs-none" id="desktop_payment_system">
                            <div class="form-group">
                                <p>Что бы вывести средства, укажите сумму и выберите электронный кошелёк</p>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/logo-payeer.png" alt="" id="payeer_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="payeer_radio" value="payeer" title="Payeer" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/PerfectMoney.png" alt="" id="pm_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="pm_radio" value="pm" title="Perfect Money" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/ADVCASH.png" alt="" id="adv_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="adv_radio" value="adv" title="ADVCash" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/bitcoin.png" alt="" id="btc_img"
                                         class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="btc_radio" value="btc" title="Bitcoin" required>
                            </div>
                            <div class="col-20p">
                                <div class="img-block">
                                    <img src="/img/ETH.png" alt="" id="eth_img" class="img-responsive thumbnail m-auto">
                                </div>
                                <input type="radio" name="payment_system" id="eth_radio" value="eth" title="Ethereum" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="withdraw_amount">Укажите сумму вывода (<i
                                            class="fa fa-usd"></i>)</label>
                                <input type="number" min="0" value="" class="form-control" name="withdraw_amount"
                                       id="withdraw_amount" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="left_amount">Остаток средств после вывода (<i
                                            class="fa fa-usd"></i>)</label>
                                <input type="text" class="form-control" name="left_amount" id="left_amount"
                                       value="{{$me->money}}" readonly>
                            </div>
                        </div>
                        <div class="text-center d-block d-xs-none">
                            <button class="btn btn-primary">Вывести</button>
                        </div>
                    </div>

                    <div class="row mt-3 d-none d-md-block">
                        <div class="col-md-7 text-center">
                            <label for="payment_system_mobile">Выберите систему вывода:</label>
                            <select name="payment_system_mobile" id="payment_system_mobile">
                                <option value="payeer">Payeer</option>
                                <option value="pm">Perfect Money</option>
                                <option value="adv">Advcash</option>
                                <option value="btc">BTC</option>
                                <option value="eth">ETH</option>
                            </select>
                            <button class="btn btn-primary btn-block mt-2">Вывести</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row my-2">
                <div class="col-md-6 col-md-offset-3">
                    <div class="table-responsive">
                        <h4 class="text-center">История платежей:</h4>
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="text-center">Дата</th>
                                <th class="text-center">Сумма (<i class="fa fa-usd"></i>)</th>
                                <th class="text-center">Тип</th>
                                <th class="text-center">Система</th>
                                <th class="text-center">Статус</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->created_at->format("d.m.Y H:i")}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->type}}</td>
                                    <td>{{$payment->payment_system ?: "Не указано"}}</td>
                                    <td>
                                        @lang("Payment Status $payment->status_id")
                                    </td>
                                    <td>
                                        @if($payment->status_id == 1 && $payment->payment_system == 'adv')
                                            <a class="btn btn-sm btn-success" href="{{ action('AdvCashController@pay',$payment->id) }}">Оплатить</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        @if(isset($popup) && !empty($popup))
        $('#close-modal').on('click', function () {
            // $('#myModal').removeClass('show');

            window.location.replace('/profile/balance');
        });
        @endif

        $('#withdraw_amount').on('input', function () {
            var left = '{{$me->money}}' - $(this).val();
            $('#left_amount').val(left <= 0 ? '0.00' : left);
        });
        $('#replenishment_amount').on('input', function () {
            var left = parseFloat("{{$me->money}}") + parseFloat($(this).val());
            $('#future_amount').val($(this).val() == '' ? '{{$me->money}}' : left);
        });
    </script>
@endpush

@push('script')
    <script>
        $('#desktop_payment_system img').on('click', function (e) {
            var target = $(e.target).attr('id');
            target = target.replace('_img', '_radio');
            $('#desktop_payment_system input[type="radio"]').attr('checked', false);
            $('#desktop_payment_system #' + target).attr('checked', true);
        });
        $('#desktop_replenishment_system img').on('click', function (e) {
            var target = $(e.target).attr('id');
            target = target.replace('_img', '_radio');
            $('#desktop_replenishment_system input[type="radio"]').attr('checked', false);
            $('#desktop_replenishment_system #' + target).attr('checked', true);
        });
    </script>
@endpush