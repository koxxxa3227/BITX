@extends("layouts.app")

@section("content")
    <!-- banner -->
    <div class="banner1">
        <div class="container">
            <h2 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="/">Главная</a> / <span>Страница не найдена</span></h2>
        </div>
    </div>
    <!-- //banner -->
    <section style="padding-top: 20px;">
        <div class="container">
            <div class="row space-top-8 space-8 row-table">
                <div style="float: right;">
                    <h1 class="text-jumbo text-ginormous">Упс!</h1>
                    <h2>Запрашиваемая страница не найдена</h2>
                    <h6>Код ошибки: 404</h6>
                </div>
                <div class="">
                    <img src="/images/404girl.gif" style="float: right;" width="313" height="428" alt="Girl has dropped her ice cream.">
                </div>
            </div>
        </div>

    </section>
@endsection

@push('script')
    <!-- for bootstrap working -->
    <script src="js/bootstrap.js"></script>
    <!-- //for bootstrap working -->
    <!-- here stars scrolling icon -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
                var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
                };
            */

            $().UItoTop({ easingType: 'easeOutQuart' });

        });
    </script>
@endpush