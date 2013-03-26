@layout('panel::panel.layout')

@section('panel_content')
	<h1>Modifier son mot de passe</h1>

	@if(Session::get('passwd_error'))
		<div class="alert alert-error">
			@if(Session::get('passwd_error') == 1)
				Votre mot de passe actuel n'est pas valide
			@elseif(Session::get('passwd_error') == 2)
				Un mot de passe vide n'est pas valide
			@else
				Les deux mot de passes n'étaient pas identiques.
			@endif
		</div>
	@endif

	@if(Session::get('passwd_success'))
		<div class="alert alert-success">
			Votre mot de passe a été changé.
		</div>
	@endif

    {{ Form::open('panel/password') }}

        <p>{{ Form::label('current_password', 'Mot de passe actuel') }}</p>
        <p>{{ Form::password('current_password') }}</p>


        <!-- new_password field -->
        <p>{{ Form::label('new_password', 'Nouveau mot de passe') }}</p>
        <p>{{ Form::password('new_password') }}</p>

        <!-- confirm_new_password field -->
        <p>{{ Form::label('confirm_new_password', 'Confirmez le mot de passe') }}</p>
        <p>{{ Form::password('confirm_new_password') }}</p>

        <!-- submit button -->
        <p>{{ Form::submit('Modifier') }}</p>
    {{ Form::close() }}

@endsection