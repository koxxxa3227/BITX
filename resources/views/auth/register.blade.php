@extends("layouts.app")

@section("content")
    <div id="content_wrapper">
        <div id="content">
            <div class="content-box-wrapper">
                <div class="content-box full-box">
                    <div class="big-title">
                        <span>Регистрация</span>
                    </div>
                    <form method="post" id="forms" action="{{route('register')}}" class="register_form full_form">
                        {{csrf_field()}}
                        <div class="form_wrapper">
                            <fieldset>
                                <div class="formatTable">
                                    <div class="form_group_wrapper{{ $errors->has('login') ? ' is-invalid' : '' }}">
                                        <label for="register_frm_uLogin">
                                            Пидумайте логин<span class="descr_star">*</span>
                                        </label>
                                        <input type="text" name="login" value="" placeholder="Придумайте логин"
                                               class="inputs string_small" size="30" required="" autofocus="">


                                        @if ($errors->has('login'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form_group_wrapper{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                        <label for="register_frm_uMail">
                                            Укажите E-mail<span class="descr_star">*</span>
                                        </label>
                                        <input type="email" name="email" value="" placeholder="Ваш E-mail"
                                               class="inputs string_small" size="30" required="">


                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form_group_wrapper{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                        <label for="register_frm_uPass">
                                            Придумайте пароль<span class="descr_star">*</span>
                                        </label>
                                        <input type="password" name="password" placeholder="Придумайте пароль"
                                               class="inputs password" size="30" required="">


                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form_group_wrapper{{ $errors->has('skype') ? ' is-invalid' : '' }}">
                                        <label for="register_frm_skype">
                                            Укажите Skype
                                        </label>
                                        <input type="text" name="skype" placeholder="Ваш Skype" class="inputs "
                                               size="30">


                                        @if ($errors->has('skype'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form_group_wrapper{{ $errors->has('ref') ? ' is-invalid' : '' }}">
                                        <label for="register_frm_Pass2">
                                            Укажите пригласителя<span class="descr_star">*</span>
                                        </label>
                                        <input type="text" name="ref" placeholder="Логин пригласителя" class="inputs"
                                               size="30" required="" readonly>


                                        @if ($errors->has('ref'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ref') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form_group_wrapper{{ $errors->has('telegram') ? ' is-invalid' : '' }}">
                                        <label for="register_frm_Pass2">
                                            Укажите Telegram
                                        </label>
                                        <input type="text" name="telegram" placeholder="Ваш Telegram" class="inputs"
                                               size="30">

                                        @if ($errors->has('telegram'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('telegram') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>


                                <div class="formatTable">
                                    <div class="form_group_wrapper checkbox_wrapper">
                                        <input type="checkbox" name="rules" value="check" id="register_frm_Agree2"
                                               class="checkbox" required=""
                                               style="    float: left; margin: 5px 10px 0px 0px; bottom: 4px; position: relative;">
                                        <label for="register_frm_Agree2">
                                            Я согласен с <a href="/rules">правилами</a>
                                            <span class="descr_star">*</span>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                            <button name="register_frm_btn" type="submit" class="button-blue">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function(){
           var href = location.href;
           href = href.replace('http://{{$_SERVER['HTTP_HOST']}}/register?ref=', '');
           $('[name="ref"]').val(href);
        });
    </script>
@endpush