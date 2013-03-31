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
        <li><a href="{{ URL::to_action('forums::category@index', array($category->id, $category->slug)) }}">{{ $category->title }}</a> <span class="divider">/</span></li>
        <li>Créer un sujet</li>
        </ul>
    </div>
</div>



	{{ Form::open(URL::to_action('forums::topic@create', array($category->id, $category->slug)), null, array('id'=>'new_reply_form', 'class'=>'form')) }}
    {{ Form::token() }}

    <div class="control-group @if($errors->has('title'))error@endif">
        {{ Form::label('title', 'Titre : ')}}
        <div class="controls">
        {{ Form::text('title', Input::old('title', null), array('placeholder'=>'Veuillez insérer un titre', 'class'=>'span12', "autofocus"=>"autofocus")) }}
        {{ $errors->first('title', '<span class="help-inline">Veuillez insérer un titre</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('content'))error@endif">
        {{ Form::label('content', 'Message : ')}}
        <div class="controls">
        {{ Form::textarea('content', Input::old('content', null), array('class'=>'span12')) }}
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