<div class="col-md-3">
    <ul class="nav nav-pills nav-stacked" id="cabinet-menu">
        <li role="presentation" class="{{$value == 1 ? "active" : ""}}"><a href="{{action('Profile\PageController@deposit')}}">Депозит</a></li>
        <li role="presentation" class="{{$value == 2 ? "active" : ""}}"><a href="{{action('Profile\PageController@payments')}}">Выплаты</a></li>
        <li role="presentation" class="{{$value == 3 ? "active" : ""}}"><a href="{{action('Profile\PageController@cabinet')}}">Кабинет</a></li>
        <li role="presentation" class="{{$value == 4 ? "active" : ""}}"><a href="{{action('Profile\PageController@refs')}}">Рефералы</a></li>
    </ul>
</div>
<div class="col-md-7">
    <div class="row">
        <div class="col-sm-4">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Доход от инвестиций:</small>
                <p><strong>0.00 <i class="fa fa-usd"></i></strong></p>
                <p class="check-circle"><i class="fa fa-check"></i></p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Общий реферальный доход:</small>
                <p><strong>0.00 <i class="fa fa-usd"></i></strong></p>
                <p class="check-circle"><i class="fa fa-check"></i></p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="rounded text-center border menu-info-item m-auto">
                <small class="text-secondary">Всего выплачено:</small>
                <p><strong>0.00 <i class="fa fa-usd"></i></strong></p>
                <p class="check-circle"><i class="fa fa-check"></i></p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 text-right">
    <p class="login"><i class="fa fa-user" aria-hidden="true"></i> Ваш логин: <strong>{{$me->login}}</strong></p>
    <p class="my-ref mt-1"><i class="fas fa-handshake" aria-hidden="true"></i> Ваш рефер: <strong>{{$me->ref_login}}</strong></p>
</div>