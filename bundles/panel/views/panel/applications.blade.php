@layout('panel::panel.layout')

@section('panel_content')
	<h1>Applications</h1>

	<p>
		<a class="btn btn-github @if(isset($have_github))
		disabled
		@endif" href="{{ URL::to('oneauth/session/github') }}">
			<i class="icon-github"></i> Lier mon compte Github
		</a>
	</p>
	<p>
		<a class="btn btn-twitter @if(isset($have_twitter))
		disabled
		@endif" href="{{ URL::to('oneauth/session/twitter') }}">
			<i class="icon-twitter"></i> Lier mon compte Twitter
		</a>
	</p>
	<p>
		<a class="btn btn-google @if(isset($have_google))
		disabled
		@endif" href="{{ URL::to('oneauth/session/google') }}">
			<i class="icon-google-plus-sign"></i> Lier mon compte Google
		</a>
	</p>
@endsection

@section('javascript')

<script>
$("a.disabled").click(function(e){
	e.preventDefault();
})
</script>

@endsection