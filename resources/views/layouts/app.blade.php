<!doctype html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title>Future Trade Club</title>
    <link rel="icon" href="/img/favicon.ico" type="image/icon">
    <link rel="icon" href="/img/future_trade_club_logo.png" type="image/png">
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="/css/linecons.css" rel="stylesheet" type="text/css">
    <link href="/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="/css/animate.css" rel="stylesheet" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,700italic,400italic,300italic,300,100italic,100,900italic'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dosis:400,500,700,800,600,300,200' rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="/css/main.min.css">

    <!-- =======================================================
    Theme Name: Butterfly
    Theme URL: https://bootstrapmade.com/butterfly-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
    ======================================================= -->

    <script type="text/javascript" src="/js/jquery.1.8.3.min.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/jquery-scrolltofixed.js"></script>
    <script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/js/jquery.isotope.js"></script>
    <script type="text/javascript" src="/js/wow.js"></script>
    <script type="text/javascript" src="/js/classie.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5m2vzl2xoliahb7pqv9yzdbt0qtrgz2hstunp3asmaaug4wd"></script>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $('.res-nav_click').click(function () {
                $('ul.toggle').slideToggle(600)
            });

            $(document).ready(function () {
                $(window).bind('scroll', function () {
                    if ($(window).scrollTop() > 0) {
                        $('#header_outer').addClass('fixed');
                    } else {
                        $('#header_outer').removeClass('fixed');
                    }
                });

            });


        });

        function resizeText() {
            var preferredWidth = 767;
            var displayWidth = window.innerWidth;
            var percentage = displayWidth / preferredWidth;
            var fontsizetitle = 24;
            var newFontSizeTitle = Math.floor(fontsizetitle * percentage);
            $(".divclass").css("font-size", newFontSizeTitle)
        }
    </script>

    <style>
        @media (max-width : 991px) {
            .text-sm-center{
                text-align : center;
            }

            .mt-sm-2{
                margin-top : 2rem;
            }
        }
    </style>

    @stack('style')
</head>

<body>

<!--Header_section-->
@include("components.header")
<!--Header_section-->


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')


@include("components.footer")
<!--twitter-feed-end-->

<script type="text/javascript" src="/js/inner.js"></script>
{{--<script async="true" src="/contactform/contactform.js"></script>--}}

{{--<script>--}}
{{--$(document).on('submit', '.contactForm', function (e) {--}}
{{--e.preventDefault();--}}

{{--$.post($(this).attr('action'), $(this).serialize(), function (json) {--}}
{{--if(json.result) {--}}
{{--$.get(location.href, function (result) {--}}
{{--var new_content = $('#top_content', result).html();--}}
{{--$('#top_content').html(new_content);--}}
{{--});--}}
{{--}--}}
{{--}, "json");--}}
{{--});--}}
{{--</script>--}}

<script type="text/javascript">
    ('.alert').setTimeout(function(){
        $(this).addClass('hidden');
    },3000)(jQuery);
</script>

@stack('script')

</body>
</html>
