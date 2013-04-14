@layout('main')

@section('title')
	@if(is_null($user))
	Profil non trouvé
	@else
	Profil de {{ $user->username }} sur Laravel France
	@endif
@endsection

@section('content')
	@if(is_null($user))
	<h2>Profil non trouvé</h2>
	@else
	<h1>Profil de {{ $user->username }}</h1>

	<div class="row">
		<div class="span2">
			<div>
				<img class="img-polaroid" src="{{ $user->get_gravatar(270) }}" alt="{{ $user->username }} avatar" />
			</div>

			<div style="text-align:center; margin-top:3px">
				@if($user->github_url)
			        <a class="btn btn-small btn-github" href="{{ $user->github_url }}" data-toggle="tooltip" data-placement="bottom" title="Voir le profil Github de {{ $user->username }}" target="_blank">
			            <i class="icon-github"></i>
			        </a>
			    @endif
				@if($user->twitter_url)
			        <a class="btn btn-small btn-twitter" href="{{ $user->twitter_url }}" data-toggle="tooltip" data-placement="bottom" title="Voir le profil Twitter de {{ $user->username }}" target="_blank">
			            <i class="icon-twitter"></i>
			        </a>
			    @endif
				@if($user->google_url)
			        <a class="btn btn-small btn-google" href="{{ $user->google_url }}" data-toggle="tooltip" data-placement="bottom" title="Voir le profil Google+ de {{ $user->username }}" target="_blank">
			            <i class="icon-google-plus-sign"></i>
			        </a>
			    @endif
			</div>
			<div style="margin-top: 15px;">
				<strong>Inscrit le : </strong>{{ date('d/m/Y', strtotime($user->created_at)) }}<br />
				<strong>Messages : </strong>{{ intval($user->nb_messages) }}
			</div>
		</div>

		<div class="offset1 span9">

		    <ul class="nav nav-tabs" id="myTab">
		      	<li class="active"><a href="#forums" data-toggle="tab">Forums</a></li>
				@if($user->github_url)
		      		<li><a href="#profilegithub" data-toggle="tab">Github</a></li>
		      	@endif
		    </ul>

    		<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade in active" id="forums">
					<h3>Derniers messages sur les forums :</h3>
					<table class="table table-condensed">
					@forelse($user_messages as $message)
						<tr style="background-color: #eee">
							<td>
								Dans <strong><a href="{{ URL::to_action('forums::topic@index', array($message->topic->slug, $message->topic->id)) }}">{{ $message->topic->title }}</a></strong>,
								Le </strong>{{ date('d/m/Y à H:i:s', strtotime($message->created_at)) }}<br />
							</td>
						</tr>
						<tr>
							<td>
								{{ $message->content }}
							</td>
						</tr>
					@empty
						<tr>
							<td>
								Aucun message sur le forum
							</td>
						</tr>
					@endforelse
					</table>
				</div>

				@if($user->github_url)
				<div class="tab-pane fade" id="profilegithub">
					<h3>Activité sur Github :</h3>
					<div id="githublist">
						Chargement...
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>


	@endif
@endsection

@section('javascript')
<script>
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
	
		@if($user->github_url)
			$.get("{{ URL::to_action('panel::profile@github', array($user->username)) }}", null, function(content){
				$("#githublist").html(content);

				$("#githublist a").each(function(){
					$(this).attr('href', 'https://github.com' + $(this).attr('href'));
				})
			}, 'html');

		$("#githublist").on({
			click: function(event) {
				event.preventDefault();
				window.open($(this).attr('href'));
			}
		}, 'a')
		@endif
    });
</script>
@endsection