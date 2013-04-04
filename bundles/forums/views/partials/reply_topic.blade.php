@if(!Auth::guest() && Auth::user()->is('Forumer'))
	<a class="btn btn-info postit" href="{{ URL::to_action('forums::topic@toggle_sticky', array($category->slug, $topic->slug)) }}"><i class="icon-flag"></i> @if($topic->sticky)Détacher@elsePost It@endif</a>
@endif

<a class="btn btn-success" href="{{ URL::to_action('forums::topic@reply', array($category->slug, $topic->slug)) }}"><i class="icon-share-alt icon-white"></i> Répondre</a>