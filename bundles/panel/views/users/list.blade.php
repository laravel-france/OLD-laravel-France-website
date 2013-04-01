@layout('panel::panel.layout')


@section('panel_content')
    <h3>Utilisateurs</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Date d'enregistrement</th>
                <th>Suppression</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $oneUser)
            <tr>
                <td>{{ $oneUser->id }}</td>
                <td>{{ HTML::link_to_action('panel::site@editusers', $oneUser->username, array($oneUser->id)) }}</td>
                <td>{{ $oneUser->email }}</td>
                <td>{{ date('d-m-Y',strtotime($oneUser->created_at)) }}</td>
                <td>{{ HTML::link_to_action('panel::site@removeuser', 'Supprimer', array('id' => $oneUser->id), array('class'=>'btn btn-danger confirm')) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


@section('javascript')
<script>
$('a.confirm').click(function(e){

    if (!confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?')) {
        e.preventDefault();
    }


})
</script>
@endsection