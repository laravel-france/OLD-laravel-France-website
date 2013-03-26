@layout('panel::panel.layout')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/blog/css/blog.css')) }}
@endsection

@section('panel_content')
    <h3>Catégories</h3>

    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
        <i class="icon-plus icon-white"></i> Nouvelle Catégorie
    </a>

    @if(!$categories)
        Aucune catégorie créée.
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Slug</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><span data-editable='1' data-id='{{ $category->id }}' data-name='name'>{{ $category->name }}</span></td>
                <td><span data-editable='1' data-id='{{ $category->id }}' data-name='slug'>{{ $category->slug }}</td>
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
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="" />
        </p>
        <p>
            <label for="slug">Slug :</label>
            <input type="text" name="slug" id="slug" value="" />
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
        <button class="btn btn-primary" id="saveCategory">Enregistrer</button>
      </div>
    </div>
@endsection


@section('javascript')
    <script>
    $("#saveCategory").click(function(){
        var name = $('#name').val();
        var slug = $('#slug').val();

        $.ajax({
            type: 'post',
            url: '{{ URL::to_action('blog::admin.category@new') }}',
            data: {name: name, slug: slug},
            async: false,
            success: function() {
                document.location.reload(true);        
            },
            error: function() {
                alert('Erreur dans vos champs...');
            }
        });

        
    });



    window.editInProgress = false;
    $('span').click(function() {
        $t = $(this);
        if ($t.data('editable') == 1 && window.editInProgress == false) {
            window.editInProgress = true;
            window.exText = $t.text();
            input = "<input id='"+ $t.data('name') + $t.data('id') +"' type='text' name='" + $t.data('name') + "' value='"+ $t.text() +"' />";
            $t.html(input);
            $('#' + $t.data('name') + $t.data('id')).focus();
            $('#' + $t.data('name') + $t.data('id')).keyup(function(e) {

                if(e.KeyCode == 27) {
                    val = window.exText;
                    $(this).remove();
                    $t.text(val);
                    window.exText = null;
                    window.editInProgress = false;
                } else if(e.keyCode == 13) {

                    val = $(this).val();

                    if($.trim(val) == '') {
                        val = window.exText;
                    }

                    if (val != window.exText) {
                        result = $.ajax({
                            url: '{{ URL::to_action('blog::admin.category@edit') }}?id='+$t.data('id')+'&type='+$t.data('name')+'&value='+val,
                            async: false
                        }).responseText;
                    }
                    $(this).remove();
                    $t.text(result);
                    window.exText = null;
                    window.editInProgress = false;
                }
            });
        }
    });
    </script>
@endsection