@extends("layouts.app")

@push('style')
    <style>
        .deposit_form select {
            width : 100%;
        }

        .text-success {
            color : #38ae37;
        }

        .show-incomes:hover {
            cursor : pointer;
        }
    </style>
@endpush

@section("content")
    <div class="container my-2 cabinet-css">
        <div class="row">
            @include('components.cabinet.menu', ['value' => '1'])
        </div>
        @foreach($plans as $key=>$plan)
            <form action="{{action('Profile\ActionController@depositsRequest')}}"
                  class="deposit_form {{$key+1 == 1 ? "" : "d-none"}} deposit_form_{{$plan->id}}"
                  method="post">
                @csrf
                <input type="text" id="hidden_plan_id" name="hidden_plan_id" hidden value="{{$plan->id}}">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="form-group">
                            <label for="invest_plan">Выберите инвестиционный план:</label> <br>
                            <select name="invest_plan" id="invest_plan" class="text-uppercase invest_plan">
                                @foreach($plans as $select_plan)
                                    <option value="{{$select_plan->id}}" {{($select_plan->id == $plan->id) ? "selected" : ""}}>{{$select_plan->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <label for="payment_amount_{{$plan->id}}">Введите сумму пополнения (<i
                                    class="fa fa-usd"></i>)</label>
                        <input type="number" min="{{$plan->min_amount}}" value="{{$plan->min_amount}}"
                               max="{{$plan->max_amount}}" class="form-control payment_amount"
                               name="payment_amount"
                               oninput="$('#income_amount_{{$plan->id}}').val(parseFloat($(this).val()) + parseFloat($(this).val() * '{{$plan->percent}}' / 100)*'{{$plan->days_multiply}}'); $('#enter_amount').val($(this).val());"
                               id="payment_amount_{{$plan->id}}">
                    </div>
                    <div class="col-md-4 text-center">
                        <label for="income_amount_{{$plan->id}}">Прибыль от депозита за {{$plan->days_multiply}} дней
                            (<i
                                    class="fa fa-usd"></i>)</label>
                        <input type="text" class="form-control"
                               value="{{$plan->min_amount + ($plan->min_amount * $plan->percent / 100)*$plan->days_multiply}}"
                               name="income_amount" id="income_amount_{{$plan->id}}"
                               readonly>
                        @if($key+1 == 4)
                            Оплата раз в 14 дней
                        @endif
                        <button class="btn btn-primary btn-block mt-1">Инвестировать</button>
                    </div>
                </div>
            </form>
        @endforeach
        <div class="row my-2">
            <div class="col-md-8 col-md-offset-2">
                <div class="table-responsive">
                    <h4 class="text-center">История:</h4>
                    <div class="row text-center">
                        <div class="col-sm-3"><h3 class="text-weight-bold">Дата</h3></div>
                        <div class="col-sm-2"><h3 class="text-weight-bold">План</h3></div>
                        <div class="col-sm-2"><h3 class="text-weight-bold">Сумма</h3></div>
                        <div class="col-sm-5"><h3 class="text-weight-bold">Статус</h3></div>
                    </div>
                    <hr>
                    @foreach($myDeposits as $key=>$myDeposit)
                        <div class="row text-center">
                            <div class="col-md-3">
                                {{$myDeposit->created_at->format("d.m.Y H:i")}}
                            </div>
                            <div class="col-md-2 text-uppercase">
                                {{$myDeposit->plan->title}}
                            </div>
                            <div class="col-md-2">
                                {{money($myDeposit->payment_amount)}} <i class="fa fa-usd"></i>
                            </div>
                            <div class="col-md-5">
                                @if($endDate = endDate($myDeposit->created_at, $myDeposit->plan->days_multiply))
                                    @if($myDeposit->status == "Обработан")
                                        <span class="text-success">Завершен</span>.
                                        {{$endDate->format("d.m.Y H:i")}}
                                        начислено {{money($myDeposit->payment_amount + $myDeposit->income_with_percent)}}
                                        $
                                    @else
                                        @if($myDeposit->plan->id != 4)
                                            {{$endDate->format("d.m.Y H:i")}} будет
                                            начислено {{money($myDeposit->income_with_percent + $myDeposit->payment_amount)}}
                                            <i class="fa fa-usd"></i>
                                        @else
                                            Бессрочно. Выплата раз в 14 дней. Через {{businessProLeftDay($myDeposit)}}
                                            дней, вам будет начислено
                                            {{$myDeposit->payment_amount*$myDeposit->plan->percent / 100 * businessProLeftDay($myDeposit)}}
                                        @endif
                                    @endif
                                @endif
                                <br>
                                <span class="text-success show-incomes"
                                      id="{{$key+1}}">Заработано {{accruedMoney($myDeposit->id)}} <i
                                            class="fa fa-usd"></i></span>

                            </div>
                        </div>
                        <div id="hidden-incomes_{{$key+1}}" class="row text-center d-none">
                            @if(count(AllMyDeposits($myDeposit->id)) > 0)
                                @foreach(AllMyDeposits($myDeposit->id) as $item)
                                    <div class="col-md-3">{{$item->created_at->format("d.m.Y H:i")}}</div>
                                    <div class="col-md-5 col-md-offset-4 text-success">Прибыль {{$item->amount}} <i
                                                class="fa fa-usd"></i></div>
                                @endforeach
                            @else
                                <div class="text-center">Ещё ничего не зачислено</div>
                            @endif
                        </div>
                        <hr>
                    @endforeach
                </div>
                <div class="text-center">
                    {{$myDeposits->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function () {
            var href = location.href, id = href.replace('https://' + location.host + '/profile/deposit/', '');
            if (id != location.href) {
                $('.deposit_form').addClass('d-none');
                $('.deposit_form_' + id).removeClass('d-none');
                $('.invest_plan option').removeAttr('selected');
                $('.deposit_form_' + id + ' .invest_plan option[value="' + id + '"]').attr('selected', true);
            }

            $(document).on('change', '.invest_plan', function () {
                $('.deposit_form').addClass('d-none');
                var target = $(this).val();
                var new_target = '.deposit_form_' + target;
                $(new_target).removeClass('d-none');
                $('.invest_plan option').removeAttr('selected');
                $(new_target + ' .invest_plan option[value="' + target + '"]').attr('selected', true);
            });

            $('.show-incomes').on('click', function (e) {
                var target = $(e.target).attr('id');
                $('#hidden-incomes_' + target).slideToggle();
            })
        });
    </script>
@endpush