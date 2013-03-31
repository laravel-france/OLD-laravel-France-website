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
        <li><a href="{{ URL::to_action('forums::category@index', array($category->slug)) }}">{{ $category->title }}</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_action('forums::topic@index', array($category->slug, $topic->slug)) }}">{{ $topic->title }}</a> <span class="divider">/</span></li>
        <li>Écrire une réponse</li>
        </ul>
    </div>
</div>



	{{ Form::open(URL::to_action('forums::topic@reply', array($category->slug, $topic->slug)), null, array('id'=>'new_reply_form', 'class'=>'form')) }}
    {{ Form::token() }}

	<div class="control-group @if($errors->has('content'))error@endif">
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

	<h3>Les derniers messages...</h3>

<div id="message_list" style="height:250px; overflow: auto;">
    <?php
        $total = count($messages);
        $i = 0;
    ?>
    @foreach($messages as $k => $message)
    <?php $i++; ?>
    <div class="row">
        <div class="forum-message span12 @if(!($k%2))bg1@elsebg2@endif"> 
            <div class="info_posted"><small><em><a href="#">Posté le {{ date('d/m/Y - H:i:s', strtotime($message->created_at)) }}</a></em></small></div>

        	<div class="span3">
        		<div class="pull-left">
        			<img src="{{ $message->user->gravatar }}" class="img-polaroid" />
        		</div>

        		<div style="padding:10px; margin-left: 90px;">
        			<strong>{{ $message->user->username }}</strong><br />
        			Inscrit le {{ date('d/m/Y', strtotime($message->user->created_at)) }}<br />
        			Message : {{ $message->user->nb_messages }}
        		</div>
        	</div>

        	<div class="span9">
        		<div class="forum-message-content" style="padding:10px;">
        			{{ $message->content }}
        		</div>
        	</div>
        </div>
    </div>

    @if($i != $total)
    <div class="row">
        <div class="span12"> 
            <div class="forum-message-sep"></div>
        </div>
    </div>
    @endif

    @endforeach
</div>

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
        autofocus: true,
        autoExpand: true,
		style: "{{ URL::to_asset('bundles/forums/jquery.sceditor.default.min.css') }}",
		emoticonsRoot: "{{ URL::to_asset('bundles/forums/') }}"
    });
});
</script>

@endsection