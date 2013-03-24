@layout('panel::panel.layout')


@section('panel_content')
    <h3>Utilisateur : {{ $cUser->username }}</h3>


    @if(Session::get('success'))
    <div class="alert alert-success">
    	<strong>{{ date('d-m-Y H:i:s')}}</strong> - Utilisateur mis à jour
	</div>
    @endif

    {{ Form::open(URL::to_action('panel::site@updateusers', array($cUser->id)), 'put') }}

    <div class="control-group ">
    	{{ Form::label('username', 'Nom d\'utilisateur :', array('class'=>'control-label')) }}
        <div class="controls">
        	{{ Form::text('username', $cUser->username) }}
    	</div>
    </div>

    <div class="control-group ">
    	{{ Form::label('email', 'Adresse Email :', array('class'=>'control-label')) }}
        <div class="controls">
        	{{ Form::text('email', $cUser->email) }}
    	</div>
    </div>

    <div class="control-group ">
    	{{ Form::label('verified', 'Vérifé :', array('class'=>'control-label')) }}
        <div class="controls">
        	{{ Form::checkbox('verified', 1, $cUser->verified) }}
    	</div>
    </div>

    <div class="control-group ">
    	{{ Form::label('disabled', 'Désactivé :', array('class'=>'control-label')) }}
        <div class="controls">
        	{{ Form::checkbox('disabled', 1, $cUser->disabled) }}
    	</div>
    </div>

    <div class="control-group ">
    	{{ Form::label('deleted', 'Supprimé :', array('class'=>'control-label')) }}
        <div class="controls">
        	{{ Form::checkbox('deleted', 1, $cUser->deleted) }}
    	</div>
    </div>


		<div class="controls">
        	{{ Form::submit('Envoyer', array('class'=>'btn btn-primary')) }}
        </div>

    </div>



    {{ Form::close() }}
@endsection