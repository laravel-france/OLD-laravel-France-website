<h3>Bonjour {{ $user->username }}</h3>


<nav class="well">
    <h3>Mon compte</h3>
    <ul>
        <li><a href="{{ URL::to_action('panel::pseudo@show') }}">Modifier mon pseudo</a></li>
        <li><a href="{{ URL::to_action('panel::avatar@show') }}">Modifier mon avatar</a></li>
        <li><a href="{{ URL::to_action('panel::applications@show') }}">Applications</a></li>
        <li><a href="{{ URL::to('logout') }}">Déconnexion</a></li>
    </ul>
</nav>

@if($user->is('Blogger'))
<nav class="well">
    <h3>Blog</h3>
    <h4>Billets</h4>
    <ul>
        <li>{{ HTML::link_to_action('blog::admin.post@new','Nouvel article') }}</li>
        <li>{{ HTML::link_to_action('blog::admin.post@list','Liste des articles') }}</li>
    </ul>
    <h4>Catégories</h4>
    <ul>
        <li>{{ HTML::link_to_action('blog::admin.category@list','Gestion des categories') }}</li>
    </ul>
</nav>
@endif

@if($user->is('Forumer'))
<nav class="well">
    <h3>Forums</h3>
    <h4>Catégories</h4>
    <ul>
        <li>{{ HTML::link_to_action('forums::admin.category@list','Gestion des categories') }}</li>
    </ul>
</nav>
@endif

@if($user->is('Super Admin'))
<nav class="well">
    <h3>Laravel.fr</h3>
    <ul>
        <li><a href="{{ URL::to_action('panel::site@listusers') }}">Utilisateurs</a></li>
        <li><a href="{{ URL::to_action('panel::site@listroles') }}">Rôles</a></li>
    </ul>
</nav>
@endif
