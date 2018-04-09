<header id="header_outer">
    <div class="container">
        <div class="header_section">
            <div class="logo"><a href="/"><img src="/img/bitx_logo.png" width="131" alt=""></a></div>
            <nav class="nav" id="nav">
                <ul class="toggle">
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#service">Преимущества</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#pricingSECTION_1">Инвесторам</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#partnerSECTION_1">Партнерам</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#howitwork">Как это работает</a></li>
                    <li><a href="{{!Request::is('/')  ? "/" : ""}}#whoweare">Кто мы</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#contact">Контакты</a></li>
                    @if(\Auth::check())
                        <li><a href="/profile">Кабинет</a></li>
                    @else
                        <li><a href="/login">Вход</a></li>
                    @endif
                </ul>
                <ul class="">
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#service">Преимущества</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#pricingSECTION_1">Инвесторам</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#partnerSECTION_1">Партнерам</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#howitwork">Как это работает</a></li>
                    <li><a href="{{!Request::is('/')  ? "/" : ""}}#whoweare">Кто мы</a></li>
                    <li><a href="{{!Request::is('/') ? "/" : ""}}#contact">Контакты</a></li>
                    @if(\Auth::check())
                        <li><a href="/profile">Кабинет</a></li>
                    @else
                        <li><a href="/login">Вход</a></li>
                    @endif
                </ul>
            </nav>
            <a class="res-nav_click animated wobble wow" href="javascript:void(0)"><i class="fa-bars"></i></a></div>
    </div>

    <div class="p-rel">
        @if(session('status'))
            <div class="alert status-alert" role="alert">
                {{session('status')}}
            </div>
        @endif
    </div>
</header>