<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        {{ HTML::style('css/vendors/normalize.min.css') }}
        {{ HTML::style('css/vendors/initializr.css') }}

        {{ HTML::style('http://fonts.googleapis.com/css?family=Ubuntu') }}


        {{ HTML::style('css/main.css') }}

        {{ HTML::script('js/vendor/modernizr-2.6.1-respond-1.1.0.min.js') }}
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">
                    {{ HTML::image(URL::to_asset('img/laravel_logo.png'), 'Laravel Logo') }}
                    laravel France
                </h1>
                <nav>
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Tutoriels</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

                @yield("container")

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>footer</h3>
            </footer>
        </div>

        {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js') }}
        {{ HTML::script('https://raw.github.com/elektronaut/jquery.livetwitter/master/jquery.livetwitter.min.js') }}
        {{ HTML::script('js/plugins.js') }}
        {{ HTML::script('js/main.js') }}

        @yield('javascript')

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
