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
            <h2>Simple</h2>
            <p>Laravel est simple, voyez par vous même :</p>
            
<pre class="prettyprint">
Route::get('/users/(:num)', function($user_id) {
    // On récupère l'utilisateur
    $user = User::find($user_id);

    // Retourne une vue, en lui passant l'utilisateur 
    return View::make('user.show')->with_user($user);
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
        // nous sommes connecté !
        return Redirect::to('home');
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
            <p>Laravel est puissant, et nous offre des outils puissants, mais simple d'utilisation :</p>
<pre class="prettyprint lang-php">
// application/start.php
IoC::singleton('mailer', function()
{
    $transport = Swift_MailTransport::newInstance();

    return Swift_Mailer::newInstance($transport);
});

// dans votre controller, par exemple
$monMailer = IoC::resolve('mailer');
</pre>
        </section>


        <section>
            <h2>Flexible</h2>
            <p>Laravel est flexible, et des développeurs ont déjà créé des {{ HTML::link('http://bundles.laravel.com/','bundles') }} pour vous :</p>
<pre class="prettyprint lang-php">
// Besoin d'utiliser oauth2 ?
// http://bundles.laravel.com/bundle/laravel-oauth2
$ php artisan bundle:install laravel-oauth2
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
