@layout('panel::panel.layout')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/blog/css/blog.css')) }}
@endsection

@section('panel_content')
    <h3>
        @if($editMode)
        Edition d'un article
        @else
        Nouvel article
        @endif
    </h3>

    {{ Form::open(null,null,array('id'=>'new_post_form', 'class'=>'form')) }}

    {{ Form::token() }}

    {{ Form::hidden('author_id', Auth::user()->id) }}

    <div class="control-group @if($errors->has('title'))error@endif">
        {{ Form::label('title','Titre* :',array('class'=>'control-label')) }}
        <div class="controls">
        {{ Form::text('title', Input::old('title', ($editMode ? $post->title : null) )) }}
        {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('slug'))error@endif">
        {{ Form::label('slug','Slug* :',array('class'=>'control-label')) }}
        <div class="controls">
        {{ Form::text('slug', Input::old('slug', ($editMode ? $post->slug : null) )) }}
        {{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('intro'))error@endif">
        {{ Form::label('intro','Introduction :',array('class'=>'control-label')) }}
        <div class="controls">
        <div class="ace_wrapper">
            <div id="intro_div">{{ HTML::entities(Input::old('intro', ($editMode ? $post->intro : null) )) }}</div>
        </div>
        {{ Form::textarea('intro', null, array('class'=>'span9 hide')) }}
        {{ $errors->first('intro', '<span class="help-inline">Veuillez insérer une introduction</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('content'))error@endif">
        {{ Form::label('content','Contenu* :',array('class'=>'control-label')) }}
        <div class="controls">
        <div class="ace_wrapper">
            <div id="content_div">{{ HTML::entities(Input::old('content', ($editMode ? $post->content : null) )) }}</div>
        </div>
        {{ Form::textarea('content', null, array('class'=>'span9 hide')) }}
        {{ $errors->first('content', '<span class="help-inline">Veuillez insérer un message</span>') }}
        </div>
    </div>

    <h4>Aperçu <small><a href="javascript: refreshPreview();">(Rafraichir)</a></small></h4>
    <div class="row">
        <div class="single well">
            <div class="entry">
                <div id="pw_intro"></div>
                <div id="pw_content"></div>
            </div>
        </div>
    </div>



    <div class="control-group @if($errors->has('publicated_at'))error@endif">
        {{ Form::label('publicated_at','Date de publication* :',array('class'=>'control-label')) }}
        <div class="controls">
        <div class="input-append">
            
            
            <input type="date" name="publicated_at_date" id="publicated_at_date" value="{{ Input::old('publicated_at_date', ($editMode ? $post->publicated_at->format('Y-m-d') : date('Y-m-d')) ) }}" />
            <input type="time" name="publicated_at_time" id="publicated_at_time" value="{{ Input::old('publicated_at_time', ($editMode ? $post->publicated_at->format('H:i') : date('H:i')) ) }}" style="width: auto;" />
            <button class="btn btn-success" type="submit" onclick="setPublicatedAt(); return false;">Maintenant</button>
        </div>
        {{ $errors->first('publicated_at', '<span class="help-inline">:message</span>') }}
    </div>

    <div class="control-group">
        <div class="controls">
        {{ Form::submit('Envoyer',array('class'=>'btn btn-primary')) }}
        </div>
    </div>
    
{{ Form::close() }}
@endsection


@section('javascript')
    <script>
    function setPublicatedAt()
    {
        var now = new Date();
        var month = (now.getMonth() + 1);               
        var day = now.getDate();
        if(month < 10) 
            month = "0" + month;
        if(day < 10) 
            day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day;
        $('#publicated_at_date').val(today);


        var hour = now.getHours();
        var min = now.getMinutes();
        var time = hour+':'+min;
        $('#publicated_at_time').val(time);
    }
    </script>

<script src="http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    jQuery(document).ready(function(){

        var content_editor = ace.edit("content_div");
        content_editor.getSession().setMode("ace/mode/markdown");
        content_editor.setHighlightActiveLine(false);
        content_editor.setShowPrintMargin(false);
        content_editor.getSession().setTabSize(4);
        content_editor.getSession().setUseSoftTabs(true);

        content_editor.getSession().on('change', function(e) {
            content = content_editor.getValue();
            $('#content').val(content);
            

            if(content === "") return;
            $.post('{{ URL::to('mdparse') }}',{content: content},function(result){
                $("#pw_content").html(result);
            });
        });


        var intro_editor = ace.edit("intro_div");
        intro_editor.setHighlightActiveLine(false);
        intro_editor.getSession().setMode("ace/mode/markdown");
        intro_editor.setShowPrintMargin(false);
        intro_editor.getSession().setTabSize(4);
        intro_editor.getSession().setUseSoftTabs(true);

        intro_editor.getSession().on('change', function(e) {
            content = intro_editor.getValue();
            $('#intro').val(intro_editor.getValue())
            

            if(content === "") return;
            $.post('{{ URL::to('mdparse') }}',{content: content},function(result){
                $("#pw_intro").html(result);
            });
        });

        window.refreshPreview = function() {

            content = content_editor.getValue();
            if(content === "") return;
            $.post('{{ URL::to('mdparse') }}',{content: content},function(result){
                $("#pw_content").html(result);
            });

            content = intro_editor.getValue();
            if(content === "") return;
            $.post('{{ URL::to('mdparse') }}',{content: content},function(result){
                $("#pw_intro").html(result);
            });
        }

        $('#intro').val(intro_editor.getValue())
        $('#content').val(content_editor.getValue())
        refreshPreview();

    });
</script>

@endsection