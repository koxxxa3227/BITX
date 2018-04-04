@extends("layouts.app")

@section("content")
    <div class="container my-2">
        <div class="row">
            @include('components.cabinet.menu', ['value' => '3'])
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4 class="text-center">Персональные данные</h4>
                <form action="" class="personal_data_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$me->email}}">
                            </div>
                            <div class="form-group">
                                <label for="login">Логин</label>
                                <input type="text" class="form-control" name="login" id="login" min="3"
                                       value="{{$me->login}}">
                            </div>
                            <div class="form-group">
                                <label for="registered">Дата регистрации</label>
                                <input type="text" class="form-control" name="registered" id="registered" min="3"
                                       value="{{$me->created_at}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old_password">Старый пароль</label>
                                <input type="password" class="form-control" name="old_password" id="old_password"
                                       min="6" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Новый пароль</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                       min="6" value="">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Подтвердить пароль</label>
                                <input type="password" class="form-control" name="confirm_password"
                                       id="confirm_password" min="6" value="">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-styled">Сохранить</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Кошельки</h4>
                <form action="" class="wallets_data_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payeer_wallet">Payeer</label>
                                <input type="text" value="" class="form-control" name="payeer_wallet"
                                       id="payeer_wallet">
                            </div>
                            <div class="form-group">
                                <label for="pm_wallet">Perfect money</label>
                                <input type="text" value="" class="form-control" name="pm_wallet"
                                       id="pm_wallet">
                            </div>
                            <div class="form-group">
                                <label for="ltc_wallet">LTC</label>
                                <input type="text" value="" class="form-control" name="ltc_wallet"
                                       id="ltc_wallet">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eth_wallet">ETH</label>
                                <input type="text" value="" class="form-control" name="eth_wallet"
                                       id="eth_wallet">
                            </div>
                            <div class="form-group">
                                <label for="btc_wallet">BTC</label>
                                <input type="text" value="" class="form-control" name="btc_wallet"
                                       id="btc_wallet">
                            </div>
                            <div class="form-group">
                                <label for="adv_wallet">Advcash</label>
                                <input type="text" value="" class="form-control" name="adv_wallet"
                                       id="adv_wallet">
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary btn-styled">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection