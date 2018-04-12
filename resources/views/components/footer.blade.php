<footer class="footer_section" id="contact">
    <div class="container">
        <section class="main-section contact" id="contact">
            <div class="contact_section">
                <h2>Контакты</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact_block">
                            <div class="contact_block_icon rollIn animated wow"><span><i class="fa-home"></i></span>
                            </div>
                            <span>5 Preston Court, Burton Latimer, <br> United Kingdom, NN15 5LR</span></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact_block">
                            <div class="contact_block_icon icon2 rollIn animated wow"><span><a
                                            href="skype:live:future.trade_1?call"> <i
                                                class="fa-skype"></i></a></span></div>
                            <span><a href="skype:live:future.trade_1?call"> SKYPE</a></span></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact_block">
                            <div class="contact_block_icon icon3 rollIn animated wow"><span><a
                                            href="https://t.me/futuretradeclub"><i
                                                class="fa-send"></i></a></span></div>
                            <span> <a href="https://t.me/futuretradeclub">TELEGRAM</a> </span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="contact-info-box address clearfix">
                        <h3>Не стесняйтесь. Обращайтесь!</h3>
                        <p>Если вы ищете ответы, хотите решить проблему или просто хотите сообщить нам о чем-то важном,
                            Вы получите помощь прямо здесь.</p>
                    </div>
                    <div class="m-auto">
                        <ul class="social-link">
                            <li class="twitter animated bounceIn wow delay-02s"><a href="/rules"><i class="fa-info"></i></a>
                            </li>
                            <li class="facebook animated bounceIn wow delay-03s"><a href="/confidence"><i
                                            class="fa-shield"></i></a></li>
                            <li class="pinterest animated bounceIn wow delay-04s"><a href="/faq"><i
                                            class="fa-question"></i></a></li>
                            <!-- 							<li class="gplus animated bounceIn wow delay-05s"><a href="javascript:void(0)"><i class="fa-google-plus"></i></a></li>
                                                        <li class="dribbble animated bounceIn wow delay-06s"><a href="javascript:void(0)"><i class="fa-dribbble"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp delay-06s">
                    <div class="form">
                        <div id="sendmessage">Ваше сообщение было отправлено. Спасибо!</div>
                        <div id="errormessage">Произошла ошибка. Повторите попытку.</div>
                        <form action="{{action("HomeController@feedback")}}" method="post" role="form"
                              class="contactForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="name" class="form-control input-text" id="name"
                                       placeholder="Ваше Имя" data-rule="minlen:4" data-msg="Минимум 4 символа."/>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control input-text" name="email" id="email"
                                       placeholder="Ваш Email" data-rule="email" data-msg="Введите email"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-text" name="subject" id="subject"
                                       placeholder="Тема" data-rule="minlen:4" data-msg="Введите тему обращения"/>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required"
                                          data-msg="Введите сообщение" placeholder="Сообщение"></textarea>
                            </div>

                            <button type="submit" class="btn input-btn">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <div class="footer_bottom">
            <span>© 2018 FUTURE TRADE BITCOIN MINING LTD. ВСЕ ПРАВА ЗАЩИЩЕНЫ.</span>
        </div>
    </div>
</footer>