@layout('main')

@section('container')
    
    <article>
        
        <header>
            <h1>Un Framework pour les artisans du web</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec.</p>
        </header>

        <section>
            <h2>article section h2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
        </section>
        <section>
            <h2>article section h2</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
        </section>
        <footer>
            <h3>article footer h3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
        </footer>
    </article>

    <aside>
        <h3>LiveTweet</h3>

        <div id="tweets"></div>
    </aside>

@endsection


@section('javascript')

	<script>
	$(document).ready(function($){
		$('#tweets').liveTwitter('laravel', {
	        limit: 10,
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
	          day:     'jour',
	          days:    'jours'
	        }});
	});
	</script>

    
@endsection