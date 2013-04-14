@forelse($news as $line)
	{{ $line->content }}
@empty
	<strong>Aucune activité</strong>
@endforelse
<style>
#githublist .mega-icon, #githublist .time, #githublist .details {
    display: none;
}
</style>