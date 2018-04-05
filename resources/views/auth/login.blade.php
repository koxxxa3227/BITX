@extends('layouts.app')

@push('style')
    <style>
        #login_frm input[type="text"],
        #login_frm input[type="email"],
        #login_frm input[type="password"] {
            position    : relative;
            width       : 100%;
            margin      : 5px 0 0;
            padding     : 15px;
            background  : #f2f2f2;
            border      : 0;
            font-family : centar sans, sans-serif;
            font-size   : 14px;
            height      : inherit;
        }

        #login_frm label {
            position : relative;
            float    : left;
            width    : 100%;
            margin   : 0;
            padding  : 0;
        }

        .big-title {
            float       : left;
            width       : 100%;
            margin      : 0;
            padding     : 0 0 18px;
            font-size   : 24px;
            line-height : normal;
            font-family : uni sans, sans-serif;
        }

        .d-inline-block {
            display : inline-block;
        }

        .btn-link {
            padding   : 0;
            font-size : 12px;
        }
    </style>
@endpush

@section('content')
    <div class="container my-2">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="big-title text-center">
                    <span class="card-header">Вход</span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="login_frm">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Адресс') }}</label>

                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Пароль') }}</label>

                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               name="remember" {{ old('remember') ? 'checked' : '' }}> Запомни меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary button-blue">
                                    Вход
                                </button>
                                <br>
                                <a class="btn btn-link d-inline-block mt-2" href="{{ route('password.request') }}">
                                    Забыли ваш пароль?
                                </a>
                                <br> -или- <br>
                                <a href="{{route('register')}}" class="btn btn-link d-inline-block">
                                    Хотите зарегистрироваться?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
