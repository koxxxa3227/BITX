@extends("layouts.app")

@section("content")
    <div class="container my-2">
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
                            <select name="invest_plan" id="invest_plan" class="text-uppercase invest_plan" required>
                                @foreach($plans as $select_plan)
                                    <option value="{{$select_plan->id}}" {{$select_plan->id == $key+1 ? "selected" : ""}}>{{$select_plan->title}}</option>
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
                        <label for="income_amount_{{$plan->id}}">Доход от депозита (<i
                                    class="fa fa-usd"></i>)</label>
                        <input type="text" class="form-control"
                               value="{{$plan->min_amount + ($plan->min_amount * $plan->percent / 100)*$plan->days_multiply}}"
                               name="income_amount" id="income_amount_{{$plan->id}}"
                               readonly>
                        @if($key+1 == 4)
                            Оплата раз в 14 дней
                        @endif
                        <button class="btn btn-primary btn-block mt-1">Инверстировать</button>
                    </div>
                </div>
            </form>
        @endforeach
        <div class="row my-2">
            <div class="col-md-6 col-md-offset-3">
                <div class="table-responsive">
                    <h4 class="text-center">История:</h4>
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th class="text-center">Дата</th>
                            <th class="text-center">План</th>
                            <th class="text-center">Сумма</th>
                            <th class="text-center">Начислено</th>
                            <th class="text-center">Всего</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($myDeposits as $myDeposit)
                            <tr>
                                <td>{{$myDeposit->created_at->format("d.M.Y H:i")}}</td>
                                <td class="text-uppercase">{{$myDeposit->plan->title}}</td>
                                <td>{{$myDeposit->payment_amount}} <i class="fa fa-usd"></i></td>
                                <td>{{$myDeposit->income_with_percent - $myDeposit->payment_amount}} <i
                                            class="fa fa-usd"></i></td>
                                <td>{{$myDeposit->income_with_percent}} <i class="fa fa-usd"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
            $('.invest_plan').on('change', function () {
                $('.deposit_form').addClass('d-none');
                var target = $(this).val();
                var new_target = 'deposit_form_' + target;
                $('.' + new_target).removeClass('d-none');
            });
        });
    </script>
@endpush