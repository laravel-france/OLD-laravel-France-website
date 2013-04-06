@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/forums/forums.css')) }}
    {{ HTML::style(URL::to_asset('bundles/forums/jquery.sceditor.default.min.css')) }}
    {{ HTML::style(URL::to_asset('bundles/forums/themes/square.min.css')) }}
@endsection

@section('title')
    {{ $category->title }} - Forums de Laravel France
@endsection

@section('content')

<div class="row">
    <div class="span12">
        <ul class="breadcrumb">
        <li><a title="Retour à la page d'accueil" href="{{ URL::home() }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_action('forums::home@index') }}">Forums</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_action('forums::category@index', array($category->slug, $category->id)) }}">{{ $category->title }}</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_action('forums::topic@index', array($topic->slug, $topic->id)) }}">{{ $topic->title }}</a> <span class="divider">/</span></li>
        <li>Modifier une réponse</li>
        </ul>
    </div>
</div>



	{{ Form::open(URL::to_action('forums::topic@edit', array($topic->slug, $topic->id, $message->id)), null, array('id'=>'edit_form', 'class'=>'form')) }}
    {{ Form::token() }}

    @if($topic->messages[0]->id == $message->id)
    <div class="control-group @if($errors->has('title'))error@endif">
        {{ Form::label('title', 'Titre : ')}}
        <div class="controls">
        {{ Form::text('title', Input::old('title', $topic->title), array('placeholder'=>'Veuillez insérer un titre', 'class'=>'span12', "autofocus"=>"autofocus")) }}
        {{ $errors->first('title', '<span class="help-inline">Veuillez insérer un titre</span>') }}
        </div>
    </div>
    @endif

    <div class="control-group @if($errors->has('content'))error@endif">
        {{ Form::label('content', 'Message : ')}}
        <div class="controls">
        {{ Form::textarea('content', Input::old('content', $message->content_bbcode), array('class'=>'span12')) }}
        {{ $errors->first('content', '<span class="help-inline">Veuillez insérer un message</span>') }}
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
        {{ Form::submit('Envoyer',array('class'=>'btn btn-primary')) }}
        </div>
    </div>

	{{ Form::close() }}
@endsection

@section('javascript')
{{ HTML::script(URL::to_asset('bundles/forums/jquery.sceditor.bbcode.min.js')) }}
{{ HTML::script(URL::to_asset('bundles/forums/languages/fr.js')) }}
<script>
$(function() {
    // Replace all textarea's
    // with SCEditor
    $("textarea").sceditor({
        plugins: "bbcode",
        height: 350,
        resizeWidth: false,
        dateFormat: "day/month/year",
        autoExpand: true,
		style: "{{ URL::to_asset('bundles/forums/jquery.sceditor.default.min.css') }}",
		emoticonsRoot: "{{ URL::to_asset('bundles/forums/') }}"
    });
});
</script>

@endsection