@extends("layouts.app")

@section("content")
    <div class="container my-2">
        <div class="row">
            @include('components.cabinet.menu', ['value' => '1'])
        </div>
        <div class="row">
            <form action="{{action('Profile\ActionController@depositsRequest')}}" class="deposit_form" method="post">
                {{csrf_field()}}
                <input type="text" hidden name="hidden_plan_id" id="hidden_plan_id">
                <input type="text" hidden name="enter_amount" id="enter_amount">
                <div class="col-md-5 text-center">
                    <div class="form-group">
                        <label for="invest_plan">Выберите инвестиционный план:</label> <br>
                        <select name="invest_plan" id="invest_plan" class="text-uppercase" required>
                            <option value="">-Выберите План-</option>
                            @foreach($plans as$plan)
                                <option value="{{$plan->id}}">{{$plan->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($plans as $plan)
                        <div class="row plan_item d-none plan_id_{{$plan->id}}">
                            <div class="col-md-6">
                                <label for="payment_amount_{{$plan->id}}">Введите сумму пополнения (<i
                                            class="fa fa-usd"></i>)</label>
                                <input type="number" min="{{$plan->min_amount}}" value="{{$plan->min_amount}}"
                                       max="{{$plan->max_amount}}" class="form-control payment_amount"
                                       name="payment_amount"
                                       oninput="$('#income_amount_'+'{{$plan->id}}').val($(this).val() *('{{$plan->percent}}'*'{{$plan->days_multiply}}')); $('#enter_amount').val($(this).val());"
                                       id="payment_amount_{{$plan->id}}">
                            </div>
                            <div class="col-md-6">
                                <label for="income_amount_{{$plan->id}}">Доход после пополнения (<i
                                            class="fa fa-usd"></i>)</label>
                                <input type="text" class="form-control"
                                       value="{{(($plan->percent*$plan->days_multiply)*$plan->min_amount)}}"
                                       name="income_amount" id="income_amount_{{$plan->id}}"
                                       readonly>
                                Оплата раз в 14 дней
                            </div>
                        </div>
                    @endforeach

                    @push('script')
                        <script>
                            $(function () {
                                $('#invest_plan').on('change', function () {
                                    $('.plan_item').addClass('d-none');
                                    var target = $(this).val();
                                    var new_target = 'plan_id_' + target;
                                    $('.' + new_target).removeClass('d-none');
                                    $('#hidden_plan_id').val(target);
                                    $('#enter_amount').val($('#payment_amount_' + target).val());
                                });
                            });
                        </script>
                    @endpush
                </div>

                <div class="col-md-7 text-center d-block d-md-none" id="desktop_payment_system">
                    <h4>Выберите систему пополнения:</h4>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/logo-payeer.png" alt="" id="payeer_img"
                                 class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="payeer" id="payeer_radio" checked>
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/PerfectMoney.png" alt="" id="pm_img" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="pm" id="pm_radio">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/ADVCASH.png" alt="" id="adv_img" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="adv" id="adv_radio">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/bitcoin.png" alt="" id="btc_img" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="btc" id="btc_radio">
                    </div>
                    <div class="col-md-2">
                        <div class="img-block">
                            <img src="/img/ETH.png" alt="" id="eth_img" class="img-responsive thumbnail m-auto">
                        </div>
                        <input type="radio" name="payment_system" value="eth" id="eth_radio">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-styled">Инвестировать</button>
                    </div>

                    @push('script')
                        <script>
                            $('#desktop_payment_system img').on('click', function (e) {
                                var target = $(e.target).attr('id');
                                target = target.replace('_img', '_radio');
                                $('input[type="radio"]').attr('checked', false);
                                $('#' + target).attr('checked', true);
                            });
                        </script>
                    @endpush
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
                    <button class="btn-primary btn btn-block mt-2">Инвестировать</button>
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
                        @foreach($myDeposits as $myDeposit)
                            <tr>
                                <td>{{$myDeposit->created_at->format("d.M.Y H:i")}}</td>
                                <td>{{$myDeposit->payment_amount}}</td>
                                <td>{{__($myDeposit->payment_system)}}</td>
                                <td>{{$myDeposit->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection