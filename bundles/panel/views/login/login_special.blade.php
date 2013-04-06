@layout('main')

@section('content')
    <div class="row">
        <div class="offset4 span4 well">
            <h2>Login</h2>

            <!-- check for login errors flash var -->
            @if (Session::has('login_errors'))
                <span class="alert alert-error">Votre login ou votre mot de passe est incorrect.</span>
            @endif

            <hr />

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
        </div>
    </div>
@endsection