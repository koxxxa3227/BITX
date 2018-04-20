@extends("layouts.app")

@section("content")
    <div class="container my-2">
        @include('components.admin_user_menu')
        <h2 class="text-center">Открыть новый депозит:</h2>
        @foreach($plans as $plan)
            <form action="{{action('Admin\ActionController@createNewDeposit', $user_id)}}" method="post" class="deposit_form deposit_form_{{$plan->id}} {{$plan->id != 1 ? "d-none" : ""}}">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="plan_{{$plan->id}}_title">Выберите план:</label>
                            <select name="selected_plan" id="plan_{{$plan->id}}_title" class="invest_plan custom-select">
                                @foreach($plans as $select_plan)
                                    <option value="{{$select_plan->id}}" {{$plan->id == $select_plan->id ? "selected" : ""}}>{{strtoupper($select_plan->title)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="plan_{{$plan->id}}_amount">Сумма</label>
                            <input type="number" min="{{$plan->min_amount}}" value="{{$plan->min_amount}}"
                                   max="{{$plan->max_amount}}" class="form-control payment_amount"
                                   name="payment_amount"
                                   oninput="$('#plan_{{$plan->id}}_income').val(parseFloat($(this).val()) + parseFloat($(this).val() * '{{$plan->percent}}' / 100)*'{{$plan->days_multiply}}'); $('#enter_amount').val($(this).val());"
                                   id="payment_amount_{{$plan->id}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="plan_{{$plan->id}}_income">Результат депозита:</label>
                            <input type="text" class="form-control" name="income" id="plan_{{$plan->id}}_income"
                                   value="{{$plan->min_amount + $plan->min_amount * $plan->percent / 100 * $plan->days_multiply}}">
                        </div>
                    </div>
                    <input type="text" hidden value="{{$plan->percent}}" id="hidden_plan_{{$plan->id}}_percent">
                    <input type="text" hidden value="{{$plan->days_multiply}}"
                           id="hidden_plan_{{$plan->id}}_day_multiply">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plan_{{$plan->id}}_date">Дата открытия:</label>
                            <input type="date" name="open_date" id="plan_{{$plan->id}}_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="open_time">Время открытия</label>
                            <input type="time" id="open_time" name="open_time" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">Создать</button>
                </div>
            </form>
        @endforeach

        <div class="table-responsive">
            <h2 class="text-center">Открытые депозиты:</h2>
            <table class="table text-center">
                <thead>
                <tr>
                    <th class="text-center font-weight-bold">Дата</th>
                    <th class="text-center font-weight-bold">План</th>
                    <th class="text-center font-weight-bold">Сумма</th>
                    <th class="text-center font-weight-bold">Результат</th>
                    <th class="text-center">Опции</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deposits as $deposit)
                    <tr>
                        <td>{{$deposit->created_at->format('d.m.Y H:i')}}</td>
                        <td class="text-uppercase">{{$deposit->plan->title}}</td>
                        <td>{{$deposit->payment_amount}} <i class="fa fa-usd"></i></td>
                        <td>{{$deposit->payment_amount+$deposit->income_with_percent}} <i class="fa fa-usd"></i></td>
                        <td>
                            <a href="{{action('Admin\ActionController@removeDeposit', [$user_id, $deposit->id])}}"> Удалить</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('change', '.invest_plan', function () {
            $('.deposit_form').addClass('d-none');
            var target = $(this).val();
            var new_target = '.deposit_form_' + target;
            $(new_target).removeClass('d-none');
            $('.invest_plan option').removeAttr('selected');
            $(new_target + ' .invest_plan option[value="' + target + '"]').attr('selected', true);
        });
    </script>
@endpush