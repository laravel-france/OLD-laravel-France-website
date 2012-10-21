@layout('main')

@section('container')
    
    <article>
        
        <header>
            <h1>Un framework simple &amp; élégant</h1>
            <p>laravel est un framework MVC PHP 5.3, créé par {{ HTML::link('https://twitter.com/taylorotwell', 'Taylor Otwell') }}, pour rendre le développement d'application web plus facile et rapide. La recette utilisée pour laravel marche : simplicité, intuitivité, puissance et flexibilité. Jetez un oeil vous même :</p>
        </header>

        <section>
            <h2>Simple</h2>
            <p>laravel est simple, voyez par vous même :</p>
            
<pre class="prettyprint">
Route::get('/', function() {
    // On récupère l'utilisateur
    $user = User::find($user_id);

    // Retourne une vue, en lui passant l'utilisateur 
    return View::make('user.show')->with_user($user);
});</pre>
        </section>

        <section>
            <h2>Intuitif</h2>
            <p>laravel est intuitif, "<span class="inline-quote" title="Phill Sparks">Il parle votre langage</span>" :</p>
<pre class="prettyprint lang-php">
Route::post('login', function() {
    // On récupère les données du formulaire
    $userdata = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );

    if (Auth::attempt($userdata)) {
        // nous sommes connécté !
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
            <p>laravel est puissant, et nous offre des outils puissants, mais simple d'utilisation :</p>
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
            <p>laravel est flexible, et des développeurs ont déjà créé des {{ HTML::link('http://bundles.laravel.com/','bundles') }} pour vous :</p>
<pre class="prettyprint lang-php">
// Besoin d'utiliser oauth2 ?
// http://bundles.laravel.com/bundle/laravel-oauth2
$ php artistan bundle:install laravel-oauth2
</pre>
        </section>

        <footer>
            <h3>Convaincu ?</h3>
            <p>Alors ne perdez plus une minute ! Téléchargez dès à présent la {{ HTML::link('http://laravel.com/download','dernière version de laravel') }}, et suivez le guide !</p>
        </footer>
    </article>

    <aside id="livetweet">
        <h3>LiveTweet</h3>

        <div id="tweets"></div>
    </aside>

@endsection


@section('javascript')

	<script>
	$(document).ready(function($){
		$('#tweets').liveTwitter('laravel', {
	        limit: 100,
	        rpp: 100,
	        filter: function(tweet){
	            return ($.inArray(tweet.iso_language_code, ['fr', 'en']) > -1); 
	        },
	        localization: {
	          seconds: 'secondes',
	          minute:  'minute',
	          minutes: 'minutes',
	          hour:    'Une heure',
	          hours:   'heures',
	          day:     'hier',
	          days:    'jours'
	        }});
	});
	</script>

    
@endsection