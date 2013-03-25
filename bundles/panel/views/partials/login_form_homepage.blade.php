{{ Form::open('login') }}
    {{ Form::hidden('from_url', Session::get('from_url')) }}

    <!-- username field -->
    <p>{{ Form::label('username', 'Nom d\'utilisateur') }}</p>
    <p>{{ Form::text('username') }}</p>
    <!-- password field -->
    <p>{{ Form::label('password', 'Mot de passe') }}</p>
    <p>{{ Form::password('password') }}</p>
    <!-- submit button -->
    <p>{{ Form::submit('Connexion') }}</p>
{{ Form::close() }}
