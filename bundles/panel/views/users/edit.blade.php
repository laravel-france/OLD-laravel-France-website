@layout('panel::panel.layout')


@section('panel_content')

    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a href="#profile" data-toggle="tab">Profil</a></li>
      <li><a href="#roles" data-toggle="tab">Rôles</a></li>
      <li><a href="#password" data-toggle="password">Mot de passe</a></li>
    </ul>


    <h3>Utilisateur : {{ $cUser->username }}</h3>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="profile">
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

            {{ Form::close() }}
        </div>

        <div class="tab-pane fade" id="roles">

            @if(Session::get('role_success'))
            <div class="alert alert-success">
                <strong>{{ date('d-m-Y H:i:s')}}</strong> - Rôles mis à jour
            </div>
            @endif

            {{ Form::open(URL::to_action('panel::site@updateuserroles', array($cUser->id)), 'put') }}
            @foreach ($roles as $role)
            <label for="role_{{ $role->id }}">
                <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" @if(in_array($role->id, $cUser->roles()->pivot()->lists('role_id'))) checked="checked" @endif />
            {{ $role->name }}
            </label><br />
            @endforeach

            {{ Form::submit('Envoyer', array('class'=>'btn btn-primary')) }}
            {{ Form::close() }}

        </div>


        <div class="tab-pane fade" id="password">

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
                    Le mot de passe a été changé.
                </div>
            @endif

            {{ Form::open(URL::to_action('panel::site@updateuserpassword', array($cUser->id)), 'put') }}

                <!-- new_password field -->
                <p>{{ Form::label('new_password', 'Nouveau mot de passe') }}</p>
                <p>{{ Form::password('new_password') }}</p>

                <!-- confirm_new_password field -->
                <p>{{ Form::label('confirm_new_password', 'Confirmez le mot de passe') }}</p>
                <p>{{ Form::password('confirm_new_password') }}</p>

                <!-- submit button -->
                <p>{{ Form::submit('Modifier') }}</p>
            {{ Form::close() }}

        </div>



    </div>
@endsection


@section('javascript')
<script>
$(function () {
    $('#myTab a:first').tab('show');

    $('#myTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    if (window.location.hash) {
        $("#myTab a[href='" + window.location.hash + "']").click();
    }


});
</script>
@endsection