<!DOCTYPE html>
<html>
  <head>
    <!--[if lt IE 9]>
        {{ HTML::script('/js/dist/html5shiv.js') }}
    <![endif]-->
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
    <link rel="alternate" type="application/rss+xml" title="Forums RSS" href="{{ URL::to_action('forums::home@rss') }}" />
    @yield('link_rss')
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
                  <li class="{{ URI::is('/') ? 'active' : '' }}"><a href="{{ URL::home() }}"><i class="icon-home"></i> Accueil</a></li>
                  <li class="{{ URI::is( '^docs*') ? 'active' : '' }}"><a href="{{ URL::to('docs') }}"><i class="icon-book"></i> Documentation</a></li>
                  <li class="dropdown {{ URI::is( '^(blog|forums|irc)*') ? 'active' : '' }}">
                    <a class="dropdown-toggle"
                       data-toggle="dropdown"
                       href="#">
                        <i class="icon-group"></i> Communauté
                        <b class="caret"></b>
                      </a>
                    <ul class="dropdown-menu">
                      <li class="{{ URI::is( '^blog*') ? 'active' : '' }}">{{ HTML::link(URL::to('blog'), 'Blog'); }}</li>
                      <li class="{{ URI::is( '^forums*') ? 'active' : '' }}">{{ HTML::link(URL::to('forums'), 'Forums'); }}</li>
                      <li class="{{ URI::is( '^irc') ? 'active' : '' }}">{{ HTML::link(URL::to('irc'), 'IRC'); }}</li>
                    </ul>
                  </li>
                  <li class="{{ URI::is( '^contact*') ? 'active' : '' }}"><a href="{{ URL::to_action('contact') }}"><i class="icon-envelope"></i> Contact</a></li>

                  <li class="dropdown {{ URI::is( '^(panel*|*/admin/*)') ? 'active' : '' }}">
                    @if(Auth::guest())
                      <a href="{{ URL::to('login') }}"><i class="icon-user"></i> Se connecter</a>
                    @else
                      <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to('panel') }}"><i class="icon-user"></i> {{ Auth::user()->username }}<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li class="{{ URI::is( '^panel*') ? 'active' : '' }}">{{ HTML::link(URL::to('panel'), 'Panel'); }}</li>
                        @if(Auth::user()->is('Blogger'))
                        <li class="{{ URI::is( '^blog/admin*') ? 'active' : '' }}">{{ HTML::link(URL::to('blog/admin/post/list'), 'Blog'); }}</li>
                        @endif
                        @if(Auth::user()->is('Forumer'))
                        <li class="{{ URI::is( '^forums/admin*') ? 'active' : '' }}">{{ HTML::link(URL::to('forums/admin/category/list'), 'Forums'); }}</li>
                        @endif
                        <li class="divider"></li>
                        <li>{{ HTML::link(URL::to('logout'), 'Déconnexion'); }}</li>
                      </ul>

                    @endif
                  </a>
                </li>

                  <li class="divider-vertical"></li>
                  <li><a href="http://laravel.fr/docs/4/installation" class='downloadlink btn btn-large'><i class="icon-download-alt icon-white"></i> Télécharger</a></li>
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
