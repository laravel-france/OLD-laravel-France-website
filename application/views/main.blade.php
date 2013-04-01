<!DOCTYPE html>
<html>
  <head>
    <title>
    @section('title')
    Bienvenue sur Laravel France
    @yield_section</title>
    <!-- Bootstrap -->
    @section('css')
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-responsive.min.css') }}
    {{ HTML::style('css/vendors/prettify.css') }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}
    @yield_section

    <link rel="alternate" type="application/rss+xml" title="Blog RSS" href="{{ URL::to_action('blog::home@rss') }}" />
    <link rel="shortcut icon" href="{{ URL::to_asset('img/favicon.png') }}">
  </head>
  <body class="@yield('page_class')">

    <header>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">

              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <h1>
                <a class="brand" href="{{ URL::home() }}">
                    {{ HTML::image(URL::to_asset('img/laravel_logo.png'), 'logo', array('style'=>'max-width:24%')) }}
                    Laravel France
                </a>
            </h1>
              <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                  <li class="{{ URI::is('/') ? 'active' : '' }}">{{ HTML::link(URL::home(), 'Accueil'); }}</li>
                  <li class="{{ URI::is( '^docs*') ? 'active' : '' }}">{{ HTML::link(URL::to('docs'), 'Documentation'); }}</li>
                  <li class="dropdown {{ URI::is( '^(blog|AUTRE)*') ? 'active' : '' }}">
                    <a class="dropdown-toggle"
                       data-toggle="dropdown"
                       href="#">
                        Communauté
                        <b class="caret"></b>
                      </a>
                    <ul class="dropdown-menu">
                      <li class="{{ URI::is( '^blog*') ? 'active' : '' }}">{{ HTML::link(URL::to('blog'), 'Blog'); }}</li>
                    </ul>
                  </li>


                  <li class="{{ URI::is( '^contact*') ? 'active' : '' }}">{{ HTML::link(URL::to_action('contact'), 'Contact'); }}</li>
                  <li><a href="{{URL::to('telecharger')}}" class='downloadlink btn btn-large'><i class="icon-download-alt icon-white"></i> Télécharger</a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>
    </header>

    <div id="page" class="container">
        @yield('content')

      <footer>
        @yield('footer')
      </footer>
    </div><!--/.container-->





        {{ HTML::script('http://code.jquery.com/jquery-latest.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/vendors/prettify/prettify.js')}}
        <script>
            prettyPrint();

            var shiftWindow = function() { scrollBy(0, -77) };
            if (location.hash) shiftWindow();
            window.addEventListener("hashchange", shiftWindow);
        </script>
        @yield('javascript')
  </body>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37182814-1']);
  _gaq.push(['_setDomainName', 'laravel.fr']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  
</html>
@yield('afterhtml')