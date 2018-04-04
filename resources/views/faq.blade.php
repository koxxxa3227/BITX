@extends("layouts.app")

@section("content")

    <div id="content_wrapper">
        <div id="content">
            <div class="content-box-wrapper">
                <div class="content-box full-box">
                    <div class="big-title">
                        <span>Вопросы и ответы</span>
                    </div>
                    <p>
                        В данном разделе Вы сможете найти всю самую важную информацию, касающуюся работы нашей компании
                        и некоторых условий непосредственно процесса инвестирования и сотрудничества с нами. Только
                        актуальная и проверенная информация. Напоминаем Вам, уважаемые инвесторы, что данные ответы,
                        размещенные в этом разделе, являются официальными и исчерпывающими, что означает их обязательное
                        принятие в формате «как есть». </p>
                </div>
                <div class="content-box full-box" style="padding-top:40px;">
                    <script>var $ = jQuery.noConflict();
                        $(document).ready(function () {
                            $('ul.tabs li').css('cursor', 'pointer');
                            $('ul.tabs.tabs1 li').click(function () {
                                var thisClass = this.className.slice(0, 2);
                                $('div.t1').hide();
                                $('div.t2').hide();
                                $('div.t3').hide();
                                $('div.t4').hide();
                                $('div.t5').hide();
                                $('div.' + thisClass).show();
                                $('ul.tabs.tabs1 li').removeClass('tab-current');
                                $(this).addClass('tab-current');
                            });
                        });</script>
                    <div class="faq-tabs-block">
                        <ul class="tabs tabs1">
                            <li class="t1 tab-current" style="cursor: pointer;">
                                <a>
                                    Общие вопросы </a>
                            </li>
                            <li class="t2" style="cursor: pointer;">
                                <a>
                                    Технические вопросы </a>
                            </li>
                            <li class="t3" style="cursor: pointer;">
                                <a>
                                    Финансовые вопросы </a>
                            </li>
                            <li class="t4 last" style="cursor: pointer;">
                                <a>
                                    Партнерская программа </a>
                            </li>
                        </ul>
                    </div>

                    <div class="faq-wrapper">
                        <!-- 1 -->
                        <div class="t1" style="display: block;">
                            <div class="faq-title">
                                1. Общие вопросы
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide1">
                                    1.1. Чем характеризуется бизнес-модель компании?
                                </a>
                                <div id="panel1">
                                    Компания предоставляет услуги Доверительного Управления инвестиционными средствами,
                                    добровольно предоставленных нам нашими инвесторами. Инновационная система
                                    диверсификации размещения инвестиционных средств предоставляет максимально
                                    положительные и результативные возможности для каждого участника процесса, делая
                                    сотрудничество с ними наиболее благоприятным. Использование в инвестировании таких
                                    направлений как vайнинг и торговля криптовалютой, компания генерирует прибыль и
                                    распределяет ее между всеми заинтересованными сторонами в соответствии количеству
                                    вложенных средств каждой стороной.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide2">
                                    1.2. Какими преимуществами располагает компания?
                                </a>
                                <div id="panel2">
                                    Самое важное, что мы предлагаем нашим инвесторам - безопасность и высокая доходность
                                    от размещенных в Доверительное Управление средств. Используя инновационную модель
                                    инвестирования, компания создает безубыточную форму сотрудничества, которая
                                    подкрепляется профессионализмом и компетентностью наших сотрудников, а также высокой
                                    надежностью используемых видеокарт. Уже в течении первых недель каждый инвестор
                                    сможет убедиться в эффективности предлагаемой нами бизнес-модели и по достоинству
                                    оценить уровень безопасности и доходности, декларируемых нашей компанией.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide3">
                                    1.3. На протяжении какого времени компания предоставляет свои услуги? </a>
                                <div id="panel3">
                                    BITX CRYPTO MINING & TRADING LIMITED предоставляет свои услуги всем заинтересованным
                                    сторонам c 2017 года, перманентно развивая и улучшая весь спектр услуг,
                                    предоставляемых в этом направлении.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide4">
                                    1.4. Что делается компанией для обеспечения безопасности инвестиций? </a>
                                <div id="panel4">
                                    BITX CRYPTO MINING & TRADING LIMITED предоставляет уникальную платформу
                                    Доверительного Управления инвестиционными средствами, на базе которой реализована
                                    бизнес-модель, которая практически полностью гарантирует безубыточность вложений.
                                    Это стало возможным благодаря разработанному компанией комплексу мер, дающих
                                    возможность гарантировать каждому нашему инвестору стабильные выплаты и полное
                                    соблюдение декларируемых компанией инвестиционных обязательств перед своими
                                    инвесторами.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide5">
                                    1.5. Как стать инвестором компании?
                                </a>
                                <div id="panel5">
                                    Чтобы иметь возможность инвестировать средства с помощью нашей компании, Вам
                                    необходимо зарегистрироваться на нашем официальном сайте. Напоминаем Вам, что пройдя
                                    процедуру регистрации, Вы автоматически принимаете все юридические положения,
                                    регулирующие сотрудничество между каждым нашим инвестором и компанией.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide6">
                                    1.6. Какое количество аккаунтов я могу использовать в системе? </a>
                                <div id="panel6">

                                </div>
                                z
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide7">
                                    1.7. Зависит ли система Доверительного Управления компании от оттока или притока
                                    инвестиционных средств? </a>
                                <div id="panel7">
                                    Объем генерированной прибыли пропорционален количеству вложенных средств. Таким
                                    образом, вне зависимости от притока или оттока инвестиционных средств, оставшиеся в
                                    системе инвесторы смогут получать декларируемый компанией доход, поскольку процесс
                                    инвестирования никоим образом не привязан к уровню и количеству новых денежных
                                    поступлений.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide8">
                                    1.8. Как связаться с экспертами компании? </a>
                                <div id="panel8">
                                    Для каждого своего инвестора компания предоставила возможность воспользоваться
                                    услугами нашей Службы поддержки. Для связи используйте, пожалуйста, электронную
                                    почту, онлайн-чат, телефон или форму обратной связи на официальном сайте компании.
                                </div>
                            </div>
                            <div class="faq_array last">
                                <a href="#" id="btn-slide29">
                                    1.9. Является ли предоставление личных данных обязательным? </a>
                                <div id="panel29">
                                    Да, это обязательное условие. Без предоставления актуальных и правдивых личных
                                    данных каждым инвестором процесс сотрудничества с компанией будет невозможен. Мы,
                                    как и все, поддерживаем тренд против отмывки нелегальных денег.
                                </div>
                            </div>
                        </div>
                        <!-- end 1 --><!-- 2 -->
                        <div class="t2" style="display: none;">
                            <div class="faq-title">
                                2. Технические вопросы
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide9">
                                    2.1. Требуется ли подтверждение личности для участия в инвестиционном процессе? </a>
                                <div id="panel9">
                                    Это не является обязательным условием сотрудничества с компанией. Но по депозитам,
                                    превышающим $100 000 вывод производится только после предоставления документов.
                                    (Если все время с первого дня деньги будут выводиться на один и тот же кошелек,
                                    тогда подтверждение личности не требуется).
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide10">
                                    2.2. Могу ли я вносить изменения в свои личные данные после регистрации? </a>
                                <div id="panel10">
                                    При необходимости Вы можете внести такие изменения, воспользовавшись помощью наших
                                    специалистов.
                                </div>
                            </div>
                            <div class="faq_array" style="margin-bottom:20px;">
                                <a href="#" id="btn-slide11">
                                    2.3. Что делать, если я забыл регистрационные данные? </a>
                                <div id="panel11">
                                    Для восстановления Ваших данных необходимо обратиться к Службе Поддержки компании.
                                </div>
                            </div>

                        </div>
                        <!-- end 2 --><!-- 3 -->
                        <div class="t3" style="display: none;">
                            <div class="faq-title">
                                3. Финансовые вопросы
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide15">
                                    3.1. Как сделать депозит? </a>
                                <div id="panel15">
                                    После прохождения регистрации вы получаете доступ к личному кабинету, в котором
                                    можно выбрать интересующий вас инвестиционный план и открыть депозит.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide17">
                                    3.2. Как происходит начисление прибыли? </a>
                                <div id="panel17">
                                    Начисление прибыли осуществляется каждые 24 часа, с момента внесения депозита
                                    согласно выбранного Вами инвестиционного плана.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide18">
                                    3.3. Каков минимально возможный номинал депозита и минимально допустимая к выводу
                                    сумма? </a>
                                <div id="panel18">
                                    Минимально Вы можете инвестировать <i class="fa fa-usd"></i>500.00, ограничения на
                                    вывод денежных средств не установлены.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide19">
                                    3.4. Сколько разрешено открыть депозитов одновременно? </a>
                                <div id="panel19">
                                    Имеется возможность создавать инвестиции без ограничений по количеству депозитов,
                                    сделанных одновременно. (Только на одном аккаунте).
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide20">
                                    3.5. С какими электронными платежными системами работает компания? </a>
                                <div id="panel20">
                                    В качестве средств, допустимых к инвестированию, мы принимаем депозиты, сделанные с
                                    помощью следующих электронных платёжных систем: Payeer, PerfectMoney, AdvCash,
                                    Bitcoin и Ethereum.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide21">
                                    3.6. Сделав депозит с использованием одной электронной платежной системы, могу ли я
                                    вывести средства на другую электронную платежную систему? </a>
                                <div id="panel21">
                                    Все операции допустимо производить только в валюте той электронной платёжной
                                    системы, с помощью которой был открыт данный конкретный депозит.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide22">
                                    3.7. Могу ли я вывести депозит до окончания срока действия инвестиционного
                                    предложения? </a>
                                <div id="panel22">
                                    Согласно условиям инвестиционных предложений, досрочное снятие инвестированной суммы
                                    предусмотрено пакетом BUSINESS PRO.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide23">
                                    3.8. Каков регламент выплат? </a>
                                <div id="panel23">
                                    Все выплаты производятся в понедельник, срок обработки запроса на выплату не может
                                    превышать 24 часов с момента создания такого запроса.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide24">
                                    3.9. Существуют ли какие-либо дополнительные, скрытые платежи или комиссионные
                                    сборы? </a>
                                <div id="panel24">
                                    Согласно Условий предоставления услуг, компанией не предусмотрены комиссионные
                                    сборы, или иные дополнительные платежи, взимаемые с инвестора.
                                </div>
                            </div>
                        </div>
                        <!-- end 3 --><!-- 4 -->
                        <div class="t4" style="display: none;">
                            <div class="faq-title">
                                4. Реферальная программа
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide25">
                                    4.1. Для чего компания использует партнерскую программу? </a>
                                <div id="panel25">
                                    Поощрительные вознаграждения при создании депозита приглашенными Вами новыми
                                    участниками инвестиционного процесса, предусмотрены инвестиционной доктриной
                                    компании и служат своего рода рекламой, позволяющей распространять наши
                                    инновационные инвестиционные решения среди максимально большого количества
                                    потенциальных инвесторов.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide26">
                                    4.2. Доступно ли партнерское вознаграждение в случае, если у пригласителя нет
                                    собственного депозита в компании? </a>
                                <div id="panel26">
                                    Мы рассматриваем в позитивной плоскости любое продуктивное сотрудничество. Поэтому
                                    Вы будете получать партнерское вознаграждение даже без собственного депозита в
                                    компании.
                                </div>
                            </div>
                            <div class="faq_array">
                                <a href="#" id="btn-slide28">
                                    4.3. Как приглашать партнеров в компанию? </a>
                                <div id="panel28">
                                    Для приглашения новых участников инвестиционного процесса, используйте партнерскую
                                    ссылку, которую Вы получаете после регистрации в компании.
                                </div>
                            </div>
                        </div>
                        <!-- end 4 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection