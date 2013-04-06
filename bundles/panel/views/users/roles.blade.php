@layout('panel::panel.layout')


@section('panel_content')
    <h3>Rôles</h3>

    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
        <i class="icon-plus icon-white"></i> Nouveau rôle
    </a>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->level }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>



    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Nouveau rôle</h3>
      </div>
      <div class="modal-body">
      <form id="newRole">
        <p>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="" />
        </p>

        <p>
            <label for="level">Niveau :</label>
            <input type="number" name="level" id="level" value="" />
        </p>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
        <button class="btn btn-primary" id="saveRole">Enregistrer</button>
      </div>
    </div>

@endsection


@section('javascript')
<script>
$('a.confirm').click(function(e){
    if (!confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?')) {
        e.preventDefault();
    }
})

$("#saveRole").click(function(){
    
    $.post(
        "{{ URL::to_action('panel::site@newrole') }}",
        $("#newRole").serialize(),
        function(){
            window.location.reload();
        }
    );

});
</script>
@endsection