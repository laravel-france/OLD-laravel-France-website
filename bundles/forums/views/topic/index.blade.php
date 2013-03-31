@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/forums/forums.css')) }}
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
        <li>{{ $topic->title }}</li>
        <li class="pull-right">Page 1</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="span12">
        <div class="pull-right">
            @include('forums::partials.reply_topic')
        </div>
    </div>
</div>

<div id="message_list">
    <?php
        $total = count($messages);
        $i = 0;
    ?>
    @foreach($messages as $k => $message)
    <?php $i++; ?>
    <a name="message{{ $message->id }}"></a>
    <div class="row">
        <div class="forum-message span12 @if(!($k%2))bg1@elsebg2@endif"> 
            <div class="info_posted"><small><em><a href="#message{{ $message->id }}">Posté le {{ date('d/m/Y - H:i:s', strtotime($message->created_at)) }}</a></em></small></div>

        	<div class="span3">
        		<div class="pull-left">
        			<img src="{{ $message->user->gravatar }}" class="img-polaroid" />
        		</div>

        		<div style="padding:10px; margin-left: 90px;">
                    <strong>{{ $message->user->username }}</strong><br />
                    Inscrit le {{ date('d/m/Y', strtotime($message->user->created_at)) }}<br />
                    Messages : {{ $message->user->nb_messages }}
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


<div class="row">
    <div class="span12">
        <div class="pull-right">
            @include('forums::partials.reply_topic')
        </div>
    </div>
</div>
@endsection