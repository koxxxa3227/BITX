@extends('layouts.app')

@push('style')
    <style>
        .mb-3 {
            margin-bottom : 3rem;
        }
    </style>
@endpush

@section('content')

    <!--Top_content-->
    <section id="top_content" class="top_cont_outer">
        <div class="top_cont_inner">
            <div class="container">
                <div class="top_content">
                    <div class="row">
                        <div class="col-lg-5 col-sm-7" style="float: right;">
                            <div class="top_left_cont flipInY wow animated">
                                <h2>Здесь зарождаются
                                    истоки будущего процветания</h2>
                                <p> Инвестиционный VIP-клуб для тех, кто ценит время и хочет выйти за рамки традиционных
                                    понятий прибыльности</p>
                                <a href="#service" class="learn_more2">Узнать больше</a></div>
                        </div>
                        <div class="col-lg-7 col-sm-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Top_content-->

    <!--Service-->
    <section id="service">
        <div class="container">
            <h2>Сделай три простых шага</h2>
            <div class="service_area">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="service_block">
                            <div class="service_icon icon1 delay-03s animated wow  zoomIn"><span></span>
                            </div>
                            <h3 class="animated fadeInUp wow">СТАНОВИТЕСЬ ЧЛЕНОМ НАШЕГО КЛУБА</h3>
                            <p class="animated fadeInDown wow">Присоединяйтесь к нашему клубу</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service_block">
                            <div class="service_icon icon2  delay-03s animated wow zoomIn"><span></span></div>
                            <h3 class="animated fadeInUp wow">ПРИНИМАЙТЕ АКТИВНОЕ УЧАСТИЕ</h3>
                            <p class="animated fadeInDown wow">Каждое пополнение делает Ваше участие в клубе более
                                весомым.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service_block">
                            <div class="service_icon icon3  delay-03s animated wow zoomIn"><span></span>
                            </div>
                            <h3 class="animated fadeInUp wow">ПОЛУЧАЙТЕ РЕЗУЛЬТАТ</h3>
                            <p class="animated fadeInDown wow">Выводите стабильную прибыль от пассивного
                                инвестирования.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-logo-part">
            <!--c-logo-part-start-->
            <div class="container">
                <h1 style="color: #fff; text-align: center;">ВЫБОР ИНВЕСТИЦИОННОГО ПЛАНА</h1><br>
                <h3 style="color: #fff; text-align: center; padding-bottom: 20px">Любой выбор неизменно даст лучший
                    результат
                    пассивного и безопасного заработка</h3>
            </div>
        </div>
    </section>
    <!--Service-->

    <div class="table-responsive">
        <section id="pricingSECTION_1">
            <div id="pricingDIV_2">

                <div id="pricingDIV_8">
                    @foreach($plans as $plan)
                        <div id="pricingDIV_9">
                            <div id="pricingDIV_10">
                                <div id="pricingDIV_11">
                                    <p id="pricingP_12" style="text-transform: uppercase">
                                        {{$plan->title}}
                                    </p>
                                </div>
                                <div id="pricingDIV_13">
                                    <h4 id="pricingH4_14">
                                        <sup id="pricingSUP_15">%</sup>{{$plan->percent}}
                                    </h4>
                                </div>
                                <div id="pricingDIV_17">
                                    <ul id="pricingUL_18">
                                        <li id="pricingLI_19">
                                            Минимальная сумма: $ {{$plan->min_amount}}
                                        </li>
                                        <li id="pricingLI_20">
                                            Максимальная сумма: $ {{$plan->max_amount}}
                                        </li>
                                        <li id="pricingLI_21">
                                            Срок инвестиции: {{$plan->invest_time}}
                                        </li>
                                        <li id="pricingLI_22">
                                            Дни начислений: {{$plan->accrual_date}}
                                        </li>
                                        <li id="pricingLI_23">
                                            Выплаты: {{$plan->payments_date}}
                                        </li>
                                    </ul>
                                </div>
                                <div id="pricingDIV_24">
                                    <a href="{{\Auth::check() ? action('Profile\PageController@deposit', $plan->id) : "/register"}}" id="pricingA_25">Инвестировать</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!--main-section-end-->

    <!--new_portfolio-->

    <!-- Portfolio -->
    <section id="partnerSECTION_1">
        <div id="partnerDIV_2">
            <div id="partnerDIV_3">
                <div id="partnerDIV_4">
                    <div id="partnerDIV_5">
                        <h2 id="partnerH2_6">
                            Партнерское вознаграждение 11%
                        </h2>
                    </div>
                    <div id="partnerDIV_7">
                        <p id="partnerP_8">
                            Приглашайте партнёров и получайте поощрительный бонус.<br>
                            После открытия депозита Вашим партнёром, в течении 24-х часов, Вы получите
                            вознаграждение в
                            размере 11% от суммы инвестиции партнёра, на Ваш торговый счёт.
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="take-payments">
            <img src="/img/bitcoin.png" alt="">
            <img src="/img/ETH.png" alt="">
            <img src="/img/LTC.png" alt="">
            <img src="/img/dash.png" alt="">
            <img src="/img/PerfectMoney.png" width="241" height="141" alt="">
            <img src="/img/PAYER.png" alt="">
            <img src="/img/ADVCASH.png" alt="">
        </div>
    </section>

    <section id="howitwork">
        <div class="investmentContainer">
            <div class="c-logo-part" style="margin: 0;">
                <!--c-logo-part-start-->
                <div class="container">
                    <h1 style="color: #fff; text-align: center;">КАК ЭТО РАБОТАЕТ?</h1><br>
                    <h3 style="color: #fff; text-align: center; padding-bottom: 20px">ДЕЯТЕЛЬНОСТЬ КЛУБА ПОСТРОЕНА НА
                        СХЕМЕ ДОВЕРИТЕЛЬНОГО УПРАВЛЕНИЯ. ПОЛНУЮ ОТВЕТСТВЕННОСТЬ ЗА РАСПРЕДЕЛЕНИЕ И СОХРАННОСТЬ АКТИВОВ
                        КЛИЕНТОВ БЕРЕТ НА СЕБЯ КЛУБ BITX</h3>
                </div>
            </div>
            <div class="investmentInner zoomIn wow" style="visibility: visible; animation-name: zoomIn;">
                <div class="row">
                    <div class="col-lg-3 text-center">
                        <div class=" ctn-Instant-padding Instant-part1">
                            <h1>Регистрация на сайте</h1>
                            <p>Для получения доступа к финансовым операциям необходимо пройти регистрацию на сайте. </p>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="ctn-Instant-padding Instant-part2">
                            <h1>Открытие депозита</h1>
                            <p>Пополнив счет и выбрав подходящий по условиям тарифный план, Вы можете приступить к
                                открытию
                                депозита.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="ctn-Instant-padding Instant-part3">
                            <h1>Распределение средств</h1>
                            <p>Наши трейдеры приступают к подбору оптимальных торговых пар для инвестирования Ваших
                                средств,
                                согласно текущим условиям на рынке.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center">
                        <div class="ctn-Instant-padding Instant-part4">
                            <h1>Торговые операции</h1>
                            <p>Закончив процедуру распределения, начинаются активные торги, которые проходят в течение
                                всего
                                времени работы Вашего депозита.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <div class="ctn-Instant-padding Instant-part5">
                            <h1>Получение прибыли</h1>
                            <p>Деньги возвращаются на торговый баланс с процентами и Вы можете распределить их снова.
                                <br>
                                Открыть новые депозиты или вывести прибыль на свой электронный кошелек
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="c-logo-part">
        <!--c-logo-part-start-->
        <div class="container">
            <h1 style="color: #fff; text-align: center;">МЫ РАБОТАЕМ С</h1><br>
            <ul class="delay-06s animated  bounce wow">
                <li><a target="_blank" rel="nofollow noopener" href="https://exmo.me/"><h2
                                style="color: #fff; margin: 0;">EXMO</h2></a></li>
                <li><a target="_blank" rel="nofollow noopener" href="https://www.binance.com/"><h2
                                style="color: #fff; margin: 0;">BINANCE</h2></a></li>
                <li><a target="_blank" rel="nofollow noopener" href="https://poloniex.com/
"><h2 style="color: #fff; margin: 0;">POLONIEX</h2></a></li>
                <li><a target="_blank" rel="nofollow noopener" href="https://www.kraken.com/"><h2
                                style="color: #fff; margin: 0;">KRAKEN</h2></a></li>
            </ul>
        </div>
    </div>
    <!--c-logo-part-end-->
    <section class="main-section whoweare mb-3" id="whoweare">
        <!--main-section whoweare-start-->
        <div id="payDIV_1">
            <div id="payDIV_2">
                <div id="payDIV_3">
                    <div id="payDIV_4">
                        История развития
                    </div>
                    Наш клуб был основан в 2016 году из группы энтузиастов-криптотрейдеров и работал сугубо с личных
                    активами. В 2017 году, основатель клуба, Виктор Теницкий, принял решение по организации торговли с
                    заёмными средствами, но как показала практика, более крупных сумм для крипто-торговли банки и другие
                    фин учреждения не предоставляли. Тогда было принято решение привлекать посторонних спонсоров и
                    инвесторов к нашему клубу, для управления их денежными активами под фиксированный процент.
                    <br><br>
                    Трейдинговое подразделение компании насчитывает 16 биржевых трейдеров и 3 аналитика, которые
                    работают на неизменно лучший результат заключаемых торговых сделок на мировых криптовалютных биржах.
                    <br><br>
                    Наш клуб эффективно использует опыт сотрудников и активно осуществляет торговые операции по 28
                    валютным парам, используя одновременно 4 торговых стратегии, что сводит риски потерь практически к
                    нулю. Это основной критерий ведения бизнеса нашим клубом - обеспечить полную безопасность средств
                    инвесторов.
                    <br><br>
                    Благодаря арбитражной и другим видам торговли, мы извлекаем прибыль не только при растущем, но и при
                    падающем тренде. Осуществляя распределение инвестиционных направлений и регламентируя торговые
                    операции, компания гарантирует итоговую прибыльность всех сделок за любую торговую сессию.
                    <br><br>
                    Мы строго следуем заданной стратегии, что полностью минимизирует все риски связанные с человеческим
                    фактором, а общие цели и контроль торговых счетов позволяют нам уверенно предоставлять высокий
                    пассивный онлайн доход для инвесторов, опираясь на многолетний торговый опыт трейдеров и руководства
                    клуба.

                </div>
                <div id="payDIV_9">
                    <div id="payDIV_10">
                        Документация компании
                    </div>
                    <div id="payDIV_11">
                        <a target="_blank" href="/img/certificate.pdf" id="payA_12"><img src="/img/certificate.png"
                                                                                         width="200px" alt=""
                                                                                         id="payIMG_13"/></a>
                    </div>
                    <div id="payDIV_14">
                        <p>FUTURE TRADE BITCOIN MINING LTD</p>
                        <br><br>

                        <p>Сайт оснащен современным и надежным SSL сертификатом. <br>
                            Протокол шифрования от компании COMODO гарантирует Безопасность и конфиденциальных
                            данных.</p>

                        <br><br>
                        <p>Гарантия безопасности ваших данных 100 000 долларов США от компании Comodo CA Ltd SSL</p>
                        <img src="/img/ssl.jpg" id="payIMG_24" alt=''/>
                    </div>
                    <div id="payDIV_25">
                    </div>
                    <div id="px-15">
                        <a target="_blank" href="/img/certificate.pdf" id="payA_26">Посмотреть сертификат</a>
                    </div>
                </div>
                <div id="payDIV_27">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="twitter-feed">
        <!--twitter-feed-->
        <div class="container  animated fadeInDown delay-07s wow">
            <div class="twitter_bird"><span><i class="fa-twitter"></i></span></div>
            <p>Делайте дела с теми людьми, которые вам нравятся и которые разделяют ваши цели.</p>
            <span>Уоррен Баффет</span></div>
    </section>
@endsection
