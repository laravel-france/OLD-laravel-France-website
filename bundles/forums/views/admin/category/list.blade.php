@layout('panel::panel.layout')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/forums/forums.css')) }}
@endsection

@section('panel_content')
    <h3>Catégories</h3>

    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
        <i class="icon-plus icon-white"></i> Nouvelle Catégorie
    </a>

    @if(!$categories)
        Aucune catégorie créée.
    @else
    <strong>Vous pouvez changer l'ordre des catégories en faisant du drag & drop</strong>
    <table class="table table-striped" id="sortable">
        <thead>
            <tr>
                <th width="32">#</th>
                <th>Nom</th>
                <th width="100">Suppression</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr id="{{ $category->id }}" data-item='{{ json_encode($category->to_array()) }}'>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ HTML::link_to_action('forums::admin.category@remove', 'Supprimer', array('id' => $category->id), array('class'=>'btn btn-danger confirm')) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif


    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Nouvelle catégorie</h3>
      </div>
      <div class="modal-body">
        <p>
            <label for="title">Nom :</label>
            <input type="text" name="title" id="title" value="" />
        </p>

        <p>
            <label for="desc">Description :</label>
            <textarea name="desc" id="desc"></textarea>
        </p>

      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
        <button class="btn btn-primary" id="saveCategory">Enregistrer</button>
      </div>
    </div>

    <div id="myModalEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEdit" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modifier catégorie</h3>
      </div>
      <div class="modal-body">

        <input type='hidden' name='id' id='catId' value= "" />

        <p>
            <label for="titleEdit">Nom :</label>
            <input type="text" name="title" id="titleEdit" value="" />
        </p>

        <p>
            <label for="descEdit">Description :</label>
            <textarea name="desc" id="descEdit"></textarea>
        </p>

      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
        <button class="btn btn-primary" id="updateCategory">Enregistrer</button>
      </div>
    </div>
@endsection


@section('javascript')
    <script src="https://raw.github.com/isocra/TableDnD/master/stable/jquery.tablednd.js"></script>

    <script>
    $("#sortable").tableDnD({
        onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
            for (var i=0; i<rows.length; i++) {
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to_action('forums::admin.category@setorder') }}',
                    data: {id: rows[i].id, order: (i+1)},
                });
            }
        }
    });
    $("#saveCategory").click(function(){
        var title = $('#title').val();
        var desc = $('#desc').val();

        $.ajax({
            type: 'post',
            url: '{{ URL::to_action('forums::admin.category@new') }}',
            data: {title: title, desc: desc},
            async: false,
            success: function() {
                document.location.reload(true);        
            },
            error: function() {
                alert('Erreur dans vos champs...');
            }
        });
    });

    $("#updateCategory").click(function(){
        var title = $('#titleEdit').val();
        var desc = $('#descEdit').val();
        var id = $('#catId').val();

        $.ajax({
            type: 'post',
            url: '{{ URL::to_action('forums::admin.category@edit') }}',
            data: {id: id, title: title, desc: desc},
            async: false,
            success: function() {
                document.location.reload(true);        
            },
            error: function() {
                alert('Erreur dans vos champs...');
            }
        });
    });

    $('tbody tr').click(function() {
        var item = $(this).data('item');

        $('#titleEdit').val(item.title);
        $('#descEdit').val(item.desc);
        $('#catId').val(item.id);

        $("#myModalEdit").modal('show')

        
    });

    $('a.confirm').click(function(e){

        if (!confirm('Êtes vous sûr de vouloir supprimer cette catégorie ?')) {
            e.preventDefault();
        }


    });
    </script>
@endsection