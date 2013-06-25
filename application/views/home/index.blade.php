@layout('main')

@section('page_class')homepage@endsection

@section('content')

<div class="row">
    <div class="span7">

    <article>
        <header>
            <h1>Un framework simple &amp; élégant</h1>
            <p>Laravel est un framework MVC PHP 5.3, créé par {{ HTML::link('https://twitter.com/taylorotwell', 'Taylor Otwell') }}, pour rendre le développement d'application web plus facile et rapide. La recette utilisée pour Laravel marche : simplicité, intuitivité, puissance et flexibilité. Jetez un oeil vous même :</p>
        </header>

        <section>
            <h2>Rapide à mettre en place</h2>
            <p>Grâce à composer, vous pouvez créer un projet Laravel en une simple commande :</p>

<pre class="prettyprint">
$ composer create-project laravel/laravel nom-de-votre-projet
</pre>
        </section>

        <section>
            <h2>Simple</h2>
            <p>Laravel est simple, voyez par vous même :</p>

<pre class="prettyprint">
Route::get('user/{id}', function($id)
    // On récupère l'utilisateur
    $user = User::find($id);

    // Retourne une vue, en lui passant l'utilisateur
    return View::make('user.show')->with('user', $user);
});</pre>
        </section>

        <section>
            <h2>Intuitif</h2>
            <p>Laravel est intuitif, "<span class="inline-quote" title="Phill Sparks">Il parle votre langue</span>" :</p>
<pre class="prettyprint lang-php">
Route::post('login', function() {
    // On récupère les données du formulaire
    $userdata = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );

    if (Auth::attempt($userdata)) {
        // Nous redirigeons l'utilisateur vers la page où il souhaitait aller,
        // Ou par défaut, sur la route nommée 'home'
        return Redirect::intended('home');
    } else {
        // Redirection vers login
        return Redirect::to('login')
            ->with('login_errors', true);
    }
});
</pre>
        </section>

        <section>
            <h2>Puissant</h2>
            <p>Laravel nous offre des outils puissants ET simple d'utilisation :</p>
<pre class="prettyprint lang-php">
// application/start.php
App::singleton('monWebService', function()
{
    return new ClasseDeMonWebService();
});

// dans votre controller, par exemple
$monMailer = IoC::resolve('mailer');
</pre>
        </section>


        <section>
            <h2>Flexible</h2>
            <p>Laravel est flexible grace à son utilisation de composer, qui nous permet d'installer des packages en une simple commande :</p>
<pre class="prettyprint lang-php">
// Besoin d'utiliser oauth2 ?
$ composer require t4s/camelot-auth dev-master
</pre>
        </section>

        <footer>
            <h3>Convaincu ?</h3>
            <p>Alors ne perdez plus une minute ! Téléchargez dès à présent la {{ HTML::link('http://laravel.com/download','dernière version de Laravel') }}, et suivez le docs !</p>
        </footer>
    </article>
</div>

<div class="span4 offset1">

@if(count($posts) > 0)
    <aside>
        <h3>En direct du blog</h3>
        <ul id="posts">
            @foreach($posts as $post)
            <li class="post">
                <a href="{{ URL::to_action('blog::home@resolve', array($post->id)) }}">{{ $post->title }}</a><br />
                <small>Le {{ $post->publicated_at->format('d-m-Y') }}</small>
            </li>
            @endforeach
        </ul>
        <p style="text-align:right; margin-right:10px;"><a href="{{ URL::to_action('blog::home@index') }}" class="btn btn-small btn-orange">Aller au blog</a></p>
    </aside>
@endif

        @if(Auth::guest())
            <h3>Se connecter</h3>
            {{ render('panel::partials.login_form_homepage') }}
        @else
            <aside id="hp_loginform">
                <h3>Mon compte</h3>
                {{ render('panel::partials.panel_homepage') }}
            </aside>
        @endif
</div>
@endsection
