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
    {{ HTML::style('css/vendors/prettify.css') }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Ubuntu') }}
    @yield_section

    <link rel="alternate" type="application/rss+xml" title="Blog RSS" href="{{ URL::to_action('blog::home@rss') }}" />
    <link rel="shortcut icon" href="{{ URL::to_asset('img/favicon.png') }}">
  </head>
  <body class="@yield('page_class')">

    <header>
        <div class="navbar navbar-fixed-top">
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
                    laravel France
                </a>
            </h1>
              <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                  <li class="{{ URI::is('/') ? 'active' : '' }}">{{ HTML::link(URL::home(), 'Accueil'); }}</li>
                  <li class="{{ URI::is( '^guides*') ? 'active' : '' }}">{{ HTML::link(URL::to('guides'), 'Guide'); }}</li>
                  <li class="{{ URI::is( '^blog*') ? 'active' : '' }}">{{ HTML::link(URL::to('blog'), 'Blog'); }}</li>
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
</html>
@yield('afterhtml')