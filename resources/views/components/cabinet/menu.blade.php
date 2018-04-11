<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked" id="cabinet-menu">
        <li role="presentation" class="{{$value == 3 ? "active" : ""}}"><a href="{{action('Profile\PageController@cabinet')}}">Кабинет</a></li>
        <li role="presentation" class="{{$value == 1 ? "active" : ""}}"><a href="{{action('Profile\PageController@deposit')}}">Депозит</a></li>
        <li role="presentation" class="{{$value == 2 ? "active" : ""}}"><a href="{{action('Profile\PageController@payments')}}">Баланс</a></li>
        <li role="presentation" class="{{$value == 4 ? "active" : ""}}"><a href="{{action('Profile\PageController@refs')}}">Рефералы</a></li>
        <li role="presentation"><a href="{{route('logout')}}">Выход</a></li>
    </ul>
</div>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-3 col-sm-6 mt-sm-2">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Баланс:</small>
                <p class="mt-2"><strong>{{number_format($me->money, 2, '.', ' ')}} <i class="fa fa-usd"></i></strong></p>
                <p class="mt-1"><a href="{{action('Profile\PageController@payments')}}">Пополнить</a></p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mt-sm-2">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Доход от инвестиций:</small>
                <p><strong>{{allIncomesFromDeposits()}} <i class="fa fa-usd"></i></strong></p>
                <p class="check-circle"><i class="fa fa-check"></i></p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mt-sm-2">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Общий реферальный доход:</small>
                <p><strong>{{allRefsSum()}} <i class="fa fa-usd"></i></strong></p>
                <p class="check-circle"><i class="fa fa-check"></i></p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mt-sm-2">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Всего <br> выплачено:</small>
                <p><strong>{{allMyPayments()}} <i class="fa fa-usd"></i></strong></p>
                <p class="check-circle"><i class="fa fa-check"></i></p>
            </div>
        </div>
    </div>
</div>
<div class=" col-sm-12 col-md-3 text-right text-sm-center mt-sm-2">
    <p class="login"><i class="fa fa-user" aria-hidden="true"></i> Ваш логин: <strong>{{$me->login}}</strong></p>
    <p class="my-ref mt-1"><i class="fas fa-handshake" aria-hidden="true"></i> Ваш рефер: <strong>{{!empty($me->ref_login) ? $me->ref_login : "Не задан"}}</strong></p>
</div>