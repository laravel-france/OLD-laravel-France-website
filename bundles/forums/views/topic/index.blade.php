@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/forums/forums.css')) }}
@endsection

@section('title')
    {{ $topic->title }} - Forums de Laravel France
@endsection

@section('content')

<div class="row">
    <div class="span12">
        <ul class="breadcrumb">
        <li><a title="Retour à la page d'accueil" href="{{ URL::home() }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_action('forums::home@index') }}">Forums</a> <span class="divider">/</span></li>
        <li><a href="{{ URL::to_action('forums::category@index', array($category->slug, $category->id)) }}">{{ $category->title }}</a> <span class="divider">/</span></li>
        <li>
        @if($topic->sticky)<i class="icon-flag"></i> @endif<strong>{{ $topic->title }}</strong></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="span6">
        <div class="pull-left">
            {{ $pagination }}
        </div>
    </div>
    <div class="span6">
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
            <div class="info_posted">
                <small><em>
                    @if(!Auth::guest() && (Auth::user()->id == $message->user->id || Auth::user()->is('Forumer')))
                        <a href="{{ URL::to_action('forums::topic@edit', array($topic->slug, $topic->id, $message->id)) }}"><i class="icon-pencil"></i> Modifier</a>&nbsp;-&nbsp;
                    @endif
                    <a href="#message{{ $message->id }}">Posté le {{ date('d/m/Y - H:i:s', strtotime($message->created_at)) }}</a>
                </em></small>
            </div>

        	<div class="span3">
        		<div class="pull-left">
                    @if(!Auth::guest() && Auth::user()->id == $message->user->id)
                    <a href="{{ URL::to_action('panel::avatar@show') }}">
                    @endif
        			<img src="{{ $message->user->gravatar }}" class="img-polaroid" />
                    @if(!Auth::guest() && Auth::user()->id == $message->user->id)
                    </a>
                    @endif
        		</div>

        		<div class="userPres">
                    <strong>{{ $message->user->username }}</strong><br />
                    Inscrit le {{ date('d/m/Y', strtotime($message->user->created_at)) }}<br />
                    Messages : {{ $message->user->nb_messages }}
        		</div>
        	</div>

        	<div class="span9">
        		<div class="forum-message-content">
        			{{ $message->content }}
        		</div>
        	</div>
            <div class="replyZone">
                <div class="pull-right">
                    <small><em>
                    @if(!Auth::guest())
                        <a class="btn btn-small btn-success" href="{{ URL::to_action('forums::topic@reply', array($topic->slug, $topic->id)) }}?o={{ $message->id }}"><i class="icon-share-alt icon-white"></i> Citer</a>
                    @endif
                    </em></small>
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
    <div class="span6">
        <div class="pull-left">
            {{ $pagination }}
        </div>
    </div>
    <div class="span6">
        <div class="pull-right">
            @include('forums::partials.reply_topic')
        </div>
    </div>
</div>
@endsection



@section('javascript')
    @if(!Auth::guest() && Auth::user()->is('Forumer'))
    <script>
        $('.postit').click(function(event){
            if(!confirm('Mettre/enlever ce sujet du mode post it ?')) {
                event.preventDefault();
            }
        });
    </script>
    @endif
@endsection
