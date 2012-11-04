@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/blog/css/blog.css')) }}
@endsection

@section('title')
    {{ $post->title }} - Le blog Laravel France
@endsection

@section('content')

<div class="row">
    <div class="span12">
        <div class="single well">

            <div class="p-time">
                <strong class="day">{{ $post->created_at->format('d') }}</strong>
                <strong class="month-year">{{ $post->created_at->format('M') }}<br>{{ $post->created_at->format('Y') }}</strong>
            </div>
                        
            <h1 id="post-{{$post->id}}" class="postTitle">
                <a href="{{ URL::to_action('blog::home@show',array($post->id, $post->slug)) }}" rel="bookmark">
                    {{ $post->title }}
                </a>
            </h1>
                        
            <div class="entry">
                <div class="texty">
                    {{ $post->content }}
                </div>

                <p class="postmetadata"><small>Catégorie : <a href="LIEN-CAT" rel="category">{{ $post->category->name }}</a>

            </div>
        </div>






        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'laravelfr'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        










    </div>
</div>
@endsection

<script type="text/javascript">
/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
var disqus_shortname = 'laravelfr'; // required: replace example with your forum shortname

/* * * DON'T EDIT BELOW THIS LINE * * */
(function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>