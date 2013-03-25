<ul>
	<h4>Bonjour {{ Auth::user()->username }}</h4>
	<li><a href="{{ URL::to('panel') }}">Accès au panel</a></li>
	<hr />
	<li><a href="{{ URL::to('logout') }}">Déconnexion</a></li>
</ul>